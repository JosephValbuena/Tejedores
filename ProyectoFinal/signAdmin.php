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
        <h1>Registrarse</h1>
        <form action="Backend/signup.php" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" placeholder="Jose Posada" required><br>
            <label for="correo">Correo Electrónico</label><br>
            <input type="email" name="correo" id="correo" placeholder="Jose@example.com" required><br>
            <label for="passw">Contraseña</label><br>
            <input type="password" name="passw" id="passw" placeholder="**********" required><br>
            <label for="descp">Cuentanos, ¿Quién eres?</label><br>
            <textarea name="descp" id="descp" cols="20" rows="3" placeholder="Tu descripción" maxlength="180" required></textarea><br>
            <label for="foto">Selecciona tu foto de perfil</label><br>
            <input type="file" name="foto" id="foto" required><br>
            <input type="hidden" id="tipo" name="tipo" value="a">
            <div class="redes">
                <label for="facebook"><i class="fab fa-facebook"></i></label>
                <input type="url" name="facebook" id="facebook" placeholder="Link hacia tu Facebook">
                <label for="twitter"><i class="fab fa-twitter"></i></label>
                <input type="url" name="twitter" id="twitter" placeholder="Link hacia tu Twitter">
                <label for="instagram"><i class="fab fa-instagram"></i></label>
                <input type="url" name="instagram" id="instagram" placeholder="Link hacia tu Instagram">
            </div>
            <button class="button btn btn-outline-dark" type="submit">Registrarse</button>
        </form>
    </div>
</body>

</html>