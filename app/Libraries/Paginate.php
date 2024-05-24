<?php
namespace App\Libraries;

class Paginate
{


/**
 * Set the number of items per page.
 *
 * @var array
 */
private $headers;

/**
 * Set the number of items per page.
 *
 * @var array
 */
private $_ignoreheaders;



/**
 * Set the number of items per page.
 *
 * @var numeric
 */
private $perPage;

/**
 * Sets the current page number.
 *
 * @var numeric
 */
private $currentPage;

/**
 * Sets the Total pages number.
 *
 * @var numeric
 */
private $totalPage;

/**
 * Set the limit for the data source.
 *
 * @var string
 */
private $limit;

/**
 * Set the total number of records/items.
 *
 * @var numeric
 */
private $totalRows = 0;

/**
 * Set the title of pagination
 *
 * @var string
 */
private $title;

public function setHeaders($headersNames = []){
    $this->headers = $headersNames;
}

public function getHeaders()
{
    return ((count($this->headers) > 0) ? $this->headers : []);
}

public function setTitle($title)
{
    $this->title = $title;
}

public function getTitle()
{
    return (($this->title != "") ? $this->getTitle() : "Resultados");
}

public function getStart()
{
    return ($this->getCurrentPage() * (int)$this->perPage) - (int)$this->perPage; //original
}

public function getFinish()
{
    if ($this->getCurrentPage() == 1) {
        return $this->perPage;
    } else {
        return ($this->getCurrentPage() * (int)$this->perPage);
    }
}

public function setPerPage($numerPages = 1)
{
    $this->perPage = $numerPages;
}

public function getPerPage()
{
    return $this->perPage;
}

public function setCurrentPage($page = 1)
{
    $this->currentPage = $page;
}

public function getCurrentPage()
{

    return (($this->currentPage <= 0) ? 1 : $this->currentPage);
}

public function setTotalPage($pages = 0)
{
    $this->totalPage = (($this->totalPage <= 0) ? 0 : $this->totalPage);
}

public function getTotalPage()
{
    return $this->totalPage;
}

public function getLimitSql()
{
    return 'WHERE RowNum > ' . $this->getStart() . ' AND RowNum <= ' . $this->getFinish();
}

public function getLimitPostgres()
{
    return " LIMIT " . $this->perPage . " OFFSET " . $this->getStart();
}

public function getLimit()
{
    return 'LIMIT '.$this->getStart().", ".$this->perPage;
}


/**
 * setTotal.
 *
 * Collect a numberic value and assigns it to the totalRows.
 *
 * @param int $totalRows holds the total number of rows
 */
public function setTotal($total)
{
    $this->totalRows = $total;
}


/**
     * Método para constrir una tabla según los parámetros indicados.
     * Ejemplo: buildTable("NUMEXP", $headers, $data['centros'], $ignore, $buttons);
     * @param Array $title - Arrelgo con el titulo del card asi como el icono que usara ejemplo: array("Titlo del card", "sync-alt")
     * @param String $editField - Description:Identificador del registro(para editar o eliminar)
     * @param Array $headers - Description: Nombre de las columnas a desplegar en la tabla
     * @param Array $data - Description: Datos a mostrar en la tabla
     * @param Array $ignore - Description: Columnas no desplegables en la tabla
     * @param Array $buttons - Description:Arreglo de botones a desplegar-[ Nombre de clase(requerido), icono del boton(requerido si no hay nombre), Nombre a desplegar(requerido si no hay icono), color del boton, tamaño de boton, title, arreglo con las condiciones para mostrar] Ejemplo:$actions[0] = array("rc", "sync-alt", "Reactivar", "info", "xs", "Reactivar", array('status' => '==:B:S'));
     * @param Array $paginacion - Arrelgo con la informacion para hacer los links de paginacion ejemplo: array(pagina_Actual, Total_paginas, "nombre funcion")
     * @return Imprime Cadena html con la tabla de datos construida(echo).
     */

