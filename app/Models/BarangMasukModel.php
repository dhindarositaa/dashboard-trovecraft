<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table      = 'tb_barangmasuk';
    protected $primaryKey = 'barangmasuk_id';
    protected $allowedFields = [
        'barangmasuk_id',
        'nama_barang',
        'merek',
        'kondisi',
        'catatan',
        'jumlah_stok',
        'kategori_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
