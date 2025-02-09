<?php

namespace App\Controllers\admin;

use App\Models\MetaModel;

class MetaController extends BaseController
{

    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $meta_model = new MetaModel();
        $all_data_meta = $meta_model->findAll();
        // var_dump($all_data_meta);
        // die();
        $validation = \Config\Services::validation();
        return view('admin/meta/index', [
            'all_data_meta' => $all_data_meta,
            'validation' => $validation
        ]);
    }

    public function tambah()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $meta_model = new MetaModel();
        $all_data_meta = $meta_model->findAll();

        $validation = \Config\Services::validation();
        return view('admin/meta/tambah', [
            'all_data_meta' => $all_data_meta,
            'validation' => $validation
        ]);
    }

    public function proses_tambah()
    {
        // Check if the user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // dd($this->request->getPost());
        $metaModel = new MetaModel();

        // Get data from the form request
        $nama_halaman_id = $this->request->getVar("nama_halaman_id");
        $nama_halaman_en = $this->request->getVar("nama_halaman_en");
        $deskripsi_halaman_id = $this->request->getVar("deskripsi_halaman_id");
        $deskripsi_halaman_en = $this->request->getVar("deskripsi_halaman_en");
        $meta_title_id = $this->request->getVar("title_id");
        $meta_title_en = $this->request->getVar("title_en");
        $meta_description_id = $this->request->getVar("meta_desc_id");
        $meta_description_en = $this->request->getVar("meta_desc_en");

        // Initialize the model

        // Prepare data to save
        $data = [
            'nama_halaman_id' => $nama_halaman_id,
            'nama_halaman_en' => $nama_halaman_en,
            'deskripsi_halaman_id' => $deskripsi_halaman_id,
            'deskripsi_halaman_en' => $deskripsi_halaman_en,
            'title_id' => $meta_title_id,
            'title_en' => $meta_title_en,
            'meta_desc_id' => $meta_description_id,
            'meta_desc_en' => $meta_description_en,
        ];

        // Save the data
        $metaModel->save($data);


        // Set a success flash message
        session()->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to(base_url('admin/meta/index'));
    }

    public function edit($id_artikel)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $meta_model = new MetaModel();
        $meta = $meta_model->find($id_artikel);
        $validation = \Config\Services::validation();

        return view('admin/meta/edit', [
            'meta' => $meta,
            'validation' => $validation
        ]);
    }

    // Produk.php (Controller)
    public function proses_edit($id)
    {
        // Check if the user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Initialize the model
        $metaModel = new MetaModel();

        // Get the existing data from the database
        $metaData = $metaModel->find($id);
        if (!$metaData) {
            session()->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to(base_url('admin/meta/index'));
        }

        // Get data from the form request
        $nama_halaman_id = $this->request->getVar("nama_halaman_id");
        $nama_halaman_en = $this->request->getVar("nama_halaman_en");
        $deskripsi_halaman_id = $this->request->getVar("deskripsi_halaman_id");
        $deskripsi_halaman_en = $this->request->getVar("deskripsi_halaman_en");
        $meta_title_id = $this->request->getVar("title_id");
        $meta_title_en = $this->request->getVar("title_en");
        $meta_description_id = $this->request->getVar("meta_desc_id");
        $meta_description_en = $this->request->getVar("meta_desc_en");

        // Prepare updated data
        $data = [
            'nama_halaman_id' => $nama_halaman_id,
            'nama_halaman_en' => $nama_halaman_en,
            'deskripsi_halaman_id' => $deskripsi_halaman_id,
            'deskripsi_halaman_en' => $deskripsi_halaman_en,
            'title_id' => $meta_title_id,
            'title_en' => $meta_title_en,
            'meta_desc_id' => $meta_description_id,
            'meta_desc_en' => $meta_description_en,
        ];

        // Update the data
        $metaModel->update($id, $data);

        // Set a success flash message
        session()->setFlashdata('success', 'Data berhasil diperbarui');
        return redirect()->to(base_url('admin/meta/index'));
    }


    public function delete($id = false)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $metaModel = new MetaModel();

        $metaModel->delete($id);

        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to(base_url('admin/meta/index'));
    }
}
