<link rel="stylesheet" href="<?php echo base_url('adm/assets/feather/feather.css')?>">
<link rel="stylesheet" href="<?php echo base_url('adm/assets/ti-icons/css/themify-icons.css')?>">
<link rel="stylesheet" href="<?php echo base_url('adm/assets/simple-line-icons/simple-line-icons.css')?>">

<link rel="stylesheet" href="<?php echo base_url('adm/assets/css/vendor.bundle.base.css')?>">
<link rel="stylesheet" href="<?php echo base_url('adm/assets/datatables.net-bs4/dataTables.bootstrap4.css')?>">
<link rel="stylesheet" href="<?php echo base_url('adm/assets/ti-icons/css/themify-icons.css')?>">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('adm/css/select.dataTables.min.css')?>">
<link rel="stylesheet" href="<?php echo base_url('adm/css/style.css')?>">
<link rel="stylesheet" href="<?php echo base_url('adm/css/mystyles.css')?>">

<link rel="stylesheet" href="<?php echo base_url('adm/css/custom.css')?>">
<link rel="stylesheet" href="<?php echo base_url('adm/css/sweetalert2.min.css')?>">
<link rel="shortcut icon" href="<?php echo base_url('adm/images/favicon.ico')?>">
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