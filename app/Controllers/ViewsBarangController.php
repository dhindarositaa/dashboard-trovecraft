<?php

namespace App\Controllers;

use App\Models\BarangModel;

class ViewsBarangController extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function views()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $barang = $this->barangModel->select('tb_barang.*, kategori.nama_kategori')
            ->join('kategori', 'tb_barang.kategori_id = kategori.kategori_id', 'left')
            ->findAll();

        return view('dashboard/viewsbarang', ['barang' => $barang]);
    }

    public function search()
    {
        $query = $this->request->getGet('q');
        $barang = $this->barangModel
            ->select('tb_barang.*, kategori.nama_kategori')
            ->join('kategori', 'tb_barang.kategori_id = kategori.kategori_id', 'left')
            ->like('nama_barang', $query)
            ->orLike('merek', $query)
            ->findAll();

        return view('dashboard/viewsbarang', [
            'barang' => $barang,
            'q' => $query
        ]);
    }

    public function detail($barangId)
    {
        $barang = $this->barangModel->select('tb_barang.*, kategori.nama_kategori')
            ->join('kategori', 'tb_barang.kategori_id = kategori.kategori_id', 'left')
            ->find($barangId);

        if (!$barang) {
            return redirect()->to('/barang')->with('error', 'Barang tidak ditemukan.');
        }

        $data = [
            'barang' => $barang
        ];

        return view('dashboard/detailbarang', $data);
    }
}
