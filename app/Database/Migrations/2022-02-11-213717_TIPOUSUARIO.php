<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIPOUSUARIO extends Migration
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
            'da_nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'default' => null,
            ],
            'da_status' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
                'default' => 'A',
            ],
        ]);
        $this->forge->addKey('cn_id', true);
        $this->forge->createTable('C_TIPO_USUARIO');
    }

    public function down()
    {
        $this->forge->dropTable('C_TIPO_USUARIO');
    }
}
