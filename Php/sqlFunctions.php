<?php
    
function insertDisco($con, String $nome, String $descricao, Int $id_artista, String $lanc, Int $id_genero, Float $preco) {
    $insert = "INSERT INTO discos (nome, descricao, id_artista, lancamento, id_genero, valor, ativo)
    VALUES ('{$nome}', '{$descricao}', '{$id_artista}', '{$lanc}', '{$id_genero}', '{$preco}','S')";

    $sql = mysqli_query($con, $insert);
    
    if ($sql) {
        //$file_name = $_FILES['foto']['name'];
        $last_id = mysqli_insert_id($con);
        $nome =@$_POST['nome'];

        $nFt = $nome;
        $ext = '.png';
        move_uploaded_file($_FILES['foto']['tmp_name'], '../images/'.$nFt.$ext);

        $nomeFoto = '../images/'.$nFt.$ext;

        $update = "UPDATE discos SET foto = '{$nomeFoto}' WHERE id = {$last_id} ";
        mysqli_query($con, $update);

        $insert = "INSERT INTO estoque (id_discos, quantidade) VALUES ('{$last_id}', '0')";
        $sql = mysqli_query($con, $insert);

        echo "<script>alert('Cadastro realizado com sucesso'); window.location.replace('HomeAuth.php');</script>";
        
    }
}


function updateDisco($con, Int $id, ?String $nome, ?String $descricao, ?Int $id_artista, ?String $lanc, ?Int $id_genero, ?Float $preco) {
    $update = 
    "UPDATE discos SET 
    nome ='{$nome}', 
    descricao = '{$descricao}', 
    id_artista = '{$id_artista}', 
    lancamento = '{$lanc}', 
    id_genero = '{$id_genero}', 
    valor = '{$preco}'
    WHERE id = '{$id}'";

    $sql = mysqli_query($con, $update);
    
    if ($sql) {
        //$file_name = $_FILES['foto']['name'];
        $nome =@$_POST['nome'];

        $nFt = $nome;
        $ext = '.png';
        move_uploaded_file($_FILES['foto']['tmp_name'], '../images/'.$nFt.$ext);

        $nomeFoto = '../images/'.$nFt.$ext;

        $update = "UPDATE discos SET foto = '{$nomeFoto}' WHERE id = {$id} ";
        mysqli_query($con, $update);

        echo "<script>alert('Cadastro atualizado com sucesso'); window.location.replace('HomeAuth.php');</script>";
    }
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

function validaEstoque($con, Int $id) {
    $select = "SELECT quantidade FROM estoque WHERE id_discos = {$id} ";
    $query = mysqli_query($con, $select);

    $result = mysqli_fetch_assoc($query);
    $rlt = implode(",",$result);

    if($rlt <= 0) {
        echo "<script>window.location.replace('Home.php');</script>";
    } 
}

function formataData($data) {

    $data = explode("-", $data);
    $dataRefact = $data[2]."/".$data[1]."/".$data[0];

    echo $dataRefact;
}

function deleteDisco($con,Int $id) {
    $delete = "UPDATE discos SET ativo = 'N' WHERE id = '{$id}' ";
    $sql = mysqli_query($con, $delete);

    if(!$sql) {
        echo mysqli_error($con);
    } else {
        echo "Registro removido com sucesso!";
    }

}

function deleteGenero($con,Int $id) {
    $delete = "UPDATE genero SET ativo = 'N' WHERE id = '{$id}' ";
    $sql = mysqli_query($con, $delete);

    if(!$sql) {
        echo mysqli_error($con);
    } else {
        echo "Gênero removido com sucesso!";
    }

}

function deleteArtista($con,Int $id) {
    $delete = "UPDATE artistas SET ativo = 'N' WHERE id = '{$id}' ";
    $sql = mysqli_query($con, $delete);

    if(!$sql) {
        echo mysqli_error($con);
    } else {
        echo "Artista removido com sucesso!";
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
function insertArtista($con, String $nome, String $ativo) {
    $insert = "INSERT INTO artistas (nome, ativo)
    VALUES ('{$nome}', '{$ativo}')";

    $sql = mysqli_query($con, $insert);
   
    echo "<script>alert('Cadastro atualizado com sucesso'); window.location.replace('HomeAuth.php');</script>";
}

function insertGenero($con, String $nome, String $ativo) {
    $insert = "INSERT INTO genero (nome, ativo)
    VALUES ('{$nome}', '{$ativo}')";

    $sql = mysqli_query($con, $insert);
   
    echo "<script>alert('Cadastro atualizado com sucesso'); window.location.replace('HomeAuth.php');</script>";
}

function updateGenero($con, Int $id, String $nome, String $ativo) {
    $update = 
    "UPDATE genero SET 
    nome ='{$nome}', 
    ativo = '{$ativo}'
    WHERE id = '{$id}'";

$sql = mysqli_query($con, $update);

   
    echo "<script>alert('Genero atualizado com sucesso'); window.location.replace('HomeAuth.php');</script>";
}

function updateArtista($con, Int $id, String $nome, String $ativo) {
    $update = 
    "UPDATE artistas SET 
    nome ='{$nome}', 
    ativo = '{$ativo}'
    WHERE id = '{$id}'";

$sql = mysqli_query($con, $update);

   
    echo "<script>alert('Artista atualizado com sucesso'); window.location.replace('HomeAuth.php');</script>";
}

function updateEstoque($con, Int $id, String $qtd) {
    
    $update = 
    "UPDATE estoque SET  
    quantidade = '{$qtd}'
    WHERE id_discos = '{$id}'";

$sql = mysqli_query($con, $update);

   
    echo "<script>alert('Estoque atualizado com sucesso'); window.location.replace('HomeAuth.php');</script>";
}
?>