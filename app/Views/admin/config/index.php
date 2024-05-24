<?php $this->extend('layout/admin') ?>
<?php  $session = \Config\Services::session(); ?>


<?php $this->section('content') ?>

    <?php echo $this->include('layout/adm/infoUser'); ?>
    <div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="icon-docs icons"></i> Filtrar Solicitudes 
                </h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_titulo">Titulo</label>
                            <input type="text" class="form-control maxlength uper" maxlength="80" id="txt_titulo" name="txt_titulo" placeholder="Titulo" value="">
                        </div>
                    </div>    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_nombre">Nombre</label>
                            <input type="text" class="form-control maxlength uper" maxlength="80" id="txt_nombre" name="txt_nombre" placeholder="Nombre" value="">
                        </div>
                    </div>    
                </div>        
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_correo">Correo</label>
                            <input type="text" class="form-control maxlength uper" maxlength="100" id="txt_correo" name="txt_correo" placeholder="Correo Electrónico" value="">
                        </div>
                    </div>    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="txt_telefono">Telefono</label>
                            <input type="text" class="form-control maxlength uper" maxlength="10" id="txt_telefono" name="txt_telefono" placeholder="Telefono" value="">
                        </div>
                    </div>  
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="txt_celular">Celular</label>
                            <input type="text" class="form-control maxlength uper" maxlength="10" id="txt_celular" name="txt_celular" placeholder="Celular" value="">
                        </div>
                    </div>  
                </div>
                
                <div class="row ">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="CboTipoPersonal">Tipo de Personal</label>
                            <select class="form-control form-control-sm fs12" id="CboTipoPersonal" name="CboTipoPersonal">
                            <?php //echo getCombo("tipo_personal");?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="CboSubsistema">Subsistema</label>
                            <select class="form-control form-control-sm" id="CboSubsistema" name="CboSubsistema">
                            <?php //echo getCombo("subsistema");?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="CboMun">Municipio del Centro</label>
                            <?php 
                                $where = "Where cast(ca_CveMunicipio as int) in (".$session->get('munipios').")";
                                $sql = "SELECT ca_CveMunicipio as id, da_Municipio as dato FROM C_MUNICIPIO ". $where ." Order by cast(ca_CveMunicipio as smallint)"?>
                            <select class="form-control form-control-sm" id="CboEstado" name="CboMun">
                                <?php //echo getCombo($sql);?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="CboEstado">Estado</label>
                            <select class="form-control form-control-sm" id="CboEstado" name="CboEstado">
                                <?php //echo getCombo('estado_solicitud', ((isset($infoSolicitud['mun'])) ? $infoSolicitud['mun'] : ''));?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 my-auto">
                        <button type="button" class="btn btn-primary float-right" id="btnReporte" title="Genera Reporte Excel">
                            <i class="icon-printer ms-1"></i>&nbsp; Reporte Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>