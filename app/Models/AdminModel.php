<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 's_usuarios';
    protected $primaryKey       = 'cn_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'da_logid'
        ,'da_clave'
        ,'da_ap1'
        ,'da_ap2'
        ,'da_nombre'
        ,'da_status'
        ,'df_alta'
        ,'df_fechamod'
        ,'fn_idmunicipio'
        ,'da_tipousuario'
        ,'da_permisos'
        ,'da_nivel'
        ,'da_telefono'
        ,'da_email'
        ,'db_usuario'
        ,'db_docente'
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
    
 
    public function getTotal($where = '')
    {
        $_where = (($where != "") ? " Where " . $where : "" );
        $sql = "SELECT COUNT(*) AS cant
                From S_USUARIO_EST
                    inner join C_MUNICIPIO on (S_USUARIO_EST.fn_idmunicipio = cast(C_MUNICIPIO.ca_CveMunicipio as int)) " .
                $_where; 
        $query = $this->db->query($sql);
        $row = $query->getRow();
        return ( (isset($row)) ? $row->cant : 0);
    }

    public function getAllData($where = "", $limit = "")
    {
        $datos = [];
        $_where = (($where != "") ? " Where " . $where : "");
        $sql = "SELECT *
                FROM (
                    SELECT ROW_NUMBER() OVER (ORDER BY S_USUARIO_EST.cn_idusuario) AS RowNum, cn_idusuario as ID, da_logid as usuario, da_ap1 as ap1, da_ap2 as ap2, da_nombre as nombre, 
                        fn_idmunicipio as idmun, C_MUNICIPIO.da_Municipio as  municipio, da_tipousuario as tipo, case when da_status='A' then 'ACTIVO' when da_status='B' then 'BAJA' end as estado,
                        da_status as status
                    From S_USUARIO_EST
                       inner join C_MUNICIPIO on (S_USUARIO_EST.fn_idmunicipio = cast(C_MUNICIPIO.ca_CveMunicipio as int)) ".
                    $_where . " " . ") AS RowConstrainedResult " . $limit . " ORDER BY ID desc ";
        //echo $sql;exit;
        $query = $this->db->query($sql);
        foreach ($query->getResultArray() as $row) {
            $datos[] = $row;
        }
        return $datos; 
    }
    
    public function infoUsuario($idUsuario = "0")
    {
        $sql = "SELECT cn_idusuario as ID, da_logid as usuario, da_ap1 as ap1, da_ap2 as ap2, da_nombre as nombre, fn_idmunicipio as idmun,
                    C_MUNICIPIO.da_Municipio as  municipio, rtrim(da_tipousuario) as tipo, da_status as status, da_municipios as municipios,
                    da_curp as curp, da_email as correo
                FROM S_USUARIO_EST
                    inner join C_MUNICIPIO on (S_USUARIO_EST.fn_idmunicipio = cast(C_MUNICIPIO.ca_CveMunicipio as int))
                Where S_USUARIO_EST.cn_idusuario = " . $idUsuario;
        //echo $sql;exit;
        $query = $this->db->query($sql);
        return $query->getRowArray();
    }
    
    public function getMunicipios()
    {
        $datos = [];
        $sql ="Select cast(ca_CveMunicipio as int) as id, da_Municipio as mun From C_MUNICIPIO Order by cast(ca_CveMunicipio as int) ";
        $query = $this->db->query($sql);
        foreach ($query->getResultArray() as $row) {
            $datos[] = $row;
        }
        return $datos; 
    }
    
    public function insertData($usuario = [])
    {
        $resp = false;
        $this->db->transBegin();
        //inserto los valores en la tabla S_USUARIO_EST
        $this->db->table("S_USUARIO_EST")->insert($usuario);

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            $resp = false;
        } else {
            $this->db->transCommit();
            $resp = true;
        }
        return $resp;
    }

    public function updateData($usuario = [], $id = "0")
    {
        $resp = false;
        $this->db->transBegin();
        
        //update data de S_USUARIO_EST
        $this->db->table("S_USUARIO_EST")->where('cn_idusuario', $id)->update($usuario);
        
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
