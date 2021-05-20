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
    <link rel="stylesheet" href="../assets/css/lista.css">
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
            <form action="../Backend/editarPersona.php" method="POST">
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
            <form action="../Backend/eliminarUsuario.php" method="POST">
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
    <script src="../assets/js/scr.js"></script>

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
                url: '../Backend/mtcl.php',
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