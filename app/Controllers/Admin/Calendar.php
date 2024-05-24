<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CalendarModel;
class Calendar extends BaseController
{
    private $folder;
    private $session;
    private $tipoUser;
    private $model;

    public function __construct()
    {
        $this->session = session();
        $this->model = new CalendarModel();
        $this->tipoUser = 'A';
        $this->folder = 'admin/';
    }

    public function index()
    {
        $data['tipoUser'] = $this->tipoUser;
        //$data['css'] = ['prueba', 'prueba2'];
        //$data['js'] = ['login/login'];
        $data['titulo'] = 'Configuración';
        return view($this->folder.'calendar/index', $data);
    }

    public function loadDataCalendar()
    {
        //echo "llega";exit;
        $event_data = $this->model->fetch_all_event();
        //echo print_r($event_data); exit;

        foreach($event_data as $row)
        {
            $data[] = [
                'id' => $row['cn_id'],
                'title' => $row['da_title'],
                'start' => $row['df_fecha_inicio'],
                'end' => $row['df_fecha_fin'],
                'status' => $row['da_status'],
            ];
        }
        echo json_encode($data);
    }

    public function insertDataCalendar()
    {
         $startdate = $this->request->getVar('start');// $this->input->post('start');
         $enddate = $this->request->getVar('end'); //$this->input->post('end');
         $data = [
           'da_title' => $this->request->getVar('title'),
           'df_fecha_inicio' => $startdate.' '.$this->request->getVar('timestart'),
           'df_fecha_fin' => $enddate.' '.$this->request->getVar('timeend'),
         ];
         $res = $this->model->insert_event($data);
    }

    public function insertDataDay()
    {
        if($this->request->getVar('title'))
        {
            $data = [
                'da_title'  => $this->request->getVar('title'),
                'df_fecha_inicio' => $this->request->getVar('start'),
                'df_fecha_fin' => $this->request->getVar('end'),
            ];
            $res = $this->model->insert_event($data);
            echo json_encode($res);
        }
    }

    public function updateDataCalendar()
    {
        $data = [
            'da_title'  => $this->request->getVar('title'),
            'df_fecha_inicio'=> $this->request->getVar('start'),
            'df_fecha_fin' => $this->request->getVar('end'),
        ];
        $id = (($this->request->getVar('id') != null) ? (int)$this->request->getVar('id') : 0);
        $res = $this->model->update_event($data, $id);
        echo json_encode($res);
    }

    public function deleteDataCalendar()
    {
        $id = (($this->request->getVar('id') != null) ? (int)$this->request->getVar('id') : 0);
        if($id > 0)
        {
            $this->model->delete_event($id);
        }
    }

    public function getCalendarData()
    {
        $id = (($this->request->getVar('id') != null) ? (int)$this->request->getVar('id') : 0);
        $a = $this->model->fetch_all_event($id);
        //$a = $this->db->from('calendar_plugin')->where('cn_id', $id)->get()->row();
        // print_r($a);die();
        $start = $a["df_fecha_inicio"];
        $end = $a["df_fecha_fin"];

        $start_date = date('Y-m-d', strtotime( $start ) );
        $start_time = date('H:i', strtotime( $start ) );
        $end_date = date('Y-m-d', strtotime( $end ) );
        $end_time = date('H:i', strtotime( $end ) );
        $data = [
            'fw_id'  => $a["cn_id"],
            'fw_title'  => $a["da_title"],
            'fw_start_date'=> $start_date,
            'fw_start_time' => $start_time,
            'fw_end_date' => $end_date,
            'fw_end_time' => $end_time,
        ]; 
        echo json_encode ($data);
    }

    public function upInsertDataCalendar()
    {  
        $start_date = $this->request->getVar('up_start');
        $end_date = $this->request->getVar('up_end');
        $start_time = $this->request->getVar('up_timestart');
        $end_time = $this->request->getVar('up_timeend');
        for($i = strtotime($start_date); $i <= strtotime($end_date); $i += (86400))
        {
            $date=date('Y-m-d', $i);
            $start=$date.' '.$start_time.':00';
            $end=$date.' '.$end_time.':00';
            $data = [
                'fw_title'=> $this->request->getVar('up_title'),
                'fw_start_event'=> $start,
                'fw_end_event' => $end,
            ];
            $id = (($this->request->getVar('up_id') != null) ? (int)$this->request->getVar('up_id') : 0);            
            $this->model->update_insert($data, $id);
            echo json_encode(' ');
        }
    }

}
