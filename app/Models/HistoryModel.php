<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    // Nama tabel di database sesuai dengan SQL yang kita buat sebelumnya
    protected $table            = 'history';

    // Primary key dari tabel
    protected $primaryKey       = 'id';

    // Mengizinkan ID untuk auto increment
    protected $useAutoIncrement = true;

    // Format hasil return (array lebih fleksibel untuk diproses JSON nantinya)
    protected $returnType       = 'array';

    // Nama-nama kolom yang diizinkan untuk diisi (Mass Assignment)
    // Sangat penting untuk menyertakan k_value, iterasi, dan detail_json
    protected $allowedFields    = [
        'k_value',
        'iterasi',
        'detail_json'
    ];

    // Mengaktifkan fitur pencatatan waktu otomatis
    protected $useTimestamps    = true;

    // Nama kolom timestamp di database
    protected $createdField     = 'created_at';
    protected $updatedField     = ''; // Kita tidak butuh updated_at untuk history analisis
}
