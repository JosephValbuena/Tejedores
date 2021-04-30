<?php
    session_start();
    include('conectar.php');

    $id = $_SESSION['user_id'];

    $marcar = mysqli_query($conn, "UPDATE notificaciones SET leido = 1 WHERE user1 = '$id'");
    
    if($marcar){
        $done = "Todas las notificaciones se han marcado como leídas.";
        $dato = array('notiAct' =>$done);
        echo json_encode($dato);
    }

?>