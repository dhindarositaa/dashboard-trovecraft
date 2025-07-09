<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Edit Laporan Penjualan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-col md:flex-row mt-16">
    <div class="flex-1 ml-[250px] p-6">
        <div class="bg-white p-8 rounded shadow-md">
            <h1 class="text-2xl font-bold mb-6">Edit Laporan Penjualan</h1>

            <form action="/laporan/update" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= esc($laporan['id']) ?>">

                <!-- Jenis Minuman -->
                <div class="mb-4">
                    <label for="jenis_minuman" class="block text-sm font-medium text-gray-700">Jenis Minuman</label>
                    <select
                        id="jenis_minuman"
                        name="jenis_minuman"
                        required
                        class="mt-1 block w-full border-2 border-gray-600 rounded-md shadow-sm focus:border-indigo-600 focus:ring-indigo-600 p-2 sm:text-sm">
                        <option value="">Pilih Jenis</option>
                        <?php
                        $jenisList = ['Powder', 'Sirup', 'Yakult', 'Soda', 'Coffee'];
                        foreach ($jenisList as $jenis):
                        ?>
                            <option value="<?= $jenis ?>" <?= $laporan['jenis_minuman'] == $jenis ? 'selected' : '' ?>>
                                <?= $jenis ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Jumlah Terjual -->
                <div class="mb-4">
                    <label for="jumlah_terjual" class="block text-sm font-medium text-gray-700">Jumlah Terjual</label>
                    <input
                        id="jumlah_terjual"
                        name="jumlah_terjual"
                        type="number"
                        required
                        class="mt-1 block w-full border-2 border-gray-600 rounded-md shadow-sm focus:border-indigo-600 focus:ring-indigo-600 p-2 sm:text-sm"
                        value="<?= esc($laporan['jumlah_terjual']) ?>">
                </div>

                <!-- Tanggal -->
                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input
                        id="tanggal"
                        name="tanggal"
                        type="date"
                        required
                        class="mt-1 block w-full border-2 border-gray-600 rounded-md shadow-sm focus:border-indigo-600 focus:ring-indigo-600 p-2 sm:text-sm"
                        value="<?= esc($laporan['tanggal']) ?>">
                </div>

                <!-- Catatan -->
                <div class="mb-4">
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea
                        id="catatan"
                        name="catatan"
                        class="mt-1 block w-full border-2 border-gray-600 rounded-md shadow-sm focus:border-indigo-600 focus:ring-indigo-600 p-2 sm:text-sm"
                        rows="3"><?= esc($laporan['catatan']) ?></textarea>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md shadow">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
