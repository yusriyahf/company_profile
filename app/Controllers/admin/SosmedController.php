<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SosmedModel;
use CodeIgniter\HTTP\ResponseInterface;

class SosmedController extends BaseController
{
    protected $sosmedModel;

    public function __construct()
    {
        $this->sosmedModel = new SosmedModel();
    }

    // Menampilkan daftar Sosmed
    public function index()
    {
        $data['sosmed'] = $this->sosmedModel->findAll();
        return view('admin/sosmed/index', $data);
    }

    // Menampilkan form tambah Sosmed
    public function create()
    {
        return view('admin/sosmed/create');
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

        $this->sosmedModel->save([
            'nama_sosmed' => $this->request->getVar('nama_sosmed'),
            'link_sosmed' => $this->request->getVar('link_sosmed'),
            'logo_sosmed' => $namaFile
        ]);

        return redirect()->to('/admin/sosmed')->with('success', 'Sosmed berhasil ditambahkan');
    }

    // Menampilkan form edit Sosmed
    public function edit($id)
    {
        $data['sosmed'] = $this->sosmedModel->find($id);
        return view('admin/sosmed/edit', $data);
    }

    // Mengupdate Sosmed termasuk gambar
    public function update($id)
    {
        $sosmed = $this->sosmedModel->find($id);
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

        $this->sosmedModel->update($id, [
            'nama_sosmed' => $this->request->getVar('nama_sosmed'),
            'link_sosmed' => $this->request->getVar('link_sosmed'),
            'logo_sosmed' => $namaFile
        ]);

        return redirect()->to('/admin/sosmed')->with('success', 'Sosmed berhasil diperbarui');
    }

    // Menghapus Sosmed dan gambar terkait
    public function delete($id)
    {
        $sosmed = $this->sosmedModel->find($id);

        if (!empty($sosmed['logo_sosmed']) && file_exists('assets/img/logo/' . $sosmed['logo_sosmed'])) {
            unlink('assets/img/logo/' . $sosmed['logo_sosmed']);
        }

        $this->sosmedModel->delete($id);
        return redirect()->to('/admin/sosmed')->with('success', 'Sosmed berhasil dihapus');
    }
}
