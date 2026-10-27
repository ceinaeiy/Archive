<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('dashboard', 'Dashboard::index');

$routes->get('produk', 'Produk::index');
$routes->get('produk/tambah', 'Produk::create');
$routes->post('produk/simpan', 'Produk::store');
$routes->get('produk/edit/(:num)', 'Produk::edit/$1');
$routes->post('produk/update/(:num)', 'Produk::update/$1');
$routes->post('produk/hapus/(:num)', 'Produk::delete/$1');
$routes->get('produk/detail/(:num)', 'Produk::detail/$1');

$routes->get('laporan', 'Laporan::index');
