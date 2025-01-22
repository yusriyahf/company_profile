<?php

namespace App\Controllers;

use App\Models\MetaModel;
use App\Controllers\BaseController;
use App\Models\KontakModel;
use CodeIgniter\HTTP\ResponseInterface;

class ContactController extends BaseController
{
    protected $lang;

    public function __construct()
    {
        $this->lang = session()->get('lang') ?? 'id';
    }

    public function index()
    {
        $data['activeMenu'] = 'contact';
        $metaModel = new MetaModel();
        $kontakModel = new KontakModel();

        $dataMeta = $metaModel->where('nama_halaman', 'contact')->first();
        $dataKontak = $kontakModel->first();

        return view('contact', ['meta' => $dataMeta, 'kontak' => $dataKontak, 'lang' => $this->lang, 'data' => $data]);
    }
}
