<?php
    include('conectar.php');

    if(isset($_POST['subirTejido'])){
        $titulo =$_POST['titulo'];
        $descp =$_POST['descp'];
        $precio =$_POST['precio'];
        $imagen = $_FILES['imagenes']['name'];

        

        if(isset($imagen) && $imagen != ""){
            $tipo = $_FILES['imagenes']['type'];
            $temp = $_FILES['imagenes']['tmp_name'];

            if( !((strpos($tipo,'gif') || strpos($tipo,'jpeg') || strpos($tipo,'webp')))){
               $_SESSION['mensaje'] = 'solo se permite archivos jpeg, gif, webp';
               header('location:../subirTejido.php'); //direción relativa no absoluta, puede dar errores en algunos navegadores
            }else{
                $query = "INSERT INTO tejido(titulo,descp,precio,ImagenTejido,tipo,idUsuario) values ('$titulo','$descp','$precio','$imagen',1,1)";
                $resultado = mysqli_query($conn,$query);

                if($resultado){
                    move_uploaded_file($temp,'imagenes/'.$imagen);
                    $_SESSION['mensaje'] = 'se ha subido correctamente';
                    header('location:../visualPrincipal/vTejedor.php');
                }else{
                    $_SESSION['mensaje'] = 'Ocurrió un error'; 
                }
            }
        }
    }
?>