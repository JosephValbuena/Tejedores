<?php
    session_start();
    include('conectar.php');

    $id1 = $_POST['idPersona3'];

    if(isset($id)){
        $vetado = mysqli_query($conn, "SELECT * FROM vetados WHERE id = '$id1'");
        $vetadoFetch = mysqli_fetch_array($vetado, MYSQLI_ASSOC);

        $id = $vetadoFetch['id'];
        $tipo = $vetadoFetch['tipo'];
        $nombre =$vetadoFetch['nombre'];
        $correo = $vetadoFetch['correo'];
        $contraseña = $vetadoFetch['contraseña'];
        $descp = $vetadoFetch['descp'];
        $foto = $vetadoFetch['foto'];
        $facebook = $vetadoFetch['facebook'];
        $twitter = $vetadoFetch['twitter'];
        $instragram =$vetadoFetch['instagram'];
        $fecha = $vetadoFetch['fechaUnion'];

        $pasar = mysqli_query($conn, "INSERT INTO usuarios (id, tipo, nombre, correo, contraseña, descp, foto, facebook, twitter, instagram, fechaUnion) VALUES ('$id', '$tipo', '$nombre', '$correo', '$contraseña', '$descp', '$foto', '$facebook', '$twitter', '$instragram', '$fecha')");

        if($pasar){
            $eliminar = mysqli_query($conn, "DELETE * FROM vetados WHERE id = '$id1'");
            header('Location: /ProyectoFinal/visualesSecundarias/vetados.php');
            
        }else{
            echo "Ha ocurrido un error";
        }
    }

?>