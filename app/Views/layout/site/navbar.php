<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
    <a href="<?php echo base_url(route_to('home')); ?>" class="navbar-brand p-0">
        <h1 class="m-0 text-primary"><i class="fa fa-tooth me-2" style="font-size:2rem; color:#a7286e"></i>Dental Mora</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="<?php echo base_url(route_to('home')); ?>" class="nav-item nav-link active">Inicio</a>
            <a href="<?php echo base_url(route_to('about')); ?>" class="nav-item nav-link">Nosotros</a>
            <a href="<?php echo base_url(route_to('services')); ?>" class="nav-item nav-link">Servicios</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu m-0">
                    <a href="price.html" class="dropdown-item">Pricing Plan</a>
                    <a href="team.html" class="dropdown-item">Our Dentist</a>
                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="<?php echo base_url(route_to('appointment')); ?>" class="dropdown-item">Citas</a>
                </div>
            </div>
            <a href="<?php echo base_url(route_to('contact')); ?>" class="nav-item nav-link">Contacto</a>
        </div>
        <button type="button" class="btn text-dark" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button>
        <a href="appointment.html" class="btn btn-primary py-2 px-4 ms-3">Citas</a>
    </div>
</nav>