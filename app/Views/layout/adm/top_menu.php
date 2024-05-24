<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

    <!-- Logos -->
    <?php echo $this->include('layout/adm/top_menu/logos'); ?>
    <!-- Logos -->

    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <!-- boton para colapsar menu -->
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <!-- boton para colapsar menu -->

        <!-- Busqueda -->
        <?php echo $this->include('layout/adm/top_menu/busqueda'); ?> 
        <!-- Busqueda -->

        <!-- Menu Derecha -->
        <ul class="navbar-nav navbar-nav-right">
            <!-- Notificaciones -->
            <?php //echo $this->include('layout/partials/top_menu/notificaciones'); ?> 
            <!-- Notificaciones -->

            <!-- Menu Usuario -->
            <?php echo $this->include('layout/adm/top_menu/menu_usuario'); ?> 
            <!-- Menu Usuario -->
            <!-- <li class="nav-item nav-settings d-none d-lg-flex">
                <a class="nav-link" href="#">
                    <i class="icon-ellipsis"></i>
                </a>
            </li> -->
        </ul>
        <!-- Notificaciones -->

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>