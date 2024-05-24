<?php

use App\Controllers\Migrate;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->group('panel', static function ($routes) {
    $routes->get('/', 'Panel\Dashboard::index', ['as' => 'dashboard']);
    $routes->get('dashboard', 'Panel\Dashboard::index');
    $routes->group('kriteria', static function ($routes) {
        $routes->get('/', 'Panel\Kriteria::index', ['as' => 'kriteria']);
        $routes->get('add', 'Panel\Kriteria::add', ['as' => 'kriteria.add']);
        $routes->get('edit/(:any)', 'Panel\Kriteria::edit/$1', ['as' => 'kriteria.edit']);
        $routes->post('storeupdate', 'Panel\Kriteria::storeupdate', ['as' => 'kriteria.store']);
        $routes->post('storeupdate/(:num)', 'Panel\Kriteria::storeupdate/$1', ['as' => 'kriteria.update']);
        $routes->get('delete/(:num)', 'Panel\Kriteria::delete/$1', ['as' => 'kriteria.delete']);
    });

    $routes->group('kriteria/(:num)', static function ($routes) {
        $routes->get('subkriteria', 'Panel\SubKriteria::index/$1', ['as' => 'kriteria.subkriteria']);
        $routes->get('subkriteria/add', 'Panel\SubKriteria::add/$1', ['as' => 'kriteria.subkriteria.add']);
        $routes->get('subkriteria/edit/(:num)', 'Panel\SubKriteria::edit/$1/$2', ['as' => 'kriteria.subkriteria.edit']);
        $routes->post('subkriteria/storeupdate', 'Panel\SubKriteria::storeupdate', ['as' => 'kriteria.subkriteria.store']);
        $routes->post('subkriteria/storeupdate/(:num)', 'Panel\SubKriteria::storeupdate/$1/$2', ['as' => 'kriteria.subkriteria.update']);
        $routes->get('subkriteria/delete/(:num)', 'Panel\SubKriteria::delete/$1/$2', ['as' => 'kriteria.subkriteria.delete']);
    });

    $routes->group('alternatif', static function ($routes) {
        $routes->get('/', 'Panel\Alternatif::index', ['as' => 'alternatif']);
        $routes->get('add', 'Panel\Alternatif::add', ['as' => 'alternatif.add']);
        $routes->get('edit/(:any)', 'Panel\Alternatif::edit/$1', ['as' => 'alternatif.edit']);
        $routes->post('storeupdate', 'Panel\Alternatif::storeupdate', ['as' => 'alternatif.store']);
        $routes->post('storeupdate/(:num)', 'Panel\Alternatif::storeupdate/$1', ['as' => 'alternatif.update']);
        $routes->get('delete/(:num)', 'Panel\Alternatif::delete/$1', ['as' => 'alternatif.delete']);
    });

    $routes->group('penilaian', static function ($routes) {
        $routes->get('/', 'Panel\Penilaian::index', ['as' => 'penilaian']);
        $routes->get('add', 'Panel\Penilaian::add', ['as' => 'penilaian.add']);
        $routes->get('edit/(:any)', 'Panel\Penilaian::edit/$1', ['as' => 'penilaian.edit']);
        $routes->post('storeupdate', 'Panel\Penilaian::storeupdate', ['as' => 'penilaian.store']);
        $routes->post('storeupdate/(:num)', 'Panel\Penilaian::storeupdate/$1', ['as' => 'penilaian.update']);
        $routes->get('delete/(:num)', 'Panel\Penilaian::delete/$1', ['as' => 'penilaian.delete']);
    });

    $routes->group('perhitungan', static function ($routes) {
        $routes->get('/', 'Panel\Perhitungan::index', ['as' => 'perhitungan']);
        $routes->get('hasil', 'Panel\Perhitungan::hasil', ['as' => 'perhitungan.hasil']);
    });
});


$routes->environment('development', static function ($routes) {
    $routes->get('migrate', [Migrate::class, 'index']);
});

$routes->environment('production', static function ($routes) {
    $routes->get('migrate', base_url());
});
