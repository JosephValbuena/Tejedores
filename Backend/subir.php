<?php
    session_start();
    include('conectar.php');
    $mensaje = '';
    if(isset($_POST['subirTejido'])){
        if(isset($_SESSION['user_id'])){
            $userId = $_SESSION['user_id'];
            $titulo =$_POST['titulo'];
            $descp =$_POST['descp'];
            $precio =$_POST['precio'];
            $imagen = $_FILES['imagenes']['name'];
            $fecha = date("d-m-Y");
    
            if(isset($imagen) && $imagen != ""){
                $tipo = $_FILES['imagenes']['type'];
                $temp = $_FILES['imagenes']['tmp_name'];
    
                if( !((strpos($tipo,'gif') || strpos($tipo,'jpeg') || strpos($tipo,'webp')))){
                   $_SESSION['mensaje'] = 'solo se permite archivos jpeg, gif, webp';
                   header('location:../subirTejido.php'); 
                }else{
                    $query = "INSERT INTO tejido(idPubli,id_user,titulo,descp,precio,ImagenTejido,fechaP) values ('','$userId','$titulo','$descp','$precio','$imagen','$fecha')";
                    $resultado = mysqli_query($conn,$query);
    
                    if($resultado){
                        move_uploaded_file($temp,'imagenes/publicaciones/'.$imagen);
                        
                        $enviar = mysqli_query($conn,"SELECT * FROM usuarios WHERE id = '$userId'");
                        $enviarFetch = mysqli_fetch_array($enviar,MYSQLI_ASSOC);

                        if($enviarFetch['tipo'] == 't'){
                            header('location:../visualPrincipal/vTejedor.php');
                        }else if($enviarFetch['tipo'] == 'a'){
                            header('location:../visualPrincipal/vAdmin.php');
                        }

                        
                    }else{ 
                    }
                }
            }
        }
        
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(!empty($mensaje)):?>
        <p><?=$mensaje?></p>
    <?php endif?>
</body>
</html>