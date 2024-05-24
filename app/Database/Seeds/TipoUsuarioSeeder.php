<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'da_nombre' => 'ADMINISTRADOR',
            'da_status' => 'A',
        ];
        // Using Query Builder
        $this->db->table('C_TIPO_USUARIO')->insert($data);

        $data = [
            'da_nombre' => 'SECRETARIA',
            'da_status' => 'A',
        ];
        // Using Query Builder
        $this->db->table('C_TIPO_USUARIO')->insert($data);

        $data = [
            'da_nombre' => 'DENTISTA',
            'da_status' => 'A',
        ];
        // Using Query Builder
        $this->db->table('C_TIPO_USUARIO')->insert($data);

        $data = [
            'da_nombre' => 'PACIENTE',
            'da_status' => 'A',
        ];
        // Using Query Builder
        $this->db->table('C_TIPO_USUARIO')->insert($data);
    }
}
