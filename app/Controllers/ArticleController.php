<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;
use App\Models\CategoryArtikelModel;
use App\Models\KategoriModel;
use App\Models\MetaModel;
use CodeIgniter\HTTP\ResponseInterface;

class ArticleController extends BaseController
{
    protected $articleModel;
    protected $kategoriModel;
    protected $metaModel;
    protected $lang;
    public function __construct()
    {
        $this->articleModel = new ArtikelModel();
        $this->kategoriModel = new KategoriModel();
        $this->metaModel = new MetaModel();

        $this->lang = session()->get('lang') ?? 'id';
    }

    public function index($categorySlug = null)
    {
        $data['activeMenu'] = 'article';
        $dataMeta = $this->metaModel->where('nama_halaman', 'article')->first();
        $kategori = $this->kategoriModel->findAll();

        // Log the active language for debugging
        log_message('debug', 'Active Language: ' . $this->lang);

        // If category slug is provided, get articles by category
        if ($categorySlug) {
            // Determine slug field based on active language
            $slugField = $this->lang === 'id' ? 'slug_kategori_id' : 'slug_kategori_en';
            $nameField = $this->lang === 'id' ? 'nama_kategori_id' : 'nama_kategori_en';

            // Log the field being used for fetching category
            log_message('debug', 'Using slug field: ' . $slugField);

            // Get the category by the slug
            $category = $this->kategoriModel->where($slugField, $categorySlug)->first();

            // Log the SQL query for debugging
            log_message('debug', 'SQL Query: ' . $this->kategoriModel->getLastQuery());

            // Debugging the fetched category
            log_message('debug', 'Fetched Category: ' . print_r($category, true));

            if ($category) {
                $categoryId = $category['id_kategori_artikel'];
                $categoryName = $category[$nameField];  // Get the category name in the correct language
                $allArticle = $this->articleModel->getByCategory($categoryId);
            } else {
                // If no category found, log and throw 404 error
                log_message('error', 'Category not found for slug: ' . $categorySlug);
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori tidak ditemukan');
            }
        } else {
            // Get all articles with category info
            $allArticle = $this->articleModel
                ->select('tb_artikel.*, tb_kategori_artikel.slug_kategori_en, tb_kategori_artikel.slug_kategori_id, tb_kategori_artikel.nama_kategori_en, tb_kategori_artikel.nama_kategori_id')
                ->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left')
                ->orderBy('tb_artikel.created_at', 'DESC')
                ->findAll(15);
        }

        // Redirect if the current language's slug doesn't match the category slug
        if ($categorySlug && isset($category)) {
            $correctedCategorySlug = $this->lang === 'id' ? $category['slug_kategori_id'] : $category['slug_kategori_en'];

            // Debugging the category slug comparison
            log_message('debug', 'Category Slug: ' . $categorySlug);
            log_message('debug', 'Corrected Category Slug: ' . $correctedCategorySlug);

            if ($categorySlug !== $correctedCategorySlug) {
                $correcturl = $this->lang === 'id' ? 'artikel' : 'article';
                log_message('debug', 'Redirecting to: ' . "/$this->lang/$correcturl/$correctedCategorySlug");
                return redirect()->to("/$this->lang/$correcturl/$correctedCategorySlug");
                log_message('debug', "Redirecting to: /$this->lang/$correcturl/$correctedCategorySlug");
            }
        }

        return view('article', [
            'lang' => $this->lang,
            'meta' => $dataMeta,
            'allArticle' => $allArticle,
            'data' => $data,
            'kategori' => $kategori,
            'categoryId' => $categoryId ?? null,
            'categoryName' => $categoryName ?? null, // Pass the translated category name
        ]);
    }




    public function detail($categorySlug, $slug)
    {
        // cek lang nya
        $data['activeMenu'] = 'article';
        $lang = session()->get('lang') ?? 'id';
        // Menambahkan log untuk melacak nilai slug yang diterima
        log_message('debug', 'Slug yang diterima: ' . $slug);

        $articleModel = new ArtikelModel();
        $metaModel = new MetaModel();
        $meta = $metaModel->first();

        // Cek apakah produk ada berdasarkan slug untuk bahasa ID atau EN
        $artikel = $articleModel->where('slug_artikel_id', $slug)->orWhere('slug_artikel_en', $slug)->first();

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
            ->orderBy('created_at', 'DESC')
            ->findAll(10);
        // Tampilkan halaman artikel (misalnya tampilan detail artikel)
        return view('detail_article', [
            'data' => $data,
            'lang' => $lang,
            'artikel' => $artikel,
            'category' => $category,
            'meta' => $meta,
            'allArticle' => $allArticle,
        ]);
    }
}
