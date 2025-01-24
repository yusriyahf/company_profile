<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_kategori_artikel' => 1, // ID kategori artikel
                'judul_artikel_id' => 'Meningkatkan Branding Bisnis Anda dengan Desain Kreatif',
                'judul_artikel_en' => 'Enhancing Your Business Branding with Creative Design',
                'snippet_id' => 'Desain kreatif adalah kunci untuk memperkuat branding bisnis Anda dan menarik perhatian audiens.',
                'snippet_en' => 'Creative design is key to strengthening your business branding and attracting audience attention.',
                'deskripsi_artikel_id' => 'Dalam artikel ini, kami akan membahas pentingnya desain kreatif dalam menciptakan branding yang kuat untuk bisnis Anda. Desain yang efektif dapat meningkatkan pengenalan merek dan menciptakan pengalaman yang lebih baik bagi pelanggan.',
                'deskripsi_artikel_en' => 'In this article, we discuss the importance of creative design in building a strong brand for your business. Effective design can enhance brand recognition and create a better customer experience.',
                'foto_artikel' => 'branding-design.jpg',
                'alt_artikel_id' => 'Desain kreatif untuk branding bisnis',
                'alt_artikel_en' => 'Creative design for business branding',
                'title_artikel_id' => 'Desain Kreatif untuk Branding Bisnis | CreativeNest',
                'title_artikel_en' => 'Creative Design for Business Branding | CreativeNest',
                'meta_desc_id' => 'Pelajari bagaimana desain kreatif dapat membantu memperkuat branding bisnis Anda di CreativeNest.',
                'meta_desc_en' => 'Learn how creative design can help strengthen your business branding at CreativeNest.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_kategori_artikel' => 2, // ID kategori artikel
                'judul_artikel_id' => 'Strategi Digital Marketing untuk Meningkatkan Penjualan',
                'judul_artikel_en' => 'Digital Marketing Strategies to Boost Sales',
                'snippet_id' => 'Strategi pemasaran digital yang efektif dapat membantu bisnis Anda mencapai audiens yang lebih luas dan meningkatkan penjualan.',
                'snippet_en' => 'Effective digital marketing strategies can help your business reach a wider audience and boost sales.',
                'deskripsi_artikel_id' => 'Pemasaran digital telah menjadi bagian penting dalam kesuksesan bisnis. Artikel ini akan membahas berbagai strategi pemasaran digital yang dapat meningkatkan penjualan dan memperluas jangkauan pasar Anda.',
                'deskripsi_artikel_en' => 'Digital marketing has become a crucial part of business success. This article will discuss various digital marketing strategies that can boost sales and expand your market reach.',
                'foto_artikel' => 'digital-marketing.jpg',
                'alt_artikel_id' => 'Strategi pemasaran digital untuk penjualan',
                'alt_artikel_en' => 'Digital marketing strategies for sales',
                'title_artikel_id' => 'Strategi Pemasaran Digital untuk Penjualan | CreativeNest',
                'title_artikel_en' => 'Digital Marketing Strategies for Sales | CreativeNest',
                'meta_desc_id' => 'Temukan cara pemasaran digital dapat meningkatkan penjualan dan jangkauan bisnis Anda di CreativeNest.',
                'meta_desc_en' => 'Discover how digital marketing can boost your sales and business reach at CreativeNest.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('tb_artikel')->insertBatch($data);
    }
}
