<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;
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

        // If category slug is provided, get articles by category
        if ($categorySlug) {
            // Determine slug field based on active language
            $slugField = $this->lang === 'id' ? 'slug_kategori_id' : 'slug_kategori_en';

            // Get the category by the slug
            $category = $this->kategoriModel->where($slugField, $categorySlug)->first();

            if ($category) {
                $categoryId = $category['id_kategori_artikel'];
                $allArticle = $this->articleModel->getByCategory($categoryId);
            } else {
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
            if ($categorySlug !== $correctedCategorySlug) {
                // Determine the correct URL based on the language
                $correcturl = $this->lang === 'id' ? 'artikel' : 'article';
                // Redirect to the correct category and language
                return redirect()->to("/$this->lang/$correcturl/{$correctedCategorySlug}");
            }
        }

        return view('article', [
            'lang' => $this->lang,
            'meta' => $dataMeta,
            'allArticle' => $allArticle,
            'data' => $data,
            'kategori' => $kategori,
            'categoryId' => $categoryId ?? null,
        ]);
    }




    public function detail($categorySlug, $articleSlug)
    {
        $data['activeMenu'] = 'article';

        // Tentukan field slug kategori berdasarkan bahasa
        $slugField = $this->lang === 'id' ? 'slug_kategori_id' : 'slug_kategori_en';

        // Retrieve the category using the appropriate slug field
        $category = $this->kategoriModel->where($slugField, $categorySlug)->first();

        // If category doesn't exist, throw a PageNotFoundException
        if (!$category) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori tidak ditemukan');
        }

        // Retrieve the article based on both the article slug and category
        $artikel = $this->articleModel
            ->select('tb_artikel.*, tb_kategori_artikel.slug_kategori_en, tb_kategori_artikel.slug_kategori_id') // Pilih kolom dari artikel dan kategori
            ->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel') // Join tabel kategori
            ->groupStart() // Mulai grup untuk kondisi slug artikel
            ->where('tb_artikel.slug_artikel_id', $articleSlug) // Filter slug artikel (bahasa Indonesia)
            ->orWhere('tb_artikel.slug_artikel_en', $articleSlug) // Filter slug artikel (bahasa Inggris)
            ->groupEnd() // Akhiri grup kondisi slug artikel
            ->where("tb_kategori_artikel.$slugField", $categorySlug) // Filter slug kategori berdasarkan bahasa
            ->first();

        // If article doesn't exist, throw a PageNotFoundException
        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan');
        }

        // Check if the article slug matches the selected language
        if (
            ($this->lang === 'id' && $articleSlug !== $artikel['slug_artikel_id']) ||
            ($this->lang === 'en' && $articleSlug !== $artikel['slug_artikel_en']) ||
            ($this->lang === 'id' && $categorySlug !== $artikel['slug_kategori_id']) ||
            ($this->lang === 'en' && $categorySlug !== $artikel['slug_kategori_en'])
        ) {
            // Tentukan slug artikel yang benar berdasarkan bahasa
            $correctedArticleSlug = $this->lang === 'id' ? $artikel['slug_artikel_id'] : $artikel['slug_artikel_en'];
            // Tentukan slug kategori yang benar berdasarkan bahasa
            $correctedCategorySlug = $this->lang === 'id' ? $artikel['slug_kategori_id'] : $artikel['slug_kategori_en'];
            // Tentukan URL dasar berdasarkan bahasa
            $correcturl = $this->lang === 'id' ? 'artikel' : 'article';

            // Redirect ke URL yang benar
            return redirect()->to("$this->lang/$correcturl/{$correctedCategorySlug}/$correctedArticleSlug");
        }


        $allArticle = $this->articleModel
            ->orderBy('created_at', 'DESC')
            ->findAll(10);

        // Send data to view
        return view('detail_article', [
            'artikel' => $artikel,
            'lang' => $this->lang,
            'category' => $category,
            'allArticle' => $allArticle,
            'data' => $data,
        ]);
    }
}
