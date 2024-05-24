<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Configuracion extends Migration
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
            'da_titlo' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'default' => null,
            ],
            'da_nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'default' => null,
            ],
            'da_correo' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'default' => null,
            ],
            'da_telefono' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'default' => null,
            ],
            'da_celular' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'default' => null,
            ],
            'da_calle' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'default' => null,
            ],
            'da_numero' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'default' => null,
            ],
            'da_colonia' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'default' => null,
            ],
            'da_cuidad' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'default' => null,
            ],
            'da_pais' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'default' => null,
            ],
            'da_zona_hora' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'default' => null,
            ],
            'da_imagen' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => null,
            ],
            'da_icono' => [
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
        $this->forge->createTable('C_CONFIGURACION');
    }

    public function down()
    {
        $this->forge->dropTable('C_CONFIGURACION');
    }
}
