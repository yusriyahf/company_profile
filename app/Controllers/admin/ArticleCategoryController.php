<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryArtikelModel;
use App\Models\KategoriModel;
use CodeIgniter\HTTP\ResponseInterface;

class ArticleCategoryController extends BaseController
{
    protected $articleCategoryModel;

    public function __construct()
    {
        $this->articleCategoryModel = new CategoryArtikelModel();
        helper('text');
    }

    // Menampilkan daftar kategori
    public function index()
    {
        $data['categories'] = $this->articleCategoryModel->findAll();
        return view('admin/kategori_artikel/index', $data);
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('admin/kategori_artikel/create');
    }

    // Menyimpan kategori baru
    public function store()
    {
        $namaKategoriId = $this->request->getVar('nama_kategori_id');
        $namaKategoriEn = $this->request->getVar('nama_kategori_en');

        $this->articleCategoryModel->save([
            'nama_kategori_id' => $namaKategoriId,
            'nama_kategori_en' => $namaKategoriEn,
            'slug_kategori_id' => url_title($namaKategoriId, '-', true),
            'slug_kategori_en' => url_title($namaKategoriEn, '-', true),
            'title_kategori_id' => $this->request->getVar('title_kategori_id'),
            'title_kategori_en' => $this->request->getVar('title_kategori_en'),
            'meta_desc_id' => $this->request->getVar('meta_desc_id'),
            'meta_desc_en' => $this->request->getVar('meta_desc_en'),
        ]);

        return redirect()->to('/admin/kategoriartikel')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Menampilkan form edit kategori
    public function edit($id)
    {
        $data['category'] = $this->articleCategoryModel->find($id);
        return view('admin/kategori_artikel/edit', $data);
    }

    // Mengupdate kategori
    public function update($id)
    {
        $namaKategoriId = $this->request->getVar('nama_kategori_id');
        $namaKategoriEn = $this->request->getVar('nama_kategori_en');

        $this->articleCategoryModel->update($id, [
            'nama_kategori_id' => $namaKategoriId,
            'nama_kategori_en' => $namaKategoriEn,
            'slug_kategori_id' => url_title($namaKategoriId, '-', true),
            'slug_kategori_en' => url_title($namaKategoriEn, '-', true),
            'title_kategori_id' => $this->request->getVar('title_kategori_id'),
            'title_kategori_en' => $this->request->getVar('title_kategori_en'),
            'meta_desc_id' => $this->request->getVar('meta_desc_id'),
            'meta_desc_en' => $this->request->getVar('meta_desc_en'),
        ]);

        return redirect()->to('/admin/kategoriartikel')->with('success', 'Kategori berhasil diperbarui');
    }

    // Menghapus kategori
    public function delete($id)
    {
        $this->articleCategoryModel->delete($id);
        return redirect()->to('/admin/kategoriartikel')->with('success', 'Kategori berhasil dihapus');
    }
}
