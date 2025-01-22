<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'foto_slider1' => 'slider-image-1.jpg', // Gantilah dengan nama file gambar yang sesuai
                'foto_slider2' => 'slider-image-2.jpg', // Gantilah dengan nama file gambar yang sesuai
                'foto_slider3' => 'slider-image-3.jpg', // Gantilah dengan nama file gambar yang sesuai
                'caption_slider_id' => 'Meningkatkan Bisnis Anda dengan Desain Website Kreatif dan Branding Profesional',
                'caption_slider_en' => 'Boost Your Business with Creative Web Design and Professional Branding',
            ],
        ];

        // Insert data ke dalam tabel
        $this->db->table('tb_slider')->insertBatch($data);
    }
}
