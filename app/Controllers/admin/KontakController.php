<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KontakModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontakController extends BaseController
{
    protected $kontakModel;

    public function __construct()
    {
        $this->kontakModel = new KontakModel();
    }

    // Menampilkan form edit Kontak
    public function edit()
    {
        $data['kontak'] = $this->kontakModel->first();
        return view('admin/kontak/edit', $data);
    }

    // Mengupdate Kontak
    public function update($id)
    {
        $this->kontakModel->update($id, [
            'deskripsi_kontak_id' => $this->request->getPost('deskripsi_kontak_id'),
            'deskripsi_kontak_en' => $this->request->getPost('deskripsi_kontak_en'),
            'link_wa' => $this->request->getPost('link_wa'),
        ]);

        return redirect()->to('/admin/kontak')->with('success', 'Kontak berhasil diperbarui');
    }
}
