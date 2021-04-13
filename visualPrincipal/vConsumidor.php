<?php 
  include('../Backend/conectar.php');
  $query = "select * from tejido";
  $resultado = mysqli_query($conn,$query);
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
    <link rel="stylesheet" href="estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body>

    <div class="row">
        <div class="col-3 ">
            <div class="page-wrapper chiller-theme toggled">
                <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
                    <i class="fas fa-bars"></i>
                </a>
                <nav id="sidebar" class="sidebar-wrapper">
                    <div class="sidebar-content">
                        <div class="sidebar-brand">
                            <a href="#">Artesanix</a>
                            <div id="close-sidebar">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                        <div class="sidebar-header">
                            <div class="user-pic">
                                <img class="img-responsive img-rounded"
                                    src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                                    alt="User picture">
                            </div>
                            <div class="user-info">
                                <span class="user-name">Johan <strong>Carrillo</strong></span>
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
                                    <a href="#">
                                        <i class="fas fa-user-alt"></i>
                                        <span>Mi Perfil</span>
                                    </a>
                                </li>
                                <li class="sidebar-dropdown">
                                    <a href="#">
                                        <i class="fas fa-plus"></i>
                                        <span>Mis Aportes</span>
                                    </a>
                                    <div class="sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="#">Mis likes</a>
                                            </li>
                                            <li>
                                                <a href="#">Mis Comentarios</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="sidebar-dropdown">
                                    <a href="#">
                                        <i class="fas fa-bell"></i>
                                        <span>Notificaciones</span>
                                    </a>
                                </li>
                                <li class="sidebar-dropdown">
                                    <a href="#">
                                        <i class="fas fa-sms"></i>
                                        <span>Chats</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- sidebar-menu  -->
                    </div>
                    <!-- sidebar-content  -->
                    <div class="sidebar-footer">
                        <a href="#">
                            <i class="fa fa-bell"></i>
                            <span class="badge badge-pill badge-warning notification"></span>
                        </a>
                        <a href="#">
                            <i class="fa fa-envelope"></i>
                            <span class="badge badge-pill badge-success notification"></span>
                        </a>
                        <a href="#">
                            <i class="fa fa-cog"></i>
                            <span class="badge-sonar"></span>
                        </a>
                    </div>
                </nav>

                <!-- page-content" -->
            </div>
        </div>
        <div class="col-8">
            <?php foreach($resultado as $row){?>
            <div class="card text-center mt-3">
                <div class="card-header text-start">
                    <div class="row">
                        <div class="col-1">
                            <img class="img-responsive rounded"
                                src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                                alt="User picture" width="30px" height="30px">
                        </div>
                        <div class="col-3">
                            <p class="lead">Pepito Perez</p>
                        </div>

                        <div class="col-8 text-end">
                            <button class="btn btn-outline-primary btn-sm">Ver Perfil</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!--imagen-->
                    <img src="../Backend/imagenes/<?php echo $row['ImagenTejido'];?>" class="card-img-top" alt="...">
                    <!--Fin imagen-->
                    <div class="mt-2">
                        <div class="row mb-0">
                            <div class="col-5">
                                <p class="text-start text-muted">Estado: "A la venta"</p>
                            </div>
                            <div class="col-7">
                                <p class="text-end text-muted">Fecha de Publicación: 5 de Abril</p>
                            </div>
                        </div>
                        <h4 class="card-title mt-2"><?php echo $row['titulo'];?></h4>
                        <p class="card-text"><?php echo $row['descp'];?></p>
                        <p class="lead">Precio: <?php echo $row['precio'];?>.000</p>
                        <a href="#" class="btn btn-primary">Ofertar</a>

                    </div>
                    <div class="card-footer text-muted mt-2">
                        <p>COMENTARIOS</p>
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
    <script src="scr.js"></script>
</body>

</html>