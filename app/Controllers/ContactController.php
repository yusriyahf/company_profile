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
    protected $uri;

    public function __construct()
    {
        $this->lang = session()->get('lang') ?? 'id';
        $this->uri = service('uri');
    }

    public function index()
    {

        $canonical = base_url("$this->lang/" . ($this->lang === 'id' ? 'kontak' : 'contact'));



        // Jika URL saat ini tidak sama dengan canonical, lakukan redirect
        // if (current_url() !== $canonical) {
        //     return redirect()->to($canonical);
        // }
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
        $dataMeta = $metaModel->where('id_meta', '6')->first();
        $dataKontak = $kontakModel->first();
        $dataProfil = $profilModel->first();
        $kategoriTeratas = $kategoriModel->getKategoriTerbanyak();
        $categories = $kategoriModel->findAll();
        $sosmed = $sosmedModel->findAll();
        $marketplace = $marketplaceModel->findAll();
        $categoriesAktivitas = $kategoriAktivitasModel->findAll();

        // Kirim data ke view
        return view('contact', [
            'canonical' => $canonical,
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
