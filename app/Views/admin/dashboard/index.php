<?php $this->extend('layout/admin') ?>
<?php  $session = \Config\Services::session(); ?>

<?php $this->section('content') ?>
<?php echo $this->include('layout/adm/infoUser'); ?>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Bienveidos al Módulo de Administración de Dental Mora</h4>
                <p class="mb-3">
                    It is a long <mark class="bg-warning text-white">established</mark> fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
                  </p>
                <img class="img-fluid rounded " src="<?php echo base_url('adm/images/solicitud.jpg') ?>" alt="Imagen Solicitud">
            </div>    
        </div>
    </div>
    <div class="col-md-6 grid-margin transparent">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Estadísticas de Solicitudes</h4>
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total de Solicitudes</p>
                                <p class="fs-30 mb-2">2</p>
                                <p>10.00% (30 days)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Solicitudes Docentes</p>
                                <p class="fs-30 mb-2">61344</p>
                                <p>22.00% (30 days)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Solicitudes Personal de Apoyo</p>
                                <p class="fs-30 mb-2">34040</p>
                                <p>2.00% (30 days)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Total Solicitudes Personal Aprobadas</p>
                                <p class="fs-30 mb-2">47033</p>
                                <p>0.22% (30 days)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>    
    </div>
</div>

<?php $this->endSection() ?>