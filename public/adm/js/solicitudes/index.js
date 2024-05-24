//const axios = require('axios');

 (function($) {

    // Setup maxlength
    $('.maxlength').maxlength({
        alwaysShow: true,
        validate: false,
        warningClass: "badge mt-1 badge-success",
        limitReachedClass: "badge mt-1 badge-danger",
    });

    
    //es para imprimir el reporte de la Solcitud
    $(document).on('click', '.vprint', function () {
        var id = $(this).attr('data');
        parent.location =  base_url + 'reporteSolicitud/'+id;
    });

    //es para anexar Documentos a la Solcitud
    $(document).on('click', '.vdoctos', function () {
        var id = $(this).attr('data');
        parent.location =  base_url + 'solicitud/'+id;
    });

    //es para Consultar una Solcitud
    $(document).on('click', '.vconsulta', function () {
        var id = $(this).attr('data');
        parent.location =  base_url + 'solicitud/'+id;
    });

    //boton para generar Reporte segun el filtro de datos
    $('#btnFiltrar').on('click', function () {    
        pagging (1,0);
    });    

    //Activar aspirante
    $(document).on('click', '.vunblock', function () {
        var id = $(this).attr('data');
        modificaBloqueoRegistro(id, '0');
    });
     
    //Bloquear aspirante
    $(document).on('click', '.vblock', function () {
        var id = $(this).attr('data');
         modificaBloqueoRegistro(id, '1');
    });
    
    //boton para generar Reporte de excel segun el filtro de datos
    $('#btnReporte').on('click', function (e) {    
        generaReporteExcel();
    });  
    
 })(jQuery);   
 
 
 function modificaBloqueoRegistro(id, valor){
        var accion=(valor=="1")? "Bloquear":"Habilitar";
        
 Swal.fire({
        title: 'Aviso', 
        text: "¿Desea "+accion+" el registro del aspirante seleccionado?",
        icon: 'question',
        showCancelButton: true,//true
        confirmButtonText: 'Si',
        confirmButtonColor: '#5c2134',
        cancelButtonText: 'No',
        cancelButtonColor: '#b2945e',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve) {
                $.ajax({
                    url: base_url + 'actualizaEstado',
                    type: 'POST',
                    cache: false,
                    data: { id: id, valor: valor}
                })
                // in case of successfully understood ajax response
                .done(function (response) {
                    console.log(response);
                    if(response=='OK') {
                        Swal.fire({
                            title: "Aviso",
                            text: "Se ha actualizado la solicitud correctamente.",
                            icon: "success",

                        }).then(function() {
                            setTimeout(function () {
                                var pa = document.getElementById("hd_pa").value;
                                var pt = document.getElementById("hd_pt").value;
                                pagging(pa, pt);
                            }, 500);
                        });
                    }
                })
                .fail(function (erordata) {
                    console.log(erordata);
                    Swal.fire('Aviso', 'Ocurrio un error al actualizar la solicitud', 'error');
                });
            });
        },
    });
  }
    
const generaReporteExcel = () => {
    var form = document.getElementById('frmFiltrar'); 
    form.action = base_url + 'reporteExcelSolicitudes';
    form.submit();
}


// (function($) {
//     'use strict';
//     $('#defaultconfig').maxlength({
//       warningClass: "badge mt-1 badge-success",
//       limitReachedClass: "badge mt-1 badge-danger"
//     });
  
//     $('#defaultconfig-2').maxlength({
//       alwaysShow: true,
//       threshold: 20,
//       warningClass: "badge mt-1 badge-success",
//       limitReachedClass: "badge mt-1 badge-danger"
//     });
  
//     $('#defaultconfig-3').maxlength({
//       alwaysShow: true,
//       threshold: 10,
//       warningClass: "badge mt-1 badge-success",
//       limitReachedClass: "badge mt-1 badge-danger",
//       separator: ' of ',
//       preText: 'You have ',
//       postText: ' chars remaining.',
//       validate: true
//     });
  
//     $('#maxlength-textarea').maxlength({
//       alwaysShow: true,
//       warningClass: "badge mt-1 badge-success",
//       limitReachedClass: "badge mt-1 badge-danger"
//     });
//   })(jQuery);



const tabla = document.getElementById('paginado');
window.addEventListener('DOMContentLoaded', (event) => {
    //const tabla = document.getElementById('paginado');
    tabla.innerHTML = '';
    // Make a request for a user with a given ID
    pagging (1,0);


});

const pagging = (pgActual, pgTotal) => {
    document.getElementById("hd_pa").value = pgActual;
    document.getElementById("hd_pt").value = pgTotal;
    filtrarDatos();
}

const filtrarDatos = () => {
    const formData = dataForm();
    axios.post(base_url + 'ajaxSolicitudes', formData)
      .then(function (response) {
        //console.log(response);
        tabla.innerHTML = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });
}

const dataForm = () =>{
    const formData = new FormData(); 
    var c = 0;
    var file_data;
    $('input[type="file"]').each(function()
    {
        var id = $(this).attr('data3'); //tipo
        file_data =  $('input[type="file"]')[c].files; // for multiple files
        for(var i= 0; i<file_data.length; i++){
            formData.append("file_"+id, file_data[i]);
        }
        c++;
    }); 

    const other_data = $('form').serializeArray(); //other fileds form
    $.each(other_data,function(key,input){
        formData.append(input.name,input.value);
    });
    return formData;

}




