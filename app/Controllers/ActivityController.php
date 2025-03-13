<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityModel;
use App\Models\CategoryActivityModel;
use App\Models\CategoryArtikelModel;
use App\Models\KontakModel;
use App\Models\MarketplaceModel;
use App\Models\MetaModel;
use App\Models\ProfilModel;
use App\Models\SosmedModel;
use CodeIgniter\HTTP\ResponseInterface;

class ActivityController extends BaseController
{
    public function index($slugCategory = null)
    {
        $data['activeMenu'] = 'activity';
        $lang = session()->get('lang') ?? 'id';  // Mendapatkan bahasa aktif dari sesi
        $canonical = base_url("$lang/" . ($lang === 'id' ? 'aktivitas' : 'activity') . '/' . $slugCategory);

        if (current_url() !== $canonical) {
            return redirect()->to($canonical);
        }

        $categoryModel = new CategoryActivityModel();
        $aktivitasModel = new ActivityModel();
        $metaModel = new MetaModel();
        $profilModel = new ProfilModel();
        $dataProfil = $profilModel->first();

        // Cek apakah kategori berdasarkan slug ditemukan, sesuai dengan bahasa
        $category = $slugCategory ? $categoryModel->getCategoryBySlug($slugCategory) : null;
        log_message('debug', 'Produk ditemukan: ' . print_r($category, true));

        // Log untuk kategori yang dicari
        log_message('info', 'Mencari kategori dengan slug: ' . $slugCategory);

        // Jika kategori tidak ditemukan, redirect ke halaman utama artikel
        if ($slugCategory && !$category) {
            log_message('warning', 'Kategori tidak ditemukan untuk slug: ' . $slugCategory);
            return redirect()->to(base_url($lang === 'id' ? 'id/aktivitas' : 'en/activity'));
        }

        // Validasi slug dan redirect ke slug yang benar jika tidak sesuai dengan bahasa yang dipilih
        if ($category) {
            $correctSlug = $lang === 'id' ? $category['slug_kategori_id'] : $category['slug_kategori_en'];

            // Jika slug yang digunakan tidak sesuai, redirect ke slug yang benar
            if ($slugCategory !== $correctSlug) {
                log_message('info', 'Slug tidak sesuai, mengarahkan ke slug yang benar: ' . $correctSlug);
                return redirect()->to(base_url($lang === 'id' ? "id/aktivitas/$correctSlug" : "en/activity/$correctSlug"));
            }
        }

        // Ambil artikel berdasarkan kategori (jika ada)
        $categoryId = $category ? $category['id_kategori_aktivitas'] : null;
        $allAktivitas = $aktivitasModel->getArticlesWithCategory($categoryId, $lang);

        // Log jumlah artikel yang ditemukan
        log_message('info', 'Jumlah artikel yang ditemukan: ' . count($allAktivitas));

        // Ambil semua kategori untuk navigasi
        $categories = $categoryModel->getAllCategories($lang);

        // Metadata halaman
        $meta = $metaModel->where('id_meta', '4')->first();
        $metaCategory = $category ? [
            'title_id' => $category['title_kategori_id'] ?? '',
            'title_en' => $category['title_kategori_en'] ?? '',
            'meta_desc_id' => $category['meta_desc_id'] ?? '',
            'meta_desc_en' => $category['meta_desc_en'] ?? ''
        ] : null;

        $kategoriArtikelModel = new CategoryArtikelModel();
        $kategoriAktivitasModel = new CategoryActivityModel();
        // Ambil data kategori artikel terbanyak
        $kategori_teratas = $kategoriArtikelModel->getKategoriTerbanyak();
        $categoriess = $kategoriArtikelModel->findAll();
        $categoriesAktivitas = $kategoriAktivitasModel->findAll();

        $sosmedModel = new SosmedModel();
        $sosmed = $sosmedModel->findAll();

        // Ambil data marketplace
        $marketplaceModel = new MarketplaceModel();
        $marketplace = $marketplaceModel->findAll();

        // Ambil data kontak
        $kontakModel = new KontakModel();
        $kontak = $kontakModel->first();

        return view('activity', [
            'lang' => $lang,
            'canonical' => $canonical,
            'allAktivitas' => $allAktivitas,
            'kategori' => $categories,
            'metaCategory' => $metaCategory,
            'categoryId' => $categoryId,
            'meta' => $meta,
            'data' => $data,
            'profil' => $dataProfil,
            'kategori_teratas' => $kategori_teratas,
            'sosmed' => $sosmed,
            'marketplace' => $marketplace,
            'kontak' => $kontak,
            'categories' => $categoriess,
            'categoriesAktivitas' => $categoriesAktivitas
        ]);
    }

