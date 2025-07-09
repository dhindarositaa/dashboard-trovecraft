<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Tambah Barang Keluar
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-col md:flex-row mt-16">
    <div class="flex-1 ml-[250px] p-6">
        <div class="bg-white p-8 rounded shadow-md">
            <h1 class="text-2xl font-bold mb-6">Tambah Barang Keluar</h1>
            <form action="/barangkeluar/save" method="post">
                <?= csrf_field(); ?>

                <!-- Nama Barang -->
                <div class="mb-4">
                    <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <select id="nama_barang" name="nama_barang" 
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                        required onchange="isiDetailBarang()">
                        <option value="">Pilih Barang</option>
                        <?php foreach ($barang as $b): ?>
                            <option 
                                value="<?= $b['nama_barang'] ?>"
                                data-kategori="<?= $b['kategori_id'] ?>"
                                data-stok="<?= $b['jumlah_stok'] ?>"
                                data-merek="<?= $b['merek'] ?>"
                            >
                                <?= $b['nama_barang'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Kategori (readonly) -->
                <div class="mb-4">
                    <label for="kategori_id_display" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <input type="text" id="kategori_id_display" disabled 
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-100 shadow-sm sm:text-sm">
                    <input type="hidden" id="kategori_id" name="kategori_id">
                </div>

                <!-- Jumlah Stok -->
                <div class="mb-4">
                    <label for="jumlah_stok" class="block text-sm font-medium text-gray-700">Jumlah Stok</label>
                    <select id="jumlah_stok" name="jumlah_stok" required 
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Pilih Jumlah</option>
                    </select>
                </div>

                <!-- Merek (readonly) -->
                <div class="mb-4">
                    <label for="merek" class="block text-sm font-medium text-gray-700">Merek</label>
                    <input type="text" id="merek" name="merek" readonly 
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-100 shadow-sm sm:text-sm">
                </div>

                <!-- Kondisi -->
                <div class="mb-4">
                    <label for="kondisi" class="block text-sm font-medium text-gray-700">Kondisi</label>
                    <input type="text" id="kondisi" name="kondisi" 
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <!-- Catatan -->
                <div class="mb-4">
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea id="catatan" name="catatan" 
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Tambahkan catatan untuk barang keluar (wajib)"></textarea>
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit" 
                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    function isiDetailBarang() {
        const select = document.getElementById('nama_barang');
        const selected = select.options[select.selectedIndex];

        const kategoriId = selected.getAttribute('data-kategori');
        const stok = parseInt(selected.getAttribute('data-stok'));
        const merek = selected.getAttribute('data-merek');

        // Isi kategori (readonly)
        document.getElementById('kategori_id').value = kategoriId;
        document.getElementById('kategori_id_display').value = kategoriId;

        // Isi merek
        document.getElementById('merek').value = merek;

        // Isi jumlah stok dropdown
        const stokSelect = document.getElementById('jumlah_stok');
        stokSelect.innerHTML = "<option value=''>Pilih Jumlah</option>";

        for (let i = stok; i >= 1; i--) {
            const option = document.createElement("option");
            option.value = i;
            option.text = i;
            stokSelect.appendChild(option);
        }
    }
</script>

<?= $this->endSection() ?>
