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

function updateDisco() {

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