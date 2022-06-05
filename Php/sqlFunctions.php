<?php
    
function insertDisco($con, String $nome, String $descricao, Int $id_artista, String $lanc, Int $id_genero, Float $preco, ?String $foto) {
    $insert = "INSERT INTO discos (nome, descricao, id_artista, lancamento, id_genero, valor, foto, ativo)
    VALUES ('{$nome}', '{$descricao}', '{$id_artista}', '{$lanc}', '{$id_genero}', '{$preco}', '{$foto}','S')";

    $sql = mysqli_query($con, $insert);
    
    if(!$sql) {
        echo mysqli_error($con);
    } else {
        echo "Registro inserido com sucesso!";
    }

}

function insertUser($con, String $nome, String $descricao, Int $id_artista, String $lanc, Int $id_genero, Float $preco, ?String $foto) {
    
    $insert = "INSERT INTO discos (nome, descricao, id_artista, lancamento, id_genero, valor, foto, ativo)
    VALUES ('{$nome}', '{$descricao}', '{$id_artista}', '{$lanc}', '{$id_genero}', '{$preco}', '{$foto}','S')";

    $sql = mysqli_query($con, $insert);
    
    if(!$sql) {
        echo mysqli_error($con);
    } else {
        echo "Registro inserido com sucesso!";
    }

}

function updateDisco() {

}

function validaDiscoAtivo($con, Int $id)  {
    $select = "SELECT ativo FROM discos WHERE id = {$id} ";
    $query = mysqli_query($con, $select);

    $result = mysqli_fetch_assoc($query);
    $rlt = implode(",",$result);

    if($rlt <> 'S') {
        echo "<script>window.location.replace('Home.php');</script>";
    } 

}    

function formataData($data) {

    $data = explode("-", $data);
    $dataRefact = $data[2]."/".$data[1]."/".$data[0];

    echo $dataRefact;
}

function deleteDisco($con,Int $id) {
    $delete = "DELETE FROM disco WHERE id = '{$id}' ";
    $sql = mysqli_query($con, $delete);

    if(!$sql) {
        echo mysqli_error($con);
    } else {
        echo "Registro removido com sucesso!";
    }

}



?>