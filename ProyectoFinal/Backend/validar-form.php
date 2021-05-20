<?php

    include('conectar.php');

    if(isset($_POST['submit'])){
        $flag = true;
        if(empty($nombre)){
            $flag = false;
            echo '<div class="alert alert-danger" role="alert"><li>No ha escrito un nombre</li></div>';
            
        }else {
            if(strlen($nombre)>10){
                $flag = false;
                echo '<div class="alert alert-danger" role="alert"><li>Ingresaste un nombre muy largo</li></div>';
            }
        }

        if(empty($correo)){
            $flag = false;
            echo '<div class="alert alert-danger" role="alert"><li>No ha escrito un correo</li></div>';
            
        }else{
            if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
                $flag = false;
                echo '<div class="alert alert-danger" role="alert"><li>El correo es incorrecto</li></div>';
                
            }

            $verifCorreo = mysqli_query($conn, "SELECT * FROM usuarios");
            while($correoFetch = mysqli_fetch_array($verifCorreo, MYSQLI_ASSOC)){
                if($correo == $correoFetch['correo']){
                    $flag = false;
                    echo '<div class="alert alert-danger" role="alert"><li>Ya existe una cuenta registrada con ese correo</li></div>';
                    break;
                }
            }
        }

        if(empty($passw)){
            $flag = false;
            echo '<div class="alert alert-danger" role="alert"><li>No ha escrito una contraseña</li></div>';
            
        }else{
            if(strlen($passw) <6){
                $flag = false;
                echo '<div class="alert alert-danger" role="alert"><li>La contraseña debe tener al menos 6 caracteres</li></div>';
            }

            if(strlen($passw)>16){
                $flag = false;
                echo '<div class="alert alert-danger" role="alert"><li>La contraseña no debe sobrepasr más de 16 caracteres</li></div>';
            }

            if(!preg_match('`[a-z]`',$passw)){
                $flag = false;
                echo '<div class="alert alert-danger" role="alert"><li>La contraseña debe contener al menos una minúscula</li></div>';
            }

            if(!preg_match('`[A-Z]`',$passw)){
                $flag = false;
                echo '<div class="alert alert-danger" role="alert"><li>La contraseña debe contener al menos una mayúscula</li></div>';
            }

            if(!preg_match('`[0-9]`',$passw)){
                $flag = false;
                echo '<div class="alert alert-danger" role="alert"><li>La contraseña debe contener al menos un número</li></div>';
            }
        }
        if(empty($descp)){
            $flag = false;
            echo '<div class="alert alert-danger" role="alert"><li>No ha escrito una descripción</li></div>';
        }else{
            if(!filter_var($descp, FILTER_SANITIZE_STRING)){
                $flag = false;
                echo '<div class="alert alert-danger" role="alert"><li>Ha escrito caracteres invalidos en la descripción ($,%,&, etc)</li></div>';
            }
        }
        if(empty($foto)){
            $flag = false;
            echo '<div class="alert alert-danger" role="alert"><li>No ha puesto una foto de perfil</li></div>';
        }else{
            if(!((strpos($tipoimg,'gif') || strpos($tipoimg,'jpeg') || strpos($tipoimg,'webp')))){
                $flag = false;
                echo '<div class="alert alert-danger" role="alert"><li>El tipo de archivo solo debe ser .gif, .jpeg o .webp</li></div>';
            }
        }

        if($flag==true){
            $fecha = date("d-m-Y");
            $newUser = mysqli_query($conn, "INSERT INTO usuarios(tipo,nombre,correo,contraseña,descp,foto,facebook,twitter,instagram,fechaUnion,latitud, longitud) VALUES ('$tipo','$nombre','$correo','$passw','$descp','$foto','$facebook','$twitter','$instagram','$fecha','$latitud','$longitud')");

            if($newUser){
                move_uploaded_file($temp,'imagenes/usuarios/'.$foto);
                header('location:/ProyectoFinal/');
            }
        }

    }

?>