<?php

use CodeIgniter\Router\RouteCollection;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/about', 'AboutController::index');


// ADMIN ROUTES
$routes->get('login', 'LoginController::index');
$routes->post('login/process', 'LoginController::process');
$routes->get('logout', 'LoginController::logout');

$routes->get('admin/dashboard', 'admin\DashboardController::index');

// ADMIN PROFILE
$routes->get('admin/profil/edit', 'admin\Profil::edit');
$routes->post('admin/profil/proses_edit', 'admin\Profil::proses_edit');

// ADMIN PRODUCTS
$routes->get('admin/produk/index', 'admin\Produk::index');
$routes->get('admin/produk/tambah', 'admin\Produk::tambah');
$routes->post('admin/produk/proses_tambah', 'admin\Produk::proses_tambah');
$routes->get('admin/produk/edit/(:num)', 'admin\Produk::edit/$1');
$routes->post('admin/produk/proses_edit/(:num)', 'admin\Produk::proses_edit/$1');
$routes->get('admin/produk/delete/(:any)', 'admin\Produk::delete/$1');

// ADMIN SLIDER
$routes->get('admin/slider/index', 'admin\Slider::index');
$routes->get('admin/slider/tambah', 'admin\Slider::tambah');
$routes->post('admin/slider/proses_tambah', 'admin\Slider::proses_tambah');
$routes->get('admin/slider/edit/(:num)', 'admin\Slider::edit/$1');
$routes->post('admin/slider/proses_edit/(:num)', 'admin\Slider::proses_edit/$1');
$routes->get('admin/slider/delete/(:any)', 'admin\Slider::delete/$1');

// ADMIN CATEGORY ACTIVITIES
$routes->get('admin/kategoriAktivitas/index', 'admin\KategoriAktivitas::index');
$routes->get('admin/kategoriAktivitas/tambah', 'admin\KategoriAktivitas::tambah');
$routes->post('admin/kategoriAktivitas/proses_tambah', 'admin\KategoriAktivitas::proses_tambah');
$routes->get('admin/kategoriAktivitas/edit/(:num)', 'admin\KategoriAktivitas::edit/$1');
$routes->post('admin/kategoriAktivitas/proses_edit/(:num)', 'admin\KategoriAktivitas::proses_edit/$1');
$routes->get('admin/kategoriAktivitas/delete/(:any)', 'admin\KategoriAktivitas::delete/$1');

// ADMIN ACTIVITIES
$routes->get('admin/aktivitas/index', 'admin\Aktivitas::index');
$routes->get('admin/aktivitas/tambah', 'admin\Aktivitas::tambah');
$routes->post('admin/aktivitas/proses_tambah', 'admin\Aktivitas::proses_tambah');
$routes->get('admin/aktivitas/edit/(:num)', 'admin\Aktivitas::edit/$1');
$routes->post('admin/aktivitas/proses_edit/(:num)', 'admin\Aktivitas::proses_edit/$1');
$routes->get('admin/aktivitas/delete/(:any)', 'admin\Aktivitas::delete/$1');

// ADMIN CATEGORY ARTICLES
$routes->get('admin/kategoriArtikel/index', 'admin\KategoriArtikel::index');
$routes->get('admin/kategoriArtikel/tambah', 'admin\KategoriArtikel::tambah');
$routes->post('admin/kategoriArtikel/proses_tambah', 'admin\KategoriArtikel::proses_tambah');
$routes->get('admin/kategoriArtikel/edit/(:num)', 'admin\KategoriArtikel::edit/$1');
$routes->post('admin/kategoriArtikel/proses_edit/(:num)', 'admin\KategoriArtikel::proses_edit/$1');
$routes->get('admin/kategoriArtikel/delete/(:any)', 'admin\KategoriArtikel::delete/$1');

// ADMIN ARTICLES CATEGORIES
$routes->get('admin/kategoriartikel', 'admin\ArticleCategoryController::index');
$routes->get('admin/kategoriartikel/create', 'admin\ArticleCategoryController::create');
$routes->post('admin/kategoriartikel/store', 'admin\ArticleCategoryController::store');
$routes->get('admin/kategoriartikel/edit/(:num)', 'admin\ArticleCategoryController::edit/$1');
$routes->post('admin/kategoriartikel/update/(:num)', 'admin\ArticleCategoryController::update/$1');
$routes->get('admin/kategoriartikel/delete/(:any)', 'admin\ArticleCategoryController::delete/$1');

// ADMIN ARTICLES
$routes->get('admin/artikel/index', 'admin\ArtikelController::index');
$routes->get('admin/artikel/tambah', 'admin\ArtikelController::tambah');
$routes->post('admin/artikel/proses_tambah', 'admin\ArtikelController::proses_tambah');
$routes->get('admin/artikel/edit/(:num)', 'admin\ArtikelController::edit/$1');
$routes->post('admin/artikel/proses_edit/(:num)', 'admin\ArtikelController::proses_edit/$1');
$routes->get('admin/artikel/delete/(:any)', 'admin\ArtikelController::delete/$1');

