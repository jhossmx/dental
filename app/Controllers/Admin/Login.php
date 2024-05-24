<?php
namespace App\Controllers\Admin;
use App\Models\AdminModel;
use App\Controllers\BaseController;

class Login extends BaseController
{
    //https: //www.tutsmake.com/codeigniter-4-login-and-registration-tutorial-example/
    private $model = '';
    private $folder;
    private $session;
    

    public function __construct()
    {
        helper(['html', 'form']);
        $this->model = new AdminModel();
        $this->folder = 'admin/';
        $this->session = session();
    }

    public function index()
    {
        //$data['css'] = ['prueba', 'prueba2'];
        //$data['js'] = ['login/login'];
        $data = [];
        return view($this->folder.'login/index', $data);
    }


    public function validalogin()
    {
        //echo print_r($_POST);exit;
        ///echo "valida admin";
        $data = [];
        
        if ($this->request->getMethod() == 'post') {

            //reglas de validacion
            $rules = [
                'txt_email' => 'required|min_length[3]|max_length[50]',
                'txt_clave' => 'required|min_length[4]|max_length[20]',
            ];

            //mensaje de error
            $errors = [
                'txt_email' => [
                    'label'   => 'Correo Electrónico',
                    'required' => "El {field} es requerido",
                    'min_length' => 'El {field} debe contener como mínimo {param} caracteres',
                    'max_length' => 'El {field} debe contener como máximo {param} caracteres',
                ],
                'txt_clave' => [
                    'label'   => 'Contraseña',
                    'required' => "La {field} es requerida",
                    'min_length' => 'La {field} debe contener como mínimo {param} caracteres',
                    'max_length' => 'La {field} debe contener como máximo {param} caracteres',
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                //echo print_r($this->validator);exit;
                return redirect()->route('admin_login')->withInput();
            } else {
                
                $email = strtolower(trim($this->request->getVar('txt_email')));
                $password = strtolower(trim($this->request->getVar('txt_clave')));
                $user = $this->model->where('da_correo', $email)->first();
                //echo print_r($user);exit;
                if ($user) {
                    $passDb = trim($user['da_clave']);
                    $verify_pass = password_verify($password, $passDb);
                    if ($verify_pass) {
                        $this->setUserSession($user);
                        return redirect()->route('principal');
                        //return redirect()->route('solicitudes');
                    }else{
                        $this->session->setFlashdata('msg', 'Datos incorrectos');
                        return redirect()->route('admin_login')->withInput();
                    }
                } else {
                    $this->session->setFlashdata('msg', 'Datos incorrectos');
                    return redirect()->route('admin_login')->withInput();
                }
            }
        }else{
            $this->session->setFlashdata('msg', 'Datos incorrectos');
            return redirect()->route('admin_login')->withInput();
        }
    }

    private function setUserSession($user)
    {
        $data = [
            'userId'  => $user['cn_id'],
            'logId'   => $user['da_usaurio'],
            'ap1'     => $user['da_apell1'],
            'ap2'     => $user['da_apell2'],
            'nombre'  => $user['da_nombre'],
            'IsAdmin'     => 'S',
            'tipoUsuario' => $user['fn_tipousuario'],
            'isLoggedIn'  => true,
        ];
        $this->session->set($data);
        //var_dump($this->session->get('IsAdmin'));exit;
        return true;
    }

    public function logout()
    { 
        //$this->session = session();
        $this->session->destroy();
        return redirect()->route('admin_login');
    }
}