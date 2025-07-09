<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Dashboard Home
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
    body {
        background-color: #EDE7F6; /* Latar ungu muda */
    }

    .banner-container {
        position: relative;
        height: 500px; 
        width: 100%;
        overflow: hidden; 
        border-radius: 8px; 
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); 
    }

    .banner-image {
        height: 100%; 
        width: 100%;
        object-fit: cover; 
    }

    .banner-text {
        position: absolute; 
        top: 50%; 
        left: 50%; 
        transform: translate(-50%, -50%); 
        color: white; 
        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7); 
        text-align: center; 
    }

    .banner-text h1 {
        font-size: 50px; 
        margin: 0;
    }

    .banner-text p {
        font-size: 20px; 
        margin: 0;
    }
</style>

<main class="flex-1 ml-[250px] mt-[50px] p-6">
    <!-- Kotak Banner -->
    <div class="banner-container">
        <img src="/img/bgtc.jpg" alt="Banner Gambar" class="banner-image">
        <!-- <div class="banner-text">
            <h1>Selamat Datang di Dashboard</h1>
            <p>Pantau barang masuk dan barang keluar di sini.</p>
        </div> -->
    </div>
    
    <!-- Kotak Informasi -->
    <div class="flex flex-wrap justify-between gap-6">
        <div class="flex-1 max-w-[300px] bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-3xl font-bold text-indigo-600"><?= esc($totalBarang) ?></h2>
            <p class="text-gray-500 mt-2">Jumlah Barang</p>
        </div>
        <div class="flex-1 max-w-[300px] bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-3xl font-bold text-indigo-600"><?= esc($totalUser) ?></h2>
            <p class="text-gray-500 mt-2">Jumlah User</p>
        </div>
        <div class="flex-1 max-w-[300px] bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-3xl font-bold text-indigo-600"><?= esc($totalKategori) ?></h2>
            <p class="text-gray-500 mt-2">Jumlah Kategori</p>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-6 mt-10">
        <!-- Kotak Kiri: Barang Masuk -->
        <div class="flex-1 bg-white p-6 rounded shadow-md">
            <h1 class="text-xl font-bold mb-4 text-indigo-600">Barang Masuk Hari Ini</h1>
            <div class="overflow-y-auto max-h-[300px]">
                <?php if (!empty($barangMasuk)): ?>
                    <div class="grid grid-cols-1 gap-4">
                        <?php foreach ($barangMasuk as $masuk): ?>
                            <div class="block p-4 bg-gray-100 rounded shadow hover:bg-gray-200 transition duration-200">
                                <span><?= esc($masuk['nama_barang']) ?></span>
                                <span class="font-bold"><?= esc($masuk['jumlah_stok']) ?> unit</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 italic">Tidak ada barang masuk untuk hari ini.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Kotak Kanan: Barang Keluar -->
        <div class="flex-1 bg-white p-6 rounded shadow-md">
            <h1 class="text-xl font-bold mb-4 text-green-600">Barang Keluar Hari Ini</h1>
            <div class="overflow-y-auto max-h-[300px]">
                <?php if (!empty($barangKeluar)): ?>
                    <div class="grid grid-cols-1 gap-4">
                        <?php foreach ($barangKeluar as $keluar): ?>
                            <div class="block p-4 bg-gray-100 rounded shadow hover:bg-gray-200 transition duration-200">
                                <span><?= esc($keluar['nama_barang']) ?></span>
                                <span class="font-bold"><?= esc($keluar['jumlah_stok']) ?> unit</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 italic">Tidak ada barang keluar untuk hari ini.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
