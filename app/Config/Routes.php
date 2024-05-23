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
    $routes->get('profile', 'Panel\Profile::index');
    $routes->get('settings', 'Panel\Settings::index');
    $routes->get('users', 'Panel\Users::index');
    $routes->get('roles', 'Panel\Roles::index');
    $routes->get('permissions', 'Panel\Permissions::index');
    $routes->get('logs', 'Panel\Logs::index');
    $routes->get('migrate', 'Panel\Migrate::index');
});


$routes->environment('development', static function ($routes) {
    $routes->get('migrate', [Migrate::class, 'index']);
});

$routes->environment('production', static function ($routes) {
    $routes->get('migrate', base_url());
});
