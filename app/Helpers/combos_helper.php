<?php

if (!function_exists('getCombo')) {

    function getCombo($sql = "", $sel = "")
    {
        //https: //stackoverflow.com/questions/61651302/how-to-write-database-queries-in-helper-in-codeigniter-4

        //connect to database
        $db = \Config\Database::connect();

        //get sql to execute
        $sql = ((!startsWith($sql, "select")) ? catalogos($sql) : $sql);

        //execute sql
        $query = $db->query($sql);

        $op = "";
        $resp = "";
        $resp .= '<option value="0" selected="">SELECCIONE</option>';

        //loop to get data
        foreach ($query->getResultArray() as $row) {
            $op = (($sel != "" && $sel == $row['id']) ? " SELECTED = 'SELECTED' " : "");
            $resp .= '<option value="' . $row['id'] . '"' . $op . '>' . $row['dato'] . '</option>';
        }
        //$db->close();
        return $resp;
    }
}

if (!function_exists('startsWith')) {
    function startsWith($sentence, $word)
    {
        $length = strlen(strtolower(trim($word)));
        $sentence = trim(strtolower($sentence));
        return ((substr($sentence, 0, $length) === $word) ? true : false);
    }
}

if (!function_exists('catalogos')) {
    function catalogos($catalogo = '')
    {
        $sql = "";
        switch ($catalogo) {
            case "departamentos":
                $sql = "SELECT cn_id as id, da_nombre as dato FROM c_departamentos Where da_status ='A' Order by da_nombre ";
                break;

            case "estados":
                $sql = "SELECT da_codEnt AS id, da_desc AS dato FROM wsdocentes.dbo.C_ESTADO Where da_codEnt ='02' ORDER BY CAST(da_codEnt AS int)";
                break;    
            case "municipios":
                $sql = "SELECT ca_CveMunicipio as id, da_Municipio as dato FROM C_MUNICIPIO  Order by cast(ca_CveMunicipio as smallint) ";
                break;    
            case "subsistema":
                $sql = "SELECT cn_ramo as id, da_subs as dato FROM wsdocentes.dbo.C_SUBSISTEMA Where da_status ='A' Order By cn_ramo ";
                break;   
            case "nivel":
                $sql = "SELECT cn_id as id, da_nivel as dato FROM C_NIVEL order by cn_id ";
                break;   
            case "gremio_sindical":
                $sql = "SELECT cn_id as id, da_nOMBRE as dato FROM C_SINDICATO order by cn_id ";
                    break;     
            case "tipo_personal":
                $sql = "SELECT cn_id as id ,da_nombre as dato FROM C_TIPO_PERSONAL Where da_status='A' order by cn_id ";
                    break;     
            case "estado_solicitud":
                $sql = "SELECT ca_idestado as id, da_estado as dato  FROM C_STATUS_EST  order by ca_idestado";
                    break;           


                    
        }
        return $sql;
    }
}