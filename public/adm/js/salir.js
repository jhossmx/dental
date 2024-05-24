const salir = function () {
    Swal.fire({
        icon: 'question',
        title: '¿Desea salir?',
        //text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: '#5c2134',
        cancelButtonColor: '#b2945e',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = base_url + rutaLogin;
        }
    });
}
document.getElementById("btnSalir").addEventListener("click", salir);