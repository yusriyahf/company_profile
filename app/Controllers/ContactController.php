<?php

namespace App\Controllers;

use App\Models\MetaModel;
use App\Controllers\BaseController;
use App\Models\CategoryActivityModel;
use App\Models\CategoryArtikelModel;
use App\Models\KontakModel;
use App\Models\MarketplaceModel;
use App\Models\ProfilModel;
use App\Models\SosmedModel;

class ContactController extends BaseController
{
    protected $lang;

    public function __construct()
    {
        // Set bahasa default dari sesi atau gunakan 'id'
        $this->lang = session()->get('lang') ?? 'id';
    }

    public function index()
    {
        // Set menu aktif
        $data['activeMenu'] = 'contact';

        // Instansiasi model yang dibutuhkan
        $metaModel = new MetaModel();
        $kontakModel = new KontakModel();   
        $profilModel = new ProfilModel();
        $kategoriModel = new CategoryArtikelModel();
        $sosmedModel = new SosmedModel();
        $marketplaceModel = new MarketplaceModel();
        $kategoriAktivitasModel = new CategoryActivityModel();


        // Ambil data dari database
        $dataMeta = $metaModel->where('nama_halaman_en', 'contact')->first();
        $dataKontak = $kontakModel->first();
        $dataProfil = $profilModel->first();
        $kategoriTeratas = $kategoriModel->getKategoriTerbanyak();
        $categories = $kategoriModel->findAll();
        $sosmed = $sosmedModel->findAll();
        $marketplace = $marketplaceModel->findAll();
        $categoriesAktivitas = $kategoriAktivitasModel->findAll();

        // Kirim data ke view
        return view('contact', [
            'meta' => $dataMeta,
            'kontak' => $dataKontak,
            'lang' => $this->lang,
            'data' => $data,
            'profil' => $dataProfil,
            'kategori_teratas' => $kategoriTeratas,
            'sosmed' => $sosmed,
            'marketplace' => $marketplace,
            'categories' => $categories,
            'categoriesAktivitas' => $categoriesAktivitas
        ]);
    }
}
