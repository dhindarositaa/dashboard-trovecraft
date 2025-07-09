<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Edit Barang Masuk
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-col md:flex-row mt-16">
    <div class="flex-1 ml-[250px] p-6">
        <div class="bg-white p-8 rounded shadow-md">
            <h1 class="text-2xl font-bold mb-6">Edit Barang Masuk</h1>
            <form action="/barangmasuk/update" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="barangmasuk_id" value="<?= $barangmasuk['barangmasuk_id'] ?>">

                <!-- Nama Barang -->
                <div class="mb-4">
                    <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" value="<?= $barangmasuk['nama_barang'] ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <!-- Merek -->
                <div class="mb-4">
                    <label for="merek" class="block text-sm font-medium text-gray-700">Merek</label>
                    <input type="text" id="merek" name="merek" value="<?= $barangmasuk['merek'] ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <!-- Kondisi -->
                <div class="mb-4">
                    <label for="kondisi" class="block text-sm font-medium text-gray-700">Kondisi</label>
                    <input type="text" id="kondisi" name="kondisi" value="<?= $barangmasuk['kondisi'] ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <!-- Catatan -->
                <div class="mb-4">
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea id="catatan" name="catatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"><?= $barangmasuk['catatan'] ?></textarea>
                </div>

                <!-- Jumlah Stok -->
                <div class="mb-4">
                    <label for="jumlah_stok" class="block text-sm font-medium text-gray-700">Jumlah Stok</label>
                    <input type="number" id="jumlah_stok" name="jumlah_stok" value="<?= $barangmasuk['jumlah_stok'] ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <!-- Diterima Oleh -->
                <div class="mb-4">
                    <label for="diterima_oleh" class="block text-sm font-medium text-gray-700">Diterima Oleh</label>
                    <input type="text" id="diterima_oleh" name="diterima_oleh" value="<?= $barangmasuk['diterima_oleh'] ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select id="kategori_id" name="kategori_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($kategori as $kat): ?>
                            <option value="<?= $kat['kategori_id'] ?>" <?= $kat['kategori_id'] == $barangmasuk['kategori_id'] ? 'selected' : '' ?>>
                                <?= $kat['nama_kategori'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
