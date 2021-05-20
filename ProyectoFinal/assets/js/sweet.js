function ingreso() {
    let nombre = document.getElementById("name").value;
    let contraseña = document.getElementById("pass").value;

    if (nombre == 'johan@artesanix.co' && contraseña == '7890') {

        Swal.fire({
            icon: 'success',
            title: 'Bienvenido',
            footer: '<span class="pie">Artesanix</span>',
            backdrop: true,
            timer: '2000',
            timerProgressBar: true,
            showConfirmButton: false,
        });

        setTimeout(function() {
            window.location.replace("http://localhost/nuevo/visualPrincipal/vConsumidor.php");
        }, 2000);

    } else if (nombre == 'joseph@artesanix.co' && contraseña == '1230') {

        Swal.fire({
            icon: 'success',
            title: 'Bienvenido',
            footer: '<span class="pie">Artesanix</span>',
            backdrop: true,
            timer: '5000',
            timerProgressBar: true,
            showConfirmButton: false,
        });

        setTimeout(function() {
            window.location.replace("http://localhost/nuevo/visualPrincipal/vTejedor.php");
        }, 5000);

    } else if (nombre == 'daniel@artesanix.co' && contraseña == '4560') {

        Swal.fire({
            icon: 'success',
            title: 'Bienvenido',
            footer: '<span class="pie">Artesanix</span>',
            backdrop: true,
            timer: '5000',
            timerProgressBar: true,
            showConfirmButton: false,
        });

        setTimeout(function() {
            window.location.replace("http://localhost/nuevo/visualPrincipal/vAdmin.php");
        }, 5000);

    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            confirmButtonText: 'Aceptar',
            text: 'Tu Usuario o contraseña son erroneos',
            footer: 'Vuelve a intentarlo',
            backdrop: true,
        });
    }
}