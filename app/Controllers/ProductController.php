<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryArtikelModel;
use App\Models\KontakModel;
use App\Models\MarketplaceModel;
use App\Models\MetaModel;
use App\Models\ProductModel;
use App\Models\ProfilModel;
use App\Models\SosmedModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    // Method untuk menampilkan halaman daftar produk
    public function index()
    {
        $metaModel = new MetaModel();
        $productModel = new ProductModel();
        $lang = session()->get('lang') ?? 'id';

        // Ambil data produk dari database
        $products = $productModel->findAll();

        $profilModel = new ProfilModel();
        $dataProfil = $profilModel->first();

        $kategoriModel = new CategoryArtikelModel();
        // Ambil data kategori artikel terbanyak
        $kategoriTeratas = $kategoriModel->getKategoriTerbanyak();

        // Ambil metadata halaman
        $dataMeta = $metaModel->where('nama_halaman_en', 'product')->first();

        // Tentukan link detail produk sesuai bahasa
        $detailProduct = ($lang === 'en') ? 'product-detail' : 'produk-detail';
        $productLink = ($lang === 'en') ? 'product' : 'produk';

        // Ambil data sosial media
        $sosmedModel = new SosmedModel();
        $sosmed = $sosmedModel->findAll();

        // Ambil data marketplace
        $marketplaceModel = new MarketplaceModel();
        $marketplace = $marketplaceModel->findAll();

        // Ambil data kontak
        $kontakModel = new KontakModel();
        $kontak = $kontakModel->first();

        $data = [
            'lang' => $lang,
            'meta' => $dataMeta,
            'products' => $products,
            'detailProduct' => $detailProduct,
            'productLink' => $productLink,
            'activeMenu' => 'product',
            'profil' => $dataProfil,
            'kategoriTeratas' => $kategoriTeratas,
            'sosmed' => $sosmed,
            'marketplace' => $marketplace,
            'kontak' => $kontak,
        ];

        return view('product.php', $data);
    }

    // Method untuk menampilkan halaman detail produk
    public function detail($slug = null)
    {
        log_message('debug', 'Slug diterima: ' . $slug);
        $lang = session()->get('lang') ?? 'id';

        $productModel = new ProductModel();
        $metaModel = new MetaModel();
        $profilModel = new ProfilModel();
        $dataProfil = $profilModel->first();

        $kategoriModel = new CategoryArtikelModel();
        // Ambil data kategori artikel terbanyak
        $kategoriTeratas = $kategoriModel->getKategoriTerbanyak();

        // Cari produk berdasarkan slug (ID atau EN)
        $product = $productModel->where('slug_id', $slug)->orWhere('slug_en', $slug)->first();

        // Ambil metadata untuk halaman detail produk
        $metaData = $metaModel->where('nama_halaman_en', 'Product Detail')->first();

        // Log hasil pencarian produk
        log_message('debug', 'Produk ditemukan: ' . print_r($product, true));

        // Jika produk tidak ditemukan, redirect ke halaman utama
        if (!$product) {
            log_message('error', 'Produk tidak ditemukan dengan slug: ' . $slug);
            return redirect()->to('/')->with('error', 'Produk tidak ditemukan');
        }

        // Periksa apakah slug sesuai dengan bahasa yang digunakan
        if (($lang === 'id' && $slug !== $product['slug_id']) || ($lang === 'en' && $slug !== $product['slug_en'])) {
            // Log sebelum melakukan redireksi
            log_message('debug', 'Slug yang sesuai untuk bahasa ' . $lang . ': ' . $product['slug_id'] . ' (ID) / ' . $product['slug_en'] . ' (EN)');

            // Redirect ke URL yang benar
            $correctedSlug = $lang === 'id' ? $product['slug_id'] : $product['slug_en'];
            $correctUrl = $lang === 'id' ? 'produk/produk-detail' : 'product/product-detail';
            log_message('debug', 'Redireksi ke URL yang benar: ' . "$lang/$correctUrl/$correctedSlug");
            return redirect()->to("$lang/$correctUrl/$correctedSlug");
        }

        // Ambil data sosial media
        $sosmedModel = new SosmedModel();
        $sosmed = $sosmedModel->findAll();

        // Ambil data marketplace
        $marketplaceModel = new MarketplaceModel();
        $marketplace = $marketplaceModel->findAll();

        // Ambil data kontak
        $kontakModel = new KontakModel();
        $kontak = $kontakModel->first();

        // Siapkan data untuk ditampilkan ke view
        $data = [
            'product' => $product,
            'lang' => $lang,
            'meta' => $metaData,
            'activeMenu' => 'product',
            'profil' => $dataProfil,
            'kategoriTeratas' => $kategoriTeratas,
            'sosmed' => $sosmed,
            'marketplace' => $marketplace,
            'kontak' => $kontak,
        ];

        return view('detail_product', $data);
    }
}
