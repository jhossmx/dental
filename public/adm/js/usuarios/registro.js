$(document).ready(function () {

    //validaciones de campos
    $('#FrmRegistro').validate({
        //hiden
        ignore: "input[type='text']:hidden",
        rules: {
            txt_usuario: {
                required: true,
                loginRegex: true,
                maxlength: 15
            },
            txt_nombre: {
                required: true,
                loginRegex: true,
                maxlength: 50
            },
            txt_ap1: {
                required: true,
                loginRegex: true,
                maxlength: 50
            },
            txt_curp: {
                required: true,
                loginRegex: true,
                minlength: 18,
                maxlength: 18
            },
            txt_correo: {
                required: true,
                email:true,
                loginRegex: false,
                maxlength: 50
            },
            CboMun: {
                selectcheck: true
            },
            CboTipoPersonal: {
                selectcheck: true
            },
            CboEstado: {
                selectcheck: true
            }
        },
        messages: {
            txt_usuario: {
                required: "El campo es requerido",
                loginRegex: "El campo solo acepta letras y números",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            txt_nombre: {
                required: "El campo es requerido",
                loginRegex: "El campo solo acepta letras y números",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            txt_ap1: {
                required: "El campo es requerido",
                loginRegex: "El campo solo acepta letras y números",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            txt_curp: {
                required:  "El campo es requerido",
                loginRegex: "El campo solo acepta letras y números",
                minlength: "El campo debe contener como mínimo {0} caracteres",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            txt_correo: {
                required: "El campo es requerido",
                loginRegex: "El campo solo acepta letras y números",
                email: "El campo debe contener un formato de correo electrónico valido",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            CboMun: {
                selectcheck: "Deber seleccionar un Municipio"
            },
            CboTipoPersonal: {
                selectcheck: "Deber seleccionar un Tipo Personal"
            },
            CboEstado: {
                selectcheck: "Deber seleccionar un Estado"
            }
        }
    });

    // Setup maxlength
    $('.maxlength').maxlength({
        alwaysShow: true,
        validate: false,
        warningClass: "badge mt-1 badge-success",
        limitReachedClass: "badge mt-1 badge-danger",
    });

    //boton para generar Reporte segun el filtro de datos
    $('#btnGrabar').on('click', function () {    
        grabarUsuario();
    });

});


function grabarUsuario() 
{
    var form = $("#FrmRegistro"); 
    const tipoR = document.getElementById('hd_tipoReg').value;
    const modalMessage = 'Se ha'+  ((tipoR=="N") ? " registrado ": " actualizado ") + 'correctamente el Usuario.';
    const pass = $('#txt_pass').val();
    const passC = $('#txt_pass_con').val();
    
    if(pass!="" || passC!="" || tipoR == "N")
    {
        $("#txt_pass").rules("add", { required: true, loginRegex: true, maxlength:10, messages: { required: "El campo es requerido", loginRegex: "El campo solo acepta letras y números", maxlength: "El campo debe contener como máximo {0} caracteres" } });
        $("#txt_pass_con").rules("add", { required: true, loginRegex: true, maxlength:10,  equalTo: "#txt_pass", messages: { required: "El campo es requerido", loginRegex: "El campo solo acepta letras y números", maxlength: "El campo debe contener como máximo {0} caracteres",  equalTo: "Las calves de los campos Constraseña y Repite contraseña deben ser iguales" } });
    }
    
    form.validate();
    if (form.valid()) {
        //----------------
        var formData = new FormData(); 
        var other_data = $('form').serializeArray(); //other fileds form
        $.each(other_data,function(key,input){
            formData.append(input.name,input.value);
        });
        //----------------
        $("html, body").animate({ scrollTop: 0 }, "slow");

        Swal.fire({
            //title: '',
            showCancelButton: true,
            //text: 'Los datos del ' + nombreProyecto.bold() +'\n son correctos?',
            html: 'Los datos del Usuario son Correctos?',
            icon: 'info',
            confirmButtonText: "Si",
            confirmButtonColor: '#5c2134',
            cancelButtonText: 'No',
            cancelButtonColor: '#b2945e',
            showLoaderOnConfirm: true,
            preConfirm: () => {

                $.ajax({
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: base_url + 'admin/grabarUsaurio',
                    data: formData,
                    success: function (response) {

                        if (tipoR=="R") {
                            document.getElementById('btnGrabar').removeAttribute("disabled");
                        }

                        /*if (tipoR=="R") {
                            document.getElementById('btnGrabar').removeAttribute("disabled");
                        }else{
                           document.getElementById('btnMod').removeAttribute("disabled");
                        }*/

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
    }else{
        $("html, body").animate({ scrollTop: 0 }, "slow");        
        //alert("error");
    }    
}

function getErrors(errors){
    let err = JSON.parse(errors)
    let msg =  '';
    for(let clave in err){
        if(err.hasOwnProperty(clave)){
            msg += err[clave] + "\n";
        }
    }
    return msg;
}


    



