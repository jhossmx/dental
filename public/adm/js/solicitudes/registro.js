$(document).ready(function () {

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: "linked",
        language: "es",
        autoclose: true
    });

    //validaciones de campos
    $('#FrmRegistro').validate({
        //hiden
        ignore: "input[type='text']:hidden",
        rules: {
            txt_correo: {
                required: true,
                email: true,
                loginRegex: false,
                maxlength: 80
            },
            txt_calle: {
                required: true,
                loginRegex: true,
                maxlength: 60
            },
            txt_numero: {
                required: true,
                loginRegex: true,
                maxlength: 10
            },
            txt_colonia: {
                required: true,
                loginRegex: true,
                maxlength: 60
            },
            txt_zip: {
                required: true,
                number: true,
                maxlength: 5
            },
            txt_telefono:{
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            txt_celular:{
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            CboMun: {
                selectcheck: true
            },
            CboEntidad: {
                selectcheck: true
            },
            txt_cct: {
                required: true,
                loginRegex: true,
                minlength: 3,
                maxlength: 10
            },
            txt_plaza: {
                required: true,
                loginRegex: true,
                maxlength: 20
            },
            txt_nombramiento: {
                required: true,
                loginRegex: true,
                maxlength: 50
            },
            CboTipoPersonal: {
                selectcheck: true
            },
            CboSubsistema: {
                selectcheck: true
            },
            txt_ingreso: {
                required: true,
                maxlength: 10
            },
            'rdoIsep[]': {
                required: true,
            },
            'rdoSe[]': {
                required: true,
            },
            CboGremioSindical: {
                 selectcheck: true,
            },
            CboNivel:{
                 selectcheck: true,
            },
            CboEstado:{
                selectcheck: true,
            }
        },
        messages: {
            txt_correo: {
                required: "El campo es requerido",
                email: "El campo debe contener un formato de correo electrónico valido",
                loginRegex: "El campo solo acepta letras y números",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            txt_calle: {
                required: "El campo es requerido",
                loginRegex: "El campo solo acepta letras y números",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            txt_numero: {
                required: "El campo es requerido",
                 
                loginRegex: "El campo solo acepta letras y números",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            txt_colonia: {
                required: "El campo es requerido",
                loginRegex: "El campo solo acepta letras y números",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            txt_zip: {
                required: "El campo es requerido",
                number: "El campo solo acepta números",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            txt_telefono: {
                required: "El campo es requerido",
                number: "El campo solo acepta números",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            txt_celular: {
                required: "El campo es requerido",
                number: "El campo solo acepta números",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            CboMun: {
                selectcheck: "Deber seleccionar un Municipio"
            },
            CboEntidad: {
                selectcheck: "Deber seleccionar una Entidad"
            },
            txt_cct: {
                required:  "El campo es Requerido",
                loginRegex: "El campo solo acepta letras y números",
                minlength: "El campo debe contener como mínimo {0} caracteres",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            txt_plaza: {
                required:  "El campo es Requerido",
                loginRegex: "El campo solo acepta letras y números",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            txt_nombramiento: {
                required:  "El campo es Requerido",
                loginRegex: "El campo solo acepta letras y números",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            CboTipoPersonal: {
                selectcheck: "Deber seleccionar un Tipo Personal"
            },
            CboSubsistema: {
                selectcheck: "Deber seleccionar un Subsistema"
            },
            txt_ingreso:{
                required: "El campo es Requerido",
                maxlength: "El campo debe contener como máximo {0} caracteres"
            },
            'rdoIsep[]':{
                required: "El campo es Requerido",
            },
            'rdoSe[]': {
                required: "El campo es Requerido",
            },
            CboGremioSindical: {
                selectcheck: "El campo es Requerido",  
            }, 
            CboNivel:{
                selectcheck: "El campo es Requerido",  
            },
            CboEstado:{
                selectcheck: "El campo es Requerido",  
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

    $('#CboTipoPersonal').change(function() {
        const value = $(this).val();
        if(value == "0"){
            $('#personalDocnete').hide();
            $('#personalAdministrativo').hide();
        }else if(value == "1"){
            $('#personalAdministrativo').hide();
            $('#personalDocnete').show();
        }else{
            $('#personalDocnete').hide();
            $('#personalAdministrativo').show();
        }
    });

    $('#chkAprobado').change(function() {
        if(this.checked) {
            Swal.fire({
                title: 'Aviso',
                showCancelButton: true,
                text: 'Desea indicar la Finalización del Registro?',
                icon: 'question',
                confirmButtonText: "Si",
                confirmButtonColor: '#5c2134',
                cancelButtonText: 'No',
                cancelButtonColor: '#b2945e',
                showLoaderOnConfirm: true,
                preConfirm: () => { }
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hd_chkFin').val("1");
                }else{
                    $('#hd_chkFin').val("0");
                    $('#chkAprobado').prop('checked', false); // Unchecks it
                }    
            });
        }else{
            $('#hd_chkFin').val("0");
            $('#chkAprobado').prop('checked', false); // Unchecks it
        }
    });

    //boton para ggrabar la solicitud de usuario docente
    $('#btnGrabar').on('click', function () {    
        grabarSolicitud();
    });
    
      //boton para grabar la solicitud de usuario administrador
    $('#btnGrabaadm').on('click', function () {    
        grabarDatosadm();
    });
    
    const tipoPersonal = $('#CboTipoPersonal').val();
    $("#CboTipoPersonal").val(tipoPersonal).change();


//manejo de carga de documentos
    //cargar un archivo a drive
    $(document).on('click', '.cargar', function () {
        var id = $(this).attr('data');
        document.getElementById('tr'+id).style.visibility="";
    });
    
      //Eliminar archivo de drive
    $(document).on('click', '.borrar', function () {
        var idDrive = $(this).attr('data');
        var idDoc = $(this).attr('data2');
        var idAsp = $(this).attr('data3');
        var idCuenta = $(this).attr('data4');
        deleteFile(idDrive, idDoc, idAsp,idCuenta);
        //window.location = DIR + "cct/Comprobantes/Eliminar/" + id;
        //alert("borrar"+id);
        //eliminarDocumento(id);
    });
    const tipoR = document.getElementById('hd_tipoReg').value;
    if(tipoR=="U"){
        recargaTablaDocs();
    }     
});

function grabarDatosadm(){
  document.getElementById('hd_obs').value=document.getElementById('txt_observ').value;
  var id=document.getElementById('hd_idsl').value;
  var form = $("#Frmdatosadm");
  var datos = form.serialize();
 Swal.fire({
        title: 'Aviso', 
        text: "¿Desea actualizar el estado de la solicitud?",
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
                    url: base_url + 'actualizasoladm',
                    type: 'POST',
                    cache: false,
                    data: datos
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
                                parent.location =  base_url + 'solicitud/'+id;
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


function grabarSolicitud() 
{
    var form = $("#FrmRegistro"); 
    const tipoR = document.getElementById('hd_tipoReg').value;
    const modalMessage = 'Se ha'+  ((tipoR=="N") ? " registrado ": " actualizado ") + 'correctamente la Solicitud.';
    let mensaje = validaBeneficiarios();
    if(mensaje!= '')
    {
        //muestra el error 
        Swal.fire({
            title: 'Aviso',
            icon: 'error',
            html: mensaje
        });
    }else{
        //paso validacion beneficiario
        if(document.getElementById('CboTipoPersonal').value == '1'){
            $("#chkRamirez").rules("add", { required: true, messages: { required: "Falta Seleccionar el Premio RAFAEL RAMIREZ"} });
            $( ".anios" ).rules( "remove", "required" );
        }else if(document.getElementById('CboTipoPersonal').value == '2'){
            $('.anios').rules("add", { required: true, messages: { required: "Falta seleccionar los años de Servicio"} });
            $( "#chkRamirez" ).rules( "remove", "required" );
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
                title: 'Aviso',
                showCancelButton: true,
                //text: 'Los datos del ' + nombreProyecto.bold() +'\n son correctos?',
                html: 'Los datos de la Solicitud son Correctos?',
                icon: 'question',
                confirmButtonText: "Si",
                confirmButtonColor: '#5c2134',
                cancelButtonText: 'No',
                cancelButtonColor: '#b2945e',
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    document.getElementById('btnGrabar').setAttribute("disabled","disabled");
                    return new Promise(function (resolve) {
                        $.ajax({
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            enctype: 'multipart/form-data',
                            cache: false,
                            url: base_url + 'grabarSolcitud',
                            data: formData,
                            //success: function (response) {}
                        })
                        .done(function (response) {
                            document.getElementById('btnGrabar').removeAttribute("disabled");
                            let msg = response;
                            if(msg==="offline"){
                                parent.location = base_url;
                            }else if(msg=="DP"){
                                Swal.fire({
                                    title: 'Aviso',
                                    text: "No puede Registrar más de una solicitud por año",
                                    icon: 'error',
                                });
                            }else if(msg=="OK"){
                                msg = modalMessage;
                                Swal.fire({
                                    title: "Aviso",
                                    text: msg,
                                    icon: "success"
                                }).then(function() {
                                    setTimeout(function () {
                                        parent.location =  base_url + 'solicitudes';
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
                        })
                        .fail(function (erordata) {
                            console.log(erordata);
                            swal('Aviso', 'Ocurrio un error al grabar la solicitud', 'error');
                        });
                    });
                },
            });
        }else{
            $("html, body").animate({ scrollTop: 0 }, "slow");        
        }    
    }
}


function validaBeneficiarios()
{   
    //'txt_ap2_ben_',
    const campos = ['txt_nombre_ben_','txt_ap1_ben_','txt_telefono_ben_','txt_celular_ben_','txt_porcentaje_ben_','txt_correo_ben_']
    const noCamposValidar = campos.length;
    const totaBeneficiarios = 4;
    let camposLlenos=0;
    let mensaje = '';
    let porcentaje = 0;
    const campoPorcentaje = 'txt_porcentaje_ben_';
    let tieneDatos = false;
    let exit_loops = false;
    let BeneficairoCompleto = 0;
    for(let beneficiarioActual=1; beneficiarioActual <= totaBeneficiarios; beneficiarioActual++)
    {
        tieneDatos = false;
        for(let x=0; x < noCamposValidar; x++)
        {
            if(tieneDatos == false){
                if(CampoTieneDatos(campos[x], beneficiarioActual.toString())==true){
                    tieneDatos = true;
                    if(campos[x]===campoPorcentaje){
                        porcentaje = porcentaje + getValorPorcentaje(campos[x], beneficiarioActual.toString(), campoPorcentaje);
                        
                    }
                    camposLlenos++;
                }
            }else if(tieneDatos == true) {
                if(CampoTieneDatos(campos[x], beneficiarioActual.toString())==false){
                    mensaje = getNombreDelCampo(campos[x], beneficiarioActual.toString());
                    exit_loops = true;
                    break;
                }else{
                    if(campos[x]===campoPorcentaje){
                        porcentaje = porcentaje + getValorPorcentaje(campos[x], beneficiarioActual.toString(), campoPorcentaje);
                        exit_loops = ((porcentaje > 100) ? true : false);
                    }
                    camposLlenos++;
                }
            }    
        }
        if(camposLlenos==noCamposValidar){
            BeneficairoCompleto++;
        }
        if (exit_loops){
            break;
        }    
    }
    //tieneDatos==false &&
    if(BeneficairoCompleto==0){
        mensaje = 'Debe llenar los datos de al menos un Beneficiario';
    }else if(porcentaje > 100){
        mensaje = 'El Porcentaje No debe exceder del 100%';
    }
    return mensaje;
}

function CampoTieneDatos(nombreCampo, numero)
{
    //alert(nombreCampo + numero);
    //console.log(document.getElementById(nombreCampo + numero).value);
    return ((document.getElementById(nombreCampo + numero).value!='') ? true : false);
    
}

function getValorPorcentaje(nombreCampo, numero, campoPorcentaje)
{
    let porcentaje = 0;
    if(nombreCampo===campoPorcentaje){
        porcentaje = Number(document.getElementById(nombreCampo + numero).value);
    }
    return ((isNaN(porcentaje)) ? 0 : porcentaje);
}

function getNombreDelCampo(campo, NoBenefiario){
    let msj = '';
    switch (campo) {
        case 'txt_nombre_ben_':
            msj = 'Falta el Nombre del ' +  getNumeroBeneficiario(NoBenefiario);
            break;
        case 'txt_ap1_ben_':
            msj = 'Falta el '+ 'Primer Apellido'.bold()+' del ' +  getNumeroBeneficiario(NoBenefiario);
            break;
        //case 'txt_ap2_ben_':
        //    msj = 'Falta el '+ 'Segundo Apellido'.bold()+' del ' +  getNumeroBeneficiario(NoBenefiario);
        //    break;
        case 'txt_telefono_ben_':
            msj = 'Falta el '+ 'Teléfono'.bold()+' del ' +  getNumeroBeneficiario(NoBenefiario);
            break;
        case 'txt_celular_ben_':
            msj = 'Falta el '+ 'Celular'.bold()+' del ' +  getNumeroBeneficiario(NoBenefiario);
            break;
        case 'txt_porcentaje_ben_':
            msj = 'Falta el '+ 'Porcentaje'.bold()+' del ' +  getNumeroBeneficiario(NoBenefiario);
            break;
        case 'txt_correo_ben_':
            msj = 'Falta el '+ 'Porcentaje'.bold()+' del ' +  getNumeroBeneficiario(NoBenefiario);
            break;
    }
    return msj;
}

function getNumeroBeneficiario(numero){
    let campo = '';
    switch (numero) {
        case '1':
            campo = 'Primer Beneficiario'; 
            break;
        case '2':
            campo = 'Segundo Beneficiario'; 
            break;
        case '3':
            campo = 'Tercer Beneficiario'; 
            break;
        case '4':
            campo = 'Cuarto Beneficiario'; 
            break;
    }
    return campo;
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


//manejo de carga de documentos
function recargaTablaDocs()
{ 
    var form = $("#FrmRegistro");
   // form.validate();
    if (true)//form.valid())
    {
        $('#tbodyResp').html("");
        var trHTML = '';
        var datos = form.serialize();
        $.ajax({
            url: base_url + 'ajaxRecargaTablaDocs',
            type: 'POST',
            cache: false,
            data: datos,
            success: function (response) {
                if(response==="offline"){
                    parent.location = base_url + login;
                }else if(response=="noSame"){
                    parent.location = base_url + 'solicitudes';
                }else{
                    if ($('#tbodyResp').length) {
                        $('#tbodyResp').append(response);
                    }
                }
            }
        });
    }
    
    }

//metodo para eliminar un archivo en drive
function deleteFile(idDrive, idDoc, idAsp, idCuenta)
{
    swal.fire({
        title: "Aviso", 
        text: "Desea eliminar el archivo seleccionado?", 
        icon: "question",
        showCancelButton: true,//true
        confirmButtonText: "Si",
        confirmButtonColor: '#5c2134',
        cancelButtonText: 'No',
        cancelButtonColor: '#b2945e',
        showLoaderOnConfirm: true,
        //closeOnConfirm: false,
        preConfirm: function () {
            return new Promise(function (resolve) {
                $.ajax({
                    url: base_url + "drive/delete",
                    type: "POST",
                    cache: false,
                    data: { idDrive: idDrive, idDoc: idDoc, idAsp: idAsp, idCuenta: idCuenta }
                })
                // in case of successfully understood ajax response
                .done(function (response) {
                    console.log(response);
                    if(response=='') {
                        swal.fire({
                            title: "Aviso",
                            text: "Se ha eliminado el Archivo correctamente",
                            icon: "success",

                        }).then(function() {
                            setTimeout(function () {
                                recargaTablaDocs();
                            }, 500);
                        });
                    }
                })
                .fail(function (erordata) {
                    console.log(erordata);
                    swal('Aviso', 'Ocurrio un error al eliminar el documento', 'error');
                });
            });
        },
    });
}

    
//funcion para leer el archivo y subirlo a drive
$(document).on('change', '.myFile', function(event) 
{ 
    let target = event.target || event.srcElement;
    if (target.value.length == 0) {

        $(this).siblings("label").text('Seleccionar Documento: ').css("color","black");            

    }else{

        var id = $(this).attr('data3'); //id
        var formData = new FormData(); 
        file_data =  $(this).prop('files')[0]; // for multiple files
        formData.append("file_" + id, file_data);
        var file = $(this)[0].files[0].name;
        $(this).siblings("label").text('Archivo: ' + file).css("color", "green");
        var idsol = document.getElementById('hd_id').value;
        formData.append('hd_id', id);
        formData.append('hd_idsol', idsol);
        Swal.fire({
            title: "Aviso",
            html: "Desea registrar el archivo seleccionado?",
            icon: "question",
            showCancelButton: true,//true
            confirmButtonText: "Si",
            confirmButtonColor: '#5c2134',
            cancelButtonText: 'No',
            cancelButtonColor: '#b2945e',
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + 'drive/upload',
                        data: formData,
                        processData: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        cache: false,
                        success: function (response) { }
                    }) 
                    .done(function (response) {
                        if(response =="OK")
                        {
                            Swal.fire({
                                title: "Aviso",
                                text: "El Documento se guardo correctamente",
                                icon: "success",
                            }).then(function() {
                                setTimeout(function () {
                                    recargaTablaDocs();
                                }, 300);
                            });
                        }else{
                            msg = response;
                            Swal.fire({
                                title: 'Aviso',
                                html: msg,
                                icon: 'error'
                            });
                        }    
                    })
                    .fail(function (erordata) {
                        console.log(erordata);
                        Swal.fire({
                                title: 'Aviso',
                                html: 'Ocurrio un error al eliminar el documento',
                                icon: 'error'
                            });
                    });
                });
            },    
        }).then((res) => {
            if(res.dismiss == 'cancel'){
                this.value = '';   
               $(this).siblings("label").text('Seleccionar Documento: ').css("color","black");            
            }else if(res.dismiss == 'esc'){
                this.value = '';   
                $(this).siblings("label").text('Seleccionar Documento: ').css("color","black");            
            }
        })
    }
});

