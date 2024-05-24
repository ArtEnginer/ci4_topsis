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
});


$routes->environment('development', static function ($routes) {
    $routes->get('migrate', [Migrate::class, 'index']);
});

$routes->environment('production', static function ($routes) {
    $routes->get('migrate', base_url());
});
