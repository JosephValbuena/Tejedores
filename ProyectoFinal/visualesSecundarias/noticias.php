<?php

    session_start();
    include('../Backend/conectar.php');

    $noticias = mysqli_query($conn,"SELECT * FROM noticias ORDER BY idNoticia desc");
    
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sección Noticias</title>
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body class="body">
    <div class="row">
        <?php
            include ('../Backend/sidebar.php');
        ?>
        <div class="col-8">
            <h2 class="text-center ndeldia">Noticias del día</h2>
            <?php foreach($noticias as $row){
                $idAdmin = $row['idAdmin'];
                $datosAdmin = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = '$idAdmin'");
                $daFetch = mysqli_fetch_array($datosAdmin,MYSQLI_ASSOC);
   
            ?>
            <?php if($row['tipo']== "cf"){ ?>
            <div class="card cardcf mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="../Backend/imagenes/noticias/<?=$row['imagen']?>" class="imagencf"
                            alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="infoAdminN">
                                <img src="../Backend/imagenes/usuarios/<?=$daFetch['foto']?>" alt=""
                                    class="imagenNoti">
                                <p class="card-text"><?=$daFetch['nombre']?></p>
                            </div>
                            <hr>
                            <h4 class="card-title"><?=$row['titulo']?></h4>
                            <p class="card-text"><?=$row['noticia']?></p>
                            <p class="card-text"><small class="text-muted">fecha de Publicacion:
                                    <?=$row['fechaP']?></small></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php }else{ ?>
            <div class="card cardcf mb-3">
                <div class="card-header infoAdminN">
                    <img src="../Backend/imagenes/usuarios/<?=$daFetch['foto']?>" alt="" class="imagenNoti">
                    <p class="card-text"><?=$daFetch['nombre']?></p>
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?=$row['titulo']?></h4>
                    <p class="card-text"><?=$row['noticia']?></p>
                    <p class="card-text text-muted"><?=$row['fechaP']?></p>
                </div>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../assets/js/scr.js"></script>
</body>

</html>