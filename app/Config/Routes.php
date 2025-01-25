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

    $routes->get('artikel', 'ArticleeController::index');
    $routes->get('artikel/(:segment)', 'ArticleeController::index/$1'); 
    $routes->get('artikel/(:segment)/(:segment)', 'ArticleeController::detail/$1/$2');  

    $routes->get('produk', 'ProductController::index');
    $routes->get('(:segment)/produk-detail/(:segment)', 'ProductController::detail/$2');
});

$routes->group('en', function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('about', 'AboutController::index');
    $routes->get('contact', 'ContactController::index');
    
    $routes->get('article', 'ArticleeController::index');
    $routes->get('article/(:segment)', 'ArticleeController::index/$1');  // Menangani kategori artikel berdasarkan slug
    $routes->get('article/(:segment)/(:segment)', 'ArticleeController::detail/$1/$2');  // Menangani detail artikel berdasarkan slug dan kategori

    $routes->get('product', 'ProductController::index');
    $routes->get('(:segment)/product-detail/(:segment)', 'ProductController::detail/$2');
});
