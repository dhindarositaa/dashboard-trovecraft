<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route (halaman awal)
$routes->get('/', 'AuthController::login'); // Mengarahkan ke halaman login jika root diakses

// Rute untuk autentikasi
$routes->get('/register', 'AuthController::register'); // Halaman register
$routes->post('/register/submit', 'AuthController::submitRegister'); // Proses register
$routes->get('/login', 'AuthController::login'); // Halaman login
$routes->post('/login/submit', 'AuthController::submitLogin'); // Proses login
$routes->get('/logout', 'AuthController::logout'); // Logout

// Rute untuk dashboard
$routes->get('/dashboard', 'FrontController::index'); // Halaman utama dashboard setelah login

// Rute untuk barang
$routes->group('barang', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'ViewsBarangController::views'); // Daftar barang
    $routes->get('search', 'ViewsBarangController::search'); // Pencarian barang
    $routes->get('detail/(:any)', 'ViewsBarangController::detail/$1'); // Detail barang
    $routes->get('add', 'InputBarangController::add'); // Form tambah barang
    $routes->post('save', 'InputBarangController::save'); // Simpan barang
    $routes->get('edit/(:any)', 'InputBarangController::edit/$1'); // Form edit barang
    $routes->post('update', 'InputBarangController::update'); // Proses update barang
    $routes->get('delete/(:any)', 'InputBarangController::delete/$1'); // Hapus barang
});

// Rute untuk kategori
$routes->group('kategori', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'KategoriController::index'); // Daftar kategori
    $routes->get('add', 'KategoriController::add'); // Form tambah kategori
    $routes->post('save', 'KategoriController::save'); // Simpan kategori
    $routes->get('edit/(:num)', 'KategoriController::edit/$1'); // Form edit kategori
    $routes->post('update', 'KategoriController::update'); // Proses update kategori
    $routes->get('delete/(:num)', 'KategoriController::delete/$1'); // Hapus kategori
    $routes->get('search', 'KategoriController::search'); // Pencarian kategori
});

// Rute untuk barang masuk
$routes->group('barangmasuk', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'BarangMasukController::index'); // Daftar barang masuk
    $routes->get('add', 'BarangMasukController::add'); // Form tambah barang masuk
    $routes->post('save', 'BarangMasukController::save'); // Simpan barang masuk
    $routes->get('edit/(:any)', 'BarangMasukController::edit/$1');
    $routes->post('update', 'BarangMasukController::update');
    $routes->get('delete/(:any)', 'BarangMasukController::delete/$1'); // Hapus barang masuk
    $routes->get('search', 'BarangMasukController::search'); // Pencarian barang masuk
});

// Rute untuk barang keluar
$routes->group('barangkeluar', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'BarangKeluarController::index'); // Daftar barang keluar
    $routes->get('add', 'BarangKeluarController::add'); // Form tambah barang keluar
    $routes->post('save', 'BarangKeluarController::save'); // Simpan barang keluar
    $routes->get('edit/(:any)', 'BarangKeluarController::edit/$1'); // Form edit barang keluar
    $routes->post('update', 'BarangKeluarController::update'); // Proses update barang keluar
    $routes->get('delete/(:any)', 'BarangKeluarController::delete/$1'); // Hapus barang keluar
    $routes->get('search', 'BarangKeluarController::search'); // Pencarian barang keluar
});

$routes->get('/laporan', 'LaporanController::index');
$routes->get('/laporan/add', 'LaporanController::add');
$routes->post('/laporan/save', 'LaporanController::save');
$routes->get('/laporan/edit/(:num)', 'LaporanController::edit/$1');
$routes->post('/laporan/update', 'LaporanController::update');
$routes->get('/laporan/delete/(:num)', 'LaporanController::delete/$1');

// Rute untuk halaman depan (opsional jika ada dashboard lain)
$routes->get('/home', 'FrontController::index');
