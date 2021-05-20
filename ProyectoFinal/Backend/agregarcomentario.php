<?php
    session_start();
    include('../Backend/conectar.php');

    $usuario = mysqli_real_escape_string($conn,$_POST['usuario']);
    $comentario = mysqli_real_escape_string($conn,$_POST['comentario']);
    $publicacion = mysqli_real_escape_string($conn,$_POST['publicacion']);
    $fecha = date("Y-m-d H:i:s");

    $insert = mysqli_query($conn,"INSERT INTO comentarios (usuario,comentario, fecha, publicacion) VALUES ('$usuario','$comentario','$fecha','$publicacion')");

    $llamado = mysqli_query($conn, "SELECT * From tejido WHERE idPubli = '".$publicacion."'");
    $ll = mysqli_fetch_array($llamado,MYSQLI_ASSOC);

    $usuario2 = mysqli_real_escape_string($conn,$ll['id_user']);

    $insert2 = mysqli_query($conn,"INSERT INTO notificaciones (user1, user2, tipo, leido, fecha, idPubli) VALUES ('$usuario','$usuario2','ha comentado','0','$fecha','$publicacion')");


    //resetear

    // $obtener = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = '$usuario'");
    // $obFetch = mysqli_fetch_assoc($obtener);
    
    // if($obFetch['tipo'] == 'a'){
    //     header("Location: ../VisualPrincipal/vAdmin.php");
    // }else if($obFetch['tipo'] == 't'){
    //     header("Location: ../VisualPrincipal/vTejedor.php");
    // }else if($obFetch['tipo' == 'c']){
    //     header("Location: ../VisualPrincipal/vConsumidor.php");
    // }


?>