<?php

    include('conectar.php');

    $message = '';

    if(!empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['passw']) && !empty($_POST['descp'])){

        $query= "INSERT INTO usuarios(tipo,nombre,correo,contraseña,descp,foto,facebook,twitter,instagram,fechaUnion) values (?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($stmt,'ssssssssss',$tipo,$nombre,$correo,$password,$descp,$foto,$facebook,$twitter,$instagram,$fecha);

        $tipo = mysqli_real_escape_string($conn,$_POST['tipo']); 
        $nombre = mysqli_real_escape_string($conn,$_POST['nombre']);
        $correo = mysqli_real_escape_string($conn,$_POST['correo']);
        $password = password_hash($_POST['passw'],PASSWORD_BCRYPT);
        $descp = mysqli_real_escape_string($conn,$_POST['descp']);
        $foto = $_FILES['foto']['name'];
        $facebook = mysqli_real_escape_string($conn,$_POST['facebook']);
        $twitter = mysqli_real_escape_string($conn,$_POST['twitter']);
        $instagram = mysqli_real_escape_string($conn,$_POST['instagram']);
        $fecha = date("d-m-Y");
        $tipoimg = $_FILES['foto']['type'];
        $temp = $_FILES['foto']['tmp_name'];
        // $secret_key = '6LfYV78aAAAAACaAtmtROvbMPuYCzTZnSiPBL7jO';
        // $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key. '&response='.$_POST['g-recaptcha-response']);
        // $response_data = json_decode($response);

            
        if(mysqli_stmt_execute($stmt)){
            if(isset($foto) && $foto !=""){
                move_uploaded_file($temp,'imagenes/usuarios/'.$foto);
                header('location:/ProyectoFinal/');
            }      
        }else{
            $message = 'Ocurrió un eror';
        }

        mysqli_stmt_close($stmt);
    }

?>

<!-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(!empty($message)):?>
        <p><?php=$message ?></p>
    <?php endif; ?>
</body>
</html> -->