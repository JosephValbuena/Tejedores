<?php
    session_start();
    include('../ProyectoFinal/Backend/conectar.php');

    if(isset($_POST['submit'])){
        $flag = true;
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $passw = $_POST['passw'];
        $descp = $_POST['descp'];
        $foto = $_FILES['foto']['name'];
        $tipoimg = $_FILES['foto']['type'];
        $temp = $_FILES['foto']['tmp_name'];
        $tipo = $_POST['tipo'];
        $facebook = $_POST['facebook'];
        $twitter = $_POST['twitter'];
        $instagram = $_POST['instagram'];
        $latitud = $_POST['lat'];
        $longitud = $_POST['lng'];
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regístrate</title>
    <!--Custom CSS-->
    <link rel="stylesheet" href="assets/css/signup.css">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body class="body">
    <div class="header">
        <i class="fas fa-handshake"></i>
        <p>ARTESANIX</p>
    </div>
    <div class="content">
        <?php
            include('../ProyectoFinal/Backend/validar-form.php');  
        ?>
        <h1>Registrarse</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method="POST"
            enctype="multipart/form-data">
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" placeholder="Jose Posada"
                value="<?php if(isset($nombre)){ echo $nombre; } ?>" required><br>
            <label for="correo">Correo Electrónico</label><br>
            <input type="email" name="correo" id="correo" placeholder="Jose@example.com"
                value="<?php if(isset($correo)){ echo $correo; } ?>" required><br>
            <label for="passw">Contraseña</label><br>
            <input type="password" name="passw" id="passw" placeholder="**********"
                value="<?php if(isset($passw)){ echo $passw; } ?>" required><br>
            <label for="descp">Cuentanos, ¿Quién eres?</label><br>
            <textarea name="descp" id="descp" cols="20" rows="3" placeholder="Tu descripción" maxlength="180"
                required></textarea><br>
            <label for="foto">Selecciona tu foto de perfil</label><br>
            <input type="file" name="foto" id="foto" required><br>
            <input type="hidden" id="tipo" name="tipo" value="t">
            <div class="redes">
                <label for="facebook"><i class="fab fa-facebook"></i></label>
                <input type="url" name="facebook" id="facebook" value="<?php if(isset($facebook)){ echo $facebook; } ?>"
                    placeholder="Link hacia tu Facebook">
                <label for="twitter"><i class="fab fa-twitter"></i></label>
                <input type="url" name="twitter" id="twitter" value="<?php if(isset($twitter)){ echo $twitter; } ?>"
                    placeholder="Link hacia tu Twitter">
                <label for="instagram"><i class="fab fa-instagram"></i></label>
                <input type="url" name="instagram" id="instagram"
                    value="<?php if(isset($instagram)){ echo $instagram; } ?>" placeholder="Link hacia tu Instagram">
            </div>
            <p class="aclaCoords">Dinos donde te encuentras</p>
            <div class="ubicacion">
                <div class="coords">
                    <input type="number" name="lat" id="lat" placeholder="Latitud" required>
                    <input type="number" name="lng" id="lng" placeholder="Longitud" required>
                </div>
            </div>
            <p class="text-muted">Recuerda que esta información la puedes obtener de Google Maps</p>
            <input class="button btn btn-outline-dark" type="submit" name="submit" value="Registrarse"></input>

        </form>
    </div>

    <script type="text/javascript">
    var onloadCallback = function() {
        alert("grecaptcha is ready!");
    };
    </script>

    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LfYV78aAAAAAP8uvITsCHsBHC8HrUTWmIg6JOlB"></script>
</body>

</html>