<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProfilTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_perusahaan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_perusahaan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'foto_perusahaan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'logo_perusahaan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'deskripsi_perusahaan_id' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'deskripsi_perusahaan_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_perusahaan', true);
        $this->forge->createTable('tb_profil');
    }

    public function down()
    {
        $this->forge->dropTable('tb_profil', true);
    }
}
