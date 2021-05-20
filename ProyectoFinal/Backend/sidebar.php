<?php
    include('conectar.php');

    //obtener el ID de la sesión
    $id = $_SESSION['user_id'];
    //Obtener la información
    $usuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE id='$id'");
    $uFetch = mysqli_fetch_array($usuario, MYSQLI_ASSOC);
?>

<div class="col-3 ">
    <div class="page-wrapper chiller-theme toggled">
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <?php if($uFetch['tipo'] == 't'){ ?>
                    <a href="/ProyectoFinal/visualPrincipal/vTejedor.php">Artesanix</a>
                    <?php }else if($uFetch['tipo'] == 'c'){ ?>
                    <a href="/ProyectoFinal/visualPrincipal/vConsumidor.php">Artesanix</a>
                    <?php }else if($uFetch['tipo'] == 'a'){ ?>
                    <a href="/ProyectoFinal/visualPrincipal/vAdmin.php">Artesanix</a>
                    <?php }?>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                        <img class="img-responsive img-rounded" src="../Backend/imagenes/usuarios/<?=$uFetch['foto']?>"
                            alt="User picture">
                    </div>
                    <div class="user-info">
                        <span class="user-name"><strong><?=$uFetch['nombre']?></strong></span>
                        <?php if($uFetch['tipo'] == 't'){ ?>
                        <span class="user-role">Tejedor</span>
                        <?php }else if($uFetch['tipo'] == 'c'){ ?>
                        <span class="user-role">Comprador</span>
                        <?php }else if($uFetch['tipo'] == 'a'){ ?>
                        <span class="user-role">Administrador</span>
                        <?php }?>
                        <span class="user-status">
                            <i class="fa fa-circle"></i>
                            <span>Online</span>
                        </span>
                    </div>
                </div>

                <?php if($uFetch['tipo'] == 't'){ ?>
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>General</span>
                        </li>
                        <li class="sidebar-dropdown">
                            <a
                                href="../visualesSecundarias/perfilTejedor.php?usuario=<?php echo $_SESSION['user_id'];?>">
                                <i class="fas fa-user-alt"></i>
                                <span>Mi Perfil</span>
                            </a>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="/ProyectoFinal/visualesSecundarias/mispublicaciones.php">
                                <i class="fas fa-clone"></i>
                                <span>Mis Publicaciones</span>
                            </a>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fas fa-plus"></i>
                                <span>Publicar Tejido</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="../visualSubir/subirTejido.php">Nuevo</a>
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
                                <div class="list-group listaNoti">

                                    <?php
                                                $noti = mysqli_query($conn, "SELECT * from notificaciones WHERE user2 = '".$_SESSION['user_id']."' AND leido = 0 ORDER BY id_not desc");
                                                $contNoti = null;
                                                while($no = mysqli_fetch_array($noti,MYSQLI_ASSOC)){
                                                    
                                                    $contNoti = mysqli_num_rows($noti);
                                                    $userNoti = mysqli_query($conn,"SELECT * FROM usuarios WHERE id = '".$no['user1']."'");
                                                    $fetchUser1 = mysqli_fetch_array($userNoti,MYSQLI_ASSOC);

                                    ?>

                                    <?php if($no['tipo'] == "ha comentado"){ ?>

                                    <a href="../visualesSecundarias/verComentarios.php?publicacion=<?=$no['idPubli']?>"
                                        class="list-group-item list-group-item-action list-group-item-dark">
                                        <i class="far fa-comment-alt notification"></i> El usuario
                                        <?php echo $fetchUser1['nombre']; ?> <?php echo $no['tipo']; ?>
                                    </a>

                                    <?php }else if($no['tipo'] == "ha dado me gusta"){ ?>

                                    <a href="../visualesSecundarias/verComentarios.php?publicacion=<?=$no['idPubli']?>"
                                        class="list-group-item list-group-item-action list-group-item-dark">
                                        <i class="fas fa-thumbs-up notification"></i> El usuario
                                        <?php echo $fetchUser1['nombre']; ?> <?php echo $no['tipo']; ?>
                                    </a>
                                    <?php } else { ?>
                                        <a href="../visualesSecundarias/chatTejedor.php?usuario=<?=$no['user1']?>"
                                        class="list-group-item list-group-item-action list-group-item-dark">
                                        <i class="fas fa-times notification"></i> El Administrador
                                        <?php echo $fetchUser1['nombre']; ?> <?php echo $no['tipo']; ?>
                                    </a>
                                    <?php } ?>
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
                            <a href="../visualesSecundarias/chatTejedor.php?usuario=<?php echo $_SESSION['user_id'];?>">
                                <i class="fas fa-sms"></i>
                                <span>Chats</span>
                            </a>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="../visualesSecundarias/noticias.php">
                                <i class="fas fa-newspaper"></i>
                                <span>Noticias</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <?php }else if($uFetch['tipo'] == 'c'){ ?>
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
                                <div class="list-group listaNoti">
                                    <?php
                                            $noti = mysqli_query($conn, "SELECT * from notificaciones WHERE user2 = '".$_SESSION['user_id']."' AND leido = 0 ORDER BY id_not desc");
                                            $contNoti = null;
                                            while($no = mysqli_fetch_array($noti,MYSQLI_ASSOC)){
                                                    
                                                $contNoti = mysqli_num_rows($noti);
                                                $userNoti = mysqli_query($conn,"SELECT * FROM usuarios WHERE id = '".$no['user1']."'");
                                                $fetchUser1 = mysqli_fetch_array($userNoti,MYSQLI_ASSOC);

                                        ?>

                                    <?php if($no['tipo'] == "ha comentado"){ ?>

                                    <a href="../visualesSecundarias/verComentarios.php?publicacion=<?=$no['idPubli']?>"
                                        class="list-group-item list-group-item-action list-group-item-dark">
                                        <i class="far fa-comment-alt notification"></i> El usuario
                                        <?php echo $fetchUser1['nombre']; ?> <?php echo $no['tipo']; ?>
                                    </a>

                                    <?php }else if($no['tipo'] == "ha dado me gusta"){ ?>

                                    <a href="../visualesSecundarias/verComentarios.php?publicacion=<?=$no['idPubli']?>"
                                        class="list-group-item list-group-item-action list-group-item-dark">
                                        <i class="fas fa-thumbs-up notification"></i> El usuario
                                        <?php echo $fetchUser1['nombre']; ?> <?php echo $no['tipo']; ?>
                                    </a>
                                    <?php } ?>
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
                        <li class="sidebar-dropdown">
                            <a href="../visualesSecundarias/noticias.php">
                                <i class="fas fa-newspaper"></i>
                                <span>Noticias</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <?php }else if($uFetch['tipo'] == 'a'){ ?>
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
                                        <a href="../visualesSecundarias/vetados.php">Usuarios vetados</a>
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
                                        <a href="../visualesSecundarias/listaOcultos.php">Lista de Publicaciones ocultas</a>
                                    </li>
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
                                <div class="list-group listaNoti">
                                    <?php
                                                $noti = mysqli_query($conn, "SELECT * from notificaciones WHERE user2 = '".$_SESSION['user_id']."' AND leido = 0 ORDER BY id_not desc");
                                                $contNoti = null;
                                                while($no = mysqli_fetch_array($noti,MYSQLI_ASSOC)){
                                                    
                                                    $contNoti = mysqli_num_rows($noti);
                                                    $userNoti = mysqli_query($conn,"SELECT * FROM usuarios WHERE id = '".$no['user1']."'");
                                                    $fetchUser1 = mysqli_fetch_array($userNoti,MYSQLI_ASSOC);

                                            ?>
                                    <?php if($no['tipo'] == "ha comentado"){ ?>

                                    <a href="../visualesSecundarias/verComentarios.php?publicacion=<?=$no['idPubli']?>"
                                        class="list-group-item list-group-item-action list-group-item-dark">
                                        <i class="far fa-comment-alt notification"></i> El usuario
                                        <?php echo $fetchUser1['nombre']; ?> <?php echo $no['tipo']; ?>
                                    </a>

                                    <?php }else if($no['tipo'] == "ha dado me gusta"){ ?>

                                    <a href="../visualesSecundarias/verComentarios.php?publicacion=<?=$no['idPubli']?>"
                                        class="list-group-item list-group-item-action list-group-item-dark">
                                        <i class="fas fa-thumbs-up notification"></i> El usuario
                                        <?php echo $fetchUser1['nombre']; ?> <?php echo $no['tipo']; ?>
                                    </a>
                                    <?php } ?>
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
                        <li class="sidebar-dropdown">
                            <a href="#"><i class="fas fa-newspaper"></i><span>Noticias</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="../visualesSecundarias/noticias.php">Ir Noticias</a>
                                    </li>
                                    <li>
                                        <a href="../visualSubir/newNoticia.php">Publicar Nueva Noticia</a>
                                    </li>
                                </ul> 
                            </div>
                        </li>
                    </ul>
                </div>
                <?php } ?>
            </div>

            <div class="sidebar-footer ">
                <a class="btn btn-danger" href="/ProyectoFinal/logout.php" role="button">Salir</a>
            </div>
        </nav>
    </div>
</div>