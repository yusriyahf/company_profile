<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;
use App\Models\CategoryActivityModel;
use App\Models\CategoryArtikelModel;
use App\Models\KontakModel;
use App\Models\MarketplaceModel;
use App\Models\MetaModel;
use App\Models\ProfilModel;
use App\Models\SosmedModel;

class ArticleeController extends BaseController
{
    public function index($slugCategory = null)
    {
        $data['activeMenu'] = 'article';
        $lang = session()->get('lang') ?? 'id'; // Mendapatkan bahasa aktif dari sesi

        // Inisialisasi model
        $categoryModel = new CategoryArtikelModel();
        $artikelModel = new ArtikelModel();
        $metaModel = new MetaModel();
        $profilModel = new ProfilModel();
        $dataProfil = $profilModel->first();

        // Cek apakah kategori berdasarkan slug ditemukan, sesuai dengan bahasa
        $category = $slugCategory ? $categoryModel->getCategoryBySlug($slugCategory) : null;


        $categoryId = $category ? $category['id_kategori_artikel'] : null;

        // $categorySlugCheck = ($lang === 'id') ? $category['slug_kategori_id'] : $category['slug_kategori_en'];

        $canonical = base_url("$lang/" . ($lang === 'id' ? 'artikel' : 'article') . '/' . $slugCategory);

        if (current_url() !== $canonical) {
            return redirect()->to($canonical);
        }

        // Jika kategori tidak ditemukan, redire    ct ke halaman utama artikel
        if ($slugCategory && !$category) {
            log_message('warning', 'Kategori tidak ditemukan untuk slug: ' . $slugCategory);
            return redirect()->to(base_url($lang === 'id' ? 'id/artikel' : 'en/article'));
        }

        // Validasi slug dan redirect ke slug yang benar jika tidak sesuai dengan bahasa yang dipilih
        if ($category) {
            $correctSlug = $lang === 'id' ? $category['slug_kategori_id'] : $category['slug_kategori_en'];

            // Jika slug yang digunakan tidak sesuai, redirect ke slug yang benar
            if ($slugCategory !== $correctSlug) {
                log_message('info', 'Slug tidak sesuai, mengarahkan ke slug yang benar: ' . $correctSlug);
                return redirect()->to(base_url($lang === 'id' ? "id/artikel/$correctSlug" : "en/article/$correctSlug"));
            }
        }

        // Ambil artikel berdasarkan kategori (jika ada)
        $perPage = 3;
        $allArticles = $artikelModel->getPaginatedArticles($categoryId, $lang, $perPage);
        $pager = $artikelModel->pager; // Ambil objek pagination
        // $allArticles = $artikelModel->getArticlesWithCategory($categoryId, $lang);

        $sideArticles = $artikelModel->getSideArticlesWithCategory($categoryId, $lang);

        // Ambil semua kategori untuk navigasi
        $categories = $categoryModel->getAllCategories($lang);
        $categoriess = $categoryModel->findAll();

        // Metadata halaman, prioritas dari kategori jika ada
        $meta = $metaModel->where('id_meta', '5')->first();
        $metaCategory = $category ? [
            'title_id' => $category['title_kategori_id'] ?? '',
            'title_en' => $category['title_kategori_en'] ?? '',
            'meta_desc_id' => $category['meta_desc_id'] ?? '',
            'meta_desc_en' => $category['meta_desc_en'] ?? ''
        ] : null;

        $kategoriModel = new CategoryArtikelModel();
        $kategoriAktivitasModel = new CategoryActivityModel();

        // Ambil data kategori artikel terbanyak
        $kategori_teratas = $kategoriModel->getKategoriTerbanyak();

        // Ambil data sosial media
        $sosmedModel = new SosmedModel();
        $sosmed = $sosmedModel->findAll();

        // Ambil data marketplace
        $marketplaceModel = new MarketplaceModel();
        $marketplace = $marketplaceModel->findAll();

        // Ambil data kontak
        $kontakModel = new KontakModel();
        $kontak = $kontakModel->first();

        $categoriesAktivitas = $kategoriAktivitasModel->findAll();

        // Ambil URL saat ini
        return view('article', [
            'lang' => $lang,
            'canonical' => $canonical,
            'allArticle' => $allArticles,
            'sideArticle' => $sideArticles,
            'kategori' => $categories,
            'categoryId' => $categoryId,
            'meta' => $meta,
            'metaCategory' => $metaCategory,
            'data' => $data,
            'profil' => $dataProfil,
            'kategori_teratas' => $kategori_teratas,
            'sosmed' => $sosmed,
            'marketplace' => $marketplace,
            'kontak' => $kontak,
            'pager' => $pager,
            'categoriesAktivitas' => $categoriesAktivitas,
            'categories' => $categoriess

        ]);
    }

