<?php
    session_start();
    include('../Backend/conectar.php');

    //obtener el id de la publicación
    $id = $_GET['publicacion'];
    $idUser = $_SESSION['user_id'];
    
    //query para obtener la publicación, información de la sesión y los comentarios
    $usuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE id='$idUser'");
    $publicacion = mysqli_query($conn, "SELECT *FROM tejido WHERE idPubli = '$id'");
    $comentarios = mysqli_query($conn, "SELECT * FROM comentarios WHERE publicacion = '$id'");
    
    //Fetch del usuario y fetch del comentario
    $uFetch = mysqli_fetch_array($usuario, MYSQLI_ASSOC);
    $publiFetch = mysqli_fetch_array($publicacion, MYSQLI_ASSOC);
    
    //obtener info del dueño de la publicación
    $dueño = mysqli_query($conn, "SELECT * FROM usuarios WHERE id='".$publiFetch['id_user']."'");
    $dueñoFetch = mysqli_fetch_array($dueño, MYSQLI_ASSOC);

    //Obtener numero de comentarios
    $numcomen = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM comentarios WHERE publicacion = '$id'"));

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicación de <?=$dueñoFetch['nombre']?></title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body class="body">
    <!-- Menu -->
    <div class="row">
        <?php
            include ('../Backend/sidebar.php');
        ?>
        <div class="col-8">
            <div class="card text-center mt-3 bg-dark publicacion">
                <div class="card-header text-start">
                    <div class="row ">
                        <div class="col-1">
                            <img class="img-responsive rounded" src="../Backend/imagenes/usuarios/<?=$dueñoFetch['foto']?>"
                                alt="User picture" width="40px" height="40px">
                        </div>
                        <div class="col-3">
                            <p class="lead"><?=$dueñoFetch['nombre']?></p>
                        </div>

                        <?php
                            if($dueñoFetch['tipo'] == 't'){
                        ?>
                        <div class="col-8 text-end">
                            <a href="../visualesSecundarias/perfilTejedor.php?usuario=<?php echo $publiFetch['id_user'];?>"
                                class="btn btn-outline-light btn-sm">Ver Perfil</a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body">
                    <!--imagen-->
                    <img src="../Backend/imagenes/publicaciones/<?php echo $publiFetch['ImagenTejido'];?>" class="card-img-top"
                        height="450px" alt="...">
                    <!--Fin imagen-->
                    <div class="mt-2">
                        <div class="row mb-0">
                            <div class="col-5"></div>
                            <div class="col-7">
                                <p class="text-end text-muted">Fecha de Publicación: <?=$publiFetch['fechaP']?></p>
                            </div>
                        </div>
                        <h4 class="card-title mt-2"><?php echo $publiFetch['titulo'];?></h4>
                        <p class="card-text"><?php echo $publiFetch['descp'];?></p>
                        <p class="lead">Precio: <?php echo $publiFetch['precio'];?>.000</p>
                        
                        <?php if($publiFetch['id_user'] == $_SESSION['user_id']){  ?>
                        <form action="../Backend/comprado.php" method="POST">
                            <input type="hidden" name="idComprado" value="<?php echo $publiFetch['idPubli']; ?>">
                            <input type="submit" name="comprado" class="btn btn-primary"
                                value="Tejido Comprado"></input>
                        </form>
                        <?php } else { ?>
                        <a href="../visualesSecundarias/chatTejedor.php?usuario=<?=$publiFetch['id_user']?>"
                            class="btn btn-warning">Ofertar</a>
                        <?php } ?>

                        <ul class="barraLike text-start ">
                            <li>
                                <?php
                                    $queryLikes = mysqli_query($conn, "SELECT * FROM megusta WHERE idPubli = '".$publiFetch['idPubli']."'AND id_user = ".$_SESSION['user_id']."");

                                    if(mysqli_num_rows($queryLikes) == 0){ ?>

                                <div class="btn btn-outline-primary btn-sm like" id="<?php echo $publiFetch['idPubli'];?>"><i
                                        class="fas fa-thumbs-up">Me gusta</i></div><span
                                    id="likes_<?php echo $publiFetch['idPubli'];?>">(<?php echo $publiFetch['likes'];?>)</span>

                                <?php } else { ?>

                                <div class="btn btn-outline-primary btn-sm like" id="<?php echo $publiFetch['idPubli'];?>"><i
                                        class="fas fa-thumbs-up">No me gusta</i></div><span class="spanLikes"
                                    id="likes_<?php echo $publiFetch['idPubli'];?>">(<?php echo $publiFetch['likes'];?>)</span>

                                <?php } ?>

                            </li>
                            <li>
                                <span href="#" class=" numeroCom link-black text-sm">Comentarios(<?=$numcomen?>)</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-muted mt-2 text-start">

                        <?php
                            $comentarios = mysqli_query($conn,"SELECT * from comentarios where publicacion = '".$publiFetch['idPubli']."' ORDER BY id_com desc");
                        
                            while($com = mysqli_fetch_array($comentarios, MYSQLI_ASSOC)){
                                $usuarioc = mysqli_query($conn,"SELECT * from usuarios where id = '".$com['usuario']."'");
                                $usec = mysqli_fetch_array($usuarioc, MYSQLI_ASSOC);
                        ?>

                        <div class="box-comment">
                            <div class="comment-information">
                                <img src="../Backend/imagenes/usuarios/<?php echo $usec['foto'];?>" alt=""
                                    class="user-pic img-responsive rounded">
                                <span class="username">
                                    <strong><?=$usec['nombre']?></strong>
                                    <span class="text-muted pull-right"><?=$com['fecha']?></span>
                                </span>
                            </div>
                            <div class="comment-text">
                                <?php echo $com['comentario'];?>
                            </div>

                        </div>

                        <?php } ?>

                        <form action="" method="post" id="record-<?php echo $publiFetch['idPubli'];?>">
                            <label class="labelComentario" for="comentar">Comentar
                                <input class="form-control enviar-btn" type="text" name="comentario" id="comentario-<?php echo $publiFetch['idPubli'];?>" placeholder="Escribe un comentario">
                            </label>
                            <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['user_id'];?>">
                            <input type="hidden" name="publicacion" id="publicacion" value="<?php echo $publiFetch['idPubli'];?>">
                            <input type="hidden" name="foto" id="foto" value="<?php echo $uFetch['foto'];?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo $uFetch['nombre'];?>">
                            <input class="btn btn-primary comentarAqui" type="submit" value="Comentar">
                        </form>
                    </div>
                </div>
            </div>
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

    <script src="../assets/js/likes.js"></script>
    <script src="../assets/js/comentarios.js"></script>
    <script>
        $(document).ready(function() {
            $("#marcarCL").click(function(){
                var id = <?php echo $_SESSION['user_id']; ?>; 
                $.ajax({
                    url: '../Backend/mtcl.php',
                    method: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(data) {
                        var seHizo = data['notiAct'];
                        alert(seHizo);
                    }
                });
            });
        });
    </script>
    <script src="../assets/js/scr.js"></script>
</body>

</html>