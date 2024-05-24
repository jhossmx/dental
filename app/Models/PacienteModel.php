<?php

namespace App\Models;

use CodeIgniter\Model;

class PacienteModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'm_pacientes';
    protected $primaryKey       = 'cn_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'da_apell1','da_apell2','da_nombre','da_genero',
        'df_fecha_nacimiento','da_correo','da_status',
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

    public function fetch_all($id=null)
    {
        $datos = [];
        $sql = '';
        $cols = "da_apell1,da_apell2,da_nombre,da_genero, 
                DATE_FORMAT(df_fecha_nacimiento,'%d/%m/%Y') as df_fecha_nacimiento,
                da_status";
        if($id==null)
        {
            $sql = "Select ".$cols." From ".$this->table." Where da_status='A' Order by cn_id desc";
            //echo $sql; exit;
            $query = $this->db->query($sql);
            foreach ($query->getResultArray() as $row) {
                $datos[] = $row;
            }

        }else{
            $sql = "Select ".$cols." From ".$this->table." Where cn_id = " . $id;
            $query = $this->db->query($sql);
            $datos = $query->getRowArray();
        }
        return $datos; 
    }

    public function armaCondicion()
    {

    }

    public function getAllData($valorBuscado=null, $start=0, $length=0)
    {
        $table_map = array_unshift($this->allowedFields, $this->primaryKey);

    }
}
