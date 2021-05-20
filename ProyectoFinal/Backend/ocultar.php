<?php
    session_start();
    include('conectar.php');

    $id = $_POST['idPublic'];
    $admin = $_SESSION['user_id'];
    //$tipo = mysqli_query($conn, "SELECT tipo FROM usuarios WHERE id = '$admin'");

    $publicacion = mysqli_query($conn, "SELECT * FROM tejido WHERE idPubli = '$id'");

    if($publicacion){
        $publiFetch = mysqli_fetch_array($publicacion, MYSQLI_ASSOC);

        $idUser = $publiFetch['id_user'];
        $titulo = $publiFetch['titulo'];
        $descp = $publiFetch['descp'];
        $precio = $publiFetch['precio'];
        $imagen = $publiFetch['ImagenTejido'];
        $fecha = $publiFetch['fechaP'];
        $likes = $publiFetch['likes'];
        $estado = $publiFetch['estado'];
        $fechah = date("Y-m-d H:i:s");
    
        $ocultar = mysqli_query($conn, "INSERT INTO tejidosocultos (idPubli,id_user,titulo,descp,precio,ImagenTejido,fechaP,likes,estado) VALUES ('$id','$idUser','$titulo','$descp','$precio','$imagen','$fecha','$likes','$estado')");
        
        $delete = mysqli_query($conn, "DELETE FROM tejido WHERE idPubli = '$id'");

            if($delete){
                $insert2 = mysqli_query($conn,"INSERT INTO notificaciones (user1, user2, tipo, leido, fecha, idPubli) VALUES ('$admin','$idUser','ha ocultado una publicación, comunicate con él para más info','0','$fechah','$id')");

                header('/ProyectoFinal/viualPrincipal/vAdmin.php');

            }
    }

?>