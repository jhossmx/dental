<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\AdminModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'da_usaurio' => 'ADMIN',
            'da_correo'  => 'jhossmx@gmail.com',
            'da_clave'   => password_hash('12345678', PASSWORD_DEFAULT),
            'da_apell1'  => 'RODRIGUEZ',
            'da_apell2'  => 'VILLALOBOS',
            'da_nombre'  => 'JOSE LUIS',
            'fn_tipousuario' => 1,
            'da_status' => 'A',
        ];
        // Using Query Builder
        $this->db->table('S_USUARIOS')->insert($data);

        /*$user = new AdminModel;
        $faker = \Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data = [
                'da_rfc'            => 'ROVL770804JB1',
                'da_curp'           => 'ROVL770804HSLDLS00',
                'da_clave'          => password_hash('12345678', PASSWORD_DEFAULT),
                'da_nombre'         => $faker->firstName,
                'da_apell1'         => $faker->lastName,  
                'da_apell2'         => $faker->lastName,  
                'fn_tipousuario'    => 1,
                'fn_municipio'      => 2,
                'da_municipios'     => '1,2,3,4,5,6,7',
                'da_status'         => 'A'
            ];
            $this->db->table('S_USUARIOS')->insert($data);
        }*/
    }
}
