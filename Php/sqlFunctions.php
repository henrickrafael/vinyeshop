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


function validaCPF($cpf) { 
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

?>