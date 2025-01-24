<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;
use App\Models\MetaModel;
use CodeIgniter\HTTP\ResponseInterface;

class ArticleController extends BaseController
{
    protected $articleModel;
    protected $lang;
    public function __construct()
    {
        $this->articleModel = new ArtikelModel();
        $this->lang = session()->get('lang') ?? 'id';
    }

    public function index()
    {
        $data['activeMenu'] = 'article';
        $metaModel = new MetaModel();
        $dataMeta = $metaModel->where('nama_halaman', 'article')->first();

        $allArticle = $this->articleModel
            ->orderBy('created_at', 'DESC')
            ->findAll(15);

        return view('article', ['lang' => $this->lang, 'meta' => $dataMeta, 'allArticle' => $allArticle, 'data' => $data]);
    }

    public function detail($slug)
    {
        $data['activeMenu'] = 'article';

        $artikel = $this->articleModel->getBySlugAndLang($slug, $this->lang);
        $allArticle = $this->articleModel
            ->orderBy('created_at', 'DESC')
            ->findAll(10);

        // Cek jika artikel ditemukan
        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan');
        }

        // Kirim data ke view
        return view('detail_article', ['artikel' => $artikel, 'lang' => $this->lang, 'articleModel' => $this->articleModel, 'allArticle' => $allArticle, 'data' => $data]);
    }
}
