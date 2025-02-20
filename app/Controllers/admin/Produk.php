<?php

namespace App\Controllers\admin;

use App\Models\ProductModel;
use App\Models\ProdukModel;

class Produk extends BaseController
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
        $produk_model = new ProductModel();
        $all_data_produk = $produk_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/produk/index', [
            'all_data_produk' => $all_data_produk,
            'validation' => $validation
        ]);
    }

    public function tambah()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $produk_model = new ProductModel();
        $all_data_produk = $produk_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/produk/tambah', [
            'all_data_produk' => $all_data_produk,
            'validation' => $validation
        ]);
    }

    public function proses_tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }
        date_default_timezone_set('Asia/Jakarta');
        $file_foto = $this->request->getFile('foto_produk');
        $currentDateTime = date('dmYHis');
        $nama_produk_id = $this->request->getVar("nama_produk_id");
        $nama_produk_en = $this->request->getVar("nama_produk_en");
        $alt_produk_id = $this->request->getVar('alt_produk_id');
        $alt_produk_en = $this->request->getVar('alt_produk_en');
        $meta_title_id = $this->request->getVar("meta_title_id");
        $meta_title_en = $this->request->getVar("meta_title_en");
        $meta_desc_id = $this->request->getVar("meta_desc_id");
        $meta_desc_en = $this->request->getVar("meta_desc_en");
        

        // Buat slug_id dari judul_artikel
        $slug_id = $this->generateSlug($nama_produk_id);
        $slug_en = $this->generateSlug($nama_produk_en);

        // Validasi nama produk Indonesia
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_produk_id)) {
            session()->setFlashdata('error', 'Nama produk Indonesia hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Validasi nama produk Inggris
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_produk_en)) {
            session()->setFlashdata('error', 'Nama produk Inggris hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        if (!$this->validate([
            'foto_produk' => [
                'rules' => 'uploaded[foto_produk]|is_image[foto_produk]|max_dims[foto_produk,572,572]|mime_in[foto_produk,image/jpg,image/jpeg,image/png]',
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
            // Ganti spasi dengan tanda "-"
            $nama_produk_id_sanitized = str_replace(' ', '-', $nama_produk_id);
            $nama_produk_en_sanitized = str_replace(' ', '-', $nama_produk_en);

            $newFileName = "{$nama_produk_id_sanitized}_{$nama_produk_en_sanitized}_{$currentDateTime}.{$file_foto->getExtension()}";
            $file_foto->move('assets/img/produk', $newFileName);

            $produkModel = new ProductModel();
            $data = [
                'nama_produk_id' => $this->request->getVar("nama_produk_id"),
                'nama_produk_en' => $this->request->getVar("nama_produk_en"),
                'deskripsi_produk_id' => $this->request->getVar("deskripsi_produk_id"),
                'deskripsi_produk_en' => $this->request->getVar("deskripsi_produk_en"),
                'foto_produk' => $newFileName,
                'alt_produk_id' => $alt_produk_id,
                'alt_produk_en' => $alt_produk_en,
                'slug_id' => $slug_id,
                'slug_en' => $slug_en,
                'meta_title_id' => $meta_title_id,
                'meta_title_en' => $meta_title_en,
                'meta_desc_id' => $meta_desc_id,
                'meta_desc_en' => $meta_desc_en,
                
            ];
            $produkModel->save($data);

            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(base_url('admin/produk/index'));
        }
    }

    public function edit($id_produk)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $produk_model = new ProductModel();
        $produkData = $produk_model->find($id_produk);
        $validation = \Config\Services::validation();

        return view('admin/produk/edit', [
            'produkData' => $produkData,
            'validation' => $validation
        ]);
    }

    // Produk.php (Controller)
    public function proses_edit($id_produk = null)
    {
        if (!$id_produk) {
            return redirect()->back();
        }

        $produkModel = new ProductModel();
        $produkData = $produkModel->find($id_produk);

        $nama_produk_id = $this->request->getVar("nama_produk_id");
        $nama_produk_en = $this->request->getVar("nama_produk_en");
        $file_foto = $this->request->getFile('foto_produk');
        $alt_produk_id = $this->request->getVar('alt_produk_id');
        $alt_produk_en = $this->request->getVar('alt_produk_en');
        $meta_title_id = $this->request->getVar("meta_title_id");
        $meta_title_en = $this->request->getVar("meta_title_en");
        $meta_desc_id = $this->request->getVar("meta_desc_id");
        $meta_desc_en = $this->request->getVar("meta_desc_en");

        // Buat slug_id dari judul_artikel
        $slug_id = $this->generateSlug($nama_produk_id);
        $slug_en = $this->generateSlug($nama_produk_en);

        // Validasi nama produk Indonesia
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_produk_id)) {
            session()->setFlashdata('error', 'Nama produk Indonesia hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Validasi nama produk Inggris
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nama_produk_en)) {
            session()->setFlashdata('error', 'Nama produk Inggris hanya boleh berisi huruf dan angka.');
            return redirect()->back()->withInput();
        }

        // Check if new 'foto_produk' file is uploaded
        if ($this->request->getFile('foto_produk')->isValid()) {
            // Delete the old 'foto_produk' file if it exists
            $oldFilePath = 'assets/img/produk/' . $produkData['foto_produk'];
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            // Ganti spasi dengan tanda "-"
            $nama_produk_id_sanitized = str_replace(' ', '-', $nama_produk_id);
            $nama_produk_en_sanitized = str_replace(' ', '-', $nama_produk_en);

            // Generate new file name
            $currentDateTime = date('dmYHis');
            $newFileName = "{$nama_produk_en_sanitized}_{$nama_produk_id_sanitized}_{$currentDateTime}.{$file_foto->getExtension()}";

            $file_foto->move('assets/img/produk/', $newFileName);
        } else {
            // If no new 'foto_produk' file is uploaded, keep the old filename
            $newFileName = $produkData['foto_produk'];
        }

        // Update the product data
        $data = [
            'foto_produk' => $newFileName,
            'nama_produk_id' => $nama_produk_id,
            'nama_produk_en' => $nama_produk_en,
            'deskripsi_produk_id' => $this->request->getPost("deskripsi_produk_id"),
            'deskripsi_produk_en' => $this->request->getPost("deskripsi_produk_en"),
            'alt_produk_id' => $alt_produk_id,
            'alt_produk_en' => $alt_produk_en,
            'meta_title_id' => $meta_title_id,
            'meta_title_en' => $meta_title_en,
            'meta_desc_id' => $meta_desc_id,
            'meta_desc_en' => $meta_desc_en,
            'slug_id' => $slug_id,
            'slug_en' => $slug_en,
        ];



        // Update the product data in the database
        $produkModel->where('id_produk', $id_produk)->set($data)->update();

        session()->setFlashdata('success', 'Berkas berhasil diperbarui');
        return redirect()->to(base_url('admin/produk/index'));
    }


    public function delete($id = false)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $produkModel = new ProductModel();

        $data = $produkModel->find($id);

        unlink('assets/img/produk/' . $data['foto_produk']);

        $produkModel->delete($id);

        return redirect()->to(base_url('admin/produk/index'));
    }
}
