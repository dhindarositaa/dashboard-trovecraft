<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Daftar Laporan Penjualan Harian
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

            <h1 class="text-2xl font-bold mb-6">Daftar Laporan Penjualan Harian</h1>

            <!-- Form Pencarian & Tombol Tambah Laporan -->
            <div class="flex items-center justify-between mb-4">
                <form action="/laporan/search" method="get" class="flex flex-1">
                    <input
                        type="text"
                        name="q"
                        placeholder="Cari laporan..."
                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                        value="<?= isset($q) ? esc($q) : '' ?>"
                    >
                    <button
                        type="submit"
                        class="ml-2 bg-indigo-600 text-white px-4 py-2 rounded-md
                               hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Cari
                    </button>
                </form>

                <a href="/laporan/add"
                   class="ml-4 bg-green-600 text-white px-4 py-2 rounded-md
                          hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Tambah Laporan
                </a>
            </div>

            <!-- Tabel Data Laporan -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-4 py-2 border">ID Laporan</th>
                            <th class="px-4 py-2 border">Jenis Minuman</th>
                            <th class="px-4 py-2 border">Jumlah Terjual</th>
                            <th class="px-4 py-2 border">Tanggal</th>
                            <th class="px-4 py-2 border">Catatan</th>
                            <th class="px-4 py-2 border">Ditulis Oleh</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($laporan) && is_array($laporan)): ?>
                        <?php foreach ($laporan as $item): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border"><?= esc($item['id']) ?></td>
                                <td class="px-4 py-2 border"><?= esc($item['jenis_minuman']) ?></td>
                                <td class="px-4 py-2 border"><?= esc($item['jumlah_terjual']) ?></td>
                                <td class="px-4 py-2 border">
                                    <?= esc(date('d-m-Y', strtotime($item['tanggal']))) ?>
                                </td>
                                <td class="px-4 py-2 border"><?= esc($item['catatan']) ?></td>
                                <td class="px-4 py-2 border"><?= esc($item['first_name']) ?></td>
                                <td class="px-4 py-2 border">
                                    <a href="/laporan/edit/<?= $item['id'] ?>"
                                       class="text-blue-600 hover:underline mr-2">Edit</a>
                                    <a href="/laporan/delete/<?= $item['id'] ?>"
                                       class="text-red-600 hover:underline"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center px-4 py-2 border">
                                Data laporan tidak ditemukan.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<script>
    setTimeout(() => {
        const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
        alerts.forEach(alert => alert.remove());
    }, 3000); 
</script>
