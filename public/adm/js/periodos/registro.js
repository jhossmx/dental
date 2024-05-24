$(document).ready(function () {
   
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: "linked",
        language: "es",
        autoclose: true
    });
    
    // Setup maxlength
    $('.maxlength').maxlength({
        alwaysShow: true,
        validate: false,
        warningClass: "badge mt-1 badge-success",
        limitReachedClass: "badge mt-1 badge-danger",
    });

    //grabar Periodos
    $('#btnGrabar').on('click', function () {
       grabarPeriodos();
    });
    
});


const grabarPeriodos = () => {
    var form = $("#frmPeriodos");    
    var modalMessage = 'Se ha actualizado correctamente la información de los Periodos.';
    form.validate();
    
    $('.datepicker').each(function() {
        $(this).rules( "add", {
            required: true,
            minlength: 10,
            messages: {
                required: "El campo es requerido",
                minlength: jQuery.validator.format("El campo debe contener como mínimo {0} caracteres")
            }
        });
    });    
    
    if (form.valid())
    {
        var datos = form.serialize();
        Swal.fire({
            //title: '',
            showCancelButton: true,
            //text: 'Los datos del ' + nombreProyecto.bold() +'\n son correctos?',
            html: 'La información de los Periodos son Correctos?',
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
                    url: base_url + 'admin/grabarperiodo',
                    data: datos,
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
}

