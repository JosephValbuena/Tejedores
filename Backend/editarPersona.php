<?php

    session_start();
    include('conectar.php');

    if(isset($_POST['idPersona'])){
        if(!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['descp'])){
            $nombre = mysqli_real_escape_string($conn,$_POST['nombre']);
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $descp = mysqli_real_escape_string($conn,$_POST['descp']);
            mysqli_query($conn,"UPDATE usuarios SET nombre='$nombre', correo='$email', descp='$descp' WHERE id='".$_POST['idPersona']."'");
            header('Location: /ProyectoFinal/visualesSecundarias/lista.php');
        }else if(!empty($_POST['nombre']) && !empty($_POST['email']) && empty($_POST['descp'])){
            $nombre = mysqli_real_escape_string($conn,$_POST['nombre']);
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            mysqli_query($conn,"UPDATE usuarios SET nombre='$nombre', correo='$email' WHERE id='".$_POST['idPersona']."'");
            header('Location: /ProyectoFinal/visualesSecundarias/lista.php');
        }else if(!empty($_POST['nombre']) && !empty($_POST['descp']) && empty($_POST['email'])){
            $nombre = mysqli_real_escape_string($conn,$_POST['nombre']);
            $descp = mysqli_real_escape_string($conn,$_POST['descp']);
            mysqli_query($conn,"UPDATE usuarios SET nombre='$nombre', descp='$descp' WHERE id='".$_POST['idPersona']."'");
            header('Location: /ProyectoFinal/visualesSecundarias/lista.php');
        }else if(empty($_POST['nombre']) && !empty($_POST['descp']) && !empty($_POST['email'])){
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $descp = mysqli_real_escape_string($conn,$_POST['descp']);
            mysqli_query($conn,"UPDATE usuarios SET correo='$email', descp='$descp' WHERE id='".$_POST['idPersona']."'");
            header('Location: /ProyectoFinal/visualesSecundarias/lista.php');
        }else if(!empty($_POST['nombre'])){
            $nombre = mysqli_real_escape_string($conn,$_POST['nombre']);
            mysqli_query($conn,"UPDATE usuarios SET nombre='$nombre' WHERE id='".$_POST['idPersona']."'");
            header('Location: /ProyectoFinal/visualesSecundarias/lista.php');
        }else if(!empty($_POST['email'])){
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            mysqli_query($conn,"UPDATE usuarios SET correo='$email' WHERE id='".$_POST['idPersona']."'");
            header('Location: /ProyectoFinal/visualesSecundarias/lista.php');
        }else if(!empty($_POST['descp'])){
            $descp = mysqli_real_escape_string($conn,$_POST['descp']);
            mysqli_query($conn,"UPDATE usuarios SET descp='$descp' WHERE id='".$_POST['idPersona']."'");
            header('Location: /ProyectoFinal/visualesSecundarias/lista.php');
        }
    }

?>