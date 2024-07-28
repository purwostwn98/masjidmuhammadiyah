<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Landing::index');
$routes->post('/landing/dinamis/load_peta', 'Landing::dinamis_load_peta');
$routes->post('/landing/dinamis/dinamis_review_maps', 'Landing::dinamis_review_maps');

//auth
$routes->get('/login-masjid', 'Auth::index');
$routes->post('/auth/proses-login', 'Auth::proses_login');

//admin
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/master-masjid', 'Admin::v_master_masjid');
$routes->post('/admin/dinamis/load_master_masjid', 'Admin::load_master_masjid');
$routes->post('/admin/dinamis/modal_tambah_masjid', 'Admin::modal_tambah_masjid');
$routes->post('/admin/do-tambah-masjid', 'Admin::do_tambah_masjid');
$routes->post('/admin/do_hapus_masjid', 'Admin::do_hapus_masjid');
$routes->post('/admin/dinamis/modal_edit_masjid', 'Admin::modal_edit_masjid');
$routes->post('/admin/do-edit-masjid', 'Admin::do_edit_masjid');
$routes->post('/admin/dinamis/modal_detail_masjid', 'Admin::modal_detail_masjid');
$routes->get('/admin/kategori-masjid', 'Admin::v_kategori_masjid');
$routes->post('/admin/dinamis/load_tabel_kategori', 'Admin::load_tabel_kategori');
$routes->get('/admin/riwayat-penilaian', 'Admin::v_riwayat_penilaian');
$routes->post('/admin/dinamis/modal_tambah_nilai', 'Admin::modal_tambah_nilai');
$routes->post('/admin/do-tambah-nilai', 'Admin::do_tambah_nilai');
$routes->post('/admin/do_hapus_nilai', 'Admin::do_hapus_nilai');
$routes->get('/admin/penilaian', 'Admin::v_penilaian');
$routes->post('/admin/do_save_nilai', 'Admin::do_save_nilai');
