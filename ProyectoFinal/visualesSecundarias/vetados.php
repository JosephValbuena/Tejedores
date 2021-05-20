<?php 
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
        <div class="col-3 ">
            <?php include ('../Backend/sidebar.php'); ?>
        </div>
        <div class="col-8">

            <?php
                $verificar = mysqli_query($conn, "SELECT * FROM vetados");
                $contar = mysqli_num_rows($verificar);

                if($contar > 0){
            ?>
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
                        $obtDatos = mysqli_query($conn,"SELECT * FROM vetados");
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
                                <a class="editar btn-volver" id="volverP" href="#"><i class="fas fa-check"></i></a>
                            </td>
                        </tr>
                        <?php  
                        }
                    } 
                    ?>
                    </tbody>
                </table>
            </div>

            <?php
                }else {
            ?>

            <div class="cerov">
                <div class="contenido">
                    <img src="../Backend/imagenes/imgNoHay.png" width="200px" height="200px"
                        alt="Imagen ilustrativa">
                    <h3>¡Aún no hay usuarios vetados!</h3>
                    <p>Es mejor así, ¿no lo crees?</p>
                </div>
            </div>

            <?php } ?>
        </div>
    </div>


    <div class="overlay3">
        <div class="popup3">
            <a href="#" id="btn-cerrar-popup3" class="btn-cerrar-popup3"><i class="fas fa-times"></i></a>
            <h3>¿Seguro desea quitar el estado de vetado al usuario?</h3>
            <form action="../Backend/quitarVetado.php" method="POST">
                <input type="hidden" name="idPersona3" class="idPersona3" id="idPersona3">
                <input type="submit" class="btn-submit3" value="quitar vetado">
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

        $('.btn-volver').click(function() {
            var getpID = $(this).parent().attr('id').replace('need-', '');
            $('.idPersona3').val(getpID);
            $('.overlay3').addClass("active");
            $('.popup3').addClass("active");
        });

        $('.btn-cerrar-popup3').click(function() {
            $('.overlay3').removeClass("active");
            $('popup3').removeClass("active");
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