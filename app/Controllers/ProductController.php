<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MetaModel;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    public function index()
    {
        $activeMenu = 'product';
        $metaModel = new MetaModel();
        $productModel = new ProductModel();
        $lang = session()->get('lang') ?? 'id';
        $product = $productModel->findAll();

        $dataMeta = $metaModel->where('nama_halaman', 'home')->first();
        $detailProduct = ($lang === 'en') ? 'product-detail' : 'produk-detail';
        $productLink = ($lang === 'en')  ? 'product' : 'produk';

        $data = [
            'lang' => $lang,
            'meta' => $dataMeta,
            'product' => $product,
            'detailProduct' => $detailProduct,
            'productLink' => $productLink,
            'activeMenu' => $activeMenu
        ];

        // log_message('debug', 'slug : ' . print_r($data, true));
        return view('product.php', $data);
    }

    public function detail($slug = null)
    {
        log_message('debug', 'isi slug ' . $slug);
        $lang = session()->get('lang') ?? 'id';

        // Menambahkan log untuk melacak nilai slug yang diterima
        log_message('debug', 'Slug yang diterima: ' . $slug);

        $productModel = new ProductModel();
        $metaModel = new MetaModel();
        $meta = $metaModel->first();

        // Cek apakah produk ada berdasarkan slug untuk bahasa ID atau EN
        $product = $productModel->where('slug_id', $slug)->orWhere('slug_en', $slug)->first();

        // Log hasil pencarian produk
        log_message('debug', 'Produk ditemukan: ' . print_r($product, true));

        // Jika produk tidak ditemukan, redirect atau tampilkan error
        if (!$product) {
            log_message('error', 'Produk tidak ditemukan dengan slug: ' . $slug);
            return redirect()->to('/')->with('error', 'Produk tidak ditemukan');
        }

        // Periksa apakah slug sesuai dengan bahasa yang digunakan
        if (($lang === 'id' && $slug !== $product['slug_id']) || ($lang === 'en' && $slug !== $product['slug_en'])) {
            // Log sebelum melakukan redireksi
            log_message('debug', 'Slug yang sesuai untuk bahasa ' . $lang . ': ' . $product['slug_id'] . ' (ID) / ' . $product['slug_en'] . ' (EN)');

            // redirect ke url yang benar
            $correctedSlug = $lang === 'id' ? $product['slug_id'] : $product['slug_en'];
            $correcturl = $lang === 'id' ? 'produk/produk-detail' : 'product/product-detail';
            log_message('debug', 'Redireksi ke URL yang benar: ' . "$lang/$correcturl/$correctedSlug");
            return redirect()->to("$lang/$correcturl/$correctedSlug");
        }

        // Siapkan data untuk ditampilkan ke view
        $data = [
            'product' => $product,
            'lang' => $lang,
            'data' => $activeMenu,
            'meta' => $meta, // Ambil data meta untuk halaman detail produk
        ];

        return view('detail_product', $data);
    }
}
