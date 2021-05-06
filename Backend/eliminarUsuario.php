<?php
    session_start();
    include('conectar.php');

    $id = $_POST['idPersona2'];

    $consultar = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = '$id'");
    $consultFetch = mysqli_fetch_array($consultar, MYSQLI_ASSOC);

    /* Obteniendo datos para vetarlo */
    
    $id = $consultFetch['id'];
    $tipo = $consultFetch['tipo'];
    $nombre = $consultFetch['nombre'];
    $correo = $consultFetch['correo'];
    $contraseña = $consultFetch['contraseña'];
    $descp = $consultFetch['descp'];
    $foto = $consultFetch['foto'];
    $facebook = $consultFetch['facebook'];
    $twitter = $consultFetch['twitter'];
    $instragram = $consultFetch['instagram'];
    $fecha = $consultFetch['fechaUnion'];

    /*Pasar el usuario a usuarios vetados */
    $vetar = mysqli_query($conn, "INSERT INTO vetados (id, tipo, nombre, correo, contraseña, descp, foto, facebook, twitter, instagram, fechaUnion) VALUES ('$id', '$tipo', '$nombre', '$correo', '$contraseña', '$descp', '$foto', '$facebook', '$twitter', '$instragram', '$fecha')");

    if($vetar){
        $eliminar = mysqli_query($conn,"DELETE FROM usuarios WHERE id= '$id' ");
        if($eliminar){
            header('Location: /ProyectoFinal/visualesSecundarias/lista.php');
        }else{
            echo "El error está en el query", mysqli_error($conn);
        }
    }else{
        echo "El error está en el query de vetar", mysqli_error($conn);
    }

    
    
?>