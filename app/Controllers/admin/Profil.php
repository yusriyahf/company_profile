<?php

namespace App\Controllers\Admin;

use App\Models\ProfilModel;
use App\Models\SliderModel;

class Profil extends BaseController
{
    public function edit()
    {
        if (!session()->get('logged_in')) {
            log_message('error', 'Akses ditolak: pengguna belum login.');
            return redirect()->to(base_url('login'));
        }

        $model = new ProfilModel();
        $slider = new SliderModel();
        $username_pengguna = session()->get('username');
        $data['profil_pengguna'] = $model->where('username', $username_pengguna)->first();
        $data['validation'] = \Config\Services::validation();
        $data['slider'] = $slider->where('id_slider', 1)->first();
        // log slider
        log_message('debug', 'slider: ' . json_encode($data['slider']));

        log_message('info', "Mengakses halaman edit profil untuk username: {$username_pengguna}");

        return view('admin/profil/edit', $data);
    }

    public function proses_edit()
    {

        $profilModel = new ProfilModel();
        $sliderModel = new SliderModel();
        $username_pengguna = session()->get('username');
        $profil = $profilModel->where('username', $username_pengguna)->first();
        $slider = $sliderModel->first();

        // if (!$profil) {
        //     log_message('error', "Profil tidak ditemukan untuk username: {$username_pengguna}");
        //     return redirect()->to(base_url('admin/profil/edit'))->with('error', 'Profil tidak ditemukan.');
        // }

        log_message('info', "Memproses update profil untuk username: {$username_pengguna}");

        $updateData = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'deskripsi_perusahaan_id' => $this->request->getPost('deskripsi_perusahaan_id'),
            'deskripsi_perusahaan_en' => $this->request->getPost('deskripsi_perusahaan_en'),
            'footer' => $this->request->getPost('footer'),
            'alt_foto_perusahaan_id' => $this->request->getPost('alt_foto_perusahaan_id'),
            'alt_foto_perusahaan_en' => $this->request->getPost('alt_foto_perusahaan_en'),
            'alt_logo_perusahaan_id' => $this->request->getPost('alt_logo_perusahaan_id'),
            'alt_logo_perusahaan_en' => $this->request->getPost('alt_logo_perusahaan_en'),
        ];

        log_message('info', 'Data yang akan diperbarui: ' . json_encode($updateData));

        // $updateSlider = [ 
        //     'caption_slider_id' => $this->request->getPost('caption_slider_id'),
        //     'caption_slider_en' => $this->request->getPost('caption_slider_en'),
        // ];

        // log_message('info', 'Data yang akan diperbarui: ' . json_encode($updateSlider));

        // Handle file uploads
        $fileFields = ['logo_perusahaan', 'favicon_perusahaan', 'foto_perusahaan'];
        foreach ($fileFields as $field) {
            $file = $this->request->getFile($field);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                if (in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif']) && $file->getSize() <= 2048000) {
                    $oldFile = $profil[$field] ?? null;
                    if ($oldFile && file_exists('assets/img/profil/' . $oldFile)) {
                        unlink('assets/img/profil/' . $oldFile);
                        log_message('info', "File lama {$oldFile} dihapus.");
                    }
                    $newFileName = "{$field}_" . str_replace(' ', '-', $updateData['nama_perusahaan']) . "_" . date('dmYHis') . "." . $file->getExtension();
                    $file->move('assets/img/profil/', $newFileName);
                    $updateData[$field] = $newFileName;
                    log_message('info', "File {$field} berhasil diupload sebagai {$newFileName}.");
                } else {
                    log_message('error', "File {$field} gagal diupload. Format atau ukuran tidak valid.");
                    return redirect()->to(base_url('admin/profil/edit'))->with('error', 'File harus berupa gambar (JPEG, PNG, GIF) dan maksimal 2MB.');
                }
            }
        }

        if ($profilModel->update($profil['id_perusahaan'], $updateData)) {
            return redirect()->to(base_url('admin/profil/edit'))->with('success', 'Profil berhasil diubah.');
        } else {
            return redirect()->to(base_url('admin/profil/edit'))->with('error', 'Gagal mengubah profil.');
        }
        log_message('info', "Profil username: {$username_pengguna} berhasil diperbarui.");
    }
}
