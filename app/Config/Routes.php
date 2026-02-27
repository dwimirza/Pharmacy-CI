<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

$routes->get('/products', 'HomeController::products');
$routes->get('/product/(:num)', 'HomeController::productDetail/$1');

$routes->get('/register', 'Auth::register');
$routes->get('/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::process');
$routes->post('/auth/register', 'Auth::processRegister');
$routes->get('/logout', 'Auth::logout');

$routes->post('/checkout', 'Checkout::store');

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/admin/medicines', 'AdminController::medicines');
    $routes->post('/admin/medicines/store', 'AdminController::storeMedicine');
    $routes->get('/admin/medicines/edit/(:num)', 'AdminController::edit/$1');
    $routes->post('/admin/medicines/update/(:num)', 'AdminController::update/$1');
    $routes->post('/admin/medicines/delete/(:num)', 'AdminController::delete/$1');
});

$routes->get('/cart', 'Cart::index');
$routes->post('/cart/add', 'Cart::add');
$routes->post('/cart/update', 'Cart::update');
$routes->get('/cart/remove/(:num)', 'Cart::remove/$1');