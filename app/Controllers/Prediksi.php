<?php

namespace App\Controllers;

use App\Models\TokohModel;
use App\Models\HistoryModel;

class Prediksi extends BaseController
{
    protected $tokohModel;
    protected $historyModel;

    public function __construct()
    {
        $this->tokohModel = new TokohModel();
        $this->historyModel = new HistoryModel();
    }

    public function index()
    {
        return view('prediksi/index', [
            'title'       => 'Input Data Prediksi Tokoh',
            'active_menu' => 'prediksi'
        ]);
    }

    public function proses()
    {
        // 1. Ambil Nilai K dan Data Baru dari Form Input
        $k = (int)($this->request->getPost('k_value') ?: 3);

        $dataBaru = [
            'nama_tokoh'          => $this->request->getPost('nama_tokoh') ?: 'Data Uji Baru',
            'jenis_institusi'     => (float)$this->request->getPost('jenis_institusi'),
            'pendidikan_terakhir' => (float)$this->request->getPost('pendidikan_terakhir'),
            'jurusan_prodi'       => (float)$this->request->getPost('jurusan_prodi'),
            'lama_selesai'        => (float)$this->request->getPost('lama_selesai'),
            'lokasi_institusi'    => (float)$this->request->getPost('lokasi_institusi'),
        ];

        if (!$k) return redirect()->to('/prediksi');

        $dataset = $this->tokohModel->findAll();
        if (count($dataset) < $k) {
            return redirect()->back()->with('error', 'Jumlah data dataset tidak mencukupi!');
        }

        // --- TITIK PUSAT KLASTER ACUAN (CENTROID SKRIPSI) ---
        // Sesuai standar acuan skripsi Bab 4:
        // Nilai A: Jenis Institusi, B: Pendidikan Terakhir, C: Program Studi, D: Lama Pendidikan, E: Lokasi Institusi
        // C1: A=1,   B=2,   C=2, D=2,   E=1
        // C2: A=1.5, B=3.5, C=5, D=3.5, E=1.5
        // C3: A=2,   B=5,   C=8, D=5,   E=2
        $defaultCentroids = [
            [
                'cluster_code'        => 'C1',
                'label'               => 'Cluster 1',
                'jenis_institusi'     => 1.0,
                'pendidikan_terakhir' => 2.0,
                'jurusan_prodi'       => 2.0,
                'lama_selesai'        => 2.0,
                'lokasi_institusi'    => 1.0,
            ],
            [
                'cluster_code'        => 'C2',
                'label'               => 'Cluster 2',
                'jenis_institusi'     => 1.5,
                'pendidikan_terakhir' => 3.5,
                'jurusan_prodi'       => 5.0,
                'lama_selesai'        => 3.5,
                'lokasi_institusi'    => 1.5,
            ],
            [
                'cluster_code'        => 'C3',
                'label'               => 'Cluster 3',
                'jenis_institusi'     => 2.0,
                'pendidikan_terakhir' => 5.0,
                'jurusan_prodi'       => 8.0,
                'lama_selesai'        => 5.0,
                'lokasi_institusi'    => 2.0,
            ],
        ];

        if ($k === 3) {
            $centroids = $defaultCentroids;
        } elseif ($k === 2) {
            $centroids = [$defaultCentroids[0], $defaultCentroids[2]];
        } else {
            $centroids = array_slice($defaultCentroids, 0, $k);
            while (count($centroids) < $k) {
                $idx = count($centroids);
                $centroids[] = [
                    'cluster_code'        => 'C' . ($idx + 1),
                    'label'               => 'Cluster ' . ($idx + 1),
                    'jenis_institusi'     => 1.0 + ($idx * 0.25),
                    'pendidikan_terakhir' => 2.0 + ($idx * 0.75),
                    'jurusan_prodi'       => 2.0 + ($idx * 1.5),
                    'lama_selesai'        => 2.0 + ($idx * 0.75),
                    'lokasi_institusi'    => 1.0 + ($idx * 0.25),
                ];
            }
        }

        // --- PERHITUNGAN EUCLIDEAN DISTANCE PADA DATASET UTAMA ---
        // Menghitung jarak setiap data tokoh terhadap C1, C2, C3 dan memilih jarak minimum
        $hasilClustering = [];
        foreach ($dataset as $row) {
            $distances = [];
            for ($i = 0; $i < $k; $i++) {
                $distances[$i] = $this->hitungEuclidean($row, $centroids[$i]);
            }
            $minDistance = min($distances);
            $clusterIndex = array_search($minDistance, $distances);

            $row['distances'] = $distances;
            $row['cluster']   = $clusterIndex;
            $hasilClustering[] = $row;
        }

        // --- PERHITUNGAN PREDIKSI UNTUK DATA BARU ---
        $jarakDataBaru = [];
        $langkahHitung = [];
        for ($i = 0; $i < $k; $i++) {
            $c = $centroids[$i];

            // Selisih nilai (x - c)
            $diffA = (float)$dataBaru['jenis_institusi'] - (float)$c['jenis_institusi'];
            $diffB = (float)$dataBaru['pendidikan_terakhir'] - (float)$c['pendidikan_terakhir'];
            $diffC = (float)$dataBaru['jurusan_prodi'] - (float)$c['jurusan_prodi'];
            $diffD = (float)$dataBaru['lama_selesai'] - (float)$c['lama_selesai'];
            $diffE = (float)$dataBaru['lokasi_institusi'] - (float)$c['lokasi_institusi'];

            // Kuadrat selisih
            $sqA = pow($diffA, 2);
            $sqB = pow($diffB, 2);
            $sqC = pow($diffC, 2);
            $sqD = pow($diffD, 2);
            $sqE = pow($diffE, 2);

            $sumSq = $sqA + $sqB + $sqC + $sqD + $sqE;
            $dist  = sqrt($sumSq);

            $jarakDataBaru[$i] = $dist;
            $langkahHitung[$i] = [
                'cluster_code' => 'C' . ($i + 1),
                'centroid'     => $c,
                'diff'         => ['a' => $diffA, 'b' => $diffB, 'c' => $diffC, 'd' => $diffD, 'e' => $diffE],
                'sq'           => ['a' => $sqA, 'b' => $sqB, 'c' => $sqC, 'd' => $sqD, 'e' => $sqE],
                'sum'          => $sumSq,
                'dist'         => $dist,
                'dist_rounded' => round($dist, 2),
            ];
        }

        $minJarakBaru = min($jarakDataBaru);
        $clusterTerpilih = array_search($minJarakBaru, $jarakDataBaru);
        $dataBaru['cluster_prediksi'] = $clusterTerpilih;
        $dataBaru['distances']        = $jarakDataBaru;
        $dataBaru['langkah_hitung']   = $langkahHitung;

        // Penentuan Status Prediksi
        $clusterStatuses = [
            0 => 'C1 (POLA 1)',
            1 => 'C2 (POLA 2)',
            2 => 'C3 (POLA 3)',
        ];
        $dataBaru['status_prediksi'] = $clusterStatuses[$clusterTerpilih] ?? ('CLUSTER ' . ($clusterTerpilih + 1));

        // --- DATA UNTUK VIEW ---
        $data = [
            'title'            => 'Hasil Prediksi Klaster',
            'active_menu'      => 'prediksi',
            'k_value'          => $k,
            'iterasi_ke'       => 1,
            'centroids'        => $centroids,
            'data_baru'        => $dataBaru,
            'dataset_hasil'    => $hasilClustering,
            'cluster_statuses' => $clusterStatuses,
            'detail_json'      => json_encode([
                'centroids'        => $centroids,
                'data_prediksi'    => $dataBaru,
                'hasil'            => $hasilClustering,
                'cluster_statuses' => $clusterStatuses
            ])
        ];

        return view('prediksi/hasil', $data);
    }

