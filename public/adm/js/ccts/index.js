$(document).ready(function () {

    //boton para mostrar busqueda de los centros de trabajo
    $('#txt_show_cct').on('click', function () {   
        limpiaInfoCt("limpiar", []); 
        const cct = $('#txt_cct').val();
        if(cct.length < 5)
        {
            Swal.fire({
                title: 'Aviso',
                text: "Debe escribir al menos 5 caracteres del Centro de Trabajo",
                icon: 'error'
            });
        }else{
            
            buscarCcts();
        }
    });

    //es para seleccionar un centro de trabajo
    $(document).on('click', '.vcheck', function () {
        var ct = $(this).attr('data');
        limpiaInfoCt("limpiar", [] );
        getDataCt(ct);
    });

});

function pagging(pgActual, pgTotal){
    document.getElementById("hd_pa").value = pgActual;
    document.getElementById("hd_pt").value = pgTotal;
    buscarCcts();
}

function getDataCt(cct)
{
    $.ajax({
        type: 'POST',
        url: base_url + 'getdatact',
        data: { cct:cct },
        success: function (response) {
            let info = JSON.parse(response);
            limpiaInfoCt("mostrar", info);
            $('#myModalCct').modal('hide');
            $("#myModalCct .close").click()
        }, 
        error: function() {
            Swal.fire({
                title: 'Aviso',
                text: "Ocurrio un error al obtener la información del Centros de Trabajo",
                icon: 'error'
            });
         }
    });
}

function limpiaInfoCt(tipo, info){
    if(tipo=="limpiar"){
        $('#txt_nombre_ct').val("");
        $('#txt_domicilio_ct').val("");
        $('#txt_tel_ct').val("");
    }else{
        $('#txt_cct').val(info.cct);
        $('#txt_nombre_ct').val(info.nombre);
        $('#txt_domicilio_ct').val(info.domicilio);
        $('#txt_tel_ct').val(info.telefono);
    }
}

function buscarCcts()
{
    const tabla = document.getElementById('tablaResultados');
    const cct = $('#txt_cct').val();
    const pa = $('#hd_pa').val();
    const pt = $('#hd_pt').val();
    $.ajax({
        type: 'POST',
        url: base_url + 'ajaxbusquedact',
        data: { cct:cct, pa:pa, pt:pt },
        success: function (response) {
            tabla.innerHTML = response;
        }, 
        error: function() {
            Swal.fire({
                title: 'Aviso',
                text: "Ocurrio un error al Búscar los Centros de Trabajo",
                icon: 'error'
            });
         }
    });

    
}