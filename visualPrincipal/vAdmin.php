<?php 
  session_start();
  include('../Backend/conectar.php');
  
  $tejidos = null;

  if(isset($_SESSION['user_id'])){

      //Obtener publicaciones
      $query = "select * from tejido";
      $stmt = mysqli_query($conn,$query);
  
      //Obtener los datos del usuario

      $query2 = "select * from usuarios where id = ?";
      $records = mysqli_prepare($conn,$query2);
      $stmt2 = mysqli_stmt_bind_param($records,'i',$_SESSION['user_id']);
      mysqli_stmt_execute($records);
      $stmtRes2= mysqli_stmt_get_result($records);
      $results = mysqli_fetch_array($stmtRes2, MYSQLI_ASSOC);

      $id = null;
      $nombre = null;
      $foto = null;

      if(count($results)> 0){
          $nombre = $results['nombre'];       
          $foto = $results['foto'];
          $id = $_SESSION['user_id'];
      }
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body class="body">

    <div class="row">
        <div class="col-3 ">
            <div class="page-wrapper chiller-theme toggled">
                <nav id="sidebar" class="sidebar-wrapper">
                    <div class="sidebar-content">
                        <div class="sidebar-brand">
                            <a href="../visualPrincipal/vAdmin.php">Artesanix</a>
                        </div>
                        <div class="sidebar-header">
                            <div class="user-pic">
                                <img class="img-responsive img-rounded"
                                    src="../Backend/imagenes/usuarios/<?=$foto?>"
                                    alt="User picture">
                            </div>
                            <div class="user-info">
                                <span class="user-name"><strong><?=$nombre?></strong></span>
                                <span class="user-role">Administrador</span>
                                <span class="user-status">
                                    <i class="fa fa-circle"></i>
                                    <span>Online</span>
                                </span>
                            </div>
                        </div>
                        <!-- sidebar-header  -->
                
                        <div class="sidebar-menu">
                            <ul>
                                <li class="header-menu">
                                    <span>General</span>
                                </li>
                                <li class="sidebar-dropdown">
                                    <a href="#">
                                        <i class="fas fa-plus"></i>
                                        <span>Usuarios</span>
                                    </a>
                                    <div class="sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="../visualesSecundarias/lista.php">Lista de Usuarios</a>
                                            </li>
                                            <li>
                                                <a href="#">Usuarios vetados</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="sidebar-dropdown">
                                    <a href="#">
                                        <i class="fas fa-scroll"></i>
                                        <span>Publicaciones</span>
                                    </a>
                                    <div class="sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="../visualSubir/subirTejido.php">Publicar Nuevo</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="sidebar-dropdown">
                                    <a href="#">
                                        <i class="fas fa-bell"></i>
                                        <span>Notificaciones</span>
                                    </a>
                                    <div class="sidebar-submenu">
                                        <div class="list-group">
                                            <?php
                                                $noti = mysqli_query($conn, "SELECT * from notificaciones WHERE user2 = '".$_SESSION['user_id']."' AND leido = 0 ORDER BY id_not desc");
                                                $contNoti = null;
                                                while($no = mysqli_fetch_array($noti,MYSQLI_ASSOC)){
                                                    
                                                    $contNoti = mysqli_num_rows($no);
                                                    $userNoti = mysqli_query($conn,"SELECT * FROM usuarios WHERE id = '".$no['user1']."'");
                                                    $fetchUser1 = mysqli_fetch_array($userNoti,MYSQLI_ASSOC);

                                            ?>
                                            <a href="#" class="list-group-item list-group-item-action list-group-item-dark">
                                                <i class="far fa-comment-alt notification"></i> El usuario <?php echo $fetchUser1['nombre']; ?> <?php echo $no['tipo']; ?>
                                            </a>
                                            <?php } ?>
                                        </div>
                                        <?php if($contNoti>0){ ?>           

                                            <div class="marcarcomoleido">
                                                <p id="marcarCL">Marcar todo como leido</p>
                                            </div>

                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="sidebar-dropdown">
                                    <a href="../visualesSecundarias/chatAdmin.php?usuario=<?php echo $_SESSION['user_id'];?>">
                                        <i class="fas fa-sms"></i>
                                        <span>Chats</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- sidebar-menu  -->
                    </div>
                    <!-- sidebar-content  -->
                    <div class="sidebar-footer ">
                        <a class="btn btn-danger" href="/ProyectoFinal/logout.php" role="button">Salir</a>
                    </div>
                </nav>

                <!-- page-content" -->
            </div>
        </div>
        <div class="col-8">
            <?php foreach($stmt as $row){
                
                $nombreQP = '';
                $fotoQP = '';
                $perfilQP = '';
                    
                $query3 = "select * from usuarios where id=?";
                $uxu = mysqli_prepare($conn,$query3);
                $stmt3 = mysqli_stmt_bind_param($uxu,'i',$row['id_user']);
                mysqli_stmt_execute($uxu);
                $stmtRes3= mysqli_stmt_get_result($uxu);
                $datosUxU = mysqli_fetch_array($stmtRes3, MYSQLI_ASSOC);
                $nombreQP = $datosUxU['nombre'];
                $fotoQP = $datosUxU['foto'];
                $tipo = $datosUxU['tipo'];
   
            ?>
            <div class="card text-center mt-3 bg-dark publicacion">
                <div class="card-header text-start">
                    <div class="row ">
                        <div class="col-1">
                            <img class="img-responsive rounded" src="../Backend/imagenes/usuarios/<?=$fotoQP?>"
                                alt="User picture" width="40px" height="40px">
                        </div>
                        <div class="col-3">
                            <p class="lead"><?=$nombreQP?></p>
                        </div>

                        <?php
                            if($tipo == 't'){
                        ?>
                            <div class="col-8 text-end">
                                <a href="/ProyectoFinal/visualesSecundarias/perfilTejedor.php?usuario=<?php echo $row['id_user'];?>" class="btn btn-outline-light btn-sm">Ver Perfil</a>
                            </div>
                        <?php } ?>
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
                                <p class="text-start text-muted">Estado: "A la venta"</p>
                            </div>
                            <div class="col-7">
                                <p class="text-end text-muted">Fecha de Publicación: <?=$row['fechaP']?></p>
                            </div>
                        </div>
                        <h4 class="card-title mt-2"><?php echo $row['titulo'];?></h4>
                        <p class="card-text"><?php echo $row['descp'];?></p>
                        <p class="lead">Precio: <?php echo $row['precio'];?>.000</p>
                        <?php
                            $idChatUsu = mysqli_query($conn,"SELECT id_user FROM tejido where idPubli = '".$row['idPubli']."'");
                            $idUsuFetch = mysqli_fetch_array($idChatUsu, MYSQLI_ASSOC);
                        ?>

                            <a href="/ProyectoFinal/visualesSecundarias/chatAdmin.php?usuario=<?=$idUsuFetch['id_user']?>" class="btn btn-warning">Ofertar</a>


                        <?php 
                            $numcomen = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM comentarios WHERE publicacion = '".$row['idPubli']."'"));
                        ?>

                        <ul class="barraLike text-start ">
                            <li>
                                <?php
                                    $queryLikes = mysqli_query($conn, "SELECT * FROM megusta WHERE idPubli = '".$row['idPubli']."'AND id_user = ".$_SESSION['user_id']."");

                                    if(mysqli_num_rows($queryLikes) == 0){ ?>

                                    <div class="btn btn-outline-primary btn-sm like" id="<?php echo $row['idPubli'];?>"><i class="fas fa-thumbs-up">Me gusta</i></div><span id="likes_<?php echo $row['idPubli'];?>">(<?php echo $row['likes'];?>)</span>
                                
                                <?php } else { ?>

                                    <div class="btn btn-outline-primary btn-sm like" id="<?php echo $row['idPubli'];?>"><i class="fas fa-thumbs-up">No me gusta</i></div><span class="spanLikes" id="likes_<?php echo $row['idPubli'];?>">(<?php echo $row['likes'];?>)</span>

                                <?php } ?>

                            </li>
                            <li>
                                <span href="#" class=" numeroCom link-black text-sm">Comentarios(<?=$numcomen?>)</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-muted mt-2 text-start">

                        <?php
                            $comentarios = mysqli_query($conn,"SELECT * from comentarios where publicacion = '".$row['idPubli']."' ORDER BY id_com desc LIMIT 2");
                        
                            while($com = mysqli_fetch_array($comentarios, MYSQLI_ASSOC)){
                                $usuarioc = mysqli_query($conn,"SELECT * from usuarios where id = '".$com['usuario']."'");
                                $usec = mysqli_fetch_array($usuarioc, MYSQLI_ASSOC);
                        ?>

                        <div class="box-comment">
                            <div class="comment-information">
                            <img src="/ProyectoFinal/Backend/imagenes/usuarios/<?php echo $usec['foto'];?>" alt=""
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

                        <?php if($numcomen > 2) { echo "<br><center> Ver todos los comentarios </center>"; } ?>
                        <form action="" method="post">
                            <label class="labelComentario" id="record-<?php echo $row['idPubli'];?>" for="comentar">Comentar
                            <input class="form-control enviar-btn" type="text" name="comentario" id="comentario-<?php echo $row['idPubli'];?>" placeholder="Escribe un comentario">
                            </label>
                            <input type="hidden" name="usuario" id="usuario" value="<?php echo $id;?>">
                            <input type="hidden" name="publicacion" id="publicacion" value="<?php echo $row['idPubli'];?>">
                            <input type="hidden" name="foto" id="foto" value="<?php echo $foto;?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo $nombre;?>">
                        </form>
                    </div>
                </div>
            </div>
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
        <script src="/ProyectoFinal/Backend/js/likes.js"></script>
    <script src="/ProyectoFinal/Backend/js/comentarios.js"></script>
    <script>
        $(document).ready(function() {
            $("#marcarCL").click(function(){
                var id = <?php echo $_SESSION['user_id']; ?>;
                $.ajax({
                    url: 'http://localhost/ProyectoFinal/Backend/mtcl.php',
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
    <script src="scr.js"></script>
</body>

</html>