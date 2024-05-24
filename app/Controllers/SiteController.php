<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class SiteController extends BaseController
{

    public function index()
    {
        $data['titulo'] = "Inicio";
        return view('site/home', $data);
    }

    public function about()
    {
        $data = [];
        return view('site/about', $data);
    }

    public function services()
    {
        $data = [];
        return view('site/services', $data);
    }

    public function contact()
    {
        $data = [];
        return view('site/contact', $data);
    }

    public function appointment(){
        $data = [];
        return view('site/appointment', $data);
    }
}
