<?php

namespace App\Controllers;

use App\Models\LaporanModel;
use App\Models\UserModel;

class LaporanController extends BaseController
{
    protected $laporanModel;

    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
    }

    public function index()
    {
        // Join laporan_penjualan dengan users
        $laporan = $this->laporanModel
            ->select('laporan_penjualan.*, users.first_name')
            ->join('users', 'users.user_id = laporan_penjualan.user_id', 'left')
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        return view('dashboard/viewslaporan', ['laporan' => $laporan]);
    }

    public function add()
        {
            return view('dashboard/tambahlaporan');
        }

    public function save()
    {
        $data = [
            'jenis_minuman'  => $this->request->getPost('jenis_minuman'),
            'jumlah_terjual' => (int) $this->request->getPost('jumlah_terjual'),
            'tanggal'        => $this->request->getPost('tanggal'),
            'catatan'        => $this->request->getPost('catatan'),
            'user_id'        => session()->get('user_id'),   // pastikan auth login sudah menyimpan ini
        ];

        // ── validasi sederhana
        if (!$this->validate([
            'jenis_minuman'  => 'required|min_length[2]',
            'jumlah_terjual' => 'required|integer',
            'tanggal'        => 'required|valid_date',
        ])) {
            // jika gagal, kembali ke form dengan error
            return redirect()->back()->withInput()->with('error', 'Maaf, Gagal Menambahkan Laporan.');
        }

        // ── simpan
        $this->laporanModel->insert($data);

        // ── redirect
        return redirect()->to('/laporan')->with('success', 'Selamat! Laporan Penjualan Harian Berhasil Ditambahkan.');
    }

    public function edit($id)
    {
        $laporan = $this->laporanModel->find($id);

        if (!$laporan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Laporan dengan ID $id tidak ditemukan.");
        }

        return view('dashboard/editlaporan', ['laporan' => $laporan]);
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $data = [
            'jenis_minuman'  => $this->request->getPost('jenis_minuman'),
            'jumlah_terjual' => $this->request->getPost('jumlah_terjual'),
            'tanggal'        => $this->request->getPost('tanggal'),
            'kondisi'        => $this->request->getPost('kondisi'),
            'catatan'        => $this->request->getPost('catatan')
        ];

        $this->laporanModel->update($id, $data);

        if ($updated) {
            return redirect()->to('/laporan')->with('success', 'Selamat! Laporan berhasil diperbarui.');
        } else {
            return redirect()->to('/laporan')->with('error', 'Maaf, gagal mengedit laporan.');
        }
    }

        public function delete($id)
    {
        if ($this->laporanModel->delete($id)) {
            return redirect()->to('/laporan')->with('success', 'Selamat! Laporan Berhasil Dihapus.');
        } else {
            return redirect()->to('/laporan')->with('error', 'Maaf, Gagal menghapus laporan.');
        }
    }
}
