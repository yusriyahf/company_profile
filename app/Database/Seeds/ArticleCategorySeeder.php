<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori_id' => 'Desain Web',
                'nama_kategori_en' => 'Web Design',
                'title_kategori_id' => 'Kategori Desain Web',
                'title_kategori_en' => 'Web Design Category',
                'meta_desc_id' => 'Kategori ini mencakup artikel-artikel mengenai desain website kreatif dan fungsional.',
                'meta_desc_en' => 'This category includes articles about creative and functional web design.',
            ],
            [
                'nama_kategori_id' => 'Branding',
                'nama_kategori_en' => 'Branding',
                'title_kategori_id' => 'Kategori Branding',
                'title_kategori_en' => 'Branding Category',
                'meta_desc_id' => 'Artikel tentang strategi branding yang efektif dan cara membangun identitas merek yang kuat.',
                'meta_desc_en' => 'Articles on effective branding strategies and how to build a strong brand identity.',
            ],
            [
                'nama_kategori_id' => 'Pemasaran Digital',
                'nama_kategori_en' => 'Digital Marketing',
                'title_kategori_id' => 'Kategori Pemasaran Digital',
                'title_kategori_en' => 'Digital Marketing Category',
                'meta_desc_id' => 'Panduan dan strategi pemasaran digital untuk meningkatkan visibilitas dan pertumbuhan bisnis online.',
                'meta_desc_en' => 'Guides and strategies for digital marketing to enhance visibility and business growth online.',
            ],
        ];

        // Insert data ke dalam tabel
        $this->db->table('tb_kategori_artikel')->insertBatch($data);
    }
}
