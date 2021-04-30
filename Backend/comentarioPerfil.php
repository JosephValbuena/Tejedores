<?php
    session_start();
    include('../Backend/conectar.php');

    $usuario = mysqli_real_escape_string($conn,$_POST['usuario']);
    $comentario = mysqli_real_escape_string($conn,$_POST['comentario']);
    $perfil = mysqli_real_escape_string($conn,$_POST['perfil']);
    $fecha = date("Y-m-d H:i:s");

    $insert = mysqli_query($conn,"INSERT INTO comenperfil (usuario,comentario, fecha, perfil) VALUES ('$usuario','$comentario','$fecha','$perfil')");

    // $llamado = mysqli_query($conn, "SELECT * From tejido WHERE idPubli = '".$publicacion."'");
    // $ll = mysqli_fetch_array($llamado,MYSQLI_ASSOC);

    // $usuario2 = mysqli_real_escape_string($conn,$ll['id_user']);

    // $insert2 = mysqli_query($conn,"INSERT INTO notificaciones (user1, user2, tipo, leido, fecha, idPubli) VALUES ('$usuario','$usuario2','ha comentado','0','$fecha','$publicacion')");


?>