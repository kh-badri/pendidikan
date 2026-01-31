<?php

namespace App\Controllers;

use App\Models\TokohModel;
use App\Models\HistoryModel; // Tambahkan model history

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
            'title' => 'Konfigurasi Clustering',
            'active_menu' => 'prediksi'
        ]);
    }

    public function proses()
    {
        $k = $this->request->getPost('k_value');
        if (!$k) return redirect()->to('/prediksi');

        $dataset = $this->tokohModel->findAll();
        if (count($dataset) < $k) {
            return redirect()->back()->with('error', 'Jumlah data tidak mencukupi!');
        }

        // --- LOGIKA K-MEANS ---
        $centroids = [];
        $randomKeys = array_rand($dataset, $k);
        foreach ((array)$randomKeys as $key) {
            $centroids[] = [
                'jenis_institusi'     => $dataset[$key]['jenis_institusi'],
                'lokasi_institusi'    => $dataset[$key]['lokasi_institusi'],
                'pendidikan_terakhir' => $dataset[$key]['pendidikan_terakhir'],
                'jurusan_prodi'       => $dataset[$key]['jurusan_prodi'],
                'lama_selesai'        => $dataset[$key]['lama_selesai'],
            ];
        }

        $isConverged = false;
        $iterasi = 0;
        $maxIterasi = 100;
        $hasilClustering = [];

        while (!$isConverged && $iterasi < $maxIterasi) {
            $iterasi++;
            $clusters = array_fill(0, $k, []);
            $newHasilClustering = [];

            foreach ($dataset as $data) {
                $distances = [];
                for ($i = 0; $i < $k; $i++) {
                    $distances[$i] = $this->hitungEuclidean($data, $centroids[$i]);
                }

                $clusterIndex = array_keys($distances, min($distances))[0];
                $data['distances'] = $distances;
                $data['cluster']   = $clusterIndex;
                $clusters[$clusterIndex][] = $data;
                $newHasilClustering[] = $data;
            }

            $newCentroids = [];
            for ($i = 0; $i < $k; $i++) {
                $newCentroids[$i] = count($clusters[$i]) > 0 ? $this->hitungRataRata($clusters[$i]) : $centroids[$i];
            }

            if ($newCentroids === $centroids) {
                $isConverged = true;
            } else {
                $centroids = $newCentroids;
            }
            $hasilClustering = $newHasilClustering;
        }

        // --- DATA UNTUK VIEW ---
        $data = [
            'title'         => 'Hasil Clustering',
            'active_menu'   => 'prediksi',
            'k_value'       => $k,
            'iterasi_ke'    => $iterasi,
            'centroids'     => $centroids,
            'dataset_hasil' => $hasilClustering,
            // Simpan detail ke JSON untuk dikirim ke hidden input saat simpan history
            'detail_json'   => json_encode([
                'centroids' => $centroids,
                'hasil'     => $hasilClustering
            ])
        ];

        return view('prediksi/hasil', $data);
    }

    public function simpan()
    {
        // Load model history di construct atau secara langsung
        $historyModel = new \App\Models\HistoryModel();

        $historyModel->save([
            'k_value'     => $this->request->getPost('k_value'),
            'iterasi'     => $this->request->getPost('iterasi'),
            'detail_json' => $this->request->getPost('detail_json'),
        ]);

        return redirect()->to('/history')->with('success', 'Analisis berhasil diarsipkan ke dalam history.');
    }

    private function hitungEuclidean($data, $centroid)
    {
        $sum = pow(($data['jenis_institusi'] - $centroid['jenis_institusi']), 2) +
            pow(($data['lokasi_institusi'] - $centroid['lokasi_institusi']), 2) +
            pow(($data['pendidikan_terakhir'] - $centroid['pendidikan_terakhir']), 2) +
            pow(($data['jurusan_prodi'] - $centroid['jurusan_prodi']), 2) +
            pow(($data['lama_selesai'] - $centroid['lama_selesai']), 2);
        return sqrt($sum);
    }

    private function hitungRataRata($clusterData)
    {
        $count = count($clusterData);
        $sums = ['jenis_institusi' => 0, 'lokasi_institusi' => 0, 'pendidikan_terakhir' => 0, 'jurusan_prodi' => 0, 'lama_selesai' => 0];
        foreach ($clusterData as $d) {
            foreach ($sums as $key => $val) {
                $sums[$key] += $d[$key];
            }
        }
        return array_map(fn($v) => $v / $count, $sums);
    }
}
