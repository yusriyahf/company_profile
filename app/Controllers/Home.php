<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\CategoryArtikelModel;
use App\Models\KategoriModel;
use App\Models\KontakModel;
use App\Models\MarketplaceModel;
use App\Models\MetaModel;
use App\Models\ProductModel;
use App\Models\ProfilModel;
use App\Models\SliderModel;
use App\Models\SosmedModel;

class Home extends BaseController
{
    protected $lang;

    public function __construct()
    {
        $this->lang = session()->get('lang') ?? 'id';
    }

    public function index($companyId = 1): string
    {
        // Set data menu aktif
        $data['activeMenu'] = 'home';

        // Inisialisasi model
        $articleModel = new ArtikelModel();
        $metaModel = new MetaModel();
        $profilModel = new ProfilModel();
        $contactModel = new KontakModel();
        $sliderModel = new SliderModel();
        $productModel = new ProductModel();
        $kategoriModel = new CategoryArtikelModel();
        $sosmedModel = new SosmedModel();
        $marketplaceModel = new MarketplaceModel();

        // Ambil data meta
        $dataMeta = $metaModel->where('nama_halaman_en', 'home')->first();
        $aboutMeta = $metaModel->where('nama_halaman_en', 'about')->first();
        $articleMeta = $metaModel->where('nama_halaman_en', 'article')->first();
        $productMeta = $metaModel->where('nama_halaman_en', 'product')->first();
        $contactMeta = $metaModel->where('nama_halaman_en', 'contact')->first();

        // Ambil data artikel
        $dataArtikel = $articleModel
            ->select('tb_artikel.*, tb_kategori_artikel.slug_kategori_id, tb_kategori_artikel.slug_kategori_en')
            ->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left')
            ->orderBy('tb_artikel.created_at', 'DESC')
            ->findAll();

        // Ambil data slider berdasarkan id_slider (sama dengan id_perusahaan)
        $slider = $sliderModel->where('id_slider', $companyId)->first();

        // Ambil data kontak, profil, dan produk
        $dataKontak = $contactModel->first();
        $dataProfil = $profilModel->first();
        $product = $productModel->findAll();

        // Ambil data kategori artikel terbanyak
        $kategori_teratas = $kategoriModel->getKategoriTerbanyak();

        // Ambil data sosial media
        $sosmed = $sosmedModel->findAll();

        // Ambil data marketplace
        $marketplace = $marketplaceModel->findAll();

        // Kembalikan view dengan data yang diperlukan
        return view('index', [
            'meta' => $dataMeta,
            'articleMeta' => $articleMeta,
            'aboutMeta' => $aboutMeta,
            'productMeta' => $productMeta,
            'contactMeta' => $contactMeta,
            'slider' => $slider,
            'profil' => $dataProfil,
            'kategori_teratas' => $kategori_teratas,
            'sosmed' => $sosmed,
            'marketplace' => $marketplace,
            'kontak' => $dataKontak,
            'lang' => $this->lang,
            'data' => $data,
            'artikel' => $dataArtikel,
            'product' => $product
        ]);
    }
} 
