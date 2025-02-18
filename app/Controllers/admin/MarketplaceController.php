<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MarketplaceModel;

class MarketplaceController extends BaseController
{
    protected $marketPlaceModel;

    public function __construct()
    {
        $this->marketPlaceModel = new MarketplaceModel();
    }

    // Menampilkan daftar Marketplace
    public function index()
    {
        $data['marketplaces'] = $this->marketPlaceModel->findAll();
        return view('admin/marketplace/index', $data);
    }

    // Menampilkan form tambah Marketplace
    public function create()
    {
        return view('admin/marketplace/create');
    }

    // Menyimpan Marketplace baru
    public function store()
    {
        $file = $this->request->getFile('logo_marketplace');
        $namaFile = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('assets/img/logo', $namaFile);
        }

        $this->marketPlaceModel->save([
            'nama_marketplace' => $this->request->getVar('nama_marketplace'),
            'link_marketplace' => $this->request->getVar('link_marketplace'),
            'logo_marketplace' => $namaFile
        ]);

        return redirect()->to('/admin/marketplace')->with('success', 'Marketplace berhasil ditambahkan');
    }

    // Menampilkan form edit Marketplace
    public function edit($id)
    {
        $data['marketplace'] = $this->marketPlaceModel->find($id);
        return view('admin/marketplace/edit', $data);
    }

    // Mengupdate Marketplace
    public function update($id)
    {
        $marketplace = $this->marketPlaceModel->find($id);
        $file = $this->request->getFile('logo_marketplace');
        $namaFile = $marketplace['logo_marketplace'];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus gambar lama jika ada
            if (!empty($marketplace['logo_marketplace']) && file_exists('assets/img/logo/' . $marketplace['logo_marketplace'])) {
                unlink('assets/img/logo/' . $marketplace['logo_marketplace']);
            }
            $namaFile = $file->getRandomName();
            $file->move('assets/img/logo', $namaFile);
        }

        $this->marketPlaceModel->update($id, [
            'nama_marketplace' => $this->request->getVar('nama_marketplace'),
            'link_marketplace' => $this->request->getVar('link_marketplace'),
            'logo_marketplace' => $namaFile
        ]);

        return redirect()->to('/admin/marketplace')->with('success', 'marketplace berhasil diperbarui');
    }


    // Menghapus Marketplace
    public function delete($id)
    {
        $marketplace = $this->marketPlaceModel->find($id);

        if (!empty($marketplace['logo_marketplace']) && file_exists('assets/img/logo/' . $marketplace['logo_marketplace'])) {
            unlink('assets/img/logo/' . $marketplace['logo_marketplace']);
        }

        $this->marketPlaceModel->delete($id);
        return redirect()->to('/admin/marketplace')->with('success', 'Marketplace berhasil dihapus');
    }
}
