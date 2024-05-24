<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AgendarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'da_title' => 'Agendar cita por teléfono',
            'da_subtitle' => 'Llamanos y con gusto te atenderemos.',
            'da_telefono' =>'+52 686 837 1376',
            'da_status' => 'A',
        ];
        // Using Query Builder
        $this->db->table('C_AGENDAR')->insert($data);

    }
}
