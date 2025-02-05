<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;
use App\Models\ProductModel;
use App\Models\SliderModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $produkModel = new ProductModel();
        // $aktivitasModel = new AktivitasModel();
        $sliderModel = new SliderModel();
        $artikelModel = new ArtikelModel();

        $data['productCount'] = $produkModel->countAll();
        // $data['aktivitasCount'] = $aktivitasModel->countAll();
        $data['sliderCount'] = $sliderModel->countAll();
        $data['artikelCount'] = $artikelModel->countAll();


        return view('admin/dashboard/index', $data);
    }
}
