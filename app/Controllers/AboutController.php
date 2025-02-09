<?php

namespace App\Controllers;

use App\Models\MetaModel;
use App\Models\CategoryArtikelModel;
use App\Models\KontakModel;
use App\Models\MarketplaceModel;
use App\Models\ProfilModel;
use App\Models\SosmedModel;
use App\Controllers\BaseController;
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
        // Set data menu aktif
        $data['activeMenu'] = 'about';

        // Inisialisasi model
        $metaModel = new MetaModel();
        $profilModel = new ProfilModel();
        $kategoriModel = new CategoryArtikelModel();
        $sosmedModel = new SosmedModel();
        $marketplaceModel = new MarketplaceModel();
        $kontakModel = new KontakModel();

        // Ambil data meta dan profil
        $dataMeta = $metaModel->where('nama_halaman_en', 'about')->first();
        $dataProfil = $profilModel->first();

        // Ambil data kategori artikel terbanyak
        $kategori_teratas = $kategoriModel->getKategoriTerbanyak();

        // Ambil data sosial media
        $sosmed = $sosmedModel->findAll();

        // Ambil data marketplace
        $marketplace = $marketplaceModel->findAll();

        // Ambil data kontak
        $kontak = $kontakModel->first();

        // Kembalikan view dengan data yang diperlukan
        return view('about', [
            'meta' => $dataMeta,
            'profil' => $dataProfil,
            'lang' => $this->lang,
            'data' => $data,
            'kategori_teratas' => $kategori_teratas,
            'sosmed' => $sosmed,
            'marketplace' => $marketplace,
            'kontak' => $kontak
        ]);
    }
}
