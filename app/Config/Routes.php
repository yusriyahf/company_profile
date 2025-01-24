<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/about', 'AboutController::index');

$routes->group('id', function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('tentang', 'AboutController::index');
    $routes->get('kontak', 'ContactController::index');
    $routes->get('artikel', 'ArticleController::index');
    $routes->get('artikel/(:segment)?', 'ArticleController::index/$1');
    $routes->get('artikel/(:segment)/(:segment)', 'ArticleController::detail/$1/$2');
    $routes->get('produk', 'ProductController::index');
    $routes->get('(:segment)/produk-detail/(:segment)', 'ProductController::detail/$2');
});

$routes->group('en', function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('about', 'AboutController::index');
    $routes->get('contact', 'ContactController::index');
    $routes->get('article', 'ArticleController::index');
    $routes->get('article/(:segment)?', 'ArticleController::index/$1');

    $routes->get('article/(:segment)/(:segment)', 'ArticleController::detail/$1/$2');
    $routes->get('product', 'ProductController::index');
    $routes->get('(:segment)/product-detail/(:segment)', 'ProductController::detail/$2');
});
