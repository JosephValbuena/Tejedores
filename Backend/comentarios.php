<?php 
    include('conectar.php');

    if(isset($_POST['coment']) && !empty($_POST['coment'])){

        $coment = $_POST['coment'];
        $idPublic = $_POST['idPublic'];
        echo $idPublic;
            $queryComent= "INSERT INTO tejido(titulo,tipo,idUsuario,depend) values( '$coment',2,1,$idPublic)";
            $resultado = mysqli_query($conn,$queryComent);
            if($resultado){
                echo "Comentario subido";
                $_SESSION['mensaje'] = 'se ha subido correctamente';
                header('location:../visualPrincipal/vTejedor.php');
            }else{
                echo $conn->error;
                $_SESSION['mensaje'] = 'Ocurrió un error'; 
            }
    }else{
        echo "NO hay comentario";
    }



?>