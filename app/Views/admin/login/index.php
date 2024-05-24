<?php $this->extend('layout/login') ?>
<?php 
    $validation = \Config\Services::validation();
    $session = \Config\Services::session(); 
?>
<?php $this->section('content') ?>
<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper2 d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 d-flex align-items-center justify-content-center">
                <div class="auth-form-light text-left p-3">
                    <div class="brand-logo">
                        <img src="<?php echo base_url('adm/images/logo.png') ?>" alt="logo" class="img-fluid mx-auto d-block">
                    </div>
                    <h4>Bienvenido al M&oacute;dulo de Administración de Dental Mora</h4>
                    <h6 class="font-weight-light">Ingrese sus datos para el ingreso</h6>
                    <form class="pt-3" name="FrmLogin" id="FrmLogin" method="POST" action='<?php echo base_url(route_to('admin_valida')); ?>'>
                    <div class="form-group">
                        <label for="txt_email">Correo Electrónico</label>
                        <input type="text" class="form-control form-control <?php if ($validation->getError('txt_email')): ?>is-invalid<?php endif?>" 
                            id="txt_email" name="txt_email" maxlength="50" placeholder="Correo Electrónico" value="<?php echo set_value('txt_email'); ?>">
                        <?php if ($validation->getError('txt_email')): ?>
                            <div class="invalid-feedback">
                                <?php echo $validation->getError('txt_email') ?>
                            </div>
                        <?php endif;?>    
                    </div>
                    <div class="form-group">
                        <label for="txt_pass">Clave de Acceso</label>
                        <input type="password" class="form-control form-control <?php if ($validation->getError('txt_clave')): ?>is-invalid<?php endif?>" id="txt_clave" name="txt_clave" maxlength="20" placeholder="Ingrese su Contraseña" value="">
                        <?php if ($validation->getError('txt_clave')): ?>
                            <div class="invalid-feedback">
                                <?php echo $validation->getError('txt_clave') ?>
                            </div>
                        <?php endif;?>    
                    </div>
                        <div class="mt-3">
                            <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="Ingresar">
                        </div>
                    </form>

                    <?php if ($session->getFlashdata('msg')): ?>
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <?php echo $session->getFlashdata('msg'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif;?>

                </div>
            </div>
            <div class="col-lg-6 login-half-bg d-flex flex-row">
                <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2021 All rights reserved.</p>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<!-- page-body-wrapper ends -->

<?php $this->endSection() ?>