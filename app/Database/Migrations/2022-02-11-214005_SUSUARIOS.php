<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SUSUARIOS extends Migration
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
            'da_usaurio' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => null,
            ],
            'da_correo' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => null,
            ],
            'da_clave' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'default' => null,
            ],
            'da_apell1' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'default' => null,
            ],
            'da_apell2' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'default' => null,
                'null' => true,
            ],
            'da_nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'default' => null,
            ],
            'fn_tipousuario' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'da_status' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
                'default' => 'A',
            ],
        ]);
        $this->forge->addKey('cn_id', true);
        $this->forge->addForeignKey('fn_tipousuario', 'C_TIPO_USUARIO', 'cn_id');
        $this->forge->createTable('S_USUARIOS');
    }

    public function down()
    {
        $this->forge->dropTable('S_USUARIOS');
    }
}
