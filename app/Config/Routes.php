<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/about', 'AboutController::index');
$routes->get('/detail', function () {
    return view('detail_article'); // 'contact' adalah nama file view di folder `app/Views`.
});


$routes->group('id', function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('tentang', 'AboutController::index');
    $routes->get('kontak', 'ContactController::index');
    $routes->get('produk', 'ProductController::index');
    $routes->get('(:segment)/produk-detail/(:segment)', 'ProductController::detail/$2');

});

$routes->group('en', function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('about', 'AboutController::index');
    $routes->get('contact', 'ContactController::index');
    $routes->get('product', 'ProductController::index');
    $routes->get('(:segment)/product-detail/(:segment)', 'ProductController::detail/$2');
});

// $routes->group('(:alpha)', ['filter' => 'lang'], function ($routes) {
//     $routes->get('/', 'Home::index');
//     $routes->get('about', 'AboutController::index');
//     $routes->get('contact', 'ContactController::index');
// });
