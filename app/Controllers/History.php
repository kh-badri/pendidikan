<?php

namespace App\Controllers;

use App\Models\HistoryModel;

class History extends BaseController
{
    protected $historyModel;

    public function __construct()
    {
        $this->historyModel = new HistoryModel();
    }

    // Menampilkan seluruh daftar arsip (Memanggil file index.php)
    public function index()
    {
        return view('history/index', [
            'title'   => 'Daftar History Analisis',
            'active_menu'  => 'history',
            'history' => $this->historyModel->orderBy('created_at', 'DESC')->findAll()
        ]);
    }

    // Menampilkan detail item arsip tunggal berdasar ID (Memanggil file detail.php)
    public function detail($id)
    {
        $dataArchive = $this->historyModel->find($id);

        if (!$dataArchive) {
            return redirect()->to('/history')->with('error', 'Data arsip tidak ditemukan!');
        }

        return view('history/detail', [
            'title'   => 'Detail Arsip #' . $id,
            'history' => $dataArchive
        ]);
    }
}
