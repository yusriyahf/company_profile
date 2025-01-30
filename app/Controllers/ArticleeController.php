<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;
use App\Models\CategoryArtikelModel;
use App\Models\MetaModel;

class ArticleeController extends BaseController
{
    public function index($slugCategory = null)
    {
        $data['activeMenu'] = 'article';
        $lang = session()->get('lang') ?? 'id';  // Mendapatkan bahasa aktif dari sesi

        $categoryModel = new CategoryArtikelModel();
        $artikelModel = new ArtikelModel();

        // Cek apakah kategori berdasarkan slug ditemukan, sesuai dengan bahasa
        $category = $slugCategory ? $categoryModel->getCategoryBySlug($slugCategory) : null;
        log_message('debug', 'Produk ditemukan: ' . print_r($category, true));

        // Log untuk kategori yang dicari
        log_message('info', 'Mencari kategori dengan slug: ' . $slugCategory);

        // Jika kategori tidak ditemukan, redirect ke halaman utama artikel
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
        $categoryId = $category ? $category['id_kategori_artikel'] : null;
        $allArticles = $artikelModel->getArticlesWithCategory($categoryId, $lang);

        // Log jumlah artikel yang ditemukan
        log_message('info', 'Jumlah artikel yang ditemukan: ' . count($allArticles));

        // Ambil semua kategori untuk navigasi
        $categories = $categoryModel->getAllCategories($lang);

        // Metadata halaman
        $meta = [
            'title_id' => $category['title_kategori_id'] ?? 'Semua Artikel',
            'title_en' => $category['title_kategori_en'] ?? 'All Articles',
            'meta_desc_id' => $category['meta_desc_id'] ?? 'Kumpulan artikel terkini.',
            'meta_desc_en' => $category['meta_desc_en'] ?? 'A collection of the latest articles.',
        ];

        return view('article', [
            'lang' => $lang,
            'allArticle' => $allArticles,
            'kategori' => $categories,
            'categoryId' => $categoryId,
            'meta' => $meta,
            'data' => $data
        ]);
    }

    public function detail($categorySlug, $slug)
    {
        $data['activeMenu'] = 'article';
        // cek lang nya
        $lang = session()->get('lang') ?? 'id';
        // Menambahkan log untuk melacak nilai slug yang diterima
        log_message('debug', 'Slug yang diterima: ' . $slug);

        $articleModel = new ArtikelModel();
        $metaModel = new MetaModel();
        $meta = $metaModel->first();



        // Cek apakah produk ada berdasarkan slug untuk bahasa ID atau EN
        $artikel = $articleModel->where('slug_artikel_id', $slug)->orWhere('slug_artikel_en', $slug)->first();

        $metaData = [
            'title_id' => $artikel['title_artikel_id'] ?? 'Artikel Tidak Ditemukan',
            'title_en' => $artikel['title_artikel_en'] ?? 'Article Not Found',
            'meta_desc_id' => $artikel['meta_desc_id'] ?? 'Deskripsi artikel tidak tersedia.',
            'meta_desc_en' => $artikel['meta_desc_en'] ?? 'Article description not available.',
        ];

        // Log hasil pencarian produk
        log_message('debug', 'Produk ditemukan: ' . print_r($artikel, true));

        // Jika produk tidak ditemukan, redirect atau tampilkan error
        if (!$artikel) {
            log_message('error', 'atyikel tidak ditemukan dengan slug: ' . $slug);
            return redirect()->to('/')->with('error', 'artikel tidak ditemukan');
        }

        // Ambil kategori artikel berdasarkan ID kategori
        $categoryModel = new CategoryArtikelModel();
        $category = $categoryModel->find($artikel['id_kategori_artikel']); // Ambil kategori berdasarkan id_kategori_artikel

        // Pastikan kategori ada
        if (!$category) {
            log_message('error', 'Kategori tidak ditemukan untuk artikel dengan ID: ' . $artikel['id_kategori_artikel']);
            return redirect()->to('/')->with('error', 'Kategori artikel tidak ditemukan');
        }

        // Periksa apakah slug sesuai dengan bahasa yang digunakan
        if (($lang === 'id' && $slug !== $artikel['slug_artikel_id']) || ($lang === 'en' && $slug !== $artikel['slug_artikel_en'])) {
            // Log sebelum melakukan redireksi
            log_message('debug', 'Slug yang sesuai untuk bahasa ' . $lang . ': ' . $artikel['slug_artikel_id'] . ' (ID) / ' . $artikel['slug_artikel_en'] . ' (EN)');

            // redirect ke url yang benar
            $correctedSlug = $lang === 'id' ? $artikel['slug_artikel_id'] : $artikel['slug_artikel_en'];
            // Ambil slug kategori yang sesuai dengan bahasa
            $categorySlug = $lang === 'id' ? $category['slug_kategori_id'] : $category['slug_kategori_en'];
            // Redirect ke URL yang benar
            $correctedSlug = $lang === 'id' ? $artikel['slug_artikel_id'] : $artikel['slug_artikel_en'];
            $urlmenu = $lang === 'id' ? 'artikel' : 'article';
            log_message('debug', 'Redireksi ke URL yang benar: ' . "$lang/$urlmenu/$categorySlug/$correctedSlug");
            return redirect()->to("$lang/$urlmenu/$categorySlug/$correctedSlug");
        }

        // Ambil artikel-artikel terbaru
        $allArticle = $articleModel
            ->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left')
            ->orderBy('tb_artikel.created_at', 'DESC')  // Menentukan tabel yang dimaksud
            ->findAll(10);

        // Tampilkan halaman artikel (misalnya tampilan detail artikel)
        return view('detail_article', [
            'lang' => $lang,
            'artikel' => $artikel,
            'category' => $category,
            'meta' => $metaData,
            'allArticle' => $allArticle,
            'data' => $data
        ]);
    }
}
