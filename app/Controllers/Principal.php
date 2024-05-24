<?php
namespace App\Controllers;

class Principal extends BaseController
{
    private $folder;
    private $session;
    private $tipoUser;

    public function __construct()
    {
        $this->session = session();
        $this->tipoUser = 'A';
        $this->folder = 'admin/';
    }

    public function index()
    {
       //$data['css'] = ['prueba', 'prueba2'];
        //$data['js'] = ['pruebajs1', 'pruebajs2'];
        $data['tipoUser'] = $this->tipoUser;
        //dashboard del Admin
        //$data['js'] = ['principal/principal'];
        $data['titulo'] = 'Principal';
        return view($this->folder.'dashboard/index', $data);
    }


}