<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKontakTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kontak' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'deskripsi_kontak_id' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'deskripsi_kontak_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_kontak', true);
        $this->forge->createTable('tb_kontak');
    }

    public function down()
    {
        $this->forge->dropTable('tb_kontak', true);
    }
}
