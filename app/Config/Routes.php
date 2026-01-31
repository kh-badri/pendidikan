<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- RUTE YANG WAJIB LOGIN (Dijaga oleh 'auth') ---
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Rute utama aplikasi
    $routes->get('/', 'Home::index');
    $routes->addRedirect('home', '/');

    // Rute untuk halaman Akun
    $routes->get('akun', 'Akun::index');
    $routes->post('akun/update_profil', 'Akun::updateProfil');
    $routes->post('akun/update_sandi', 'Akun::updateSandi');

    // Cari kode ini dan sesuaikan:
    $routes->get('dataset', 'Dataset::index');
    $routes->post('dataset/save', 'Dataset::save');
    $routes->post('dataset/upload', 'Dataset::upload');
    $routes->get('dataset/delete/(:num)', 'Dataset::delete/$1');
    $routes->get('dataset/hapus-semua', 'Dataset::hapusSemua');
    $routes->post('dataset/update/(:num)', 'Dataset::update/$1');

    // --- RUTE PREDIKSI ---
    $routes->get('/prediksi', 'Prediksi::index');
    $routes->post('/prediksi/proses', 'Prediksi::proses');
    $routes->post('prediksi/simpan', 'Prediksi::simpan');

    // --- RUTE HISTORY ---
    $routes->get('/history', 'History::index');
    $routes->get('/history/delete/(:num)', 'History::delete/$1');
    $routes->get('/history/hapus-semua', 'History::hapusSemua');
    $routes->get('/history/detail/(:num)', 'History::detail/$1');
});


// --- RUTE UNTUK TAMU (Dijaga oleh 'guest') ---
$routes->group('', ['filter' => 'guest'], function ($routes) {
    $routes->get('login', 'Auth::index', ['as' => 'login']);
    $routes->get('register', 'Auth::register', ['as' => 'register']);
});


// --- RUTE AKSI PUBLIK ---
$routes->post('login', 'Auth::login');
$routes->post('register', 'Auth::processRegister');
$routes->get('logout', 'Auth::logout');
