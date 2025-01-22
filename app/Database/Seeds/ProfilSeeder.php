<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProfilSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_perusahaan' => 'CreativeNest Digital Solutions',
                'foto_perusahaan' => 'creativenest-photo.jpg', // Gantilah dengan nama file gambar yang sesuai
                'logo_perusahaan' => 'creativenest-logo.png', // Gantilah dengan nama file logo yang sesuai
                'deskripsi_perusahaan_id' => 'CreativeNest adalah agensi desain digital yang berfokus pada pembuatan website kreatif, branding inovatif, dan pemasaran digital untuk membantu bisnis Anda tumbuh di dunia digital.',
                'deskripsi_perusahaan_en' => 'CreativeNest is a digital design agency focused on creating creative websites, innovative branding, and digital marketing to help your business grow in the digital world.',
            ],
        ];

        // Insert data ke dalam tabel
        $this->db->table('tb_profil')->insertBatch($data);
    }
}
