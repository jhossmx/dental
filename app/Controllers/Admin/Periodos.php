<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\PeridoModel;

class Periodos extends BaseController
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
        $this->model = new PeridoModel();
    }
    
    public function index()
    {
        $data['tipoUser'] = $this->tipoUser;
        $data['css'] = ['bootstrap-datepicker.min'];
        $data['js'] = ['bootstrap-datepicker.min', 'bootstrap-datepicker.es.min','periodos/registro'];
        $data['titulo'] = 'Periodos';
        $data['tipoRegistro'] = "U"; //Update datos 
        $data['infoPeriodos'] = $this->model->getInfoPeriodos();
        return view($this->folder.'/periodos/registro', $data);
    }
    
    public function grabar()
    {
        //print_r($_POST); 
        //exit;
        $DATOSPERIODOS = [];
        $message = "";
        $sql = "";
        $total=0;
        //No periodos
        $hdPeriodos = ((isset($_POST['hd_periodos']) && $_POST['hd_periodos'] != "0") ? trim($_POST['hd_periodos']) : "");  //cadena de periodos
        
        $Periodos= explode(":", $hdPeriodos);
        $continue = true;
        foreach ($Periodos as $Periodo) 
        {
            $tmpPeriodo = $_POST['txt_perido'.$Periodo];
            $tmpTipoPeriodo = $_POST['txt_tipoPeriodo'.$Periodo];
            $tmpDescripcionPeriodo = $_POST['txt_descripcion'.$Periodo];
            
            $tmpf1 = $_POST['txt_inicio'.$Periodo];
            $f1 =  str_replace('/', '-', $tmpf1);
            $date1 = date('d/m/Y',  strtotime($f1));
            
            $tmpf2 = $_POST['txt_cierre'.$Periodo];
            $f2 =  str_replace('/', '-', $tmpf2);
            $date2 = date('d/m/Y',  strtotime($f2));
            
            if($tmpTipoPeriodo=="")
            {
                $message ="El Tipo de Personal no puede estar vacio"; 
                $continue = false;
                break;
            }else if($tmpPeriodo=="")
            {
                $message ="El periodo del ".$tmpTipoPeriodo." no puede estar vacio"; 
                $continue=false;
                break;
            }else if($tmpDescripcionPeriodo=="")
            {
                $message ="La descripción del ".$tmpTipoPeriodo." no puede estar vacio"; 
                $continue=false;
                break;
            }else if($tmpf1=="")
            {
                $message ="La fecha inicial del ".$tmpTipoPeriodo." no puede estar vacia"; 
                $continue=false;
                break;
            }else if($tmpf2=="")
            {
                $message ="La fecha final del ".$tmpTipoPeriodo." no puede estar vacia";
                $continue = false;
                break;
            }else if(strtotime($f1) > strtotime($f2))
            {
                $message ="La fecha inicial del ".$tmpTipoPeriodo." no puede ser mayor a la fecha final del ".$tmpTipoPeriodo;
                $continue = false;
                break;
            }
            
            if($continue)
            {
                $tmp_periodo = [
                    'da_periodo'     => "'" . $tmpPeriodo . "'",
                    'da_tipoperiodo' => "'" . $tmpTipoPeriodo . "'",
                    'da_desc'        => "'" . $tmpDescripcionPeriodo ."'", 
                    'df_inicio'      => " convert(smalldatetime, '". $tmpf1 ."', 103) ",
                    'df_cierre'      => " convert(smalldatetime, '". $tmpf2 ."', 103) ", 
                ];
                $DATOSPERIODOS[] = $tmp_periodo;
                $sql = $sql . $this->model->armaCadenaUpdate("C_PERIODO_EST", $tmp_periodo, array('cn_periodo' => $Periodo))."; "; 
            }
        }
        
        
        if($continue)
        {
            //echo $sql; exit;
            $message = $this->model->UpdateDatos($sql);
        }    
        echo $message;
    }
}
