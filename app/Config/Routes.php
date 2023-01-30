<?php

namespace Config;

use App\Controllers\GestioneIstruttori;
use App\Controllers\Admin\Admin;
use App\Controllers\Admin\Admin_GestioneIstruttori;
use App\Controllers\Admin\Admin_GestioneLezioni;


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

$routes->get('istruttori/elencoistruttori', [GestioneIstruttori::class, 'index']);
$routes->get('istruttori/(:segment)', [GestioneIstruttori::class, 'view']);

// ADMINISTRATIVE PART
$routes->get('admin/admin_page', 'Admin\Admin::index');
$routes->match(['get', 'post'], 'admin/istruttori/nuovoistruttore', [Admin_GestioneIstruttori::class, 'nuovoistruttore']);
$routes->get('admin/istruttori/elencoistruttori', [Admin_GestioneIstruttori::class, 'index']);
$routes->get('/admin/istruttori/(:segment)', [Admin_GestioneIstruttori::class, 'view']);
$routes->match(['get', 'post'], 'admin/lezioni/nuovalezione', [Admin_GestioneLezioni::class, 'nuovalezione']);
$routes->get('admin/lezioni/elencolezioni', [Admin_GestioneLezioni::class, 'index']);
$routes->get('/admin/lezioni/(:segment)', [Admin_GestioneLezioni::class, 'view']);

service('auth')->routes($routes);

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
