<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'tb_barang';
    protected $primaryKey = 'barang_id';
    protected $allowedFields = [
        'barang_id',
        'nama_barang',
        'merek',
        'kondisi',
        'catatan',
        'jumlah_stok',
        'user_id',
        'kategori_id',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = false;

    /**
     * Validasi barang_id
     *
     * @param array $barangIds
     * @return bool
     */
    public function validateBarangIds(array $barangIds): bool
    {
        foreach ($barangIds as $barangId) {
            if (!$this->find($barangId)) {
                return false; 
            }
        }
        return true; 
    }

    public function updateStock($id, $jumlahStokBaru)
    {
        log_message('info', 'Update stok barang_id: ' . $id . ' ke jumlah_stok: ' . $jumlahStokBaru);
        return $this->update($id, ['jumlah_stok' => $jumlahStokBaru]);
    }

}
