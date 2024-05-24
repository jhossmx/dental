<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Calendar extends Migration
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
            'df_fecha_inicio' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'df_fecha_fin' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'df_fecha' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'da_status' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
                'default' => 'A',
            ],
        ]);
        $this->forge->addKey('cn_id', true);
        $this->forge->createTable('M_CALENDAR');
    }

    public function down()
    {
        $this->forge->dropTable('M_CALENDAR');
    }
}
