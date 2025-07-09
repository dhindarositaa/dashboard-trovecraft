<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarModel extends Model
{
    protected $table = 'tb_barangkeluar';
    protected $primaryKey = 'barangkeluar_id';
    protected $allowedFields = [
        'barangkeluar_id',
        'nama_barang',
        'merek',
        'kondisi',
        'catatan',
        'jumlah_stok',
        'user_id',
        'kategori_id',
        'dikeluarkan_oleh',
        'created_at',
        'updated_at'
    ];
}
