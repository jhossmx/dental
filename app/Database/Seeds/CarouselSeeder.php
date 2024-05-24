<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CarouselSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'da_image' => 'site\img\carousel-1.jpg',
            'da_subtitle' => 'KEEP YOUR TEETH HEALTHY',
            'da_title' => 'Take The Best Quality Dental Treatment',
            'da_titlelink1'=>'Agendar Cita',
            'da_link1' => '',
            'da_titlelink2'=>'Contactp',
            'da_link2' => '',
            'da_status' => 'A',
        ];
        // Using Query Builder
        $this->db->table('M_CAROUSEL')->insert($data);

        $data = [
            'da_image' => 'site\img\carousel-2.jpg',
            'da_subtitle' => 'KEEP YOUR TEETH HEALTHY',
            'da_title' => 'Take The Best Quality Dental Treatment',
            'da_titlelink1'=>'Agendar Cita',
            'da_link1' => '',
            'da_titlelink2'=>'Contactp',
            'da_link2' => '',
            'da_status' => 'A',
        ];
        // Using Query Builder
        $this->db->table('M_CAROUSEL')->insert($data);
    }
}
