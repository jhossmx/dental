<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HorarioSeeder extends Seeder
{
    public function run()
    {

       $data = [
            'da_inicio' => 'Lunes',
            'da_fin' =>'Viernes',
            'da_hora1' => '10:00 am',
            'da_hora2' => '08:00 pm',
            'da_status' => 'A',
       ];
        // Using Query Builder
        $this->db->table('C_HORARIO')->insert($data);
        
        $data = [
            'da_inicio' => 'Lunes',
            'da_fin' =>'Viernes',
            'da_hora1' => '10:00 am',
            'da_hora2' => '8:00 pm',
            'da_status' => 'A',
        ];
        // Using Query Builder
        $this->db->table('C_HORARIO')->insert($data);

        $data = [
            'da_inicio' => 'Sábado',
            'da_fin' => '',
            'da_hora1' => '10:00 am',
            'da_hora2' => ' 2:00 pm',
            'da_status' => 'A',
        ];
        // Using Query Builder
        $this->db->table('C_HORARIO')->insert($data);

        $data = [
            'da_inicio' => 'Domingo',
            'da_fin' => '',
            'da_hora1' => '',
            'da_hora2' => ' Cerrado',
            'da_status' => 'A',
        ];
        // Using Query Builder
        $this->db->table('C_HORARIO')->insert($data);
    }
}
