<?php

namespace App\Models;

use CodeIgniter\Model;

class CalendarModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'M_CALENDAR';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'da_title','df_fecha_inicio','df_fecha_fin',
        'df_fecha','da_status'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];



    public function fetch_all_event($id=null)
    {
        $datos = [];
        $sql = '';
        if($id==null)
        {
            $sql = "Select * From M_CALENDAR Where da_status='A' Order by cn_id";
            //echo $sql; exit;
            $query = $this->db->query($sql);
            foreach ($query->getResultArray() as $row) {
                $datos[] = $row;
            }

        }else{
            $sql = "Select * From M_CALENDAR Where cn_id = " . $id;
            $query = $this->db->query($sql);
            $datos = $query->getRowArray();
        }
        return $datos; 
    }

    function insert_event($data)
    {
        $resp = false;
        $this->db->transBegin();
        //inserto los valores en la tabla 
        $this->db->table("M_CALENDAR")->insert($data);
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            $resp = false;
        } else {
            $this->db->transCommit();
            $resp = true;
        }
        return $resp;
    }

    function update_event($data, $id)
    {
        $resp = false;
        $this->db->transBegin();
        //update data de la tabla
        $this->db->table("M_CALENDAR")->where('cn_id', $id)->update($data);
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            $resp = false;
        } else {
            $this->db->transCommit();
            $resp = true;
        }
        return $resp;
    }

    function delete_event($id)
    {
        $resp = false;
        $this->db->transBegin();
        $this->db->table("M_CALENDAR")->where('cn_id', $id)->delete();
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            $resp = false;
        } else {
            $this->db->transCommit();
            $resp = true;
        }
        return $resp;
    }

    function update_insert($data, $id)
    {
        $resp = false;
        $this->db->transBegin();
        //update data de la tabla
        $this->db->table("M_CALENDAR")->where('cn_id', $id)->update($data);
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            $resp = false;
        } else {
            $this->db->transCommit();
            $resp = true;
        }
        return $resp;
    }
}
