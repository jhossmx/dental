<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Config extends BaseController
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
        $data['tipoUser'] = $this->tipoUser;
        //$data['css'] = ['prueba', 'prueba2'];
        //$data['js'] = ['login/login'];
        $data['titulo'] = 'Configuración';
        return view($this->folder.'config/index', $data);
    }



}
