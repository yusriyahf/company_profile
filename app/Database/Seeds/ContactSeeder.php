<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'deskripsi_kontak_id' => 'Hubungi kami untuk solusi digital kreatif yang membantu bisnis Anda berkembang pesat di era modern. Kami siap membantu Anda dengan layanan desain website, branding, dan strategi pemasaran digital.',
                'deskripsi_kontak_en' => 'Contact us for creative digital solutions that help your business thrive in the modern era. We are ready to assist you with web design, branding, and digital marketing strategies.',
            ],
        ];

        // Insert data ke dalam tabel
        $this->db->table('tb_kontak')->insertBatch($data);
    }
}
