<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\AdminModel;

class Usuarios extends BaseController
{
    
    private $model;
    private $folder;
    private $session;
    private $tipoUser;
    private $validation;

    public function __construct()
    {
        helper(['html', 'form']);
        $this->folder = 'admin/';
        $this->session = session();
        //A: ADMIN
        //U: USUARIO
        $this->tipoUser = (($this->session->get('IsAdmin')=='S') ? 'A' : 'U');
        $this->validation =  \Config\Services::validation();
        $this->model = new AdminModel();
    }
    
    public function index()
    {
        $data['tipoUser'] = $this->tipoUser;
        $data['js'] = ['usuarios/index'];
        $data['titulo'] = 'Listado de usuarios';
        return view($this->folder.'/usuarios/index', $data);
    }
    
    public function ajaxusuarios()
    { 
        
        $data = [];
        $pa = (($this->request->getVar('hd_pa') != null) ? (int)$this->request->getVar('hd_pa') : 1);
        $pt = (($this->request->getVar('hd_pt') != null) ? (int)$this->request->getVar('hd_pt') : 0);

        //filtros del Admin
        $usuario = (($this->request->getVar('txt_usr') != null) ? (int)$this->request->getVar('txt_usr') : '');
        $nombre = (($this->request->getVar('txt_nombre') != null) ? (string)$this->request->getVar('txt_nombre') : '');
        $ap1 = (($this->request->getVar('txt_ap1') != null) ? (string)$this->request->getVar('txt_ap1') : '');
        $ap2 = (($this->request->getVar('txt_ap2') != null) ? (string)$this->request->getVar('txt_ap2') : '');
        $municipio = (($this->request->getVar('CboMun') != null) ? (int)$this->request->getVar('CboMun') : "0");

        //$idDocente = $this->session->get('userId');
        $where = "";
        //$where .= (($this->tipoUser=="U") ? " M_REGISTRO_EST.fn_iddocente=".$idDocente : "");

        //filtros del Admin
        $where .= ((trim($where) !== "" && $usuario !== "") ? " and S_USUARIO_EST.da_logid like '%".trim($usuario)."%'" : ((trim($where) === "" && $usuario !== "") ? " S_USUARIO_EST.da_logid like '%".trim($usuario)."%'" : ""));
        $where .= ((trim($where) !== "" && $nombre !== "") ? " and S_USUARIO_EST.da_nombre like '%".trim($nombre)."%'" : ((trim($where) === "" && $nombre !== "") ? " S_USUARIO_EST.da_nombre like '%".trim($nombre)."%'" : ""));
        $where .= ((trim($where) !== "" && $ap1 !== "") ? " and S_USUARIO_EST.da_ap1 like '%".trim($ap1)."%'" : ((trim($where) === "" && $ap1 !== "") ? " S_USUARIO_EST.da_ap1 like '%".trim($ap1)."%'" : ""));
        $where .= ((trim($where) !== "" && $ap2 !== "") ? " and S_USUARIO_EST.da_ap2 like '%".trim($ap2)."%'" : ((trim($where) === "" && $ap2 !== "") ? " S_USUARIO_EST.da_ap2 like '%".trim($ap2)."%'" : ""));
        $where .= ((trim($where) !== "" && $municipio != "0") ? " and S_USUARIO_EST.fn_idmunicipio='".trim($municipio)."'" : ((trim($where) === "" && $municipio != "0") ? "  S_USUARIO_EST.fn_idmunicipio='".trim($municipio)."'" : ""));

        //echo $where;exit;
        //$paginate = new Paginate();
        $this->paginate->setPerPage(10);
        $this->paginate->setCurrentPage($pa);
        $totalRows = $this->model->getTotal($where);
        $data['usuarios'] = $this->model->getAllData($where, $this->paginate->getLimitSql());

        $title= array("Listado de usuarios","icon-user");
        $headers = array("USUARIO","NOMBRE","PRIMER APELLIDO","SEGUNDO APELLIDO", "MUNICIPIO", "TIPO", "ESTADO");
        $ignore = array("RowNum","ID", "idmun","status");

        $actions = [];
        $actions[0] = array("vconsulta", "user", "Consultar", "info", "xs", "Consultar Usuario");                
        $actions[1] = array("vbaja", "user", "Baja", "danger", "xs", "Baja Usuario", array('status' => '==:A:S'));                
        $actions[2] = array("vactivar", "user", "Activar", "success", "xs", "Activar Usuario", array('status' => '==:B:S'));                        

        //paginado
        $paginacion = [];
        $paginacion[0] = $pa;
        $paginacion[1] = $totalRows;

        echo $this->paginate->Create($title, "ID", $headers, $data['usuarios'], $ignore, $actions, $paginacion);
    } 
    
