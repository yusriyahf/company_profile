<?php

namespace App\Controllers;

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
        $metaModel = new MetaModel();
        $profilModel = new ProfilModel();
        $contactModel = new KontakModel();
        $sliderModel = new SliderModel();
        $productModel = new ProductModel();
        $dataMeta = $metaModel->where('nama_halaman', 'home')->first();
        $dataSlider = $sliderModel->first();
        $dataKontak = $contactModel->first();
        $dataProfil = $profilModel->first();
        $product = $productModel->findAll();
        return view('index', ['meta' => $dataMeta, 'slider' => $dataSlider, 'profil' => $dataProfil, 'kontak' => $dataKontak, 'lang' => $this->lang, 'data' => $data, 'product' => $product]);
    }
}
