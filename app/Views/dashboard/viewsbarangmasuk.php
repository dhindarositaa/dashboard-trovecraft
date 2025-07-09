<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Daftar Barang Masuk
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-col md:flex-row mt-16">
    <div class="flex-1 ml-[250px] p-6">
        <div class="bg-white p-8 rounded shadow-md">

            <!-- Notifikasi Flashdata -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4 font-semibold">
                    ✅ <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded mb-4 font-semibold">
                    ❌ <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <h1 class="text-2xl font-bold mb-6">Daftar Barang Masuk</h1>

            <!-- Form Pencarian dan Tombol Tambah Barang Masuk -->
            <div class="flex items-center justify-between mb-4">
                <form action="/barangmasuk/search" method="get" class="flex flex-1">
                    <input type="text" name="q" placeholder="Cari barang masuk..." 
                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                        value="<?= isset($q) ? $q : '' ?>">
                    <button type="submit" class="ml-2 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Cari</button>
                </form>

                <a href="/barangmasuk/add" class="ml-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Tambah Barang Masuk
                </a>
            </div>

            <!-- Tabel Data Barang Masuk -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">ID Barang Masuk</th>
                            <th class="px-4 py-2 border">Nama Barang</th>
                            <th class="px-4 py-2 border">Jumlah Masuk</th>
                            <th class="px-4 py-2 border">Tanggal</th>         
                            <th class="px-4 py-2 border">Diterima Oleh</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($barangmasuk) && is_array($barangmasuk)): ?>
                        <?php foreach ($barangmasuk as $item): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border"><?= $item['barangmasuk_id'] ?></td>
                                <td class="px-4 py-2 border"><?= $item['nama_barang'] ?></td>
                                <td class="px-4 py-2 border"><?= $item['jumlah_stok'] ?></td>

                                <td class="px-4 py-2 border">
                                    <?= esc(date('d-m-Y H:i', strtotime($item['created_at']))) ?>
                                </td>

                                <td class="px-4 py-2 border"><?= esc($item['first_name']) ?></td>
                                <td class="px-4 py-2 border">
                                    <a href="/barangmasuk/edit/<?= $item['barangmasuk_id'] ?>" class="text-blue-600 hover:underline">Edit</a> |
                                    <a href="/barangmasuk/delete/<?= $item['barangmasuk_id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center px-4 py-2 border">Data barang masuk tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
