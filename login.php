<?php

    session_start();
    
    include('Backend/conectar.php');
    

    if(!empty($_POST['email']) && !empty($_POST['passw'])){
        $query = "select id,tipo, correo, contraseña from usuarios where correo=?";
        $records = mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($records,'s',$_POST['email']);
        mysqli_stmt_execute($records);
        $stmtRes= mysqli_stmt_get_result($records);
        $results = mysqli_fetch_array($stmtRes, MYSQLI_ASSOC);

        $message = '';
        
        if(count($results)>0 && password_verify($_POST['passw'], $results['contraseña'])){
            $_SESSION['user_id'] = $results['id'];  
            $tipo = $results['tipo'];
            if($tipo == 'c'){
                header('location:/ProyectoFinal/visualPrincipal/vConsumidor.php');
            }else if($tipo == 't'){
                header('location:/ProyectoFinal/visualPrincipal/vTejedor.php');
            } else if($tipo == 'a'){
                header('location:/ProyectoFinal/visualPrincipal/vAdmin.php');
            }   

        }else{
            $message = 'Lo sentimos, tus credenciales no coinciden';
        }
    }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!--Custom CSS-->
    <link rel="stylesheet" href="assets/css/login.css">
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

    <?php if(!empty($message)) :?>
        <p style="color: white;"><?= $message?></p>
    <?php endif?>

    <div class="content">
        <form action="login.php" method="POST">
            <h1>Iniciar Sesión</h1>
            <input type="email" name="email" id="email" placeholder="Correo Electrónico"><br>
            <input type="password" name="passw" id="passw" placeholder="Contraseña"><br>
            <button class="button btn btn-warning">Ingresar</button>
        </form>
    </div>

</body>

</html>