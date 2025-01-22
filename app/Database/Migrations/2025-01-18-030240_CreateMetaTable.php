<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMetaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_meta' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_halaman' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'title_id' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'title_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'meta_desc_id' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'meta_desc_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_meta', true);
        $this->forge->createTable('tb_meta');
    }

    public function down()
    {
        $this->forge->dropTable('tb_meta', true);
    }
}
