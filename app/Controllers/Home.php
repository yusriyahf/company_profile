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

    public function notFound()
    {
        return redirect()->to('/');
    }

    public function index($companyId = 1): string
    {
        $canonical = base_url("$this->lang/");

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
        $dataMeta = $metaModel->where('id_meta', '1')->first();
        $aboutMeta = $metaModel->where('id_meta', '2')->first();
        $articleMeta = $metaModel->where('id_meta', '5')->first();
        $productMeta = $metaModel->where('id_meta', '3')->first();
        $aktivitasMeta = $metaModel->where('id_meta', '4')->first();
        $contactMeta = $metaModel->where('id_meta', '6')->first();

        $dataArtikel = $articleModel
            ->select('
                tb_artikel.foto_artikel, tb_artikel.*,
                tb_kategori_artikel.nama_kategori_en,
                tb_kategori_artikel.nama_kategori_id
            ')
            ->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left')
            ->orderBy('tb_artikel.created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $slider = $sliderModel->findAll(); // Mengambil semua data dari tb_slider
        $dataKontak = $contactModel->first();
        $dataProfil = $profilModel->first();
        $dataAktivitas = $aktivitasModel->limit(10)->findAll();
        $product = $productModel->limit(10)->findAll();
        $kategori_teratas = $kategoriModel->findAll();
        $sosmed = $sosmedModel->findAll();
        $marketplace = $marketplaceModel->findAll();
        $allArticles = $articleModel->getArticle($this->lang);
        // dd($allArticles);
        $sideArtikel = $articleModel->getSideArticlesWithCategoryRand($this->lang);

        return view('index', [
            'canonical' => $canonical,
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
