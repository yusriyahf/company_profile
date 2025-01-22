<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MetaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_halaman' => 'home',
                'title_id' => 'CreativeNest | Solusi Digital Kreatif untuk Website dan Branding Anda',
                'title_en' => 'CreativeNest | Creative Digital Solutions for Your Website and Branding',
                'meta_desc_id' => 'CreativeNest menyediakan layanan desain website, branding profesional, dan strategi pemasaran digital untuk meningkatkan bisnis Anda di era modern.',
                'meta_desc_en' => 'CreativeNest offers professional web design, branding, and digital marketing strategies to boost your business in the modern era.',
            ],
            [
                'nama_halaman' => 'about',
                'title_id' => 'Tentang CreativeNest | Mitra Digital Inovatif',
                'title_en' => 'About CreativeNest | Innovative Digital Partner',
                'meta_desc_id' => 'CreativeNest adalah mitra terbaik Anda untuk solusi digital, menciptakan website interaktif dan branding yang menarik untuk meningkatkan visibilitas bisnis.',
                'meta_desc_en' => 'CreativeNest is your best partner for digital solutions, creating interactive websites and engaging branding to boost business visibility.',
            ],
            [
                'nama_halaman' => 'contact',
                'title_id' => 'Hubungi CreativeNest | Konsultasi Gratis untuk Solusi Digital',
                'title_en' => 'Contact CreativeNest | Free Consultation for Digital Solutions',
                'meta_desc_id' => 'Hubungi CreativeNest sekarang untuk konsultasi gratis mengenai desain website, branding, dan pemasaran digital untuk bisnis Anda.',
                'meta_desc_en' => 'Contact CreativeNest now for a free consultation on web design, branding, and digital marketing for your business.',
            ],
        ];

        // Insert data ke dalam tabel
        $this->db->table('tb_meta')->insertBatch($data);
    }
}
