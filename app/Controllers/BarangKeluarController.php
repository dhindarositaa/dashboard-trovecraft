<?php

namespace App\Controllers;

use App\Models\BarangKeluarModel;
use App\Models\BarangModel;
use App\Models\KategoriModel;

class BarangKeluarController extends BaseController
{
    protected $barangKeluarModel;
    protected $barangModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->barangKeluarModel = new BarangKeluarModel();
        $this->barangModel = new BarangModel(); 
        $this->kategoriModel = new KategoriModel(); 
    }

    public function index()
    {
        $barangkeluar = $this->barangKeluarModel
        ->select('tb_barangkeluar.*, users.first_name')
        ->join('users', 'users.user_id = tb_barangkeluar.user_id', 'left')
        ->findAll();

        return view('dashboard/viewsbarangkeluar', ['barangkeluar' => $barangkeluar]);
    }

    public function add()
    {
        $data = [
            'kategori' => $this->kategoriModel->findAll(),
            'barang' => $this->barangModel->findAll()
        ];

        return view('dashboard/tambahbarangkeluar', $data);
    }

    public function save()
    {
        $namaBarang = $this->request->getPost('nama_barang');
        $jumlahStok = (int) $this->request->getPost('jumlah_stok');

        $barang = $this->barangModel->where('nama_barang', $namaBarang)->first();

        if (!$barang || $jumlahStok > $barang['jumlah_stok']) {
            return redirect()->back()->withInput()->with('error', 'Stok tidak mencukupi atau barang tidak valid.');
        }

        $dataKeluar = [
            'barangkeluar_id' => strtoupper(substr(uniqid(), -6)),
            'nama_barang' => $namaBarang,
            'jumlah_stok' => $jumlahStok,
            'kategori_id' => $barang['kategori_id'],
            'user_id' => session()->get('user_id'),
            'created_at' => date('Y-m-d H:i:s'),
            'merek' => $barang['merek'], 
            'kondisi' => $this->request->getPost('kondisi'),
            'catatan' => $this->request->getPost('catatan')
        ];

        $this->barangKeluarModel->insert($dataKeluar);

        // Kurangi stok
        $newStok = $barang['jumlah_stok'] - $jumlahStok;
        $this->barangModel->update($barang['barang_id'], ['jumlah_stok' => $newStok]);

        return redirect()->to('/barangkeluar')->with('success', 'Selamat! Barang keluar berhasil disimpan.');
    }

    public function delete($id)
    {
        // Periksa apakah data barang keluar ada di database
        $barangKeluar = $this->barangKeluarModel->find($id);

        if (!$barangKeluar) {
            return redirect()->to('/barangkeluar')->with('error', 'Barang keluar tidak ditemukan.');
        }

        // Hapus data dari tabel barang keluar
        $this->barangKeluarModel->delete($id);

        // Tambahkan kembali stok ke tabel barang (opsional)
        $existingBarang = $this->barangModel->where('nama_barang', $barangKeluar['nama_barang'])->first();

        if ($existingBarang) {
            $newStok = $existingBarang['jumlah_stok'] + $barangKeluar['jumlah_stok'];

            // Update stok
            $this->barangModel->update($existingBarang['barang_id'], ['jumlah_stok' => $newStok]);

            log_message('info', 'Stok setelah penambahan kembali: ' . $newStok);
        }

        return redirect()->to('/barangkeluar')->with('success', 'Selamat! Barang keluar berhasil dihapus.');
    }
}
