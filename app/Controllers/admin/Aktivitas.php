<?php

namespace App\Controllers\admin;

use App\Models\ActivityModel;
use App\Models\CategoryActivityModel;

class Aktivitas extends BaseController
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
        $aktivitas_model = new ActivityModel();
        $all_data_aktivitas = $aktivitas_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/aktivitas/index', [
            'all_data_aktivitas' => $all_data_aktivitas,
            'validation' => $validation
        ]);
    }

    public function tambah()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $aktivitas_model = new ActivityModel();
        $all_data_aktivitas = $aktivitas_model->findAll();

        $aktivitas_kategori = new CategoryActivityModel();
        $all_data_kategori = $aktivitas_kategori->findAll();

        $validation = \Config\Services::validation();
        return view('admin/aktivitas/tambah', [
            'all_data_aktivitas' => $all_data_aktivitas,
            'all_data_kategori' => $all_data_kategori,
            'validation' => $validation
        ]);
    }

    public function proses_tambah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $file_foto = $this->request->getFile('foto_aktivitas');
        $currentDateTime = date('dmYHis');
        $judul_aktivitas_id = $this->request->getVar("judul_aktivitas_id");
        $judul_aktivitas_en = $this->request->getVar("judul_aktivitas_en");
        $snippet_id = $this->request->getVar("snippet_id");
        $snippet_en = $this->request->getVar("snippet_en");
        $alt_aktivitas_id = $this->request->getVar("alt_aktivitas_id");
        $alt_aktivitas_en = $this->request->getVar("alt_aktivitas_en");
        $title_aktivitas_id = $this->request->getVar("title_aktivitas_id");
        $title_aktivitas_en = $this->request->getVar("title_aktivitas_en");
        $meta_desc_id = $this->request->getVar("meta_desc_id");
        $meta_desc_en = $this->request->getVar("meta_desc_en");
        $id_kategori_aktivitas = $this->request->getVar("id_kategori_aktivitas");

        // Buat slug_id dari judul_artikel
        $slug_aktivitas_id = $this->generateSlug($judul_aktivitas_id);
        $slug_aktivitas_en = $this->generateSlug($judul_aktivitas_en);

        // Validasi nama aktivitas Indonesia
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $judul_aktivitas_id)) {
            session()->setFlashdata('error', 'Nama aktivitas Indonesia hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Validasi nama aktivitas Inggris
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $judul_aktivitas_en)) {
            session()->setFlashdata('error', 'Nama aktivitas Inggris hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        if (!$this->validate([
            'foto_aktivitas' => [
                'rules' => 'uploaded[foto_aktivitas]|is_image[foto_aktivitas]|max_dims[foto_aktivitas,572,572]|mime_in[foto_aktivitas,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih foto terlebih dahulu',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'max_dims' => 'Maksimal ukuran gambar 572x572 pixels',
                    'mime_in' => 'File yang anda pilih wajib berekstensikan jpg/jpeg/png'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $newFileName = "{$judul_aktivitas_id}_{$judul_aktivitas_en}_{$currentDateTime}.{$file_foto->getExtension()}";

            // Ganti spasi dengan tanda -
            $newFileName = str_replace(' ', '-', $newFileName);

            $file_foto->move('assets/img/aktivitas', $newFileName);

            $aktivitasModel = new ActivityModel();
            $data = [
                'judul_aktivitas_id' => $this->request->getVar("judul_aktivitas_id"),
                'judul_aktivitas_en' => $this->request->getVar("judul_aktivitas_en"),
                'deskripsi_aktivitas_id' => $this->request->getVar("deskripsi_aktivitas_id"),
                'deskripsi_aktivitas_en' => $this->request->getVar("deskripsi_aktivitas_en"),
                'snippet_id' => $snippet_id,
                'snippet_en' => $snippet_en,
                'alt_aktivitas_id' => $alt_aktivitas_id,
                'alt_aktivitas_en' => $alt_aktivitas_en,
                'id_kategori_aktivitas' => $id_kategori_aktivitas,
                'title_aktivitas_id' => $title_aktivitas_id,
                'title_aktivitas_en' => $title_aktivitas_en,
                'meta_desc_id' => $meta_desc_id,
                'meta_desc_en' => $meta_desc_en,
                'foto_aktivitas' => $newFileName,
                'slug_aktivitas_id' => $slug_aktivitas_id,
                'slug_aktivitas_en' => $slug_aktivitas_en,
            ];
    
            $aktivitasModel->save($data);

            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(base_url('admin/aktivitas/index'));
        }
    }


    public function edit($id_aktivitas)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $aktivitas_model = new ActivityModel();
        $aktivitasData = $aktivitas_model->find($id_aktivitas);

        $aktivitas_kategori = new CategoryActivityModel();
        $all_data_kategori = $aktivitas_kategori->findAll();
        $validation = \Config\Services::validation();

        return view('admin/aktivitas/edit', [
            'aktivitasData' => $aktivitasData,
            'all_data_kategori' => $all_data_kategori,
            'validation' => $validation
        ]);
    }

    public function proses_edit($id_aktivitas = null)
    {
        if (!$id_aktivitas) {
            return redirect()->back();
        }

        date_default_timezone_set('Asia/Jakarta');
        $file_foto = $this->request->getFile('foto_aktivitas');
        $currentDateTime = date('dmYHis');
        $judul_aktivitas_id = $this->request->getVar("judul_aktivitas_id");
        $judul_aktivitas_en = $this->request->getVar("judul_aktivitas_en");
        $id_kategori_aktivitas = $this->request->getVar("id_kategori_aktivitas");
        $title_aktivitas_id = $this->request->getVar("title_aktivitas_id");
        $title_aktivitas_en = $this->request->getVar("title_aktivitas_en");
        $meta_desc_id = $this->request->getVar("meta_desc_id");
        $meta_desc_en = $this->request->getVar("meta_desc_en");
        $snippet_id = $this->request->getVar("snippet_id");
        $snippet_en = $this->request->getVar("snippet_en");
        $alt_aktivitas_id = $this->request->getVar("alt_aktivitas_id");
        $alt_aktivitas_en = $this->request->getVar("alt_aktivitas_en");

        $aktivitasModel = new ActivityModel();
        $aktivitasData = $aktivitasModel->find($id_aktivitas);

        // Buat slug_id dari judul_artikel
        $slug_aktivitas_id = $this->generateSlug($judul_aktivitas_id);
        $slug_aktivitas_en = $this->generateSlug($judul_aktivitas_en);

        // Validasi nama aktivitas Indonesia
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $judul_aktivitas_id)) {
            session()->setFlashdata('error', 'Nama aktivitas Indonesia hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Validasi nama aktivitas Inggris
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $judul_aktivitas_en)) {
            session()->setFlashdata('error', 'Nama aktivitas Inggris hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Check if new 'foto_aktivitas' file is uploaded
        if ($this->request->getFile('foto_aktivitas')->isValid()) {
            // Delete the old 'foto_aktivitas' file
            unlink('assets/img/aktivitas/' . $aktivitasData['foto_aktivitas']);

            // Upload the new 'foto_aktivitas' file
            $newFileName = "{$judul_aktivitas_id}_{$judul_aktivitas_en}_{$currentDateTime}.{$file_foto->getExtension()}";

            // Ganti spasi dengan tanda -
            $newFileName = str_replace(' ', '-', $newFileName);

            $file_foto->move('assets/img/aktivitas/', $newFileName);

            // Update the 'foto_aktivitas' field in the database with a "where" clause
            $aktivitasModel->where('id_aktivitas', $id_aktivitas)->set([
                'foto_aktivitas' => $newFileName,
                'judul_aktivitas_id' => $this->request->getPost("judul_aktivitas_id"),
                'judul_aktivitas_en' => $this->request->getPost("judul_aktivitas_en"),
                'id_kategori_aktivitas' => $this->request->getPost("id_kategori_aktivitas"),
                'deskripsi_aktivitas_id' => $this->request->getPost("deskripsi_aktivitas_id"),
                'deskripsi_aktivitas_en' => $this->request->getPost("deskripsi_aktivitas_en"),
                'snippet_id' => $snippet_id,
                'snippet_en' => $snippet_en,
                'alt_aktivitas_id' => $alt_aktivitas_id,
                'alt_aktivitas_en' => $alt_aktivitas_en,
                'title_aktivitas_id' => $title_aktivitas_id,
                'title_aktivitas_en' => $title_aktivitas_en,
                'meta_desc_id' => $meta_desc_id,
                'meta_desc_en' => $meta_desc_en,
                'slug_aktivitas_id' => $slug_aktivitas_id,
                'slug_aktivitas_en' => $slug_aktivitas_en,
            ])->update();
        } else {
            // If no new 'foto_aktivitas' file is uploaded, keep the old filename
            $newFileName = $aktivitasData['foto_aktivitas'];
        }

        // Update the Akvtivitas data
        $data = [
            'foto_aktivitas' => $newFileName,
            'judul_aktivitas_id' => $judul_aktivitas_id,
            'judul_aktivitas_en' => $judul_aktivitas_en,
            'id_kategori_aktivitas' => $id_kategori_aktivitas,
            'deskripsi_aktivitas_id' => $this->request->getPost("deskripsi_aktivitas_id"),
            'deskripsi_aktivitas_en' => $this->request->getPost("deskripsi_aktivitas_en"),
            'title_aktivitas_id' => $title_aktivitas_id,
            'title_aktivitas_en' => $title_aktivitas_en,
            'meta_desc_id' => $meta_desc_id,
            'meta_desc_en' => $meta_desc_en,
            'slug_aktivitas_id' => $slug_aktivitas_id,
            'slug_aktivitas_en' => $slug_aktivitas_en,
        ];

        // Update the product data in the database
        $aktivitasModel->where('id_aktivitas', $id_aktivitas)->set($data)->update();

        session()->setFlashdata('success', 'Berkas berhasil diperbarui');
        return redirect()->to(base_url('admin/aktivitas/index'));
    }


    public function delete($id = false)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $aktivitasModel = new ActivityModel();

        $data = $aktivitasModel->find($id);

        unlink('assets/img/aktivitas/' . $data['foto_aktivitas']);

        $aktivitasModel->delete($id);

        return redirect()->to(base_url('admin/aktivitas/index'));
    }
}
