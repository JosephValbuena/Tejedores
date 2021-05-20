<?php

include('conectar.php');

    $id = $_POST['id'];
    $consultar = mysqli_query($conn, "SELECT * FROM tejido WHERE idPubli = '$id'");
    
    if($consultar){
        $conFetch = mysqli_fetch_array($consultar, MYSQLI_ASSOC);
        $titulo = $conFetch['titulo'];
        $imagen  = $conFetch['ImagenTejido'];
        $descp = $conFetch['descp'];
        $precio = $conFetch['precio'];
        $datos = array('titulo' => $titulo, 'imagen' => $imagen, 'descp' => $descp, 'precio' => $precio);
        echo json_encode($datos);

    }else{
        echo mysqli_error($conn);
    }
?>