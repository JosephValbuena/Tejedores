<?php
    session_start();
    include('../Backend/conectar.php');

        //Información del usuario del perfil
        $idUsuario = $_GET['usuario'];
        if(isset($idUsuario)){
            $comidUsuario =  mysqli_real_escape_string($conn,$_GET['usuario']);
            $infoUser = mysqli_query($conn,"SELECT * FROM usuarios WHERE id = '$comidUsuario'");
            $infoUserFetch = mysqli_fetch_array($infoUser,MYSQLI_ASSOC);
            
            $nombre = null;
            $foto = null;
            $fechaU = null;
            $descp = null;
            $correo = null;
            $facebook =null;
            $twitter = null;
            $instagram = null;
            
            if(count($infoUserFetch)> 0){
                $nombre =$infoUserFetch['nombre'];
                $fechaU = $infoUserFetch['fechaUnion'];
                $descp = $infoUserFetch['descp'];
                $correo = $infoUserFetch['correo'];
               
                if(filter_var($infoUserFetch['twitter'],FILTER_VALIDATE_URL) && filter_var($facebook = $infoUserFetch['facebook'],FILTER_VALIDATE_URL) && filter_var($instagram = $infoUserFetch['instagram'],FILTER_VALIDATE_URL)){
                    $twitter = $infoUserFetch['twitter'];
                    $facebook = $infoUserFetch['facebook'];
                    $instagram = $infoUserFetch['instagram'];
                }
                $foto = $infoUserFetch['foto'];
            }
        


        
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Custom CSS-->
    <link rel="stylesheet" href="../assets/css/perfil.css">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Mi Perfil</title>
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body class="body">
    <div class="contenedor">
        <div class="banner">
            <img src="https://images.pexels.com/photos/258109/pexels-photo-258109.jpeg" alt="Banner">
        </div>
        <div class="datosBasicos">
            <div class="datos">
                <?php
                    $comprobar = mysqli_query($conn, "SELECT tipo FROM usuarios where id = '".$_SESSION['user_id']."'");
                    $comFetch = mysqli_fetch_array($comprobar, MYSQLI_ASSOC);

                    if($comFetch['tipo'] == 't'){
                ?>
                <a href="../visualPrincipal/vTejedor.php"><i class="fas fa-chevron-left"></i></a>
                <?php } else if ($comFetch['tipo'] == 'c'){ ?>
                <a href="../visualPrincipal/vConsumidor.php"><i class="fas fa-chevron-left"></i></a>
                <?php } else { ?>
                <a href="../visualPrincipal/vAdmin.php"><i class="fas fa-chevron-left"></i></a>
                <?php } ?>
                <div class="imagen">
                    <img src="../Backend/imagenes/usuarios/<?=$foto?>"
                        clas="img-fluid" alt="Foto Mi Perfil">
                </div>
                <div class="datosPrincipales">
                    <h2><?=$nombre?></h2>
                    <p class="muted estado">Consumidor</p>
                    <br>

                    <?php
                        $numCom = mysqli_query($conn, "SELECT * FROM comentarios WHERE usuario = '$comidUsuario'");
                        $numCom2 = mysqli_query($conn, "SELECT * FROM comenperfil WHERE usuario = '$comidUsuario'");

                        $contCom = mysqli_num_rows($numCom);
                        $contCom2 = mysqli_num_rows($numCom2);
                    ?>

                    <p class="muted">Número de comentarios: <?php echo ($contCom + $contCom2); ?></p>
                    <p class="muted">Fecha de Unión: <?=$fechaU?></p>
                </div>

            </div>
            <div class="descripcion">
                <div class="cambiar">
                    <p><?=$descp?></p>
                    <?php if($comidUsuario == $_SESSION['user_id']){?>
                    <a href="#"><i class="fas fa-pen-alt"></i></a>
                    <?php } ?>
                </div>
                
                   
                <div class="redes">
                <a href="mailto: <?=$correo?>" target="_blank"><i class="fas fa-envelope"></i></a>
                    <?php if(!empty($facebook)):?>
                    <a href="<?=$facebook?>" target="_blank"><i class="fab fa-facebook"></i></a>
                    <?php endif?>
                    <?php if(!empty($twitter)):?>
                    <a href="<?=$twitter?>" target="_blank"><i class="fab fa-twitter"></i></a>
                    <?php endif?>
                    <?php if(!empty($instagram)):?>
                    <a href="<?$instagram?>" target="_blank"><i class="fab fa-instagram"></i></a>
                    <?php endif?>

                    <?php if($comFetch['tipo'] == 't'){ ?>
                    <a href="../visualesSecundarias/chatTejedor.php?usuario=<?=$comidUsuario?>"><i
                            class="fas fa-comments"></i></a>
                    <?php } else if($comFetch['tipo'] == 'c'){ ?>
                    <a href="../visualesSecundarias/chatConsumidor.php?usuario=<?=$comidUsuario?>"><i
                            class="fas fa-comments"></i></a>
                    <?php }else { ?>
                    <a href="../visualesSecundarias/chatAdmin.php?usuario=<?=$comidUsuario?>"><i
                            class="fas fa-comments"></i></a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="portafolio-c align-middle">
            <div class="portHeader-c">
                <h4>Mi Actividad</h4>
            </div>
            <hr>
            <div class="row row-cols-1 row-cols-md-4 g-3 align-middle porta-c">
            <?php 
                    $obtcoments = mysqli_query($conn, "SELECT * FROM comentarios where usuario = '$idUsuario'");
                
                    while($comentFetch = mysqli_fetch_array($obtcoments,MYSQLI_ASSOC)){

                        $obtPubli = mysqli_query($conn, "SELECT * FROM tejido WHERE idPubli = '".$comentFetch['publicacion']."'");
                        $publiFetch = mysqli_fetch_array($obtPubli, MYSQLI_ASSOC);
                ?>
                <div class="col ">
                    <div class="card h-100" style="width: 13rem;">
                        <img src="../Backend/imagenes/publicaciones/<?=$publiFetch['ImagenTejido']?>" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h4 class="card-title"><a href="../visualesSecundarias/verComentarios.php?publicacion=<?=$publiFetch['idPubli']?>" class="link-secondary"><?=$publiFetch['titulo']?></a></h4>
                            <div class="card-text"><?=$comentFetch['comentario']?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>

        <div class="comentarios-c">
            <div class="comentariosHeader">
                <h4>Comentarios</h4>
            </div>
            <hr>
            <div class="coments">

                <?php
                    $traerComent = mysqli_query($conn,"SELECT * FROM comenperfil WHERE perfil = '$comidUsuario' ORDER BY id_comenp DESC");
                    
                    while($traerComentFetch = mysqli_fetch_array($traerComent, MYSQLI_ASSOC)){
                        $informUsu = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = '".$traerComentFetch['usuario']."'");
                        $informUFetch = mysqli_fetch_array($informUsu, MYSQLI_ASSOC);
                ?>

                <div class="box-comment">
                    <div class="comment-information">
                        <img src="../Backend/imagenes/usuarios/<?php echo $informUFetch['foto']?>" alt=""
                            class="user-pic img-responsive rounded">
                        <span class="username">
                            <strong><?=$informUFetch['nombre']?></strong>
                            <span class="text-muted pull-right"><?=$traerComentFetch['fecha']?></span>
                        </span>
                    </div>
                    <div class="comment-text">
                        <?php echo $traerComentFetch['comentario'];?>
                    </div>

                </div>
                
                <?php } ?>
            </div>
            <?php 
                    $QuienComenta = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = '".$_SESSION['user_id']."'");
                    $qcFetch = mysqli_fetch_array($QuienComenta, MYSQLI_ASSOC);

                    if($_SESSION['user_id'] != $comidUsuario){
                ?>

                <form action="" method="post">
                    <label class="labelComenPerfil" id="perfil-<?php echo $comidUsuario;?>" for="comenPerfil">Comentar
                        <input class="form-control enviar-btn" type="text" name="comenPerfil"
                            id="comentario-<?php echo $comidUsuario;?>" placeholder="Escribe un comentario">
                    </label>
                    <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['user_id'];?>">
                    <input type="hidden" name="perfil" id="pefil" value="<?php echo $comidUsuario;?>">
                    <input type="hidden" name="foto" id="foto" value="<?php echo $qcFetch['foto'];?>">
                    <input type="hidden" name="nombre" id="nombre" value="<?php echo $qcFetch['nombre'];?>">
                </form>
                <?php } ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../assets/js/comentarioPerfil.js"></script>
</body>

</html>
