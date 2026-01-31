<?php

namespace App\Controllers;

use App\Models\TokohModel;
use App\Models\HistoryModel;

class Home extends BaseController
{
    protected $tokohModel;
    protected $historyModel;

    public function __construct()
    {
        // Inisialisasi model untuk mengambil data statistik
        $this->tokohModel = new TokohModel();
        $this->historyModel = new HistoryModel();
    }

    public function index()
    {
        // Menghitung total data untuk ditampilkan di kartu statistik Home
        $data = [
            'title'        => 'Dashboard Analis K-Means',
            'active_menu'  => 'home',
            'total_tokoh'  => $this->tokohModel->countAllResults(),
            'total_history' => $this->historyModel->countAllResults(),
        ];

        return view('home/index', $data);
    }
}
