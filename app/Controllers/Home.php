<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\CategoryArtikelModel;
use App\Models\KategoriModel;
use App\Models\KontakModel;
use App\Models\MetaModel;
use App\Models\ProductModel;
use App\Models\ProfilModel;
use App\Models\SliderModel;

class Home extends BaseController
{
    protected $lang;

    public function __construct()
    {
        $this->lang = session()->get('lang') ?? 'id';
    }

    public function index(): string
    {
        $data['activeMenu'] = 'home';
        $articleModel = new ArtikelModel();
        $metaModel = new MetaModel();
        $profilModel = new ProfilModel();
        $contactModel = new KontakModel();
        $sliderModel = new SliderModel();
        $productModel = new ProductModel();
        $dataMeta = $metaModel->where('nama_halaman_en', 'home')->first();
        $aboutMeta = $metaModel->where('nama_halaman_en', 'about')->first();
        $articleMeta = $metaModel->where('nama_halaman_en', 'article')->first();
        $productMeta = $metaModel->where('nama_halaman_en', 'product')->first();
        $contactMeta = $metaModel->where('nama_halaman_en', 'contact')->first();
        $dataArtikel = $articleModel
            ->select('tb_artikel.*, tb_kategori_artikel.slug_kategori_id, tb_kategori_artikel.slug_kategori_en')
            ->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left')
            ->orderBy('tb_artikel.created_at', 'DESC')
            ->findAll();
        $dataSlider = $sliderModel->first();
        $dataKontak = $contactModel->first();
        $dataProfil = $profilModel->first();
        $product = $productModel->findAll();
        $kategoriModel = new CategoryArtikelModel();
        // Ambil data kategori artikel terbanyak
        $kategori_teratas= $kategoriModel->getKategoriTerbanyak();
        return view('index', [
            'meta' => $dataMeta, 
            'articleMeta' => $articleMeta, 
            'aboutMeta' => $aboutMeta, 
            'productMeta' => $productMeta, 
            'contactMeta' => $contactMeta, 
            'slider' => $dataSlider, 
            'profil' => $dataProfil, 
            'kategori_teratas' => $kategori_teratas,
            'kontak' => $dataKontak, 'lang' => $this->lang, 'data' => $data, 'artikel' => $dataArtikel, 'product' => $product]);
            
    }
}
