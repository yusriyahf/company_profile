<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NewDBSeeder extends Seeder
{
    public function run()
    {
        $this->call('ArticleCategorySeeder');
        $this->call('ArticleSeeder');
    }
}
