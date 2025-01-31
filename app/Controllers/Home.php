<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
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
        $dataMeta = $metaModel->where('nama_halaman', 'home')->first();
        $dataArtikel = $articleModel
            ->select('tb_artikel.*, tb_kategori_artikel.slug_kategori_id, tb_kategori_artikel.slug_kategori_en')
            ->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left')
            ->orderBy('tb_artikel.created_at', 'DESC')
            ->findAll();
        $dataSlider = $sliderModel->first();
        $dataKontak = $contactModel->first();
        $dataProfil = $profilModel->first();
        $product = $productModel->findAll();
        return view('index', ['meta' => $dataMeta, 'slider' => $dataSlider, 'profil' => $dataProfil, 'kontak' => $dataKontak, 'lang' => $this->lang, 'data' => $data, 'artikel' => $dataArtikel, 'product' => $product]);
    }
}
