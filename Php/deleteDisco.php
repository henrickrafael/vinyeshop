<?php
    include('conexao.php');
    include('sqlFunctions.php');
    include('verifica.php');

    $tipo_usr = $_SESSION['tipo_usuario'];
    
    if($tipo_usr <> 'A') {
        echo "<script>window.location.replace('HomeAuth.php');</script>";
    }
    
    $id = @$_GET['id'];

    if(isset($id)) {
        deleteDisco($con, $id);
    } else {
        echo "<script>window.location.replace('Painel.php');</script>";
    }

?>