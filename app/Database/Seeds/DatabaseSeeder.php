<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('MetaSeeder');
        $this->call('ContactSeeder');
        $this->call('ProfilSeeder');
        $this->call('SliderSeeder');
        $this->call('SliderSeeder');
        $this->call('ArticleCategorySeeder');
        $this->call('ArticleSeeder');
    }
}
