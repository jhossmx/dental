<?php helper('html');?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title><?php echo 'Dental Mora' . ((isset($titulo)) ? ' - '.$titulo:''); ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Favicon -->
    <link href="site/img/favicon.ico" rel="icon">
    <?php //carga de css del template ?>
    <?php echo $this->include('layout/site/header_css'); ?>
    <script>
        const base_url = '<?php echo base_url() ?>/';
    </script>
     <?php $this->renderSection('css')?>
</head>
<body>
    <!-- Spinner Start -->
    <?php echo $this->include('layout/site/spiner'); ?>
    <!-- Spinner End -->
    
    <!-- Topbar Start -->
    <?php echo $this->include('layout/site/topBar'); ?>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <?php echo $this->include('layout/site/navbar'); ?>
    <!-- Navbar End -->

    <!-- Full Screen Search Start -->
    <?php echo $this->include('layout/site/search'); ?>
    <!-- Full Screen Search End -->

    <?php //contenido principal ?>
    <?php $this->renderSection('content')?>
    <?php //contenido principal ?>
    
    <!-- Footer Start -->
    <?php echo $this->include('layout/site/footer'); ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <?php echo $this->include('layout/site/footer_js'); ?>
    <?php $this->renderSection('js')?>
    </body>
</html>