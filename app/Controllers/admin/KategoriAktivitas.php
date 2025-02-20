<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\CategoryActivityModel;
use CodeIgniter\HTTP\ResponseInterface;

class KategoriAktivitas extends BaseController
{
    public function generateSlug($string)
    {
        // Ubah string menjadi huruf kecil
        $slug = strtolower($string);
        // Hapus semua karakter non-alfanumerik kecuali spasi
        $slug = preg_replace('/[^a-z0-9\s]/', '', $slug);
        // Ganti spasi dengan tanda hubung
        $slug = preg_replace('/\s+/', '-', $slug);
        return $slug;
    }

    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $aktivitas_kategori_model = new CategoryActivityModel();
        $all_data_aktivitas_kategori = $aktivitas_kategori_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/kategoriAktivitas/index', [
            'all_data_aktivitas_kategori' => $all_data_aktivitas_kategori,
            'validation' => $validation
        ]);
    }

    public function tambah()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $aktivitas_kategori_model = new CategoryActivityModel();
        $all_data_aktivitas_kategori = $aktivitas_kategori_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/kategoriAktivitas/tambah', [
            'all_data_aktivitas_kategori' => $all_data_aktivitas_kategori,
            'validation' => $validation
        ]);
    }

    public function proses_tambah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $nama_kategori_id = $this->request->getVar("nama_kategori_id");
        $nama_kategori_en = $this->request->getVar("nama_kategori_en");
        $title_kategori_id = $this->request->getVar("title_kategori_id");
        $title_kategori_en = $this->request->getVar("title_kategori_en");
        $meta_desc_id = $this->request->getVar("meta_desc_id");
        $meta_desc_en = $this->request->getVar("meta_desc_en");

        // Buat slug_id dari judul_artikel
        $slug_kategori_id = $this->generateSlug($nama_kategori_id);
        $slug_kategori_en = $this->generateSlug($nama_kategori_en);

        // Validasi nama aktivitas Indonesia
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_kategori_id)) {
            session()->setFlashdata('error', 'Nama aktivitas Indonesia hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Validasi nama aktivitas Inggris
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_kategori_en)) {
            session()->setFlashdata('error', 'Nama aktivitas Inggris hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

            $aktivitas_kategori_model = new CategoryActivityModel();
            $data = [
                'nama_kategori_id' => $this->request->getVar("nama_kategori_id"),
                'nama_kategori_en' => $this->request->getVar("nama_kategori_en"),
                'title_kategori_id' => $title_kategori_id,
                'title_kategori_en' => $title_kategori_en,
                'meta_desc_id' => $meta_desc_id,
                'meta_desc_en' => $meta_desc_en,
                'slug_kategori_id' => $slug_kategori_id,
                'slug_kategori_en' => $slug_kategori_en,
            ];
            $aktivitas_kategori_model->save($data);

            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(base_url('admin/kategoriAktivitas/index'));
        
    }


    public function edit($id_kategori_aktivitas)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $aktivitas_kategori_model = new CategoryActivityModel();
        $all_data_aktivitas_kategori = $aktivitas_kategori_model->find($id_kategori_aktivitas);
        $validation = \Config\Services::validation();

        return view('admin/kategoriAktivitas/edit', [
            'all_data_aktivitas_kategori' => $all_data_aktivitas_kategori,
            'validation' => $validation
        ]);
    }

    public function proses_edit($id_kategori_aktivitas = null)
    {
        if (!$id_kategori_aktivitas) {
            return redirect()->back();
        }

        date_default_timezone_set('Asia/Jakarta');
        $nama_kategori_id = $this->request->getVar("nama_kategori_id");
        $nama_kategori_en = $this->request->getVar("nama_kategori_en");
        $title_kategori_id = $this->request->getVar("title_kategori_id");
        $title_kategori_en = $this->request->getVar("title_kategori_en");
        $meta_desc_id = $this->request->getVar("meta_desc_id");
        $meta_desc_en = $this->request->getVar("meta_desc_en");

        $aktivitas_kategori_model = new CategoryActivityModel();

        // Buat slug_id dari judul_artikel
        $slug_kategori_id = $this->generateSlug($nama_kategori_id);
        $slug_kategori_en = $this->generateSlug($nama_kategori_en);

        // Validasi nama aktivitas Indonesia
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_kategori_id)) {
            session()->setFlashdata('error', 'Nama aktivitas Indonesia hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Validasi nama aktivitas Inggris
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_kategori_en)) {
            session()->setFlashdata('error', 'Nama aktivitas Inggris hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Update the Akvtivitas data
        $data = [
            'nama_kategori_id' => $nama_kategori_id,
            'nama_kategori_en' => $nama_kategori_en,
            'title_kategori_id' => $title_kategori_id,
            'title_kategori_en' => $title_kategori_en,
            'meta_desc_id' => $meta_desc_id,
            'meta_desc_en' => $meta_desc_en,
            'slug_kategori_id' => $slug_kategori_id,
            'slug_kategori_en' => $slug_kategori_en,
        ];

        // Update the product data in the database
        $aktivitas_kategori_model->where('id_kategori_aktivitas', $id_kategori_aktivitas)->set($data)->update();

        session()->setFlashdata('success', 'Berkas berhasil diperbarui');
        return redirect()->to(base_url('admin/kategoriAktivitas/index'));
    }


    public function delete($id = false)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $aktivitas_kategori_model = new CategoryActivityModel();

        $aktivitas_kategori_model->delete($id);

        return redirect()->to(base_url('admin/kategoriAktivitas/index'));
    }
}
