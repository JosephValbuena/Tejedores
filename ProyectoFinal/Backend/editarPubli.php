<?php

    session_start();
    include('conectar.php');

    if(isset($_POST['idPublicacionN'])){

        $idPersona = $_SESSION['user_id'];
        $tipo = mysqli_query($conn,"SELECT tipo FROM usuarios WHERE id = '$idPersona'");
        $tipoF = mysqli_fetch_array($tipo, MYSQLI_ASSOC);

        if(!empty($_POST['tituloN']) && !empty($_POST['descpN']) && !empty($_POST['precioN'])){
            $tituloN = mysqli_real_escape_string($conn,$_POST['tituloN']);
            $descpN = mysqli_real_escape_string($conn,$_POST['descpN']);
            $precioN = mysqli_real_escape_string($conn,$_POST['precioN']);
            mysqli_query($conn,"UPDATE tejido SET titulo='$tituloN', descp='$descpN', precio='$precioN' WHERE idPubli='".$_POST['idPublicacionN']."'");
            if($tipoF['tipo'] == 't'){
                header('Location: /ProyectoFinal/visualPrincipal/vTejedor.php');
            }else if($tipoF['tipo'] == 'a'){
                header('Location: /ProyectoFinal/visualPrincipal/vAdmin.php');
            }
        }else if(!empty($_POST['tituloN']) && !empty($_POST['descpN']) && empty($_POST['precioN'])){
            $tituloN = mysqli_real_escape_string($conn,$_POST['tituloN']);
            $descpN = mysqli_real_escape_string($conn,$_POST['descpN']);
            mysqli_query($conn,"UPDATE tejido SET titulo='$tituloN', descp='$descpN' WHERE idPubli='".$_POST['idPublicacionN']."'");
            if($tipoF['tipo'] == 't'){
                header('Location: /ProyectoFinal/visualPrincipal/vTejedor.php');
            }else if($tipoF['tipo'] == 'a'){
                header('Location: /ProyectoFinal/visualPrincipal/vAdmin.php');
            }
        }else if(!empty($_POST['tituloN']) && !empty($_POST['precioN']) && empty($_POST['descpN'])){
            $tituloN = mysqli_real_escape_string($conn,$_POST['tituloN']);
            $precioN = mysqli_real_escape_string($conn,$_POST['precioN']);
            mysqli_query($conn,"UPDATE tejido SET titulo='$tituloN', precio='$precioN' WHERE idPubli='".$_POST['idPublicacionN']."'");
            if($tipoF['tipo'] == 't'){
                header('Location: /ProyectoFinal/visualPrincipal/vTejedor.php');
            }else if($tipoF['tipo'] == 'a'){
                header('Location: /ProyectoFinal/visualPrincipal/vAdmin.php');
            }
        }else if(empty($_POST['tituloN']) && !empty($_POST['precioN']) && !empty($_POST['descpN'])){
            $descpN = mysqli_real_escape_string($conn,$_POST['descpN']);
            $precioN = mysqli_real_escape_string($conn,$_POST['precioN']);
            mysqli_query($conn,"UPDATE tejido SET descp='$descpN', precio='$precioN' WHERE idPubli='".$_POST['idPublicacionN']."'");
            if($tipoF['tipo'] == 't'){
                header('Location: /ProyectoFinal/visualPrincipal/vTejedor.php');
            }else if($tipoF['tipo'] == 'a'){
                header('Location: /ProyectoFinal/visualPrincipal/vAdmin.php');
            }
        }else if(!empty($_POST['tituloN'])){
            $tituloN = mysqli_real_escape_string($conn,$_POST['tituloN']);
            mysqli_query($conn,"UPDATE tejido SET titulo='$tituloN' WHERE idPubli='".$_POST['idPublicacionN']."'");
            if($tipoF['tipo'] == 't'){
                header('Location: /ProyectoFinal/visualPrincipal/vTejedor.php');
            }else if($tipoF['tipo'] == 'a'){
                header('Location: /ProyectoFinal/visualPrincipal/vAdmin.php');
            }
        }else if(!empty($_POST['descpN'])){
            $descpN = mysqli_real_escape_string($conn,$_POST['descpN']);
            mysqli_query($conn,"UPDATE tejido SET descp='$descpN' WHERE idPubli='".$_POST['idPublicacionN']."'");
            if($tipoF['tipo'] == 't'){
                header('Location: /ProyectoFinal/visualPrincipal/vTejedor.php');
            }else if($tipoF['tipo'] == 'a'){
                header('Location: /ProyectoFinal/visualPrincipal/vAdmin.php');
            }
        }else if(!empty($_POST['precioN'])){
            $precioN = mysqli_real_escape_string($conn,$_POST['precioN']);
            mysqli_query($conn,"UPDATE tejido SET precio='$precioN' WHERE idPubli='".$_POST['idPublicacionN']."'");
            if($tipoF['tipo'] == 't'){
                header('Location: /ProyectoFinal/visualPrincipal/vTejedor.php');
            }else if($tipoF['tipo'] == 'a'){
                header('Location: /ProyectoFinal/visualPrincipal/vAdmin.php');
            }
        }
    }

?>