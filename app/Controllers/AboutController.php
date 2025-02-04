<?php

namespace App\Controllers;

use App\Models\MetaModel;
use App\Controllers\BaseController;
use App\Models\CategoryArtikelModel;
use App\Models\ProfilModel;
use CodeIgniter\HTTP\ResponseInterface;


class AboutController extends BaseController
{
    protected $lang;

    public function __construct()
    {
        $this->lang = session()->get('lang') ?? 'id';
    }

    public function index()
    {
        $data['activeMenu'] = 'about';
        $metaModel = new MetaModel();
        $profilModel = new ProfilModel();

        $dataMeta = $metaModel->where('nama_halaman_en', 'about')->first();
        $dataProfil = $profilModel->first();
        $kategoriModel = new CategoryArtikelModel();
        // Ambil data kategori artikel terbanyak
        $kategori_teratas= $kategoriModel->getKategoriTerbanyak();
        return view('about', ['meta' => $dataMeta, 'profil' => $dataProfil, 'lang' => $this->lang, 'data' => $data, 'kategori_teratas' => $kategori_teratas]);
    }
}
