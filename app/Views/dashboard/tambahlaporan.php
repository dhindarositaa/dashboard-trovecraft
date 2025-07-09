<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Tambah Laporan Penjualan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-col md:flex-row mt-16">
    <div class="flex-1 ml-[250px] p-6">
        <div class="bg-white p-8 rounded shadow-md">
            <h1 class="text-2xl font-bold mb-6">Tambah Laporan Penjualan</h1>

            <form action="/laporan/save" method="post">
                <?= csrf_field(); ?>

                <!-- Jenis Minuman -->
                <div class="mb-4">
                    <label for="jenis_minuman" class="block text-sm font-medium text-gray-700">
                        Jenis Minuman
                    </label>
                    <select
                        type="text"
                        id="jenis_minuman"
                        name="jenis_minuman"
                        class="mt-1 block w-full border border-gray-400 rounded-md shadow-sm
                               focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required
                    >
                        <option value="">Pilih Jenis</option>
                        <option value="Powder">Bubuk Powder</option>
                        <option value="Sirup">Sirup</option>
                        <option value="Yakult">Yakult</option>
                        <option value="Soda">Soda</option>
                        <option value="Coffee">Coffee</option>
                    </select>
                </div>

                <!-- Jumlah Terjual -->
                <div class="mb-4">
                    <label for="jumlah_terjual" class="block text-sm font-medium text-gray-700">
                        Jumlah Terjual
                    </label>
                    <input
                        type="number"
                        id="jumlah_terjual"
                        name="jumlah_terjual"
                        class="mt-1 block w-full border border-gray-400 rounded-md shadow-sm
                               focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required
                        min="0"
                    >
                </div>

                <!-- Tanggal -->
                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">
                        Tanggal
                    </label>
                    <input
                        type="date"
                        id="tanggal"
                        name="tanggal"
                        class="mt-1 block w-full border border-gray-400 rounded-md shadow-sm
                               focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required
                    >
                </div>

                <!-- Catatan -->
                <div class="mb-4">
                    <label for="catatan" class="block text-sm font-medium text-gray-700">
                        Catatan
                    </label>
                    <textarea
                        id="catatan"
                        name="catatan"
                        class="mt-1 block w-full border border-gray-400 rounded-md shadow-sm
                               focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        rows="3"
                    ></textarea>
                </div>

                <!-- Tombol Simpan -->
                <button
                    type="submit"
                    class="bg-indigo-600 text-white py-2 px-4 rounded
                           hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
