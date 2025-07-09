<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'laporan_penjualan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis_minuman', 'tanggal', 'catatan', 'jumlah_terjual', 'user_id', 'created_at'];
}
