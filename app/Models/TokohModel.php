<?php

namespace App\Models;

use CodeIgniter\Model;

class TokohModel extends Model
{
    protected $table            = 'tokoh_sukses';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nama_tokoh',
        'jenis_institusi',
        'pendidikan_terakhir',
        'jurusan_prodi',
        'lama_selesai',
        'lokasi_institusi',
        'cluster_hasil'
    ];
}
