<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->get('/', 'Home::index');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/save_register', 'Auth::save_register');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/cek_login', 'Auth::cek_login');
$routes->get('auth/logout', 'Auth::logout');
$routes->addRedirect('login', 'auth/login');
$routes->addRedirect('register', 'auth/register');
$routes->group('admin', function($routes){
    $routes->get('dashboard', 'Admin\Admin::dashboard');
});
$routes->addRedirect('admin', 'admin/dashboard');
$routes->addRedirect('premium', 'premium/dashboard');
$routes->addRedirect('user', 'user/dashboard');

$routes->group('api', function($routes){
    $routes->group('v1', ['namespace' => 'App\Controllers\Api\V1'], static function($routes){
        $routes->get('jadwalkuliah', 'JadwalKuliah::getDataByDate',['filter' => 'level2']);
        $routes->resource('produk');
        $routes->resource('jadwalkuliah');
        $routes->get('mahasiswa', 'Mahasiswa::index');
        $routes->group('saham', function($routes){
            $routes->get('perusahaan', 'Saham::perusahaan');
            $routes->get('index', 'Saham::index');
            $routes->get('indexdetail', 'Saham::indexdetail');
            $routes->get('detail', 'Saham::detailemiten');
            $routes->get('trending', 'Saham::trending');
            $routes->get('top_gainer', 'Saham::top_gainer');
            $routes->get('top_loser', 'Saham::top_loser');

        });
        $routes->group('quote', function($routes){
            $routes->get('/', 'Quote::random');
        });
    });
    $routes->group('v2', ['namespace' => 'App\Controllers\Api\V2'], static function($routes){
        $routes->resource('user');
    });
});

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
