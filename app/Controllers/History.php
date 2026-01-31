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

    public function index()
    {
        return view('history/index', [
            'title'   => 'History Analisis',
            'history' => $this->historyModel->orderBy('created_at', 'DESC')->findAll(),
            'active_menu' => 'history'
        ]);
    }

    public function detail($id)
    {
        $dataHistory = $this->historyModel->find($id);
        $detail = json_decode($dataHistory['detail_json'], true);

        return view('prediksi/hasil', [
            'title'         => 'Detail History Analisis',
            'k_value'       => $dataHistory['k_value'],
            'iterasi_ke'    => $dataHistory['iterasi'],
            'centroids'     => $detail['centroids'],
            'dataset_hasil' => $detail['hasil'],
            'detail_json'   => $dataHistory['detail_json'],
            'is_history'    => true // Flag agar tombol "Simpan" di view hasil bisa disembunyikan
        ]);
    }

    public function delete($id)
    {
        $this->historyModel->delete($id);
        return redirect()->to('/history')->with('success', 'Riwayat berhasil dihapus.');
    }
}