    public function detail($categorySlug, $slug)
    {
        $data['activeMenu'] = 'activity';
        $lang = session()->get('lang') ?? 'id';


        // cek lang nya
        // Menambahkan log untuk melacak nilai slug yang diterima
        log_message('debug', 'Slug yang diterima: ' . $slug);

        $activityModel = new ActivityModel();
        $metaModel = new MetaModel();
        $profilModel = new ProfilModel();
        $dataProfil = $profilModel->first();

        // Cek apakah produk ada berdasarkan slug untuk bahasa ID atau EN
        // $aktivitas = $activityModel->where('slug_aktivitas_id', $slug)->orWhere('slug_aktivitas_en', $slug)->first();

        $aktivitas = $activityModel->getActivityWithCategory($slug);

        $dataMeta = $metaModel->where('id_meta', '8')->first();

        $metaCategory = $aktivitas ? [
            'title_id' => $aktivitas['title_aktivitas_id'] ?? '',
            'title_en' => $aktivitas['title_aktivitas_en'] ?? '',
            'meta_desc_id' => $aktivitas['meta_desc_id'] ?? '',
            'meta_desc_en' => $aktivitas['meta_desc_en'] ?? ''
        ] : null;

        $kategoriModel = new CategoryArtikelModel();
        $categories = $kategoriModel->findAll();

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

        // Log hasil pencarian produk
        log_message('debug', 'Produk ditemukan: ' . print_r($aktivitas, true));

        // Jika produk tidak ditemukan, redirect atau tampilkan error
        if (!$aktivitas) {
            log_message('error', 'artikel tidak ditemukan dengan slug: ' . $slug);
            return redirect()->to('/')->with('error', 'artikel tidak ditemukan');
        }

        // Ambil kategori artikel berdasarkan ID kategori
        $categoryModel = new CategoryActivityModel();
        $category = $categoryModel->find($aktivitas['id_kategori_aktivitas']); // Ambil kategori berdasarkan id_kategori_aktivitas

        // Pastikan kategori ada
        if (!$category) {
            log_message('error', 'Kategori tidak ditemukan untuk artikel dengan ID: ' . $aktivitas['id_kategori_aktivitas']);
            return redirect()->to('/')->with('error', 'Kategori artikel tidak ditemukan');
        }

        // Periksa apakah slug sesuai dengan bahasa yang digunakan
        if (($lang === 'id' && $slug !== $aktivitas['slug_aktivitas_id'])   || ($lang === 'en' && $slug !== $aktivitas['slug_aktivitas_en'])) {
            // Log sebelum melakukan redireksi


            // redirect ke url yang benar
            $correctedSlug = $lang === 'id' ? $aktivitas['slug_aktivitas_id'] : $aktivitas['slug_aktivitas_en'];
            // Ambil slug kategori yang sesuai dengan bahasa
            $categorySlug = $lang === 'id' ? $category['slug_kategori_id'] : $category['slug_kategori_en'];
            // Redirect ke URL yang benar
            $correctedSlug = $lang === 'id' ? $aktivitas['slug_aktivitas_id'] : $aktivitas['slug_aktivitas_en'];
            $urlmenu = $lang === 'id' ? 'aktivitas' : 'activity';

            return redirect()->to("$lang/$urlmenu/$categorySlug/$correctedSlug");
        }

        // Ambil artikel-artikel terbaru
        $allAktivitas = $activityModel
            ->join('tb_kategori_aktivitas', 'tb_kategori_aktivitas.id_kategori_aktivitas = tb_aktivitas.id_kategori_aktivitas', 'left')
            ->where('tb_aktivitas.id_aktivitas !=', $aktivitas['id_aktivitas']) // Menghindari aktivitas saat ini
            ->where('tb_aktivitas.id_kategori_aktivitas', $aktivitas['id_kategori_aktivitas']) // Hanya artikel dari kategori yang sama
            ->orderBy('tb_aktivitas.created_at', 'DESC')  // Menentukan tabel yang dimaksud
            ->findAll(5);

        // Ambil data kategori artikel terbanyak
        $kategori_teratas = $kategoriModel->getKategoriTerbanyak();

        $categorySlugCheck = ($lang === 'id') ? $category['slug_kategori_id'] : $category['slug_kategori_en'];
        $slugCheck = ($lang === 'id') ? $aktivitas['slug_aktivitas_id'] : $aktivitas['slug_aktivitas_en'];
        $canonical = base_url("$lang/" . ($lang === 'id' ? 'aktivitas' : 'activity') . '/' . ($categorySlugCheck !== false ? $categorySlugCheck : '') . '/' . ($slugCheck !== false ? $slugCheck : ''));

        if (current_url() !== $canonical) {
            return redirect()->to($canonical);
        }

        // Tampilkan halaman artikel (misalnya tampilan detail artikel)
        return view('detail_activity', [
            'lang' => $lang,
            'canonical' => $canonical,
            'aktivitas' => $aktivitas,
            'metaCategory' => $metaCategory,
            'category' => $category,
            'meta' => $dataMeta,
            'allAktivitas' => $allAktivitas,
            'data' => $data,
            'profil' => $dataProfil,
            'kategori_teratas' => $kategori_teratas,
            'sosmed' => $sosmed,
            'marketplace' => $marketplace,
            'kontak' => $kontak,
            'categories' => $categories,

        ]);
    }
}
