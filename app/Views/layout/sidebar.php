<aside
    class="bg-white w-[250px] min-h-screen pt-[60px] fixed text-black"
>
<style>
    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 24px; /* Memberikan jarak bawah */
    }

    .logo-image {
        height: 150px; /* Tinggi logo */
        width: auto; /* Lebar otomatis untuk menjaga proporsi */
        object-fit: contain; /* Memastikan gambar tidak terpotong */
    }
    .bg-white {
        background-color: #FFFFFF; /* Warna putih */
    }
    .bg-gray-100 {
        background-color: #F7F7F7; /* Warna abu-abu terang */
    }
    .hover-bg-gray-200:hover {
        background-color: #E0E0E0; /* Warna hover abu-abu lebih gelap */
    }
    .text-black {
        color: #000000; /* Warna teks hitam */
    }
</style>

<!-- Logo -->
<div class="logo-container">
    <img src="/img/logo.jpg" alt="Logo" class="logo-image">
</div>

<nav>
    <ul>
        <!-- Home -->
        <li class="p-4 hover-bg-gray-200 transition">
            <a href="/home" class="flex items-center text-black">
                <span class="material-icons mr-2"></span>
                Home
            </a>
        </li>

        <!-- Daftar Barang -->
        <li class="p-4 hover-bg-gray-200 transition">
            <a href="/barang" class="flex items-center text-black">
                <span class="material-icons mr-2"></span>
                Daftar Barang
            </a>
        </li>

        <!-- Barang Masuk -->
        <li class="p-4 hover-bg-gray-200 transition relative group">
            <button class="flex items-center w-full text-black">
                <span class="material-icons mr-2"></span>
                Barang Masuk
                <span class="ml-auto material-icons transform group-hover:rotate-90 transition">
                    &#9662;
                </span>
            </button>
            <ul class="hidden group-hover:block bg-gray-100 ml-4">
                <li class="p-4 hover-bg-gray-200 transition">
                    <a href="/barangmasuk/add" class="flex items-center text-black">
                        <span class="material-icons mr-2"></span>
                        Tambah Barang Masuk
                    </a>
                </li>
                <li class="p-4 hover-bg-gray-200 transition">
                    <a href="/barangmasuk" class="flex items-center text-black">
                        <span class="material-icons mr-2"></span>
                        Daftar Barang Masuk
                    </a>
                </li>
            </ul>
        </li>

        <!-- Barang Keluar -->
        <li class="p-4 hover-bg-gray-200 transition relative group">
            <button class="flex items-center w-full text-black">
                <span class="material-icons mr-2"></span>
                Barang Keluar
                <span class="ml-auto material-icons transform group-hover:rotate-90 transition">
                    &#9662;
                </span>
            </button>
            <ul class="hidden group-hover:block bg-gray-100 ml-4">
                <li class="p-4 hover-bg-gray-200 transition">
                    <a href="/barangkeluar/add" class="flex items-center text-black">
                        <span class="material-icons mr-2"></span>
                        Tambah Barang Keluar
                    </a>
                </li>
                <li class="p-4 hover-bg-gray-200 transition">
                    <a href="/barangkeluar" class="flex items-center text-black">
                        <span class="material-icons mr-2"></span>
                        Daftar Barang Keluar
                    </a>
                </li>
            </ul>
        </li>

        <!-- Kategori Barang -->
        <li class="p-4 hover-bg-gray-200 transition relative group">
            <button class="flex items-center w-full text-black">
                <span class="material-icons mr-2"></span>
                Kategori Barang
                <span class="ml-auto material-icons transform group-hover:rotate-90 transition">
                    &#9662;
                </span>
            </button>
            <ul class="hidden group-hover:block bg-gray-100 ml-4">
                <li class="p-4 hover-bg-gray-200 transition">
                    <a href="/kategori/add" class="flex items-center text-black">
                        <span class="material-icons mr-2"></span>
                        Tambah Kategori
                    </a>
                </li>
                <li class="p-4 hover-bg-gray-200 transition">
                    <a href="/kategori" class="flex items-center text-black">
                        <span class="material-icons mr-2"></span>
                        Daftar Kategori
                    </a>
                </li>
            </ul>
        </li>

        <!-- Laporan Penjualan Harian -->
        <li class="p-4 hover-bg-gray-200 transition relative group">
            <button class="flex items-center w-full text-black">
                <span class="material-icons mr-2"></span>
                Laporan Penjualan Harian
                <span class="ml-auto material-icons transform group-hover:rotate-90 transition">
                    &#9662;
                </span>
            </button>
            <ul class="hidden group-hover:block bg-gray-100 ml-4">
                <li class="p-4 hover-bg-gray-200 transition">
                    <a href="/laporan/add" class="flex items-center text-black">
                        <span class="material-icons mr-2"></span>
                        Tambah Laporan 
                    </a>
                </li>
                <li class="p-4 hover-bg-gray-200 transition">
                    <a href="/laporan" class="flex items-center text-black">
                        <span class="material-icons mr-2"></span>
                        Daftar Laporan 
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
</aside>
