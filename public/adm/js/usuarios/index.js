(function($) {

    // Setup maxlength
    $('.maxlength').maxlength({
        alwaysShow: true,
        validate: false,
        warningClass: "badge mt-1 badge-success",
        limitReachedClass: "badge mt-1 badge-danger",
    });
    
    //es para Consultar un Usuario
    $(document).on('click', '.vconsulta', function () {
        var id = $(this).attr('data');
        parent.location =  base_url + 'admin/usuario/'+id;
    });
    
    //es para dar de baja un Usuario
    $(document).on('click', '.vbaja', function () {
        var id = $(this).attr('data');
       CambiarEstado(id, 'B');
    });
    
    //es para activar un Usuario
    $(document).on('click', '.vactivar', function () {
        var id = $(this).attr('data');
        CambiarEstado(id, 'A');
    });

    //boton para generar filtro de datos
    $('#btnFiltrar').on('click', function () {    
        pagging (1,0);
    });    

})(jQuery);

const tabla = document.getElementById('paginado');
window.addEventListener('DOMContentLoaded', () => {
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
    axios.post(base_url + 'admin/ajaxusuarios', formData)
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

const CambiarEstado = (id, estado) => {
    const modalMessage = 'Se ha '+  ((estado=="B") ? " dado de Baja ": " Reactivado ") + 'correctamente el Usuario.';
    Swal.fire({
        //title: '',
        showCancelButton: true,
        //text: 'Los datos del ' + nombreProyecto.bold() +'\n son correctos?',
        html: '¿Desea '+  ((estado=="B") ? " dar de Baja ": " Reactivar ") + 'al Usuario.',
        icon: 'info',
        confirmButtonText: "Si",
        confirmButtonColor: '#5c2134',
        cancelButtonText: 'No',
        cancelButtonColor: '#b2945e',
        showLoaderOnConfirm: true,
        preConfirm: () => {

            $.ajax({
                type: 'POST',
                //processData: false,
                //contentType: false,
                //cache: false,
                url: base_url + 'admin/cambiarestadousuario',
                data: { id: id, estado: estado},
                success: function (response) {
                    let msg = response;
                    if(msg==="offline"){
                        parent.location = base_url;
                    }else if(msg=="OK"){
                        msg = modalMessage;
                        Swal.fire({
                            title: "Aviso",
                            text: msg,
                            icon: "success"
                        }).then(function() {
                            setTimeout(function () {
                                parent.location =  base_url + 'admin/usuarios';
                            }, 500);
                        });
                    }else
                    {   
                        console.log(response);
                        msg = getErrors(response);
                        Swal.fire({
                            title: 'Aviso',
                            html: msg,
                            //text: msg,
                            icon: 'error',
                        });
                    }
                }, 
                error: function(error) {
                    Swal.fire({
                        title: 'Aviso',
                        text: error,
                        icon: 'error'
                    });
                 }
            });
        }
    });
}