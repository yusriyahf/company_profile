<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;
use App\Models\CategoryActivityModel;
use App\Models\CategoryArtikelModel;
use App\Models\KategoriModel;
use App\Models\KontakModel;
use App\Models\MarketplaceModel;
use App\Models\MetaModel;
use App\Models\ProductModel;
use App\Models\ProfilModel;
use App\Models\SosmedModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    public function index()
    {
        $metaModel = new MetaModel();
        $productModel = new ProductModel();
        $lang = session()->get('lang') ?? 'id';

        $canonical = base_url("$lang/" . ($lang === 'id' ? 'produk' : 'product'));

        // if (current_url() !== $canonical) {
        //     return redirect()->to($canonical);
        // }
        // Tentukan segment URL berdasarkan bahasa
        $productSegment = ($lang === 'id') ? 'produk' : 'product';



        // Ambil data produk dari database
        $products = $productModel->findAll();

        $profilModel = new ProfilModel();
        $dataProfil = $profilModel->first();

        $kategoriModel = new CategoryArtikelModel();
        $kategoriTeratas = $kategoriModel->getKategoriTerbanyak();
        $categories = $kategoriModel->findAll();

        $kategoriAktivitasModel = new CategoryActivityModel();
        $categoriesAktivitas = $kategoriAktivitasModel->findAll();

        // Ambil metadata halaman
        $dataMeta = $metaModel->where('id_meta', '3')->first();

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
            'canonical' => $canonical,
            'product' => $products,
            'productLink' => $productSegment,
            'activeMenu' => 'product',
            'profil' => $dataProfil,
            'kategori_teratas' => $kategoriTeratas,
            'sosmed' => $sosmed,
            'marketplace' => $marketplace,
            'kontak' => $kontak,
            'categories' => $categories,
            'categoriesAktivitas' => $categoriesAktivitas,
        ];

        return view('product.php', $data);
    }

    // Method untuk menampilkan halaman detail produk
    public function detail($slug)
    {
        $lang = session()->get('lang') ?? 'id';
        $productModel = new ProductModel();


        $product = $productModel->where('slug_id', $slug)->orWhere('slug_en', $slug)->first();



        $metaModel = new MetaModel();
        $profilModel = new ProfilModel();
        $dataProfil = $profilModel->first();

        $kategoriModel = new CategoryArtikelModel();
        $kategoriTeratas = $kategoriModel->getKategoriTerbanyak();
        $categories = $kategoriModel->findAll();

        $kategoriAktivitasModel = new CategoryActivityModel();
        $categoriesAktivitas = $kategoriAktivitasModel->findAll();

        // Cari produk berdasarkan slug (ID atau EN)

        // Jika produk tidak ditemukan, tampilkan error 404
        if (!$product) {
            log_message('error', 'Produk tidak ditemukan dengan slug: ' . $slug);
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Jika URL yang diakses tidak sesuai, redirect ke URL yang benar
        // if (current_url() !== $canonical) {
        //     return redirect()->to($canonical);
        // }

        // Ambil metadata untuk halaman detail produk
        $metaData = $metaModel->where('id_meta', '7')->first();

        log_message('debug', 'Produk ditemukan: ' . print_r($product, true));

        // Ambil data sosial media
        $sosmedModel = new SosmedModel();
        $sosmed = $sosmedModel->findAll();

        // Ambil data marketplace
        $marketplaceModel = new MarketplaceModel();
        $marketplace = $marketplaceModel->findAll();

        // Ambil data kontak
        $kontakModel = new KontakModel();
        $kontak = $kontakModel->first();

        $slugCheck = ($lang === 'id') ? $product['slug_id'] : $product['slug_en'];

        $canonical = base_url("$lang/" . ($lang === 'id' ? 'produk' : 'product') . '/' . $slugCheck);

        if (current_url() !== $canonical) {
            return redirect()->to($canonical);
        }

        // Siapkan data untuk ditampilkan ke view
        $data = [
            'canonical' => $canonical,
            'product' => $product,
            'lang' => $lang,
            'meta' => $metaData,
            'activeMenu' => 'product',
            'profil' => $dataProfil,
            'kategori_teratas' => $kategoriTeratas,
            'sosmed' => $sosmed,
            'marketplace' => $marketplace,
            'kontak' => $kontak,
            'categories' => $categories,
            'categoriesAktivitas' => $categoriesAktivitas,
        ];

        return view('detail_product', $data);
    }
}
