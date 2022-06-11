<!DOCTYPE html>
<?php
    include('conexao.php');
    include('sqlFunctions.php');
    require('verifica.php');

    $tipo_usr = $_SESSION['tipo_usuario'];
    if($tipo_usr <> 'A') {
        echo "<script>window.location.replace('HomeAuth.php');</script>";
     }
     
    $id = @$_GET['id'];

?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../Css/style.css">
    <script src="../JS/script.js"></script>
    <title>Cadastro de disco</title>
</head>
<?php

if (isset($id) && !@$_REQUEST['botao']) {
	$query = "
		SELECT * FROM discos WHERE id=' {$id}'
	";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_assoc($result);
	foreach( $row as $key => $value )
	{
		$_POST[$key] = $value;
	}
}

?>
<body>
    <div class="main-wrapper-register main-disco"><!--main-wrapper-register-->
        <div class="form-1 disco-form"><!--form-1-->
            <div class="label-header">
                <h2>Cadastrar disco</h2>
            </div><!--label-header-->         
            <form action="#" method="POST" enctype="multipart/form-data">
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Nome do disco</span>
                    <input type="text" name="nome" maxlength="35" value="<?php echo @$_POST['nome']; ?>" required>
                </div>         
            </div>
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Descricao</span>
                    <input type="text" name="desc" maxlength="11" value="<?php echo @$_POST['descricao']; ?>" required>
                </div>         
            </div>        
            <div class="input-login-wrapper register-input cad-disco">
                <select name="artista">                             
                    <option value="" disabled selected>Artista</option>

                    <?php 
                        $select = 
                        "SELECT * FROM artistas WHERE id > 0 AND ATIVO = 'S' ";
                        $query = mysqli_query($con, $select); 
    
                        while($row = mysqli_fetch_array($query)) { ?>   
                        
                        <option value=<?php echo $row['id']?> <?php echo (@$_POST['id_artista'] == $row['id'] ? "selected" :""); ?>> <?php echo $row['nome'] ?></option>
                    <?php
                        }
                    ?>        

                </select>       
            </div>
            <div class="input-login-wrapper register-input cad-disco">
                <select name="genero">                             
                    <option value="" disabled selected>Gêneros</option>

                    <?php 
                        $select = 
                        "SELECT * FROM genero WHERE id > 0 AND ATIVO = 'S' ";
                        $query = mysqli_query($con, $select); 
    
                        while($row = mysqli_fetch_array($query)) { ?>   
                        
                        <option value=<?php echo $row['id']?> <?php echo (@$_POST['id_genero'] == $row['id'] ? "selected" :""); ?>> <?php echo $row['nome'] ?></option>
                    <?php
                        }
                    ?>        

                </select>       
            </div>
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Lançamento:</span>
                    <input type="date" name="lanc" value="<?php echo @$_POST['lancamento']; ?>" required>
                </div>         
            </div>
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Preço:</span>
                    <input type="number" min="0" name="preco" placeholder="R$" value="<?php echo @$_POST['valor']; ?>" required>
                </div>         
            </div>
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Arquivo de foto do disco:</span>
                    <input type="file" name="foto">
                </div>         
            </div>
            <div class="input-login-wrapper register-input cad-disco-btn">
                <div class="input-login">
                    <input type="submit" name="botao" value="Cadastrar">
                </div>         
            </div>            
        </div>
        </form>      
    </div>
<?php
    

if(@$_REQUEST['botao'] ){

    if (!@$_REQUEST['id']) {
        insertDisco($con, $_POST['nome'], $_POST['desc'], $_POST['artista'], $_POST['lanc'], $_POST['genero'], $_POST['preco']);
     } else{
        updateDisco($con, $id, $_POST['nome'], $_POST['desc'], $_POST['artista'], $_POST['lanc'], $_POST['genero'], $_POST['preco']);
    }

}

?>
</body>
</html>