    public function detail($categorySlug, $slug)
    {
        $data['activeMenu'] = 'article';
        $lang = session()->get('lang') ?? 'id'; // cek lang nya

        // Menambahkan log untuk melacak nilai slug yang diterima
        log_message('debug', 'Slug yang diterima: ' . $slug);

        // Inisialisasi model
        $articleModel = new ArtikelModel();
        $metaModel = new MetaModel();
        $profilModel = new ProfilModel();
        $dataProfil = $profilModel->first();

        // Cek apakah produk ada berdasarkan slug untuk bahasa ID atau EN
        $artikel = $articleModel->getArtikelWithCategory($slug);

        $dataMeta = $metaModel->where('id_meta', '9')->first();

        $metaCategory = $artikel ? [
            'title_id' => $artikel['title_artikel_id'] ?? '',
            'title_en' => $artikel['title_artikel_en'] ?? '',
            'meta_desc_id' => $artikel['meta_desc_id'] ?? '',
            'meta_desc_en' => $artikel['meta_desc_en'] ?? ''
        ] : null;

        // Log hasil pencarian produk
        log_message('debug', 'Produk ditemukan: ' . print_r($artikel, true));

        // Jika produk tidak ditemukan, redirect atau tampilkan error
        if (!$artikel) {
            log_message('error', 'Artikel tidak ditemukan dengan slug: ' . $slug);
            return redirect()->to('/')->with('error', 'Artikel tidak ditemukan');
        }

        // Ambil kategori artikel berdasarkan ID kategori
        $categoryModel = new CategoryArtikelModel();
        $category = $categoryModel->find($artikel['id_kategori_artikel']);
        $categories = $categoryModel->findAll();

        // Pastikan kategori ada
        if (!$category) {
            log_message('error', 'Kategori tidak ditemukan untuk artikel dengan ID: ' . $artikel['id_kategori_artikel']);
            return redirect()->to('/')->with('error', 'Kategori artikel tidak ditemukan');
        }

        // Periksa apakah slug sesuai dengan bahasa yang digunakan
        if (($lang === 'id' && $slug !== $artikel['slug_artikel_id']) || ($lang === 'en' && $slug !== $artikel['slug_artikel_en'])) {
            // Log sebelum melakukan redireksi
            log_message('debug', 'Slug yang sesuai untuk bahasa ' . $lang . ': ' . $artikel['slug_artikel_id'] . ' (ID) / ' . $artikel['slug_artikel_en'] . ' (EN)');

            // Redirect ke URL yang benar
            $correctedSlug = $lang === 'id' ? $artikel['slug_artikel_id'] : $artikel['slug_artikel_en'];
            $categorySlug = $lang === 'id' ? $category['slug_kategori_id'] : $category['slug_kategori_en'];
            $urlmenu = $lang === 'id' ? 'artikel' : 'article';
            return redirect()->to("$lang/$urlmenu/$categorySlug/$correctedSlug");
        }

        // Ambil artikel-artikel terbaru berdasarkan kategori yang sama
        $allArticle = $articleModel
            ->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left')
            ->where('tb_artikel.id_artikel !=', $artikel['id_artikel']) // Menghindari artikel saat ini
            ->where('tb_artikel.id_kategori_artikel', $artikel['id_kategori_artikel']) // Hanya artikel dari kategori yang sama
            ->orderBy('tb_artikel.created_at', 'DESC')
            ->findAll(5);

        $categorySlugCheck = ($lang === 'id') ? $category['slug_kategori_id'] : $category['slug_kategori_en'];
        $slugCheck = ($lang === 'id') ? $artikel['slug_artikel_id'] : $artikel['slug_artikel_en'];

        $canonical = base_url("$lang/" . (($lang === 'id') ? 'artikel' : 'article') . '/' . ($categorySlugCheck !== false ? $categorySlugCheck : '') . '/' . ($slugCheck !== false ? $slugCheck : ''));


        if (current_url() !== $canonical) {
            return redirect()->to($canonical);
        }

        $kategoriModel = new CategoryArtikelModel();
        $kategoriAktivitasModel = new CategoryActivityModel();

        // Ambil data kategori artikel terbanyak
        $kategori_teratas = $kategoriModel->getKategoriTerbanyak();
        $categoriesAktivitas = $kategoriAktivitasModel->findAll();

        // Ambil data sosial media
        $sosmedModel = new SosmedModel();
        $sosmed = $sosmedModel->findAll();

        // Ambil data marketplace
        $marketplaceModel = new MarketplaceModel();
        $marketplace = $marketplaceModel->findAll();

        // Ambil data kontak
        $kontakModel = new KontakModel();
        $kontak = $kontakModel->first();

        return view('detail_article', [
            'canonical' => $canonical,
            'lang' => $lang,
            'artikel' => $artikel,
            'category' => $category,
            'meta' => $dataMeta,
            'allArticle' => $allArticle,
            'data' => $data,
            'metaCategory' => $metaCategory,
            'profil' => $dataProfil,
            'kategori_teratas' => $kategori_teratas,
            'sosmed' => $sosmed,
            'marketplace' => $marketplace,
            'kontak' => $kontak,
            'categories' => $categories,
            'categoriesAktivitas' => $categoriesAktivitas,
        ]);
    }
}