    public function simpan()
    {
        $this->historyModel->save([
            'k_value'     => $this->request->getPost('k_value'),
            'iterasi'     => $this->request->getPost('iterasi'),
            'detail_json' => $this->request->getPost('detail_json'),
        ]);

        return redirect()->to('/history')->with('success', 'Analisis dan Prediksi berhasil diarsipkan.');
    }

    private function hitungEuclidean($data, $centroid)
    {
        // Persamaan Euclidean Distance:
        // d = sqrt( (a1-a2)^2 + (b1-b2)^2 + (c1-c2)^2 + (d1-d2)^2 + (e1-e2)^2 )
        $sum = pow(((float)$data['jenis_institusi'] - (float)$centroid['jenis_institusi']), 2) +
            pow(((float)$data['pendidikan_terakhir'] - (float)$centroid['pendidikan_terakhir']), 2) +
            pow(((float)$data['jurusan_prodi'] - (float)$centroid['jurusan_prodi']), 2) +
            pow(((float)$data['lama_selesai'] - (float)$centroid['lama_selesai']), 2) +
            pow(((float)$data['lokasi_institusi'] - (float)$centroid['lokasi_institusi']), 2);
        return sqrt($sum);
    }

    private function hitungRataRata($clusterData)
    {
        $count = count($clusterData);
        $sums = [
            'jenis_institusi'     => 0,
            'pendidikan_terakhir' => 0,
            'jurusan_prodi'       => 0,
            'lama_selesai'        => 0,
            'lokasi_institusi'    => 0
        ];
        foreach ($clusterData as $d) {
            foreach ($sums as $key => $val) {
                $sums[$key] += (float)$d[$key];
            }
        }
        return array_map(fn($v) => $v / $count, $sums);
    }
}
