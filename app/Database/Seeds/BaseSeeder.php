<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BaseSeeder extends Seeder
{
    public function run()
    {
        //catalogos
        
        $this->call('CarouselSeeder');
        $this->call('HorarioSeeder');
        $this->call('AgendarSeeder');

        $this->call('TipoUsuarioSeeder');
        $this->call('UserSeeder');
        $this->call('SliderSeeder');
        
    }
}
