<?php

namespace App\Controllers;

use App\Models\BarangMasukModel;
use App\Models\BarangModel;
use App\Models\KategoriModel;

class BarangMasukController extends BaseController
{
    protected $barangMasukModel;
    protected $kategoriModel;
    protected $barangModel;

    public function __construct()
    {
        $this->barangMasukModel = new BarangMasukModel();
        $this->kategoriModel = new KategoriModel();
        $this->barangModel = new BarangModel(); 
    }

    public function index()
    {
        $barangmasuk = $this->barangMasukModel
            ->select('tb_barangmasuk.*, users.first_name')
            ->join('users', 'users.user_id = tb_barangmasuk.user_id', 'left')
            ->findAll();

        return view('dashboard/viewsbarangmasuk', ['barangmasuk' => $barangmasuk]);
    }

    public function add()
    {
        $data = [
            'kategori' => $this->kategoriModel->findAll()
        ];

        return view('dashboard/tambahbarangmasuk', $data);
    }

    public function save()
    {
        $validation = $this->validate([
            'nama_barang' => 'required',
            'jumlah_stok' => 'required|numeric',
            'merek' => 'required',
            'kondisi' => 'required',
            'catatan' => 'permit_empty',
            'kategori_id' => 'required|integer'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $dataMasuk = [
            'barangmasuk_id' => strtoupper(substr(uniqid(), -6)),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah_stok' => $this->request->getPost('jumlah_stok'),
            'merek' => $this->request->getPost('merek'),
            'kondisi' => $this->request->getPost('kondisi'),
            'catatan' => $this->request->getPost('catatan'),
            'user_id' => session()->get('user_id'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Simpan ke tabel tb_barangmasuk
        $this->barangMasukModel->insert($dataMasuk);

        // Sinkronkan ke tabel tb_barang
        $this->syncToBarang($dataMasuk);

        return redirect()->to('/barangmasuk')->with('success', 'Selamat! Barang masuk berhasil ditambahkan.');
    }

    private function syncToBarang($dataMasuk)
    {
        // Cek apakah barang sudah ada di tb_barang
        $existingBarang = $this->barangModel->where('nama_barang', $dataMasuk['nama_barang'])->first();

        if ($existingBarang) {
            // Update stok jika barang sudah ada
            $this->barangModel->update($existingBarang['barang_id'], [
                'jumlah_stok' => $existingBarang['jumlah_stok'] + $dataMasuk['jumlah_stok']
            ]);
        } else {
            // Tambahkan barang baru jika belum ada
            $this->barangModel->insert([
                'barang_id' => strtoupper(substr(uniqid(), -6)),
                'nama_barang' => $dataMasuk['nama_barang'],
                'kategori_id' => $dataMasuk['kategori_id'],
                'merek' => $dataMasuk['merek'],
                'kondisi' => $dataMasuk['kondisi'],
                'catatan' => $dataMasuk['catatan'],
                'jumlah_stok' => $dataMasuk['jumlah_stok'],
                'user_id' => session()->get('user_id')
            ]);
        }
    }

    public function edit($id)
    {
        // Ambil data barang masuk berdasarkan ID
        $barangmasuk = $this->barangMasukModel->find($id);

        if (!$barangmasuk) {
            return redirect()->to('/barangmasuk')->with('error', 'Data barang masuk tidak ditemukan.');
        }

        // Ambil data kategori
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'barangmasuk' => $barangmasuk,
            'kategori' => $kategori
        ];

        return view('dashboard/editbarangmasuk', $data);
    }

    public function update()
    {
        // ─── Validasi ─
        $validation = $this->validate([
            'barangmasuk_id' => 'required',
            'nama_barang'    => 'required',
            'jumlah_stok'    => 'required|numeric',
            'merek'          => 'required',
            'kondisi'        => 'required',
            'catatan'        => 'permit_empty',
            'kategori_id'    => 'required|integer'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // ─── Ambil data lama untuk hitung selisih stok 
        $id        = $this->request->getPost('barangmasuk_id');
        $old       = $this->barangMasukModel->find($id);
        if (!$old) {
            return redirect()->to('/barangmasuk')->with('error', 'Data tidak ditemukan.');
        }

        $newQty    = (int) $this->request->getPost('jumlah_stok');
        $qtyDelta  = $newQty - (int) $old['jumlah_stok'];   // bisa + / -

        // ─── Update tb_barangmasuk 
        $updateMasuk = [
            'nama_barang'  => $this->request->getPost('nama_barang'),
            'jumlah_stok'  => $newQty,
            'merek'        => $this->request->getPost('merek'),
            'kondisi'      => $this->request->getPost('kondisi'),
            'catatan'      => $this->request->getPost('catatan'),
            'kategori_id'  => $this->request->getPost('kategori_id'),
            'user_id'      => session()->get('user_id'),
            'updated_at'   => date('Y-m-d H:i:s')
        ];
        $this->barangMasukModel->update($id, $updateMasuk);

        // ─── Sinkron dengan tb_barang ─
        $barang = $this->barangModel
                ->where('nama_barang', $old['nama_barang'])   // cari berdasarkan nama lama
                ->first();

        if ($barang) {
            // kalkulasi stok baru & update field lain
            $newStok = max(0, $barang['jumlah_stok'] + $qtyDelta);

            $this->barangModel->update($barang['barang_id'], [
                'nama_barang'  => $updateMasuk['nama_barang'],
                'merek'        => $updateMasuk['merek'],
                'kondisi'      => $updateMasuk['kondisi'],
                'catatan'      => $updateMasuk['catatan'],
                'jumlah_stok'  => $newStok,
                'kategori_id'  => $updateMasuk['kategori_id'],
                'user_id'      => session()->get('user_id')
            ]);
        } else {
            // jika entri di tb_barang belum ada (mis. nama baru), masukkan baru
            $this->barangModel->insert([
                'barang_id'    => strtoupper(substr(uniqid(), -6)),
                'nama_barang'  => $updateMasuk['nama_barang'],
                'merek'        => $updateMasuk['merek'],
                'kondisi'      => $updateMasuk['kondisi'],
                'catatan'      => $updateMasuk['catatan'],
                'jumlah_stok'  => $newQty,
                'kategori_id'  => $updateMasuk['kategori_id'],
                'user_id'      => session()->get('user_id')
            ]);
        }

        return redirect()->to('/barangmasuk')
                        ->with('success', 'Data barang masuk & stok berhasil diperbarui.');
    }

    public function delete($id)
    {
        // Pastikan data barangmasuk ada
        $barangMasuk = $this->barangMasukModel->find($id);

        if (!$barangMasuk) {
            return redirect()->to('/barangmasuk')->with('error', 'Maaf, Barang masuk tidak ditemukan.');
        }

        // Hapus data dari tabel tb_barangmasuk
        $this->barangMasukModel->delete($id);

        // Opsional: Jika ingin mengurangi stok di tb_barang saat barang masuk dihapus
        $existingBarang = $this->barangModel->where('nama_barang', $barangMasuk['nama_barang'])->first();
        if ($existingBarang) {
            $newStok = $existingBarang['jumlah_stok'] - $barangMasuk['jumlah_stok'];
            if ($newStok < 0) $newStok = 0; // Pastikan stok tidak negatif

            $this->barangModel->update($existingBarang['barang_id'], [
                'jumlah_stok' => $newStok
            ]);
        }

        return redirect()->to('/barangmasuk')->with('success', 'Selamat! Barang masuk berhasil dihapus.');
    }

}
