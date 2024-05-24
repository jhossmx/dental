<?php $this->extend('layout/site') ?>
<?php $session = \Config\Services::session(); ?>

<?php $this->section('content') ?>
<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 hero-header mb-5">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h1 class="display-3 text-white animated zoomIn">Contacto</h1>
            <a href="<?php echo base_url(route_to('home')); ?>" class="h4 text-white">Inicio</a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="<?php echo base_url(route_to('contact')); ?>" class="h4 text-white">Contacto</a>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Contact Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.1s">
                <div class="bg-dark rounded h-100 p-5">
                    <div class="section-title">
                        <h5 class="position-relative d-inline-block text-primary text-uppercase text-white">Contacto</h5>
                        <h1 class="display-6 mb-4 text-white">Llamos para atenderte</h1>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-geo-alt fs-1 text-white me-3"></i>
                        <div class="text-start">
                            <h5 class="mb-0 text-white">Nuestro Consultorio</h5>
                            <span class="text-white">Av. de las Cofradías #293 Villa del Rey, Mexicali, Mexico</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-envelope-open fs-1 text-white me-3"></i>
                        <div class="text-start">
                            <h5 class="mb-0 text-white">Email Us</h5>
                            <span class="text-white">info@example.com</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-phone-vibrate fs-1 text-white me-3"></i>
                        <div class="text-start">
                            <h5 class="mb-0 text-white">Call Us</h5>
                            <span class="text-white">+012 345 6789</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                <form>
                    <div class="row g-3 mt-1 p-3 bg-secondary">
                        <div class="col-12 ">
                            <input type="text" class="form-control border-0 bg-white px-4" placeholder="Nombre" style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <input type="email" class="form-control border-0 bg-white px-4" placeholder="Correo Electrónico" style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control border-0 bg-white px-4" placeholder="Asunto" style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <textarea class="form-control border-0 bg-white px-4 py-3" rows="5" placeholder="Mensaje"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Enviar Mensaje</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-4 col-lg-12 wow slideInUp" data-wow-delay="0.6s">
                <iframe class="position-relative rounded w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd" frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<!-- Newsletter Start -->
<?php echo $this->include('layout/site/newsletter'); ?>
<!-- Newsletter End -->

<?php $this->endSection() ?>