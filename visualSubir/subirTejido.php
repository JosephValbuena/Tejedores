<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilosSubida.css">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <title>Document</title>
</head>

<body>
    <p class="nombreEmpresa">Artesanix</p>
    <div class="principal mt-5">
        <h2 class="text-center">Publicar un nuevo tejido</h2>
        <form action="../Backend/subir.php" method="POST" enctype="multipart/form-data" class="formSubir">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título del Tejido</label>
                <input type="text" placeholder="Título del tejido" class="form-control" id="titulo" name="titulo"
                    required>
            </div>
            <div class=" mb-3">
                <label for="descp ">Descripción del Tejido</label>
                <textarea class="form-control mt-2" placeholder="El mejor tejido" id="descp" style="height: 100px"
                    name="descp" required></textarea>

                <?php if(isset($_SESSION['mensaje'])){?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><?php echo $_SESSION['mensaje'];?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php session_unset(); }?>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio del Tejido</label>
                <input type="text" placeholder="150.000" class="form-control" id="precio" name="precio" required>
            </div>

            <div class="mb-3">
                <label for="imagen">Seleccione la imagen que desea subir</label>
                <br>
                <input type="file" name="imagenes" id="imagen" required>
            </div>
            <div class="d-grid gap-2 ">
                <button type="submit" name="subirTejido" class="btn btn-outline-light mt-4">Subir</button>
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>
</body>

</html>