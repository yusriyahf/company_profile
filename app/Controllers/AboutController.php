<?php

namespace App\Controllers;

use App\Models\MetaModel;
use App\Models\CategoryArtikelModel;
use App\Models\KontakModel;
use App\Models\MarketplaceModel;
use App\Models\ProfilModel;
use App\Models\SosmedModel;
use App\Controllers\BaseController;
use App\Models\CategoryActivityModel;
use CodeIgniter\HTTP\ResponseInterface;

class AboutController extends BaseController
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
        $canonical = base_url("$this->lang/" . ($this->lang === 'id' ? 'tentang' : 'about'));

        // Jika URL saat ini tidak sama dengan canonical, lakukan redirect
        // if (current_url() !== $canonical) {
        //     return redirect()->to($canonical);
        // }
        // Set data menu aktif
        $data['activeMenu'] = 'about';

        // Inisialisasi model
        $metaModel = new MetaModel();
        $profilModel = new ProfilModel();
        $kategoriModel = new CategoryArtikelModel();
        $sosmedModel = new SosmedModel();
        $marketplaceModel = new MarketplaceModel();
        $kontakModel = new KontakModel();
        $kategoriAktivitasModel = new CategoryActivityModel();

        // Ambil data meta dan profil
        $dataMeta = $metaModel->where('id_meta', '2')->first();
        $dataProfil = $profilModel->first();

        // Ambil data kategori artikel terbanyak
        $kategori_teratas = $kategoriModel->getKategoriTerbanyak();
        $categories = $kategoriModel->findAll();
        $categoriesAktivitas = $kategoriAktivitasModel->findAll();

        // Ambil data sosial media
        $sosmed = $sosmedModel->findAll();

        // Ambil data marketplace
        $marketplace = $marketplaceModel->findAll();

        // Ambil data kontak
        $kontak = $kontakModel->first();

        // Kembalikan view dengan data yang diperlukan
        return view('about', [
            'canonical' => $canonical,
            'meta' => $dataMeta,
            'profil' => $dataProfil,
            'lang' => $this->lang,
            'data' => $data,
            'kategori_teratas' => $kategori_teratas,
            'sosmed' => $sosmed,
            'marketplace' => $marketplace,
            'kontak' => $kontak,
            'categories' => $categories,
            'categoriesAktivitas' => $categoriesAktivitas
        ]);
    }
}
