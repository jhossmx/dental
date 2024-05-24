
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo 'Dental Mora ' . ((isset($titulo)) ? ' - '.$titulo:''); ?></title>
    <link rel="stylesheet" href="<?php echo base_url('adm/assets/feather/feather.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('adm/assets/ti-icons/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('adm/assets/css/vendor.bundle.base.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('adm/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('adm/css/mystyles.css') ?>">
    <link rel="shortcut icon" href="<?php echo base_url('adm/images/favicon.ico') ?>" />

    <?php
        //archivos css requeridos por el template
        $cssFileArray = [];
        //agrego los extras
        if (isset($css)) {
            $data_ccs = $css;
            foreach ($data_ccs as &$cssFile) {
                array_push($cssFileArray, ('adm/css/' . $cssFile . ".css"));
            }
        }

        //css opcionales que le pado del controlador
        foreach ($cssFileArray as $css) {
            echo link_tag($css);
        }
    ?>
    <script>
        var base_url = '<?php echo base_url() ?>/';
    </script>
</head>

<body>
    <?php $session = \Config\Services::session(); ?>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <?php //contenido principal ?>
            <?php $this->renderSection('content') ?>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script src="<?php echo base_url('adm/assets/js/vendor.bundle.base.js') ?>"></script>
    <script src="<?php echo base_url('adm/js/off-canvas.js') ?>"></script>
    <script src="<?php echo base_url('adm/js/hoverable-collapse.js') ?>"></script>
    <script src="<?php echo base_url('adm/js/template.js') ?>"></script>
    <script src="<?php echo base_url('adm/js/settings.js') ?>"></script>
    <script src="<?php echo base_url('adm/js/todolist.js') ?>"></script>

    <?php //script custom
        $jsFileArray = [];
        //agrego los extras
        if (isset($js)) {
            $data_js = $js;
            foreach ($data_js as &$jsFile) {
                array_push($jsFileArray, ('adm/js/'. $jsFile . ".js"));
            }
        }

        //js opcionales que le pado del controlador
        foreach ($jsFileArray as $js) {
            echo script_tag($js);
        }
    ?>
    <?php echo $this->renderSection('js') ?>
</body>
</html>