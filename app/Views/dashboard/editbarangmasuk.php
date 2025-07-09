<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Edit Barang Masuk<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-col md:flex-row mt-16">
    <div class="flex-1 ml-[250px] p-6">
        <div class="bg-white p-8 rounded shadow-md">
            <h1 class="text-2xl font-bold mb-6">Edit Barang Masuk</h1>

            <form action="/barangmasuk/update" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="barangmasuk_id" value="<?= esc($barangmasuk['barangmasuk_id']) ?>">

                <!-- Nama Barang -->
                <div class="mb-4">
                    <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input
                        id="nama_barang" name="nama_barang" type="text" required
                        class="mt-1 block w-full border-2 border-gray-600 rounded-md shadow-sm focus:border-indigo-600 focus:ring-indigo-600 p-2 sm:text-sm"
                        value="<?= esc($barangmasuk['nama_barang']) ?>">
                </div>

                <!-- Merek -->
                <div class="mb-4">
                    <label for="merek" class="block text-sm font-medium text-gray-700">Merek</label>
                    <input
                        id="merek" name="merek" type="text" required
                        class="mt-1 block w-full border-2 border-gray-600 rounded-md shadow-sm focus:border-indigo-600 focus:ring-indigo-600 p-2 sm:text-sm"
                        value="<?= esc($barangmasuk['merek']) ?>">
                </div>

                <!-- Kondisi -->
                <div class="mb-4">
                    <label for="kondisi" class="block text-sm font-medium text-gray-700">Kondisi</label>
                    <input
                        id="kondisi" name="kondisi" type="text" required
                        class="mt-1 block w-full border-2 border-gray-600 rounded-md shadow-sm focus:border-indigo-600 focus:ring-indigo-600 p-2 sm:text-sm"
                        value="<?= esc($barangmasuk['kondisi']) ?>">
                </div>

                <!-- Catatan -->
                <div class="mb-4">
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea
                        id="catatan" name="catatan"
                        class="mt-1 block w-full border-2 border-gray-600 rounded-md shadow-sm focus:border-indigo-600 focus:ring-indigo-600 p-2 sm:text-sm"
                    ><?= esc($barangmasuk['catatan']) ?></textarea>
                </div>

                <!-- Jumlah Masuk -->
                <div class="mb-4">
                    <label for="jumlah_stok" class="block text-sm font-medium text-gray-700">Jumlah Masuk</label>
                    <input
                        id="jumlah_stok" name="jumlah_stok" type="number" required
                        class="mt-1 block w-full border-2 border-gray-600 rounded-md shadow-sm focus:border-indigo-600 focus:ring-indigo-600 p-2 sm:text-sm"
                        value="<?= esc($barangmasuk['jumlah_stok']) ?>">
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select
                        id="kategori_id" name="kategori_id" required
                        class="mt-1 block w-full border-2 border-gray-600 rounded-md shadow-sm focus:border-indigo-600 focus:ring-indigo-600 p-2 sm:text-sm">
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k['kategori_id'] ?>"
                                <?= $barangmasuk['kategori_id'] == $k['kategori_id'] ? 'selected' : '' ?>>
                                <?= esc($k['nama_kategori']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
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
