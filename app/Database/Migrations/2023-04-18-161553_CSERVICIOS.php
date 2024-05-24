<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CSERVICIOS extends Migration
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
            'da_image' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'default' => null,
            ],
            'da_nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'default' => null,
            ],
            'da_subtitle' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => null,
            ],
            'da_title' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => null,
            ],
            'da_link1' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'default' => null,
            ],
            'da_link2' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'default' => 'A',
            ],
            'da_status' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
                'default' => 'A',
            ],

        ]);
        $this->forge->addKey('cn_id', true);
        $this->forge->createTable('C_SERVICIOS');
    }

    public function down()
    {
        $this->forge->dropTable('C_SERVICIOS');
    }
}
