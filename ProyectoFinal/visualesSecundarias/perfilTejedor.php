<?php
    session_start();
    include('../Backend/conectar.php');

    if(isset($_SESSION['user_id'])){
        
        //Información del usuario del perfil
        $idUsuario = $_GET['usuario'];
        if(isset($idUsuario)){
            $comidUsuario =  mysqli_real_escape_string($conn,$_GET['usuario']);
            $infoUser = mysqli_query($conn,"SELECT * FROM usuarios WHERE id = '$comidUsuario'");
            $infoUserFetch = mysqli_fetch_array($infoUser,MYSQLI_ASSOC);
            
            //obtener numero de publicaciones
        
            $userId = $_SESSION['user_id'];
            $querycantidad = mysqli_query($conn,"SELECT * FROM tejido where id_user = '$comidUsuario'");
            $numeroPublicaciones = mysqli_num_rows($querycantidad);

            $nombre = null;
            $foto = null;
            $fechaU = null;
            $descp = null;
            $correo = null;
            $facebook =null;
            $twitter = null;
            $instagram = null;

            if(count($infoUserFetch)> 0){
                $nombre = filter_var ($infoUserFetch['nombre'],FILTER_SANITIZE_STRING);
                $fechaU = $infoUserFetch['fechaUnion'];
                $descp = filter_var ($infoUserFetch['descp'],FILTER_SANITIZE_STRING);
                $correo = filter_var($infoUserFetch['correo'],FILTER_SANITIZE_EMAIL);
               
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
            <img src="../Backend/imagenes/frontend/bannerMiPerfil.png" alt="Banner">
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
                <input type="hidden" id="lat" value="<?=$infoUserFetch['latitud']?>">
                <input type="hidden" id="lng" value="<?=$infoUserFetch['longitud']?>">
                <div class="imagen">
                    <img src="../Backend/imagenes/usuarios/<?=$foto?>" clas="img-fluid" alt="Foto Mi Perfil">
                </div>
                <div class="datosPrincipales">
                    <h2 id="nomH2"><?=$nombre?></h2>
                    <input style="display: none;" type="text" id="nomInput" value="<?=$nombre?>">
                    <input style="display: none;" class="btn-primary h-5" type="button" id="nomBtn" value="Guardar cambios">
                    <p class="muted estado">Tejedor</p>
                    
                    <br>
                    <p class="muted">Número de Publicaciones: <?=$numeroPublicaciones?></p>
                    <p class="muted">Fecha de Unión: <?=$fechaU?></p>
                </div>

            </div>
            <div class="descripcion">
                <div class="cambiar">
                     <p id="descpP"><?=$descp?></p>
                     <input id="descpInput" style="display:none; " value="<?=$descp?>">
                     <input id="descpBtn" style="display:none; " class="h-25 btn-primary" type="button"  value="Guardar cambios">
                    <?php if($comidUsuario == $_SESSION['user_id']){?>
                    <a href="#" id="editDescp"><i class="fas fa-pen-alt"></i></a>
                    
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

        <div class="portafolio align-middle">
            <div class="portHeader">
                <h4>Portafolio</h4>
                <?php if($comidUsuario == $_SESSION['user_id']){?>
                <a href="#"><i class="fas fa-pen-alt"></i></a>
                
                <?php } ?>
            </div>
            <hr>
            <div class="row row-cols-1 row-cols-md-4 g-3 align-middle porta">
                <?php 
                    //Obteniendo información de las publicaciones del usuario
                    $infoPubli = mysqli_query($conn,"SELECT * FROM tejido WHERE id_user = '$comidUsuario'");
                    while($infoPubliFetch = mysqli_fetch_array($infoPubli, MYSQLI_ASSOC)){
                        
                ?>
                <div class="col ">
                    <div class="card" style="width: 14rem;">
                        <img src="../Backend/imagenes/publicaciones/<?php echo $infoPubliFetch['ImagenTejido'];?>"
                            class="card-img-top" height="170px" alt="...">
                        <div class="card-body text-center" id="frmPrev-<?=$infoPubliFetch['idPubli']?>">
                                <button class="btn btn-primary btn-sm prev" name="buttonPrev">Previsualizar</button>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="comentarios">
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

        <div class="mapa">
            <div class="mapaHeader">
                <h4>Ubicación del tejedor</h4>
            </div>
            <hr>
            <div class="contenedorde">
                <div class="googleM" id="googleM"></div>
            </div>
        </div>
    </div>

    <div class="overlay">
        <div class="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <h3 id="tituloPrev"></h3>
            <img src="" alt="Imagen de Previsualización" id="imgPrev">
            <p id="descpPrev"></p>
            <p id="precioPrev"></p>
            <input type="button" class=" btn btn-outline-danger w-80" value="Eliminar">
            <input type="button" class=" btn btn-outline-primary w-80" value="Editar">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../assets/js/comentarioPerfil.js"></script>
    <script>
        $(document).ready(function(){
            $('.prev').click(function(){
                var getpID = $(this).parent().attr('id').replace('frmPrev-', '');
                var dataString = 'id='+getpID;
                $.ajax({
                    type: "POST",
                    url: "../Backend/previsualizar.php",
                    data: {id: getpID},
                    dataType: 'json',
                    success:function(datos){
                        var titulo = datos['titulo'];
                        var imagen  = datos['imagen'];
                        var descp = datos['descp'];
                        var precio = datos['precio'];

                        $('#tituloPrev').text(titulo);
                        $('#imgPrev').attr("src","../Backend/imagenes/publicaciones/"+imagen);
                        $('#descpPrev').text(descp);
                        $('#precioPrev').text('$'+precio+'.000');
                        $('.overlay').addClass("active");
                        $('.popup').addClass("active");
                    }
                });
                return false;
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.btn-cerrar-popup').click(function() {
                $('.overlay').removeClass("active");
                $('.popup').removeClass("active");
            });

            $('#editDescp').click(function(){
                $('#descpP').hide("fast");
                $('#editDescp').hide("fast");
                $('#descpInput').show("fast");
                $('#descpBtn').show("fast");
                
            });
            $('#descpBtn').click(function(){
                $('#descpInput').hide("fast");
                $('#descpBtn').hide("fast");
                $('#descpP').show("fast");
                $('#editDescp').show("fast");
            })
            $('#editNom').click(function(){
                $('#nomH2').hide("fast");
                $('#editNom').hide("fast");
                $('#nomInput').show("fast");
                $('#nomBtn').show("fast");
                
            });
            $('#nomBtn').click(function(){
                $('#nomInput').hide("fast");
                $('#nomBtn').hide("fast");
                $('#nomH2').show("fast");
                $('#editNom').show("fast");
            })

        });
    </script>
    <script>
        function iniciarMap() {
            var latitud = parseFloat(document.getElementById('lat').value);
            var longitud = parseFloat(document.getElementById('lng').value);
            console.log(latitud);
            console.log(longitud);
		    var coord = {lat:latitud ,lng: longitud};
            var map = new google.maps.Map(document.getElementById('googleM'), {
            zoom: 15,
            center: coord
        });
        var marker = new google.maps.Marker({
            position: coord,
            map: map
        });
        }
    </script>
</body>

</html>

<?php } ?>
