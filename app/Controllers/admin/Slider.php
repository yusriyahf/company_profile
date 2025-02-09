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
        $nama_perusahaan = $profilData->nama_perusahaan;
        $nama_perusahaan = str_replace(' ', '-', $nama_perusahaan);

        date_default_timezone_set('Asia/Jakarta');
        $file_foto = $this->request->getFile('file_foto_slider');
        $currentDateTime = date('dmYHis');

        if (!$this->validate([
            'file_foto_slider' => [
                'rules' => 'uploaded[file_foto_slider]|is_image[file_foto_slider]|max_dims[file_foto_slider,1900,1144]|mime_in[file_foto_slider,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih foto terlebih dahulu',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'max_dims' => 'Maksimal ukuran gambar 1900x1144 pixels',
                    'mime_in' => 'File yang anda pilih wajib berekstensikan jpg/jpeg/png'
                ]
            ]

        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $newFileName = "{$nama_perusahaan}_{$currentDateTime}.{$file_foto->getExtension()}";
            $file_foto->move('asset-user/images', $newFileName);

            $sliderModel = new SliderModel();
            $data = [
                'file_foto_slider' => $newFileName
            ];
            $sliderModel->save($data);

            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(base_url('admin/slider/index'));
        }
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
        return redirect()->to(base_url('admin/slider'))->with('success', 'Slider berhasil diperbarui.');
    }


    public function delete($id = false)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); // Ubah 'login' sesuai dengan halaman login kamu
        }
        $sliderModel = new SliderModel();

        $data = $sliderModel->find($id);

        unlink('asset-user/images/' . $data->file_foto_slider);

        $sliderModel->delete($id);

        return redirect()->to(base_url('admin/slider/index'));
    }
}
