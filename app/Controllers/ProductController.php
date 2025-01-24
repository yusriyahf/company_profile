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
            'productLink' => $productLink
        ];

        // log_message('debug', 'slug : ' . print_r($data, true));
        return view('product.php', $data);
    }

    public function detail($slug = null)
    {
        $lang = session()->get('lang') ?? 'id';

        $productModel = new ProductModel();
        $metaModel = new MetaModel();
        $meta = $metaModel->first();
        $product = $productModel->where('slug_id', $slug)->orWhere('slug_en', $slug)->first();


        // Jika produk tidak ditemukan, redirect atau tampilkan error
        if (!$product) {
            return redirect()->to('/')->with('error', 'Produk tidak ditemukan');
        }

        // Periksa apakah slug sesuai dengan bahasa yang digunakan
        if (($lang === 'id' && $slug !== $product['slug_id']) || ($lang === 'en' && $slug !== $product['slug_en'])) {
            // redirect ke url yang benar
            $correctedSlug = $lang === 'id' ? $product['slug_id'] : $product['slug_en'];
            $correcturl = $lang === 'id' ? 'produk/produk-detail' : 'product/product-detail';
            return redirect()->to("$lang/$correcturl/$correctedSlug");
        }

        // Siapkan data untuk ditampilkan ke view
        $data = [
            'product' => $product,
            'lang' => $lang,
            'meta' => $meta, // Ambil data meta untuk halaman detail produk
        ];

        return view('detail_product', $data);
    }
}
