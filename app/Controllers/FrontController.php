<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\BarangMasukModel;
use App\Models\BarangKeluarModel;
use App\Models\UserModel; // Tambahkan model user

class FrontController extends BaseController
{
    public function index()
    {
        // Inisialisasi model
        $barangModel = new BarangModel();
        $kategoriModel = new KategoriModel();
        $barangMasukModel = new BarangMasukModel();
        $barangKeluarModel = new BarangKeluarModel();
        $userModel = new UserModel(); // Inisialisasi UserModel

        // Barang Masuk Hari Ini
        $barangMasuk = $barangMasukModel
            ->where('DATE(created_at)', date('Y-m-d'))
            ->findAll();

        // Barang Keluar Hari Ini
        $barangKeluar = $barangKeluarModel
            ->where('DATE(created_at)', date('Y-m-d'))
            ->findAll();

        // Hitung jumlah total
        $totalBarang = $barangModel->countAllResults();
        $totalKategori = $kategoriModel->countAllResults();
        $totalUser = $userModel->countAllResults(); // Hitung jumlah user

        // Kirim data ke view
        return view('dashboard/home', [
            'barangMasuk' => $barangMasuk,
            'barangKeluar' => $barangKeluar,
            'totalBarang' => $totalBarang,
            'totalKategori' => $totalKategori,
            'totalUser' => $totalUser, // Kirim total user ke view
        ]);
    }
}
