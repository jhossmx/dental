<?php helper('html');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo 'Dental Mora ' . ((isset($titulo)) ? ' - '.$titulo:''); ?></title>
    <?php //carga de css del template ?>
    <?php echo $this->include('layout/adm/header_css'); ?>
    <?php  $session = \Config\Services::session(); ?>
    <script>
        const base_url = '<?php echo base_url() ?>/';
        const tipoUser = '<?php echo (($session->get('IsAdmin') == 'S') ? 'A' : 'U') ?>'
        const rutaLogin = '<?php echo (($session->get('IsAdmin') == 'S') ? 'admin/logout' : 'logout') ?>'
    </script>
    <?php $this->renderSection('css')?>
</head>

<body>
    <div class="container-scroller">

        <!-- Menu Top -->
        <?php echo $this->include('layout/adm/top_menu'); ?>
        <!-- Menu Top -->

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <!-- Settings -->
            <?php //echo $this->include('layout/adm/settings'); ?>
            <!-- Settings -->

            <!-- Todo List -->
            <?php //echo $this->include('layout/adm/todo'); ?>
            <!-- Todo List -->

            <!-- SideBar -->
            <?php echo $this->include('layout/adm/sidebar'); ?>
            <!-- SideBar -->

            <!-- Contenido Principal -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <?php //contenido principal ?>
                    <?php $this->renderSection('content')?>
                </div>

                <!-- Footer -->
                <?php echo $this->include('layout/adm/footer'); ?>
                <!-- Footer -->

            </div>
            <!-- Contenido Principal -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <?php //carga de js del template ?>
    <?php echo $this->include('layout/adm/footer_js'); ?>
    <?php $this->renderSection('js')?>
</body>
</html>