<?php
    session_start();
    include('conectar.php');
    $mensaje = '';
    if(isset($_POST['subirTejido'])){
        if(isset($_SESSION['user_id'])){
            

            $userId = mysqli_real_escape_string($conn,$_SESSION['user_id']);
            $titulo =mysqli_real_escape_string($conn,$_POST['titulo']);
            $descp =mysqli_real_escape_string($conn,$_POST['descp']);
            $precio =mysqli_real_escape_string($conn,$_POST['precio']);
            $imagen = mysqli_real_escape_string($conn,$_FILES['imagenes']['name']);
            $fecha = date("d-m-Y");

           
            if(isset($imagen) && $imagen != ""){
                $tipo = $_FILES['imagenes']['type'];
                $temp = $_FILES['imagenes']['tmp_name'];
        
                if( !((strpos($tipo,'gif') || strpos($tipo,'jpeg') || strpos($tipo,'webp')))){
                $_SESSION['mensaje'] = 'solo se permite archivos jpeg, gif, webp';
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