<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/home', 'Home::index', ['filter' => 'auth']);
//petugas controller
$routes->get('/petugas', 'PetugasController::index', ['filter' => 'auth']);
$routes->get('/fpetugas', 'PetugasController::create', ['filter' => 'auth']);
$routes->add('/spetugas', 'PetugasController::save', ['filter' => 'auth']);
$routes->get('/petugas/delete/(:segment)', 'PetugasController::delete/$1', ['filter' => 'auth']);
$routes->add('/petugas/edit/(:segment)', 'PetugasController::edit/$1', ['filter' => 'auth']);
//siswa controller
$routes->get('/siswa', 'SiswaController::index', ['filter' => 'auth']);
$routes->get('/fsiswa', 'SiswaController::create', ['filter' => 'auth']);
$routes->add('/ssiswa', 'SiswaController::save', ['filter' => 'auth']);
$routes->get('/siswa/delete/(:segment)', 'SiswaController::delete/$1', ['filter' => 'auth']);
$routes->get('/siswa/edit/(:segment)', 'SiswaController::edit/$1', ['filter' => 'auth']);
//jenis_bayar controller
$routes->get('/jenisbayar', 'JenisbayarController::index', ['filter' => 'auth']);
$routes->get('/fjenisbayar', 'JenisbayarController::create', ['filter' => 'auth']);
$routes->add('/sjenisbayar', 'JenisbayarController::save', ['filter' => 'auth']);
$routes->add('/jenisbayar/delete/(:segment)', 'JenisbayarController::delete/$id', ['filter' => 'auth']);
$routes->add('/jenisbayar/edit/(:segment)', 'JenisbayarController::edit/$id', ['filter' => 'auth']);
//login
$routes->get('/', 'LoginController::index');
$routes->add('/login', 'LoginController::login');
$routes->get('/logout', 'LoginController::logout');
//Transaksi
$routes->get('/pembayaran', 'TransaksiController::index');
$routes->add('/caritagihan', 'TransaksiController::cari');
$routes->add('/bayar(:segment)/(:segment)/(:segment)', 'TransaksiController::bayar/$1/$2/$3');
$routes->get('/bill/(segment)', 'TransaksiController::bill/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