    public function Create($title = [], $editField = "", $headers = [], $data = [], $ignore = [], $buttons = [], $paginacion = [])
    {
        //pregunto si hay columnas que mostrar
        if (count($headers) > 0) {
            echo '<div class="row">';
                echo '<div class="col-md-12 grid-margin stretch-card">';
                    echo '<div class="card">';
                        echo '<div class="card-body" style="margin-bottom: -30px">';
                            $this->createTitleCard($title);               
                        echo '</div>';
                        echo '<div class="row">';
                            echo '<div class="col-12">';
                                $this->createTable($headers, $editField, $data, $ignore, $buttons);
                            echo '</div>';        
                        echo '</div>';    

                        if (count($paginacion) > 0) {
                            echo '<div class="mt-3">';
                                echo '<nav class="pr-2">';
                                    echo '<ul class="pagination d-flex flex-wrap justify-content-end pagination-primary">';
                                        $this->createFooterCard($paginacion);
                                    echo '</ul>';
                                echo '</nav>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    }     

    /**
     * Metodo para Poner el Titulo del Card
     * aprematros array $tilte(titulo, icono)
     */
    private function createTitleCard($title = [])
    {
        if (count($title) == 0) {
            $title[0] = "Resultado";
            $title[1] = "icon-layers";
        } else if (count($title) < 2) {
            $title[1] = "icon-layers";
        }
        echo '<div class="d-flex justify-content-between">';
            echo '<p class="card-title"><i class="'.$title[1].' menu-icon"></i>&nbsp;'.$title[0].'</p>';
        echo '</div>';
    }

    //metodo para crear el Footer del card
    private function createFooterCard($paginacion = [])
    {
        if (count($paginacion) > 0) {
            if (count($paginacion) < 3) {
                $paginacion[2] = "pagging";
            }
            //echo '<div class="card-footer">';
            $this->createLinks($paginacion[0], $paginacion[1], $paginacion[2]);
            //echo '</div>';
        }
    }

    private function createTable($headers = [], $editField="", $data = [], $ignore = [], $buttons = [])
    {
        echo '<div class="row">';
            echo '<div class="col-12">';
                echo '<div class="table-responsive">';
                    echo '<div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">';
                        echo '<div class="row">';
                            echo '<div class="col-sm-12">';
                                echo '<table id="example" class="table-hover display expandable-table dataTable no-footer" style="width: 100%;" role="grid">';
                                    $this->createTheadTable($headers, $ignore, $buttons);
                                    $this->createTBodyTabale($editField, $data, $ignore, $buttons);
                                echo '</table>';
                            echo '</div>';
                        echo '</div>';    
                    echo '</div>';    
                echo '</div>';    
            echo '</div>';    
        echo '</div>';    
    }   

    //metodo para crear el thead de la tabla
    private function createTheadTable($headers=[], $ignore=[], $buttons=[])
    {
        echo '<thead>';
            echo '<tr role="row">';
                foreach ($headers as $key) {
                    if (!in_array($key, $ignore)) {
                        echo '<th>' . $key . ' </th>';
                    }
                }
                echo ((count($buttons) > 0) ? '<th>&nbsp;</th>' : '');
            echo '</tr>';
        echo '</thead>';
    }

    private function createTBodyTabale($editField = "", $data = [], $ignore = [], $buttons = [])
    {
        $class = '';
        $row=0; 
        $i = 0;
        $id = 0;
        echo '<tbody>';
        ///ciclo para recorrer row de los datos
        foreach ($data as $row) {
            $class = (($row % 2) == 0 ? " odd " : " even ");
            echo '<tr class="'.$class.'">';
                //ciclo para recorrer las columnas de un row
                foreach ($row as $key => $value) {
                    if (!in_array($key, $ignore)) {
                        echo '<td>'.strtoupper(trim($value)).'</td>';
                        if (strtolower(trim($key)) == strtolower(trim($editField))) {
                            $id = $value;
                        }
                        $i = $i + 1;
                    } else if (strtolower(trim($key)) == strtolower(trim($editField))) {
                        $id = $value;
                    }
                }
                //Botones
                if (count($buttons) > 0) {
                    $this->createTdButtons($buttons, $id, $row);
                }
                //Botones
            echo '</tr>';
            $row++;   
        }
        echo '</tbody>';
    }

    private function createTdButtons($buttons = [], $id = "", $rowActual = [])
    {
        echo '<td>';
            echo '<div class="dropdown show">';
                echo '<a class="dropdown-toggle" style="color:black;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>';
                echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
                    $this->createButtons($buttons, $id, $rowActual);        
                echo '</div>'; 
            echo '</div>';     
        echo '</td>';
    }

    private function createButtons($buttons = [], $id = "", $rowActual = [])
    {
        $mostrarBoton = false;
        if (count($buttons) > 0) 
        {
            //ciclo para obtner los datos de los botones
            foreach ($buttons as $button) 
            {
                $mostrarBoton = true;
                $btn_class = ((trim($button[0]) != "") ? strtolower(trim($button[0])) : "");
                $btn_icon = ((trim($button[1]) != "") ? 'icon-' . strtolower(trim($button[1])) : "");
                $btn_text = ((trim($button[2]) != "") ? strtolower(trim($button[2])) : (($btn_icon !== "") ? "" : "Default"));
                $btn_color = ((trim($button[3]) != "") ? strtolower(trim($button[3])) : "default");
                $btn_size = ((trim($button[4]) != "") ? strtolower(trim($button[4])) : "xs");
                $btn_title = ((trim($button[5]) != "") ? ' title="' . ucfirst(trim($button[5])) . '" ' : "");

                if (isset($button[6]) && count($button[6]) > 0) 
                {
                    foreach ($button[6] as $key => $value) {
                        // 'status'=>'=:p'
                        $valores = explode(":", $value);
                        if (count($valores) == 3) {
                            $operador = trim($valores[0]);
                            $valor = trim($valores[1]);
                            $mostrar = trim($valores[2]);
                            //echo $operador." ".$valor." ".$mostrar. " ". $row[$key];
                            switch ($operador) {
                                case "==":
                                    if ($valor == $rowActual[$key] && $mostrar == "N") {
                                        $mostrarBoton = false;
                                    } else if ($valor == $rowActual[$key] && $mostrar == "S") {
                                        $mostrarBoton = true;
                                    } else /*if($valor!=$row[$key])*/{
                                        $mostrarBoton = false;
                                    }
                                    break;
                                case "!=":
                                    if ($valor != $rowActual[$key] && $mostrar == "N") {
                                        $mostrarBoton = false;
                                    } else if ($valor != $rowActual[$key] && $mostrar == "S") {
                                        $mostrarBoton = true;
                                    } else /*if($valor!=$row[$key])*/{
                                        $mostrarBoton = false;
                                    }
                                    break;
                            }
                            //$valor = $valores[1];
                            //$condicion.= 'return '.$key.$operador.$valor;
                        }
                    }
                }
                if ($mostrarBoton) {
                    echo '<a href="javascript:void(0)"  class="btn btn-'. $btn_color .' '. $btn_class . ' dropdown-item"  data="' . $id . '" ' . $btn_title . '>';
                        echo '<i style="color:white; padding:0.4rem;" class="mr-1 ' . $btn_icon . ' btn-' . $btn_color . ' btn-' . $btn_size . '"></i>';
                        if (trim($btn_text) != '') {
                            echo "&nbsp;".ucfirst($btn_text);
                        }
                    echo'</a>';
                }
            }
        }
    }

    public function createLinks($pageActual = 1, $totalRows = 0, $nombrefuncion = "pagging")
    {

        $this->perPage = (int) (($this->perPage > 0) ? $this->perPage : 0);
        $pageActual = (($pageActual == "undefined") ? 1 : $pageActual);
        $nombrefuncion = (($nombrefuncion == "") ? "pagging" : $nombrefuncion);
        $pageTotal = (($this->perPage > $totalRows) ? 1 : ceil($totalRows / $this->perPage));
        $this->createLeftButtonPaginate($pageActual, $pageTotal, $nombrefuncion);
        $this->createSelectPagination($pageActual, $pageTotal, $nombrefuncion);
        $this->createRighttButtonPaginate($pageActual, $pageTotal, $nombrefuncion);
    }

    private function createLeftButtonPaginate($pageActual = 1, $pageTotal = 0, $nombrefuncion = "pagging")
    {
        //echo $pageActual. ' - ' . $pageTotal;
        $disabed_antli = (($pageActual == 1) ? ' disabled' : '');
        $disabed_anchor = (($pageActual == 1) ? '' : '');
        $action_ant = (($pageActual == 1) ? '' : ' onclick="' . $nombrefuncion . '(' . trim(trim($pageActual) - 1) . ' ,' . trim($pageTotal) . ');"');
        echo '<li class="page-item ' . $disabed_antli . '">';
        echo '<a class="page-link " ' . $disabed_anchor . $action_ant . '><i class="ti-angle-left"></i></a>';
        echo '</li>';
    }

    private function createRighttButtonPaginate($pageActual = 1, $pageTotal = 0, $nombrefuncion = "pagging")
    {
        $disabed_sig = (($pageActual == $pageTotal || $pageTotal == 0) ? ' disabled' : '');
        $disabed_siganchor = (($pageActual == $pageTotal || $pageTotal == 0) ? ' tabindex="-1" aria-disabled="true" ' : '');
        $action_sig = (($pageActual == $pageTotal || $pageTotal == "0") ? '' : ' onclick="' . $nombrefuncion . '(' . trim(trim($pageActual) + 1) . ',' . trim($pageTotal) . ');"');
        echo '<li class="page-item ' . $disabed_sig . ' ">';
        echo '<a class="page-link btn-sm" ' . $disabed_siganchor . $action_sig . '> <i class="ti-angle-right"></i></a>';
        echo '</li>';
    }

    private function createSelectPagination($pageActual = 1, $pageTotal = 0, $nombrefuncion = "pagging")
    {
        $disabed_sel = ((($pageTotal == "0")) ? ' disabled="disabled" ' : '');
        echo '<select  onchange="' . $nombrefuncion . '(this.value,' . trim($pageTotal) . ')"  id="cboNumPage" name="cboNumPage" ' . $disabed_sel . '>';
        for ($pg = 1; $pg <= $pageTotal; $pg++) {
            $valor = (($pg == $pageActual) ? ' selected="selected" ' : '');
            echo '<option value="' . ($pg) . '" ' . $valor . '>' . ((string)trim($pg)) . '</option>';
        }
        echo '</select>';
    }

}
?>