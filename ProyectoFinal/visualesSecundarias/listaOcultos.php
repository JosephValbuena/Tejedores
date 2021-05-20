<?php
    session_start();
    include('../Backend/conectar.php');

    $lista = mysqli_query($conn, "SELECT * FROM tejidosocultos");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de publicaciones</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/estilo.css">
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
            <?php foreach($lista as $row){ 

                $idPer = $row['id_user'];
                $persona = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = '$idPer'");
                $personaF = mysqli_fetch_array($persona, MYSQLI_ASSOC);
            
            ?>
                
            <div class="card text-center mt-3 bg-dark publicacion">
                <div class="card-header text-start">
                    <div class="row ">
                        <div class="col-1">
                            <img class="img-responsive rounded" src="../Backend/imagenes/usuarios/<?=$personaF['foto']?>"
                                alt="User picture" width="40px" height="40px">
                        </div>
                        <div class="col-3">
                            <p class="lead"><?=$personaF['nombre']?></p>
                        </div>

                        <div class="col-8 text-end">
                            <button class="btn btn-outline-primary desbloquear" id="publi-<?=$row['idPubli']?>">Quitar Oculto</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!--imagen-->
                    <img src="../Backend/imagenes/publicaciones/<?php echo $row['ImagenTejido'];?>" class="card-img-top"
                        alt="...">
                    <!--Fin imagen-->
                    <div class="mt-2">
                        <div class="row mb-0">
                            <div class="col-5">
                                <?php if($row['estado'] == 0){ ?>
                                    <p class="text-start text-muted">Estado: "A la venta"</p>
                                <?php }else{ ?>
                                    <p class="text-start text-muted">Estado: "Vendido"</p>
                                <?php } ?>
                            </div>
                            <div class="col-7">
                                <p class="text-end text-muted">Fecha de Publicación: <?=$row['fechaP']?></p>
                            </div>
                        </div>
                        <h4 class="card-title mt-2"><?php echo $row['titulo'];?></h4>
                        <p class="card-text"><?php echo $row['descp'];?></p>
                        <p class="lead">Precio: <?php echo $row['precio'];?>.000</p>


                    </div>

                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="overlay">
        <div class="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <h3>¿Está seguro de que desea quitar el estado oculto a la publicación?</h3>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <input type="hidden" name="idPublic" id="paraDesbloquear">
                <input type="submit" class="btn btn-outline-danger seguro" value="Desocultar"></input>
            </form>
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
    <script>
    $(document).ready(function() {
        $('.desbloquear').click(function() {
            var getpID = $(this).attr('id').replace('publi-', '');
            $('#paraDesbloquear').val(getpID);
            $('.overlay').addClass("active");
            $('.popup').addClass("active");
        });

        $('.btn-cerrar-popup').click(function() {
            $('.overlay').removeClass("active");
            $('popup').removeClass("active");
        });
    });
    </script>
</body>

</html>