<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CHORARIO extends Migration
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
            'da_inicio' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => null,
            ],
            'da_fin' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => null,
            ],
            'da_hora1' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'default' => null,
            ],
            'da_hora2' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'default' => null,
            ],
            'da_status' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
                'default' => 'A',
            ],
        ]);
        $this->forge->addKey('cn_id', true);
        $this->forge->createTable('C_HORARIO');
    }

    public function down()
    {
        $this->forge->dropTable('C_HORARIO');
    }
}
