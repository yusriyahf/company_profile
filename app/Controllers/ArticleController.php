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




    public function detail($categorySlug, $articleSlug)
    {
        $data['activeMenu'] = 'article';

        log_message('debug', 'Current language: ' . $this->lang);
        log_message('debug', 'Category Slug: ' . $categorySlug);
        log_message('debug', 'Article Slug: ' . $articleSlug);

        // Tentukan field slug kategori berdasarkan bahasa
        $slugField = $this->lang === 'id' ? 'slug_kategori_id' : 'slug_kategori_en';

        // Periksa jika categorySlug sesuai dengan slug yang aktif (berdasarkan bahasa)
        // var_dump($categorySlug);
        log_message('debug', 'Category Slug: ' . $categorySlug);
        log_message('debug', 'Slug Field: ' . $slugField);


        // Cari kategori berdasarkan slug kategori sesuai bahasa
        $category = $this->kategoriModel->where($slugField, $categorySlug)->first();

        // Tambahkan log untuk memeriksa hasil
        log_message('debug', 'Found Category: ' . print_r($category, true));

        if (!$category) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori tidak ditemukan');
        }

        // Cek artikel
        $artikel = $this->articleModel
            ->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel')
            ->where("tb_kategori_artikel.$slugField", $categorySlug)
            ->groupStart()
            ->where('tb_artikel.slug_artikel_id', $articleSlug)
            ->orWhere('tb_artikel.slug_artikel_en', $articleSlug)
            ->groupEnd()
            ->first();
        log_message('debug', 'Found article: ' . print_r($artikel, true));  // Debugging article

        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan');
        }

        log_message('debug', 'Article Slug (ID): ' . $artikel['slug_artikel_id']);
        log_message('debug', 'Article Slug (EN): ' . $artikel['slug_artikel_en']);
        log_message('debug', 'Category Slug (ID): ' . $artikel['slug_kategori_id']);
        log_message('debug', 'Category Slug (EN): ' . $artikel['slug_kategori_en']);

        log_message('debug', 'Current Language: ' . $this->lang);
        log_message('debug', 'Current Article Slug: ' . $articleSlug);
        log_message('debug', 'Current Category Slug: ' . $categorySlug);

        // Periksa apakah kondisi terpenuhi
        log_message(
            'debug',
            'Slug Comparison: ' .
                (($this->lang === 'id' && $articleSlug !== $artikel['slug_artikel_id']) ? 'Article Slug mismatch' : 'Article Slug match') .
                ', ' .
                (($this->lang === 'en' && $articleSlug !== $artikel['slug_artikel_en']) ? 'Article Slug mismatch' : 'Article Slug match') .
                ', ' .
                (($this->lang === 'id' && $categorySlug !== $artikel['slug_kategori_id']) ? 'Category Slug mismatch' : 'Category Slug match') .
                ', ' .
                (($this->lang === 'en' && $categorySlug !== $artikel['slug_kategori_en']) ? 'Category Slug mismatch' : 'Category Slug match')
        );

        // Periksa slug artikel dan kategori
        if (
            ($this->lang === 'id' && $articleSlug !== $artikel['slug_artikel_id']) ||
            ($this->lang === 'en' && $articleSlug !== $artikel['slug_artikel_en']) ||
            ($this->lang === 'id' && $categorySlug !== $artikel['slug_kategori_id']) ||
            ($this->lang === 'en' && $categorySlug !== $artikel['slug_kategori_en'])
        ) {


            $correctedArticleSlug = $this->lang === 'id' ? $artikel['slug_artikel_id'] : $artikel['slug_artikel_en'];
            $correctedCategorySlug = $this->lang === 'id' ? $artikel['slug_kategori_id'] : $artikel['slug_kategori_en'];
            $correcturl = $this->lang === 'id' ? 'artikel' : 'article';
            log_message('debug', 'Conditions met for redirection');
            // dd($correctedCategorySlug);

            $correctUrl = "/$this->lang/$correcturl/{$correctedCategorySlug}/$correctedArticleSlug";
            log_message('debug', 'Redirecting to: ' . $correctUrl);

            return redirect()->to($correctUrl);
        }

        $allArticle = $this->articleModel
            ->select('tb_artikel.*, tb_kategori_artikel.slug_kategori_en, tb_kategori_artikel.slug_kategori_id, tb_kategori_artikel.nama_kategori_en, tb_kategori_artikel.nama_kategori_id')
            ->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left')
            ->orderBy('tb_artikel.created_at', 'DESC')
            ->findAll(5); // Limit to 5 related articles

        return view('detail_article', [
            'artikel' => $artikel,
            'lang' => $this->lang,
            'category' => $category,
            'allArticle' => $allArticle,
            'data' => $data,
        ]);
    }
}
