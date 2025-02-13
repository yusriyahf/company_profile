<?php

namespace App\Controllers;

use App\Models\ActivityModel;
use App\Models\ArtikelModel;
use App\Models\CategoryActivityModel;
use App\Models\CategoryArtikelModel;
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
        $data['activeMenu'] = 'home';
        // Inisialisasi Model
        $articleModel = new ArtikelModel();
        $metaModel = new MetaModel();
        $profilModel = new ProfilModel();
        $contactModel = new KontakModel();
        $aktivitasModel = new ActivityModel();
        $sliderModel = new SliderModel();
        $productModel = new ProductModel();
        $kategoriModel = new CategoryArtikelModel();
        $kategoriAktivitasModel = new CategoryActivityModel();
        $sosmedModel = new SosmedModel();
        $marketplaceModel = new MarketplaceModel();

        // Mengambil data dari database
        $dataMeta = $metaModel->where('nama_halaman_en', 'home')->first();
        $aboutMeta = $metaModel->where('nama_halaman_en', 'about')->first();
        $articleMeta = $metaModel->where('nama_halaman_en', 'article')->first();
        $productMeta = $metaModel->where('nama_halaman_en', 'product')->first();
        $aktivitasMeta = $metaModel->where('nama_halaman_en', 'activity')->first();
        $contactMeta = $metaModel->where('nama_halaman_en', 'contact')->first();

        $dataArtikel = $articleModel
            ->select('
                tb_artikel.foto_artikel, tb_artikel.*,
                tb_kategori_artikel.nama_kategori_en,
                tb_kategori_artikel.nama_kategori_id
            ')
            ->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left')
            ->orderBy('tb_artikel.created_at', 'DESC')
            ->limit(4)
            ->findAll();

        $slider = $sliderModel->where('id_slider', $companyId)->first();
        $dataKontak = $contactModel->first();
        $dataProfil = $profilModel->first();
        $dataAktivitas = $aktivitasModel->limit(3)->findAll();
        $product = $productModel->findAll();
        $kategori_teratas = $kategoriModel->findAll();
        $sosmed = $sosmedModel->findAll();
        $marketplace = $marketplaceModel->findAll();
        $allArticles = $articleModel->getArticle($this->lang);
        // dd($allArticles);
        $sideArtikel = $articleModel->getSideArticlesWithCategoryRand($this->lang);

        return view('index', [
            'meta' => $dataMeta,
            'articleMeta' => $articleMeta,
            'aboutMeta' => $aboutMeta,
            'aktivitasMeta' => $aktivitasMeta,
            'productMeta' => $productMeta,
            'contactMeta' => $contactMeta,
            'slider' => $slider,
            'profil' => $dataProfil,
            'kategori_teratas' => $kategori_teratas,
            'sosmed' => $sosmed,
            'marketplace' => $marketplace,
            'kontak' => $dataKontak,
            'lang' => $this->lang,
            'artikel' => $dataArtikel,
            'aktivitas' => $dataAktivitas,
            'product' => $product,
            'categories' => $kategoriModel->findAll(),
            'categoriesAktivitas' => $kategoriAktivitasModel->findAll(),
            'article' => $allArticles,
            'data' => $data,
            'sideArtikel' => $sideArtikel,
        ]);
    }
}
