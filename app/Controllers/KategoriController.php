<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $kategori = $this->kategoriModel->findAll();
        return view('dashboard/viewskategori', ['kategori' => $kategori]);
    }

    public function add()
    {
        return view('dashboard/tambahkategori');
    }

    public function save()
    {
        $validation = $this->validate([
            'nama_kategori' => 'required'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ];

        if ($this->kategoriModel->insert($data)) {
            return redirect()->to('/kategori')->with('success', 'Selamat! Kategori berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Maaf, Gagal menambahkan kategori.');
        }
    }

    public function edit($id)
    {
        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            return redirect()->to('/kategori')->with('error', 'Kategori tidak ditemukan.');
        }

        return view('dashboard/editkategori', ['kategori' => $kategori]);
    }

    public function update()
    {
        $id = $this->request->getPost('kategori_id');

        $validation = $this->validate([
            'nama_kategori' => 'required'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ];

        if ($this->kategoriModel->update($id, $data)) {
            return redirect()->to('/kategori')->with('success', 'Selamat! Kategori berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Maaf, Gagal memperbarui kategori.');
        }
    }

    public function delete($id)
    {
        if ($this->kategoriModel->delete($id)) {
            return redirect()->to('/kategori')->with('success', 'Selamat! Kategori berhasil dihapus.');
        } else {
            return redirect()->to('/kategori')->with('error', 'Maaf, Gagal menghapus kategori.');
        }
    }

    public function search()
    {
        $query = $this->request->getGet('q');
        $kategori = $this->kategoriModel->like('nama_kategori', $query)->findAll();

        return view('dashboard/viewskategori', [
            'kategori' => $kategori,
            'q' => $query
        ]);
    }
}
