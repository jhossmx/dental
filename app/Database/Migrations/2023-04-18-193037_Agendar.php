<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Agendar extends Migration
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
            'da_title' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => null,
            ],
            'da_subtitle' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => null,
            ],
            'da_telefono' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'default' => null,
            ],
            'da_status' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
                'default' => 'A',
            ],

        ]);
        $this->forge->addKey('cn_id', true);
        $this->forge->createTable('C_AGENDAR');
    }

    public function down()
    {
        $this->forge->dropTable('C_AGENDAR');
    }
}
