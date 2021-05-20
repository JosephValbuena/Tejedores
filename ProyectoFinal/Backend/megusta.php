<?php
    session_start();
    include('conectar.php');

    $post = mysqli_real_escape_string($conn,$_POST['id']);
    
    $usuario = $_SESSION['user_id'];
    $fecha = date("Y-m-d H:i:s");

    $comprobar = mysqli_query($conn, "SELECT * FROM megusta WHERE idPubli = '".$post."'AND id_user = ".$usuario."");
    $count = mysqli_num_rows($comprobar);

    //obtener información del dueño de la publicacion
    $tejido = mysqli_query($conn, "SELECT * FROM tejido WHERE idPubli = '$post'");
    $tejidoFetch = mysqli_fetch_array($tejido, MYSQLI_ASSOC);
    $dueño = mysqli_query($conn, "SELECT * FROM usuarios WHERE id= '".$tejidoFetch['id_user']."'");
    $dueñoFetch = mysqli_fetch_array($dueño, MYSQLI_ASSOC);
    $idDueño = $dueñoFetch['id'];

    if($count == 0){
        $insert = mysqli_query($conn,"INSERT INTO megusta (idPubli,id_user,fecha) VALUES ('$post','$usuario','$fecha')");
        $update = mysqli_query($conn,"UPDATE tejido SET likes = likes+1 WHERE idPubli = '".$post."'");
        $notificaciones = mysqli_query($conn,"INSERT INTO notificaciones (user1, user2, tipo, leido, fecha, idPubli) VALUES ('$usuario','$idDueño','ha dado me gusta','0','$fecha','$post')");
    }else{
        $delete = mysqli_query($conn,"DELETE FROM megusta WHERE idPubli = ".$post." AND id_user = ".$usuario."");
        $update = mysqli_query($conn,"UPDATE tejido SET likes = likes-1 WHERE idPubli = '".$post."'");
    }

    $contar = mysqli_query($conn,"SELECT likes FROM tejido WHERE idPubli =".$post."");
    $cont = mysqli_fetch_array($contar,MYSQLI_ASSOC);
    $likes = $cont['likes'];

    if($count>= 1){
        $megusta = "<i class='fas fa-thumbs-up'> Me gusta";
        $likes = " (".$likes++.")";
    }else{
        $megusta = "<i class='fas fa-thumbs-down'> No me gusta";
        $likes = " (".$likes--.")";
    }

    $datos = array('likes' =>$likes,'text' =>$megusta);

    echo json_encode($datos);

?>