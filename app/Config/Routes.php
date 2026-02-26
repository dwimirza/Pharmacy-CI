<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

$routes->get('/products', 'HomeController::products');

$routes->get('/admin/medicines', 'AdminController::medicines');
$routes->post('/admin/medicines/store', 'AdminController::storeMedicine');
$routes->get('/admin/medicines/edit/(:num)', 'AdminController::edit/$1');
$routes->post('/admin/medicines/update/(:num)', 'AdminController::update/$1');
$routes->post('/admin/medicines/delete/(:num)', 'AdminController::delete/$1');