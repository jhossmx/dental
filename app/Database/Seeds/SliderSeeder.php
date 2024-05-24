<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run()
    {
        $ruta = base_url().'site/img/';
        $data = [
            'da_imagen' => $ruta .'carousel-1.jpg',
            'da_title' => 'Hacemos el Mejor Tratamiento Dental',
            'da_subtitle' =>'Manten tu Sonrisa Saludable.',    
            'da_status' => 'A',
        ];
        // Using Query Builder
        $this->db->table('C_SLIDER')->insert($data);

        $data = [
            'da_imagen' => $ruta .'carousel-2.jpg',
            'da_title' => 'Hacemos el Mejor Tratamiento Dental',
            'da_subtitle' =>'Manten tu Sonrisa Saludable.',    
            'da_status' => 'A',
        ];
        // Using Query Builder
        $this->db->table('C_SLIDER')->insert($data);

    }
}