    public function crear(){

        $data['tipoUser'] = $this->tipoUser;
        //$data['css'] = ['bootstrap-datepicker.min'];
        $data['js'] = ['usuarios/registro'];
        $data['titulo'] = 'Crear Usuario';
        $infoSolicitud = [];
        $data['municipios'] = $this->model->getMunicipios();
        $data['tipoRegistro'] = "N"; //nueva Solicitud
        $data['id'] = "0";
        return view($this->folder.'/usuarios/registro', $data);
    }

    public function consultar($idUsuario="0")
    {
        $data['tipoUser'] = $this->tipoUser;
        //$data['css'] = [''];
        $data['js'] = ['usuarios/registro'];
        $data['titulo'] = 'Consulta Usuarios';
        $data['tipoRegistro'] = "U"; //Update datos de la Solicitud
        $data['id'] = $idUsuario;
        $data['municipios'] = $this->model->getMunicipios();
        $data['infoUsuario'] = $this->model->infoUsuario($idUsuario);
        //echo print_r($data['infoUsuario']);exit;
        return view($this->folder.'/usuarios/editar', $data);
    }
    
    public function grabar()
    {
        //echo print_r($_POST);
        $data = $_POST;
        $tipo = (($this->request->getVar('hd_tipoReg') != null) ? $this->request->getVar('hd_tipoReg') : '');
        $id = (($this->request->getVar('hd_id') != null) ? $this->request->getVar('hd_id') : '0');
        
        //archivo de validaciones en app\config\Validation.php
        if($this->validation->run($data, 'registroUsuario')) {
            //paso validaciones de campos

            //es para obtener los datos de la forma de registro
            $datos = $this->getDataOfForm($tipo, $id);

            /*echo "<pre>";
            echo print_r($datos['usuario']);
            echo "</pre>";
            exit; */
            
            if( $tipo== "N" ){

                if($this->model->insertData($datos['usuario'])){
                    echo "OK";
                }else{
                    echo "Ocurrio un error";
                }

            }else if( $tipo== "U"){

                if($this->model->updateData($datos['usuario'], $id)){
                    echo "OK";
                }else{
                    echo "Ocurrio un error";
                }
            }

        }else{
            //echo $errors = $validation->getErrors();
            echo json_encode($this->validation->getErrors());
            //echo print_r($validation->getErrors());
        }
        
    }

    private function getDataOfForm($tipo = '', $id="0")
    {
        
        //s_usuarios_est
        $usuario = strtoupper(trim($this->request->getVar('txt_usuario')));
        $clave = strtoupper(trim($this->request->getVar('txt_pass')));
        $claveR = strtoupper(trim($this->request->getVar('txt_pass_con')));
        $nombre = strtoupper(trim($this->request->getVar('txt_nombre')));
        $ap1 = strtoupper(trim($this->request->getVar('txt_ap1')));
        $ap2 = strtoupper(trim($this->request->getVar('txt_ap2')));
        $curp = strtoupper(trim($this->request->getVar('txt_curp')));
        $correo = strtoupper(trim($this->request->getVar('txt_correo')));
        $municipio = (int)(trim($this->request->getVar('CboMun')));
        $tipoPersonal = strtoupper(trim($this->request->getVar('CboTipoPersonal')));
        $derechos_municipio = implode(",", $this->request->getVar('chk_mun'));
        
        $infoUser = [
            'da_logid'  => strtoupper(trim($usuario)),
            'da_clave'  => trim($clave),
            'da_ap1'    => strtoupper(trim($ap1)),
            'da_ap2'    => strtoupper(trim($ap2)),
            'da_nombre' => strtoupper(trim($nombre)),
            'da_curp'   => strtoupper(trim($curp)),
            'da_email'  => strtolower(trim($correo)),
            'da_status' => 'A',
            'fn_idmunicipio' => strtoupper(trim($municipio)),
            'da_tipousuario' => strtoupper(trim($tipoPersonal)),
            'da_municipios'  => strtoupper(trim($derechos_municipio))
        ];

        return [
            'usuario' => $infoUser,
        ];
    }
    
    public function cambiarEstadoUsuario()
    {
        //echo print_r($_POST);exit;
        $id = strtoupper(trim($this->request->getVar('id')));
        $estado = strtoupper(trim($this->request->getVar('estado')));
        //echo $id."-".$estado;exit;
        $data = [
            'da_status' => $estado
        ];
        
        if($this->model->updateData($data, $id)){
            echo "OK";
        }else{
            echo "Ocurrio un error";
        }
    }
    
}
