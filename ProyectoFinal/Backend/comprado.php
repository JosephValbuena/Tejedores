<?php
    session_start();
    include('conectar.php');
    if(isset($_POST['comprado'])){
        $publicacion = $_POST['idComprado'];
        $obtUsuario = mysqli_query($conn,"SELECT * FROM usuarios WHERE id = '$_SESSION[user_id]'");
        $tipoFetch =  mysqli_fetch_array($obtUsuario, MYSQLI_ASSOC);
        $tipo = $tipoFetch['tipo'];
        $comprado = mysqli_query($conn, "UPDATE tejido SET estado = 1 WHERE idPubli = '$publicacion'");
        if($comprado){
            if($tipo == 'a'){
                header('Location: /ProyectoFinal/visualPrincipal/vAdmin.php');
            }else if($tipo == 't'){
                header('Location: /ProyectoFinal/visualPrincipal/vTejedor.php');
            }
        }else{
            echo mysqli_error($conn);
        }
    }
?>