// ADMIN ARTICLES CATEGORIES
$routes->get('admin/kategoriartikel', 'admin\ArticleCategoryController::index');
$routes->get('admin/kategoriartikel/create', 'admin\ArticleCategoryController::create');
$routes->post('admin/kategoriartikel/store', 'admin\ArticleCategoryController::store');
$routes->get('admin/kategoriartikel/edit/(:num)', 'admin\ArticleCategoryController::edit/$1');
$routes->post('admin/kategoriartikel/update/(:num)', 'admin\ArticleCategoryController::update/$1');
$routes->get('admin/kategoriartikel/delete/(:any)', 'admin\ArticleCategoryController::delete/$1');

// ADMIN MARKETPLACE
$routes->get('admin/marketplace', 'admin\MarketplaceController::index');
$routes->get('admin/marketplace/create', 'admin\MarketplaceController::create');
$routes->post('admin/marketplace/store', 'admin\MarketplaceController::store');
$routes->get('admin/marketplace/edit/(:num)', 'admin\MarketplaceController::edit/$1');
$routes->post('admin/marketplace/update/(:num)', 'admin\MarketplaceController::update/$1');
$routes->get('admin/marketplace/delete/(:any)', 'admin\MarketplaceController::delete/$1');

// ADMIN KONTAK
$routes->get('admin/kontak', 'admin\KontakController::edit');
$routes->post('admin/kontak/update/(:num)', 'admin\KontakController::update/$1');

// ADMIN SOSMED
$routes->get('admin/sosmed', 'admin\SosmedController::index');
$routes->get('admin/sosmed/create', 'admin\SosmedController::create');
$routes->post('admin/sosmed/store', 'admin\SosmedController::store');
$routes->get('admin/sosmed/edit/(:num)', 'admin\SosmedController::edit/$1');
$routes->post('admin/sosmed/update/(:num)', 'admin\SosmedController::update/$1');
$routes->get('admin/sosmed/delete/(:any)', 'admin\SosmedController::delete/$1');

// ADMIN META
$routes->get('admin/meta/index', 'admin\MetaController::index');
$routes->get('admin/meta/tambah', 'admin\MetaController::tambah');
$routes->post('admin/meta/proses_tambah', 'admin\MetaController::proses_tambah');
$routes->get('admin/meta/edit/(:num)', 'admin\MetaController::edit/$1');
$routes->post('admin/meta/proses_edit/(:num)', 'admin\MetaController::proses_edit/$1');
$routes->get('admin/meta/delete/(:any)', 'admin\MetaController::delete/$1');



$routes->get('/', function () {
    return redirect()->to('/id/'); // Default redirect ke /en/home
});

// $routes->set404Override('App\Controllers\Home::notFound');


$routes->group('id', function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('kontak', 'ContactController::index');
    $routes->get('tentang', 'AboutController::index');
    $routes->get('artikel', 'ArticleeController::index');
    $routes->get('artikel/(:segment)', 'ArticleeController::index/$1');
    $routes->get('artikel/(:segment)/(:segment)', 'ArticleeController::detail/$1/$2');

    $routes->get('aktivitas', 'ActivityController::index');
    $routes->get('aktivitas/(:segment)', 'ActivityController::index/$1');
    $routes->get('aktivitas/(:segment)/(:segment)', 'ActivityController::detail/$1/$2');

    $routes->get('produk', 'ProductController::index');
    $routes->get('produk/(:segment)', 'ProductController::detail/$1');
    $routes->get('(:segment)', 'ContentController::index');
    $routes->get('(:segment)/(:segment)', 'ContentController::category');
    $routes->get('(:segment)/(:segment)/(:segment)', 'ContentController::detail');
});

$routes->group('en', function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('contact', 'ContactController::index');
    $routes->get('about', 'AboutController::index');
    $routes->get('article', 'ArticleeController::index');
    $routes->get('article/(:segment)', 'ArticleeController::index/$1');
    $routes->get('article/(:segment)/(:segment)', 'ArticleeController::detail/$1/$2');

    $routes->get('activity', 'ActivityController::index');
    $routes->get('activity/(:segment)', 'ActivityController::index/$1');
    $routes->get('activity/(:segment)/(:segment)', 'ActivityController::detail/$1/$2');

    $routes->get('product', 'ProductController::index');
    $routes->get('product/(:segment)', 'ProductController::detail/$1');
    $routes->get('(:segment)', 'ContentController::index');
    $routes->get('(:segment)/(:segment)', 'ContentController::category');
    $routes->get('(:segment)/(:segment)/(:segment)', 'ContentController::detail');
});
