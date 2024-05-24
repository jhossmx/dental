<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Paciente extends Migration
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
            'da_genero' => [
                'type' => 'ENUM',
                'constraint' => ['Masculino', 'Femenino'],
                'default' => null,
            ],
            'df_fecha_nacimiento' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'da_correo' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => null,
            ],
            'da_status' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
                'default' => 'A',
            ],
        ]);
        $this->forge->addKey('cn_id', true);
        $this->forge->createTable('M_PACIENTES');
    }

    public function down()
    {
        $this->forge->dropTable('M_PACIENTES');
    }
}
