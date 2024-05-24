<?php $this->extend('layout/site') ?>
<?php $session = \Config\Services::session(); ?>

<?php $this->section('content') ?>

<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 hero-header mb-5">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h1 class="display-3 text-white animated zoomIn">Servicios</h1>
            <a href="<?php echo base_url(route_to('home')); ?>" class="h4 text-white">Inicio</a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="<?php echo base_url(route_to('services')); ?>" class="h4 text-white">Servicios</a>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Service Start -->
<?php echo $this->include('layout/site/services'); ?>
<!-- Service End -->

<!-- Newsletter Start -->
<?php echo $this->include('layout/site/newsletter'); ?>
<!-- Newsletter End -->

<?php $this->endSection() ?>