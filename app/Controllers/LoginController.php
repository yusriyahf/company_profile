<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfilModel;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    public function index()
    {
        // Pengecekan jika pengguna sudah login
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('admin/dashboard')); // Ubah 'vw_home' sesuai dengan halaman yang diinginkan setelah login
        }

        // Proses login jika pengguna belum login
        return view('admin/login/index');
    }

    public function process()
    {
        $users = new ProfilModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Ambil data user dari database
        $dataUser = $users->where(['username' => $username])->first();

        if ($dataUser) {
            // Pastikan akses sesuai dengan tipe data yang dikembalikan
            if ($password === $dataUser['password']) {  // Gunakan array notation jika returnType tidak diubah
                session()->set([
                    'username' => $dataUser['username'],
                    'nama_perusahaan' => $dataUser['nama_perusahaan'],
                    'deskripsi_perusahaan_id' => $dataUser['deskripsi_perusahaan_id'],
                    'deskripsi_perusahaan_en' => $dataUser['deskripsi_perusahaan_en'],
                    // 'title_website' => $dataUser['title_website'],
                    // 'alamat' => $dataUser['alamat'],
                    // 'deskripsi_kontak_id' => $dataUser['deskripsi_kontak_id'],
                    // 'deskripsi_kontak_en' => $dataUser['deskripsi_kontak_en'],
                    // 'link_maps' => $dataUser['link_maps'],
                    // 'link_whatsapp' => $dataUser['link_whatsapp'],
                    // 'no_hp' => $dataUser['no_hp'],
                    // 'email' => $dataUser['email'],
                    'favicon_perusahaan' => $dataUser['favicon_perusahaan'],
                    'logo_perusahaan' => $dataUser['logo_perusahaan'],
                    'foto_perusahaan' => $dataUser['foto_perusahaan'],
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('admin/dashboard'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }
    }



    function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
