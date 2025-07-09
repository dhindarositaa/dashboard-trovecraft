<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Tambah Barang Masuk
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-col md:flex-row mt-16">
    <div class="flex-1 ml-[250px] p-6">
        <div class="bg-white p-8 rounded shadow-md">
            <h1 class="text-2xl font-bold mb-6">Tambah Barang Masuk</h1>
            <form action="/barangmasuk/save" method="post">
                <?= csrf_field(); ?>

                <!-- Nama Barang -->
                <div class="mb-4">
                    <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" 
                        class="mt-1 block w-full border border-gray-400 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" required>
                </div>

                <!-- Merek -->
                <div class="mb-4">
                    <label for="merek" class="block text-sm font-medium text-gray-700">Merek</label>
                    <input type="text" id="merek" name="merek" 
                        class="mt-1 block w-full border border-gray-400 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" required>
                </div>

                <!-- Kondisi -->
                <div class="mb-4">
                    <label for="kondisi" class="block text-sm font-medium text-gray-700">Kondisi</label>
                    <input type="text" id="kondisi" name="kondisi" 
                        class="mt-1 block w-full border border-gray-400 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" required>
                </div>

                <!-- Catatan -->
                <div class="mb-4">
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea id="catatan" name="catatan" 
                            class="mt-1 block w-full border border-gray-400 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"></textarea>
                </div>

                <!-- Jumlah Stok -->
                <div class="mb-4">
                    <label for="jumlah_stok" class="block text-sm font-medium text-gray-700">Jumlah Masuk</label>
                    <input type="number" id="jumlah_stok" name="jumlah_stok" 
                        class="mt-1 block w-full border border-gray-400 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" required>
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select id="kategori_id" name="kategori_id" 
                            class="mt-1 block w-full border border-gray-400 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($kategori as $kat): ?>
                            <option value="<?= $kat['kategori_id']; ?>"><?= $kat['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Submit -->
                <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded">Simpan</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
