<?php

    session_start();
    include('../Backend/conectar.php');

    if(isset($_SESSION['user_id'])){
        $query2 = "select * from usuarios where id = ?";
        $records = mysqli_prepare($conn,$query2);
        $stmt2 = mysqli_stmt_bind_param($records,'i',$_SESSION['user_id']);
        mysqli_stmt_execute($records);
        $stmtRes2= mysqli_stmt_get_result($records);
        $results = mysqli_fetch_array($stmtRes2, MYSQLI_ASSOC);

        $nombre = null;
        $foto = null;

        if(count($results)> 0){
            $nombre = $results['nombre'];
            $foto = $results['foto'];
        }
    }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat de pepito</title>
    <!--Custom CSS-->
    <link rel="stylesheet" href="../visualesSecundarias/css/chat.css">
    <!--Font Awesome-->
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
                            <a href="../visualPrincipal/vConsumidor.php">Artesanix</a>
                        </div>
                        <div class="sidebar-header">
                            <div class="user-pic">
                                <img class="img-responsive img-rounded" src="../Backend/imagenes/usuarios/<?=$foto?>"
                                    alt="User picture">
                            </div>
                            <div class="user-info">
                                <span class="user-name"><strong><?=$nombre?></strong></span>
                                <span class="user-role">Consumidor</span>
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
                                    <a
                                        href="../visualesSecundarias/perfilConsumidor.php?usuario=<?php echo $_SESSION['user_id'];?>">
                                        <i class="fas fa-user-alt"></i>
                                        <span>Mi Perfil</span>
                                    </a>
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

                                            <a href="#"
                                                class="list-group-item list-group-item-action list-group-item-dark">
                                                <i class="far fa-comment-alt notification"></i> El usuario
                                                <?php echo $fetchUser1['nombre']; ?> <?php echo $no['tipo']; ?>
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
                                    <a
                                        href="../visualesSecundarias/chatConsumidor.php?usuario=<?php echo $_SESSION['user_id'];?>">
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
        <div class="col-1"></div>
        <div class="col-5 ">

            <?php
                $user = mysqli_real_escape_string($conn,$_GET['usuario']);
                $sees = $_SESSION['user_id'];
                $chats = mysqli_query($conn,"SELECT * FROM chats WHERE de = '$user' AND para = '$sees' OR de = '$sees' AND para = '$user'");
            ?> 
            
            <?php 
                $obtUser = mysqli_query($conn, "SELECT * FROM usuarios where id = '$user'");
                $obtFetch = mysqli_fetch_array($obtUser,MYSQLI_ASSOC);
            ?>

            <div class="chateo">
                <div class="chateoHeader">
                    <img src="/ProyectoFinal/Backend/imagenes/usuarios/<?=$obtFetch['foto']?>"
                        alt="">
                    <p><?=$obtFetch['nombre']?></p>
                </div>
                <hr>

                <div class="mensajesEntrantes">
                <?php while($ch = mysqli_fetch_array($chats,MYSQLI_ASSOC)){ ?>
                    <?php if($ch['de'] == $user){  ?>
                    <div class="izquierda">
                        <p><?php echo $ch['mensaje'];?></p>
                    </div>
                    <?php }else if($ch['para'] == $user) { ?>
                    <div class="derecha ">
                        <p><?php echo $ch['mensaje'];?></p>
                    </div>
                    
                    <?php } ?>

                <?php } ?> 
                </div>

                <div class="envMensajes">
                    <form action="" method="post">
                        <input type="text" class="envmensaje" name="envmensaje" id="envmensaje" placeholder="Escribe un mensaje">
                        <input type="submit" name="enviar" class="btn btn-primary btn-sm enviar"></input>
                    </form>
                </div>

                <?php
                    if(isset($_POST['enviar'])){
                        $mensaje = mysqli_real_escape_string($conn,$_POST['envmensaje']);
                        if($mensaje == ""){
                            $para = mysqli_real_escape_string($conn,$_GET['usuario']);
                            echo '<script>"debes enviar un mensaje"</script>';
                            echo '<script>window.location="/ProyectoFinal/visualesSecundarias/chatTejedor.php?usuario='.$para.'"</script>';
                        }else{
                            $de = $_SESSION['user_id'];
                            $para = mysqli_real_escape_string($conn,$_GET['usuario']);
                            $fecha = date("Y-m-d H:i:s");
    
                            $comprobar = mysqli_query($conn,"SELECT * FROM c_chats WHERE de = '$de' AND para = '$para' OR de = '$para' AND para = '$de' ");
                            
    
                            if(mysqli_num_rows($comprobar) == 0){
                                $insert = mysqli_query($conn,"INSERT INTO c_chats (de,para) VALUES ('$de','$para')");
                                $siguiente = mysqli_query($conn,"SELECT id_cch FROM c_chats WHERE de = '$de' AND para = '$para' OR de = '$para' AND para = '$de' ");
                                $siguiFetch = mysqli_fetch_array($siguiente,MYSQLI_ASSOC);
                                $siguiResult =$siguiFetch['id_cch'];
                                $insert2 = mysqli_query($conn, "INSERT INTO chats(id_cch,de,para,mensaje,fecha,leido) VALUES ('$siguiResult','$de','$para','$mensaje','$fecha',0)");
    
                                if($insert){
                                    echo '<script>window.location="/ProyectoFinal/visualesSecundarias/chatTejedor.php?usuario='.$para.'"</script>';
                                }
                            }else{
                                $com = mysqli_fetch_array($comprobar,MYSQLI_ASSOC);
                                $comResult = $com['id_cch'];
                                $insert3 = mysqli_query($conn, "INSERT INTO chats(id_cch,de,para,mensaje,fecha,leido) VALUES ('$comResult','$de','$para','$mensaje','$fecha',0)");
                                if($insert3){
                                    echo '<script>window.location="/ProyectoFinal/visualesSecundarias/chatTejedor.php?usuario='.$para.'"</script>';
                                }
                            }
                        }  
                    }
                ?>

            </div>
        </div>
        <div class="col-1"></div>
        <div class="col-2 barraDerecha">
            <h4>Chats</h4>
            <hr>
            <?php
                $obtChats = mysqli_query($conn,"SELECT * FROM c_chats where de = '$sees' OR para = '$sees'");
                

                while($chatsFetch = mysqli_fetch_array($obtChats, MYSQLI_ASSOC)){

                    if($chatsFetch['para'] == $sees){
                        $idPerWChat = $chatsFetch['de'];
                        $obtInfo = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = '$idPerWChat'");
                    }else if($chatsFetch['de'] == $sees){
                        $idPerWChat = $chatsFetch['para'];
                        $obtInfo = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = '$idPerWChat'");
                    }

                    $obtInfoFetch = mysqli_fetch_array($obtInfo, MYSQLI_ASSOC);
            ?>
            <a href="/ProyectoFinal/visualesSecundarias/chatConsumidor.php?usuario=<?php echo $obtInfoFetch['id']; ?>">
                <div class="burbuja">
                    <img src="/ProyectoFinal/Backend/imagenes/usuarios/<?=$obtInfoFetch['foto']?>"
                        alt="User picture">
                    <p><?php echo $obtInfoFetch['nombre']; ?></p>
                    <i class="far fa-comment"></i>
                </div>
            </a>
            <hr>

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
    <script src="js/chat.js"></script>
</body>

</html>