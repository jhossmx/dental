<script src="<?php echo base_url('adm/assets/js/vendor.bundle.base.js')?>"></script>
<script src="<?php echo base_url('adm/assets/js/vendor.bundle.base1.js')?>"></script>

<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?php echo base_url('adm/assets/chart.js/Chart.min.js')?>"></script>
<script src="<?php echo base_url('adm/assets/datatables.net/jquery.dataTables.js')?>"></script>
<script src="<?php echo base_url('adm/assets/datatables.net-bs4/dataTables.bootstrap4.js')?>"></script>
<script src="<?php echo base_url('adm/js/dataTables.select.min.js')?>"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?php echo base_url('adm/js/off-canvas.js')?>"></script>
<script src="<?php echo base_url('adm/js/hoverable-collapse.js')?>"></script>
<script src="<?php echo base_url('adm/js/template.js')?>"></script>
<script src="<?php echo base_url('adm/js/settings.js')?>"></script>
<script src="<?php echo base_url('adm/js/bootstrap-maxlength.min.js')?>"></script>
<!-- endinject -->

<!-- Custom js for this page-->
<script src="<?php echo base_url('adm/js/sweetalert2.min.js')?>"></script>
<script src="<?php echo base_url('js/axios.min.js')?>"></script>

<script src="<?php echo base_url('adm/js/jquery.validate.min.js')?>"></script>
<script src="<?php echo base_url('adm/js/additional-methods.min.js')?>"></script>
<script src="<?php echo base_url('adm/js/genericas.js')?>"></script>




<!--<script src="<?php //echo base_url('js/dashboard.js')?>"></script> -->
<!-- <script src="<?php //echo base_url('js/Chart.roundedBarCharts.js')?>"></script> -->
<script src="<?php echo base_url('adm/js/salir.js')?>"></script>


<!-- End custom js for this page-->
<?php
    $jsFileArray = [];
    //agrego los extras
    if (isset($js)) {
        $data_js = $js;
        foreach ($data_js as &$jsFile) {
            array_push($jsFileArray, ('adm/js/' . $jsFile . ".js"));
        }
    }
    //js opcionales que le pado del controlador
    foreach ($jsFileArray as $js) {
        echo script_tag($js);
    }
?>