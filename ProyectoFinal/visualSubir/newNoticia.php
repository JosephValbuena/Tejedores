<?php
    session_start();
    include('../Backend/conectar.php');
    $idAdmin = $_SESSION['user_id'];
    $fecha = date("Y-m-d H:i:s");
    if(isset($_POST['enviar'])){
        $seleccion = $_POST['tipoNoticia'];
        if($seleccion == 'confoto'){
            $tipo = "cf";
            if($_FILES['imagen']['name'] == ""){
                $mensaje = "No ha seleccionado una foto";
            }else{
                $imagen = $_FILES['imagen']['name'];
                $tipoimg = $_FILES['imagen']['type'];
                $temp = $_FILES['imagen']['tmp_name'];
                if(!((strpos($tipoimg,'gif') || strpos($tipoimg,'jpeg') || strpos($tipoimg,'webp') || strpos($tipoimg,'png')))){
                    $mensaje = "El tipo del archivo no es el indicado";
                }else{
                    if(isset($_POST['titulo'])){
                        $titulo = $_POST['titulo'];
                        if(isset($_POST['texto'])){
                        
                            $texto = $_POST['texto'];
                            $nuevaN = mysqli_query($conn, "INSERT INTO noticias (idAdmin, tipo, titulo, imagen, noticia, fechaP) VALUES ('$idAdmin','$tipo','$titulo','$imagen','$texto','$fecha')");
                            if($nuevaN){
                                move_uploaded_file($temp,'../Backend/imagenes/noticias/'.$imagen);
                                header('Location: ../visualesSecundarias/noticias.php');
                            }
                        }
                    }else{
                        $mensaje = 'no ha colocado un titulo para la noticia';
                    }
                    
                }  
            }
        }else if($seleccion == 'sinfoto'){
            $tipo = "sf";
            if(isset($_POST['titulo'])){
                $titulo = $_POST['titulo'];
                if(isset($_POST['texto'])){
                    $texto = $_POST['texto'];
                    $nuevaN = mysqli_query($conn, "INSERT INTO noticias (idAdmin, tipo,titulo,noticia, fechaP) VALUES ('$idAdmin','$tipo','$titulo,'$texto','$fecha')");
                    if($nuevaN){
                        header('Location: ../visualesSecundarias/noticias.php');
                    }
    
                }else{
                    $mensaje = "No ha puesto ninguna noticia";
                }
            }else{
                $mensaje = 'no ha colocado un titulo para la noticia';
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
    <title>Nueva Noticia</title>
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="../assets/css/newN.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- FontAwesome-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body class="body">
    <div class="header">
        <i class="fas fa-handshake"></i>
        <p>ARTESANIX</p>
    </div>
    <div class="content">
        <h1>Nueva Noticia</h1>
        <div class="formulario">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method="POST" enctype="multipart/form-data">
                <label class="mb-2">Seleccione el tipo de noticia</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipoNoticia" id="tipoN1" value="confoto" checked>
                    <label class="form-check-label radios" for="flexRadioDefault1">
                        Noticia con foto
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipoNoticia" value="sinfoto" id="tipoN2">
                    <label class="form-check-label radios" for="flexRadioDefault2">
                        Noticia sin foto
                    </label>
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Seleccione una imagen</label>
                    <input class="form-control" type="file" id="imagen" name="imagen">
                </div>

                <div class="mb-3">
                    <label for="titulo">Digite el titulo de la noticia</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Escriba la noticia</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="texto" rows="3" required></textarea>
                </div>

                <div class="d-grid gap-2 mb-3">
                    <input type="submit" name="enviar" class="btn btn-primary" value="Publicar Noticia">
                </div>

                <?php 
                    if(isset($mensaje)){
                        echo $mensaje;
                    }
                ?>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>