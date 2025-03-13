<?php

namespace App\Controllers\admin;

use App\Models\SliderModel;
use App\Models\ProfilModel;

class Slider extends BaseController
{
    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $slider_model = new SliderModel();
        $all_data_slider = $slider_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/slider/index', [
            'all_data_slider' => $all_data_slider,
            'validation' => $validation
        ]);
    }

    public function tambah()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $slider_model = new SliderModel();
        $all_data_slider = $slider_model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/slider/tambah', [
            'all_data_slider' => $all_data_slider,
            'validation' => $validation
        ]);
    }

    public function proses_tambah()
    {
        $profilModel = new ProfilModel();
        $profilData = $profilModel->first();
        $nama_perusahaan = str_replace(' ', '-', $profilData['nama_perusahaan']);

        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = date('dmYHis');

        // Validasi file upload
        $foto1 = $this->request->getFile('foto_slider');
        $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'];

        if (!$foto1->isValid()) {
            session()->setFlashdata('error_foto_slider', 'File tidak valid.');
            return redirect()->back()->withInput();
        }

        if (!in_array($foto1->getMimeType(), $allowedTypes)) {
            session()->setFlashdata('error_foto_slider', 'File harus berupa gambar (PNG, JPG, JPEG, GIF).');
            return redirect()->back()->withInput();
        }

        if ($foto1->getSize() > 2048 * 1024) { // Maksimal 2MB
            session()->setFlashdata('error_foto_slider', 'Ukuran file maksimal 2MB.');
            return redirect()->back()->withInput();
        }

        // Simpan dengan nama file unik
        $foto_slider1 = "{$nama_perusahaan}_slider_{$currentDateTime}.{$foto1->getExtension()}";
        $foto1->move('assets/img/slider', $foto_slider1);

        // Simpan ke database
        $sliderModel = new SliderModel();
        $slider = [
            'foto_slider' => $foto_slider1,
            'alt_foto_slider_id' => $this->request->getPost('alt_foto_slider_id'),
            'alt_foto_slider_en' => $this->request->getPost('alt_foto_slider_en'),
            'caption_slider_id' => $this->request->getPost('caption_slider_id'),
            'caption_slider_en' => $this->request->getPost('caption_slider_en')
        ];

        if (!$sliderModel->insert($slider)) {
            session()->setFlashdata('error', 'Gagal menyimpan data ke database.');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to(base_url('admin/slider/index'));
    }



    public function edit($id_slider)
    {
        $sliderModel = new SliderModel();
        $sliderData = $sliderModel->find($id_slider);

        if (!$sliderData) {
            return redirect()->to('/admin/slider')->with('error', 'Data slider tidak ditemukan.');
        }

        return view('admin/slider/edit', ['sliderData' => $sliderData]);
    }

    public function proses_edit($id_slider)
    {
        $sliderModel = new SliderModel();

        // Validasi keberadaan slider
        $sliderData = $sliderModel->find($id_slider);
        if (!$sliderData) {
            session()->setFlashdata('error', 'Data slider tidak ditemukan.');
            return redirect()->back()->withInput();
        }

        $dataToUpdate = [];
        $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'];
        $maxSize = 2048 * 1024; // Maksimal 2MB

        // Validasi dan proses unggahan file foto
        $file = $this->request->getFile('file_foto_slider');
        if ($file && $file->isValid()) {
            // Validasi tipe file
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                session()->setFlashdata('error', "File harus berupa gambar (PNG, JPG, JPEG, GIF).");
                return redirect()->back()->withInput();
            }

            // Validasi ukuran file
            if ($file->getSize() > $maxSize) {
                session()->setFlashdata('error', "Ukuran file maksimal 2MB.");
                return redirect()->back()->withInput();
            }

            // Hapus file lama jika ada
            if (!empty($sliderData['foto_slider']) && file_exists('assets/img/slider/' . $sliderData['foto_slider'])) {
                unlink('assets/img/slider/' . $sliderData['foto_slider']);
            }

            // Simpan dengan nama unik
            $newFileName = time() . '_' . $file->getRandomName();
            $file->move('assets/img/slider', $newFileName);
            $dataToUpdate['foto_slider'] = $newFileName; // Simpan di kolom 'foto_slider'
        }

        // Menambahkan hanya jika ada input baru
        $altFields = [
            'alt_foto_slider_id',
            'alt_foto_slider_en',
            'caption_slider_id',
            'caption_slider_en',
        ];

        foreach ($altFields as $field) {
            $value = $this->request->getPost($field);
            if (!empty($value)) {
                $dataToUpdate[$field] = $value;
            }
        }

        // Jika tidak ada data yang diupdate, tampilkan peringatan
        if (empty($dataToUpdate)) {
            session()->setFlashdata('warning', 'Tidak ada perubahan yang disimpan.');
            return redirect()->back()->withInput();
        }

        // Update hanya jika ada perubahan
        $sliderModel->update($id_slider, $dataToUpdate);
        session()->setFlashdata('success', 'Slider berhasil diperbarui.');
        return redirect()->to(base_url('admin/slider/index'));
    }


    public function delete($id = false)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $sliderModel = new SliderModel();
        $data = $sliderModel->find($id);

        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$data) {
            session()->setFlashdata('error', 'Data slider tidak ditemukan.');
            return redirect()->to(base_url('admin/slider/index'));
        }

        // Hapus file gambar jika ada
        $filePath = 'assets/img/slider/' . $data['foto_slider'];
        if (!empty($data['foto_slider']) && file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus data dari database
        $sliderModel->delete($id);

        session()->setFlashdata('success', 'Slider berhasil dihapus.');
        return redirect()->to(base_url('admin/slider/index'));
    }
}
