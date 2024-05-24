<li class="nav-item nav-profile dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
        <img src="<?php echo base_url('adm/images/faces/face28.jpg')?>" alt="profile" />
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
        <a class="dropdown-item" title="Manual del Sistema">
            <i class="ti-file text-primary"></i>
            Manual
        </a>
        <?php 
            $session = \Config\Services::session();        
            $ruta = (($session->get('IsAdmin') == 'S') ? 'admin_logout' : 'logout'); 
            //echo base_url(route_to($ruta)); 
        ?>
        <a class="dropdown-item" href="javascript:void(0);" id="btnSalir"  title="Salir del Sistema">
            <i class="ti-power-off text-primary"></i>
            Salir
        </a>
    </div>
</li>