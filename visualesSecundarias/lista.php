<?php 

//esto es una prueba 
  session_start();
  include('../Backend/conectar.php');

  if($_SESSION['user_id'] == '21'){
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
        $idEdit = null;
  
        if(count($results)> 0){
            $nombre = $results['nombre'];       
            $foto = $results['foto'];
            $id = $_SESSION['user_id'];
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
    <title>Lista de Usuarios</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../visualesSecundarias/css/lista.css">
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
                                <img class="img-responsive img-rounded" src="../Backend/imagenes/usuarios/<?=$foto?>"
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
                                                    
                                                    $contNoti = mysqli_num_rows($noti);
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
                                        href="../visualesSecundarias/chatAdmin.php?usuario=<?php echo $_SESSION['user_id'];?>">
                                        <i class="fas fa-sms"></i>
                                        <span>Chats</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <div class="sidebar-footer ">
                        <a class="btn btn-danger" href="/ProyectoFinal/logout.php" role="button">Salir</a>
                    </div>
                </nav>

            </div>
        </div>
        <div class="col-8">
            <div class="tabla">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">tipo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Herramientas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $obtDatos = mysqli_query($conn,"SELECT * FROM usuarios");
                    ?>

                        <?php foreach($obtDatos as $row){ 
                        
                        if($row['tipo'] != 'a'){    
                    ?>
                        <tr>
                            <th scope="row"><?=$row['id']?></th>
                            <td><?=$row['tipo']?></td>
                            <td><?=$row['nombre']?></td>
                            <td><?=$row['correo']?></td>
                            <td id="need-<?=$row['id']?>">
                                <a class="editar btn-editar" id="editarP" href="#"><i class="fas fa-pen"></i></a>
                                <a class="eliminar btn-eliminar" href="#"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                        <?php  
                        }
                    } 
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <div class="overlay ">
        <div class="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <h3>Editar Usuario</h3>
            <form action="/ProyectoFinal/Backend/editarPersona.php" method="POST">
                <?php
                    
                ?>
                <div class="contenedor-inputs">
                    <input type="hidden" name="idPersona" class="idPersona" id="idPersona">
                    <label for="nombre">Nombre Nuevo</label><br>
                    <input type="text" name="nombre" id="nombre"><br>
                    <label for="email">Correo Nuevo</label><br>
                    <input type="email" name="email" id="email"><br>
                    <label for="descp">Nueva descripción</label><br>
                    <textarea name="descp" id="descp" cols="20" rows="3" maxlength="180"></textarea><br>
                    <input type="submit" class="btn-submit" value="Realizar edit">
                </div>
            </form>
        </div>
    </div>

    <div class="overlay2">
        <div class="popup2">
            <a href="#" id="btn-cerrar-popup2" class="btn-cerrar-popup2"><i class="fas fa-times"></i></a>
            <h3>¿Seguro desea vetar el usuario?</h3>
            <form action="/ProyectoFinal/Backend/eliminarUsuario.php" method="POST">
                <input type="hidden" name="idPersona2" class="idPersona2" id="idPersona2">
                <input type="submit" class="btn-submit2" value="Eliminar">
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
    <script src="/ProyectoFinal/visualPrincipal/scr.js"></script>

    <script>
    $(document).ready(function() {
        $('.btn-editar').click(function() {
            var getpID = $(this).parent().attr('id').replace('need-', '');
            $('.idPersona').val(getpID);
            $('.overlay').addClass("active");
            $('.popup').addClass("active");
        });

        $('.btn-cerrar-popup').click(function() {
            $('.overlay').removeClass("active");
            $('popup').removeClass("active");
        });

        $('.btn-eliminar').click(function() {
            var getpID = $(this).parent().attr('id').replace('need-', '');
            $('.idPersona2').val(getpID);
            $('.overlay2').addClass("active");
            $('.popup2').addClass("active");
        });

        $('.btn-cerrar-popup2').click(function() {
            $('.overlay2').removeClass("active");
            $('popup2').removeClass("active");
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $("#marcarCL").click(function() {
            var id = <?php echo $_SESSION['user_id']; ?>;
            $.ajax({
                url: 'http://localhost/ProyectoFinal/Backend/mtcl.php',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    var seHizo = data['notiAct'];
                    alert(seHizo);
                }
            });
        });
    });
    </script>
</body>

</html>