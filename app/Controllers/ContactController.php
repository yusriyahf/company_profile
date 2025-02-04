<?php

namespace App\Controllers;

use App\Models\MetaModel;
use App\Controllers\BaseController;
use App\Models\CategoryArtikelModel;
use App\Models\KontakModel;
use App\Models\ProfilModel;
use CodeIgniter\HTTP\ResponseInterface;

class ContactController extends BaseController
{
    protected $lang;

    public function __construct()
    {
        $this->lang = session()->get('lang') ?? 'id';
    }

    public function index()
    {
        $data['activeMenu'] = 'contact';
        $metaModel = new MetaModel();
        $kontakModel = new KontakModel();   
        $profilModel = new ProfilModel();
        $dataProfil = $profilModel->first();
        

        $dataMeta = $metaModel->where('nama_halaman_en', 'contact')->first();
        $dataKontak = $kontakModel->first();
        $kategoriModel = new CategoryArtikelModel();
        // Ambil data kategori artikel terbanyak
        $kategori_teratas= $kategoriModel->getKategoriTerbanyak();

        return view('contact', ['meta' => $dataMeta, 'kontak' => $dataKontak, 'lang' => $this->lang, 'data' => $data, 'profil' => $dataProfil, 'kategori_teratas' => $kategori_teratas]);
    }
}
