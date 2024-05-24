<?php  $session = \Config\Services::session(); ?>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <?php 
                    $modulo = ""; $tipo="";
                    if($tipoUser=="U"){
                        $modulo  = "Módulo Usuario";
                    }else if($tipoUser=="A"){
                        $modulo  = "Módulo de Administración || ";
                        $tipo = "<b>Tipo de Usuario:</b> ". $session->get('tipoUsuario');
                    }
                ?>
                <h5 class="font-weight-normal mb-0 text-primary"><?php echo $modulo .$tipo; ?></h5> 
                <h3 class="font-weight-bold">Bienvenido(a) <?php echo $session->get('nombre').' '.$session->get('ap1').' '.$session->get('ap2') ?> </h3>
                <!--<h6 class="font-weight-normal mb-0">Registro de Nueva Solicitud de Estimulo</h6>-->
            </div>
        </div>
    </div>
</div>