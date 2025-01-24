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
    $routes->get('artikel/(:segment)', 'ArticleController::detail/$1');
});

$routes->group('en', function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('about', 'AboutController::index');
    $routes->get('contact', 'ContactController::index');
    $routes->get('article', 'ArticleController::index');
    $routes->get('article/(:segment)', 'ArticleController::detail/$1');
});

// $routes->group('(:alpha)', ['filter' => 'lang'], function ($routes) {
//     $routes->get('/', 'Home::index');
//     $routes->get('about', 'AboutController::index');
//     $routes->get('contact', 'ContactController::index');
// });
