<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TokohModel;

class Dataset extends BaseController
{
    protected $tokohModel;

    public function __construct()
    {
        $this->tokohModel = new TokohModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Manajemen Dataset Tokoh Sukses',
            'dataset'     => $this->tokohModel->findAll(),
            'active_menu' => 'dataset'
        ];

        return view('dataset/index', $data);
    }

    public function save()
    {
        // Validasi ditambah variabel lokasi_institusi (1: Dalam Negeri, 2: Luar Negeri)
        $rules = [
            'nama_tokoh'          => 'required',
            'jenis_institusi'     => 'required|in_list[1,2]',
            'pendidikan_terakhir' => 'required|in_list[1,2,3,4,5]',
            'jurusan_prodi'       => 'required|in_list[1,2,3,4,5,6,7,8,9]',
            'lokasi_institusi'    => 'required|in_list[1,2]',
            'lama_selesai'        => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/dataset')->withInput()->with('error', 'Validasi gagal. Pastikan semua kolom terisi dengan benar.');
        }

        // Simpan ke Database
        $this->tokohModel->save([
            'nama_tokoh'          => $this->request->getPost('nama_tokoh'),
            'jenis_institusi'     => $this->request->getPost('jenis_institusi'),
            'pendidikan_terakhir' => $this->request->getPost('pendidikan_terakhir'),
            'jurusan_prodi'       => $this->request->getPost('jurusan_prodi'),
            'lokasi_institusi'    => $this->request->getPost('lokasi_institusi'),
            'lama_selesai'        => $this->request->getPost('lama_selesai'),
        ]);

        return redirect()->to('/dataset')->with('success', 'Data tokoh berhasil ditambahkan!');
    }

    public function upload()
    {
        $validationRule = [
            'file_csv' => [
                'label' => 'File CSV',
                'rules' => 'uploaded[file_csv]|ext_in[file_csv,csv]|max_size[file_csv,2048]',
            ],
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->to('/dataset')->withInput()->with('error', 'File tidak valid atau ukuran terlalu besar.');
        }

        $file = $this->request->getFile('file_csv');
        if (!$file->isValid() || $file->hasMoved()) {
            return redirect()->to('/dataset')->with('error', 'Terjadi masalah saat mengupload file.');
        }

        $filePath = $file->getRealPath();
        $fileContent = file($filePath);
        $csvData = array_map('str_getcsv', $fileContent);

        // Hapus Header CSV
        array_shift($csvData);

        $dataToInsert = [];
        foreach ($csvData as $row) {
            // Sekarang minimal 7 kolom: No, Nama, Inst, Pend, Prodi, Lama, Lokasi
            if (count($row) < 7) {
                continue;
            }

            $dataToInsert[] = [
                'nama_tokoh'          => trim($row[1]),
                'jenis_institusi'     => trim($row[2]),
                'pendidikan_terakhir' => trim($row[3]),
                'jurusan_prodi'       => trim($row[4]),
                'lama_selesai'        => trim($row[5]),
                'lokasi_institusi'    => trim($row[6]), // Kolom ke-7 (Index 6)
            ];
        }

        if (!empty($dataToInsert)) {
            try {
                $insertedCount = $this->tokohModel->insertBatch($dataToInsert);
                return redirect()->to('/dataset')->with('success', "Import Selesai! {$insertedCount} data tokoh berhasil masuk.");
            } catch (\Exception $e) {
                return redirect()->to('/dataset')->with('error', 'Error Database: ' . $e->getMessage());
            }
        }

        return redirect()->to('/dataset')->with('error', 'File CSV kosong atau tidak sesuai format.');
    }

    public function update($id = null)
    {
        $rules = [
            'nama_tokoh'          => 'required',
            'jenis_institusi'     => 'required|in_list[1,2]',
            'pendidikan_terakhir' => 'required|in_list[1,2,3,4,5]',
            'jurusan_prodi'       => 'required|in_list[1,2,3,4,5,6,7,8,9]',
            'lokasi_institusi'    => 'required|in_list[1,2]',
            'lama_selesai'        => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Update gagal. Pastikan data valid.');
        }

        $this->tokohModel->update($id, [
            'nama_tokoh'          => $this->request->getPost('nama_tokoh'),
            'jenis_institusi'     => $this->request->getPost('jenis_institusi'),
            'pendidikan_terakhir' => $this->request->getPost('pendidikan_terakhir'),
            'jurusan_prodi'       => $this->request->getPost('jurusan_prodi'),
            'lokasi_institusi'    => $this->request->getPost('lokasi_institusi'),
            'lama_selesai'        => $this->request->getPost('lama_selesai'),
        ]);

        return redirect()->to('/dataset')->with('success', 'Data tokoh berhasil diperbarui!');
    }

    public function hapusSemua()
    {
        try {
            $this->tokohModel->truncate();
            return redirect()->to('/dataset')->with('success', "Semua dataset tokoh berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->to('/dataset')->with('error', 'Gagal hapus: ' . $e->getMessage());
        }
    }

    public function delete($id = null)
    {
        $this->tokohModel->delete($id);
        return redirect()->to('/dataset')->with('success', 'Data tokoh berhasil dihapus.');
    }
}
