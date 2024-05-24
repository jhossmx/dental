<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Slider extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'cn_id' => [
                'type' => 'INT',
                'constraint' => 6,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'da_imagen' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => null,
            ],
            'da_title' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'default' => null,
            ],
            'da_subtitle' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'default' => null,
            ],
            'da_status' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
                'default' => 'A',
            ],
        ]);
        $this->forge->addKey('cn_id', true);
        $this->forge->createTable('C_SLIDER');
    }

    public function down()
    {
        $this->forge->dropTable('C_SLIDER');
    }
}
