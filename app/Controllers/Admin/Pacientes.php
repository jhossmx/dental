<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Libraries\TableLib;
use App\Models\PacienteModel;
use CodeIgniter\API\ResponseTrait;


use Config\Database;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\Codeigniter4Adapter;


class Pacientes extends BaseController
{
    use ResponseTrait;
    private $folder;
    private $session;
    private $tipoUser;
    private $model;
    private $db;

    public function __construct()
    {
        $this->session = session();
        $this->tipoUser = 'A';
        $this->folder = 'admin/';
        $this->model = new PacienteModel();
        $this->db = Database::connect();
    }

    public function index()
    {
        $data['tipoUser'] = $this->tipoUser;
        //$data['css'] = ['prueba', 'prueba2'];
        //$data['js'] = ['login/login'];
        $data['titulo'] = 'Configuración';
        return view($this->folder.'pacientes/index', $data);
    }

    public function getDataPacientes0() {
        $data = [];
        $result = $this->model->fetch_all(); 
       foreach($result as $val){
            $data[] = [                                  // push data in array
                $val["da_apell1"]." ". $val["da_apell2"]." ".$val["da_nombre"],
                $val["da_genero"],
                $val["df_fecha_nacimiento"],
                $val["da_status"]
            ];
        }
        $output = ["data" => $data];
        echo json_encode($output); // send output as json to ajax call
    }
    
    public function getDataPacientes1() {
        $data = [];
        $valorBuscado = $this->request->getGet('search')['value'];
        $table_map = [
            0 => 'cn_id',
            1 => 'da_apell1',
            2 => 'da_apell2',
            3 => 'da_nombre',
            4 => 'da_genero',
            5 => 'df_fecha_nacimiento', 
            6 => 'da_status'
        ];

        $sql_count = "Select count(cn_id) as total From m_pacientes";
        $sql_data = "Select cn_id, da_apell1, da_apell2, da_nombre, da_genero, df_fecha_nacimiento, da_status From m_pacientes";
        $condition = '';

        if(!empty($valorBuscado)){
            foreach($table_map as $key => $val) {
                if($table_map[$key] === 'cn_id'){
                    $condition .= " WHERE " .$val." LIKE '%" . $valorBuscado . "%'";
                }else{
                    $condition .= " OR " .$val." LIKE '%" . $valorBuscado . "%'";
                }   
            }
        }

        $sql_count = $sql_count . $condition;
        $sql_data = $sql_data . $condition;

        $total_count = $this->db->query($sql_count)->getRow();

        $sql_data .= " ORDER BY ". $table_map[$this->request->getGet('order')[0]['column']] ." ".
            $this->request->getGet('order')[0]['dir'] . " LIMIT " .
            $this->request->getGet('start')." , ".$this->request->getGet('length'); 

        //echo $sql_data;exit;  

        $data = $this->db->query($sql_data)->getResult(); 
        $json_data = [
            'draw' =>intval($this->request->getGet('draw')),
            'recordsTotal' => $total_count->total,
            'recordsFiltered' => $total_count->total,
            'data' => $data,
            'debug_query' => $sql_data,
        ];
        echo json_encode($json_data);
    }

    public function getDataPacientes() {
        $param['draw'] = (($this->request->getVar('draw') != null) ? $this->request->getVar('draw') : '');
        $valorBuscado = ((isset($this->request->getVar('search')['value'])) ? trim($this->request->getVar('search')['value']) : '');
        $start = (($this->request->getVar('start') != null) ? $this->request->getVar('start') : '');
        $length = (($this->request->getVar('length') != null) ? $this->request->getVar('length') : '');



    }    

    public function list()
    {
        $order = $this->request->getVar('order');
        $order = array_shift($order);

        $param = [ 
            'draw' => $this->request->getVar('draw'),
            'length' => $this->request->getVar('length'),
            'start' => $this->request->getVar('start'),
            'order' => $order['column'],
            'direction' => $order['dir'],
            'search' => $this->request->getVar('search')['value']
        ];

        //las Columnas deben de coincidir con las de la BD
        $columns = ['cn_id','da_apell1','da_apell2','da_nombre','da_genero','df_fecha_nacimiento','da_status'];
        $lib = new TableLib($this->model, 'gp1', $columns);
        $response = $lib->getResponse($param);

        return $this->respond($response);
        //var_dump($response);
    }



}
