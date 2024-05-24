<?php $this->extend('layout/admin') ?>
<?php $session = \Config\Services::session(); ?>

<?php $this->section('css') ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<?php echo $this->include('layout/adm/infoUser'); ?>
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="icon-docs icons"></i> Listado de Pacientes
                </h4>
                
                <div class="row">
                    <div class="col-12" id="sql-result"></div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Primer Apellido</th>
                                    <th scope="col">Segundo Apellido</th>
                                    <th scope="col">Nombre(s)</th>
                                    <th scope="col">Genero</th>
                                    <th scope="col">Fecha de Nacimiento</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>

<?php $this->section('js') ?>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"></script>
    
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>


    <script type="text/javascript">
        $('#myTable').DataTable({
            "dom": 'Bfrtip',
            "buttons": [
                 'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "language": {
                "sProcessing":    "Procesando...",
                "sLengthMenu":    "Mostrar _MENU_ registros",
                "sZeroRecords":   "No se encontraron resultados",
                "sEmptyTable":    "Ningún dato disponible en esta tabla",
                "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":   "",
                "sSearch":        "Buscar:",
                "sUrl":           "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":    "Último",
                    "sNext":    "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            serverSide: true,
            processing: true,
            ajax : {
                url:  base_url + 'pacientes/getDataPacientes',
                type: "get",
                dataSrc: function(json){
                    $('#sql-result').html('').append(json.debug_query);
                    return json.data;
                }
            },
            columns: [
                { data: "cn_id"  },
                { data: "da_apell1" },
                { data: "da_apell2" },
                { data: "da_nombre" },
                { data: "da_genero" },
                { data: "df_fecha_nacimiento" },
                { data: "da_status" }
            ],
            responsive: true
        });
    </script>
<?php $this->endSection() ?>