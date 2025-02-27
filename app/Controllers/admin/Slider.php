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

    // Ambil file upload
    $foto1 = $this->request->getFile('foto_slider1');
    $foto2 = $this->request->getFile('foto_slider2');
    $foto3 = $this->request->getFile('foto_slider3');

        // Simpan dengan nama file unik
        $foto_slider1 = "{$nama_perusahaan}_slider1_{$currentDateTime}.{$foto1->getExtension()}";
        $foto_slider2 = "{$nama_perusahaan}_slider2_{$currentDateTime}.{$foto2->getExtension()}";
        $foto_slider3 = "{$nama_perusahaan}_slider3_{$currentDateTime}.{$foto3->getExtension()}";

        $foto1->move('assets/img/slider/', $foto_slider1);
        $foto2->move('assets/img/slider/', $foto_slider2);
        $foto3->move('assets/img/slider/', $foto_slider3);

        // Simpan ke database
        $sliderModel = new SliderModel();
        $slider = [
            'foto_slider1' => $foto_slider1,
            'alt_foto_slider1_id' => $this->request->getPost('alt_foto_slider1_id'),
            'alt_foto_slider1_en' => $this->request->getPost('alt_foto_slider1_en'),
            'foto_slider2' => $foto_slider2,
            'alt_foto_slider2_id' => $this->request->getPost('alt_foto_slider2_id'),
            'alt_foto_slider2_en' => $this->request->getPost('alt_foto_slider2_en'),
            'foto_slider3' => $foto_slider3,
            'alt_foto_slider3_id' => $this->request->getPost('alt_foto_slider3_id'),
            'alt_foto_slider3_en' => $this->request->getPost('alt_foto_slider3_en'),
            'caption_slider_id' => $this->request->getPost('caption_slider_id'),
            'caption_slider_en' => $this->request->getPost('caption_slider_en')
        ];
        
        $sliderModel->save($slider);

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
        if (!$id_slider || !$sliderModel->find($id_slider)) {
            return redirect()->back()->with('error', 'Data slider tidak ditemukan.');
        }

        $dataToUpdate = [];

        foreach (['file_foto_slider1', 'file_foto_slider2', 'file_foto_slider3'] as $fileField) {
            $file = $this->request->getFile($fileField);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newFileName = time() . '_' . $file->getRandomName();
                $file->move('assets/img/slider', $newFileName);
                $dataToUpdate[$fileField] = $newFileName;
            }
        }

        // Menambahkan hanya jika ada input baru
        $altFields = [
            'alt_foto_slider1_id',
            'alt_foto_slider1_en',
            'alt_foto_slider2_id',
            'alt_foto_slider2_en',
            'alt_foto_slider3_id',
            'alt_foto_slider3_en'
        ];

        foreach ($altFields as $field) {
            $value = $this->request->getPost($field);
            if ($value !== null) {
                $dataToUpdate[$field] = $value;
            }
        }

        // Jika tidak ada data yang diupdate, kembalikan tanpa error
        if (empty($dataToUpdate)) {
            return redirect()->back()->with('warning', 'Tidak ada perubahan yang disimpan.');
        }

        // Update hanya jika ada perubahan
        $sliderModel->update($id_slider, $dataToUpdate);
        return redirect()->to(base_url('admin/slider/index'))->with('success', 'Slider berhasil diperbarui.');
    }


    public function delete($id = false)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $sliderModel = new SliderModel();

        $data = $sliderModel->find($id);

        unlink('assets/img/slider//' . $data->file_foto_slider);

        $sliderModel->delete($id);

        return redirect()->to(base_url('admin/slider/index'));
    }
}
