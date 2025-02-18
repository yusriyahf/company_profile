<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;
use App\Models\CategoryArtikelModel;

class ArtikelController extends BaseController
{
    protected $artikelModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
        $this->kategoriModel = new CategoryArtikelModel();
    }

    // Menampilkan daftar Sosmed
    public function index()
    {
        $data['artikel'] = $this->artikelModel->getArtikelWithCategoryAdmin();
        return view('admin/artikel/index', $data);
    }

    // Menampilkan form tambah Sosmed
    public function create()
    {
        return view('admin/artikel/create');
    }

    // Menyimpan Sosmed baru dengan gambar
    public function store()
    {
        $file = $this->request->getFile('logo_sosmed');
        $namaFile = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('assets/img/logo', $namaFile);
        }

        $this->artikelModel->save([
            'nama_sosmed' => $this->request->getVar('nama_sosmed'),
            'link_sosmed' => $this->request->getVar('link_sosmed'),
            'logo_sosmed' => $namaFile
        ]);

        return redirect()->to('/admin/artikel')->with('success', 'Sosmed berhasil ditambahkan');
    }

    // Menampilkan form edit Sosmed
    public function edit($id)
    {
        $data['sosmed'] = $this->artikelModel->find($id);
        return view('admin/artikel/edit', $data);
    }

    // Mengupdate Sosmed termasuk gambar
    public function update($id)
    {
        $sosmed = $this->artikelModel->find($id);
        $file = $this->request->getFile('logo_sosmed');
        $namaFile = $sosmed['logo_sosmed'];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus gambar lama jika ada
            if (!empty($sosmed['logo_sosmed']) && file_exists('assets/img/logo/' . $sosmed['logo_sosmed'])) {
                unlink('assets/img/logo/' . $sosmed['logo_sosmed']);
            }
            $namaFile = $file->getRandomName();
            $file->move('assets/img/logo', $namaFile);
        }

        $this->artikelModel->update($id, [
            'nama_sosmed' => $this->request->getVar('nama_sosmed'),
            'link_sosmed' => $this->request->getVar('link_sosmed'),
            'logo_sosmed' => $namaFile
        ]);

        return redirect()->to('/admin/artikel')->with('success', 'Sosmed berhasil diperbarui');
    }

    // Menghapus Sosmed dan gambar terkait
    public function delete($id)
    {
        $sosmed = $this->artikelModel->find($id);

        if (!empty($sosmed['logo_sosmed']) && file_exists('assets/img/logo/' . $sosmed['logo_sosmed'])) {
            unlink('assets/img/logo/' . $sosmed['logo_sosmed']);
        }

        $this->artikelModel->delete($id);
        return redirect()->to('/admin/artikel')->with('success', 'Sosmed berhasil dihapus');
    }
}
