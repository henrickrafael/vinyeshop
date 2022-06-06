<!DOCTYPE html>
<?php
    include('conexao.php');
    include('sqlFunctions.php');
    require('verifica.php');

    $tipo_usr = $_SESSION['tipo_usuario'];

     if($tipo_usr <> 'A') {
        echo "<script>window.location.replace('HomeAuth.php');</script>";
     }

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
                    <input type="text" name="nome" maxlength="35" value="<?php echo @$_POST['nome']; ?>"required>
                </div>         
            </div>
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Descricao</span>
                    <input type="text" name="desc" maxlength="11" value="<?php echo @$_POST['cpf']; ?>"required>
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
                        
                        <option value="<?php echo $row['id']?>"> <?php echo $row['nome'] ?></option>
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
                        
                        <option value="<?php echo $row['id']?>"> <?php echo $row['nome'] ?></option>
                    <?php
                        }
                    ?>        

                </select>       
            </div>
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Lançamento:</span>
                    <input type="date" name="lanc" required>
                </div>         
            </div>
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Preço:</span>
                    <input type="number" min="0" name="preco" placeholder="R$" required>
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


if(@$_REQUEST['botao']){

    @$senha = md5(@$_POST['senha']);
    @$confirmasenha = md5(@$_POST['confirma_senha']);
   
        //if ($senha == "d41d8cd98f00b204e9800998ecf8427e") {
        //$mensagem = "Senha não foi inserida!";
        

        if(validaCPF($_POST['cpf']) == false){
            echo "<script>alert('Cpf invalido');</script>";
            exit;
        }

    if ($senha == $confirmasenha) {

        if( $_FILES["foto"]["type"] !== "image/png") { 
            echo "<script>alert('Imagem não suportada');</script>";
            exit;
        }
       
        
    

        $insere = "INSERT INTO usuarios (nome, cpf, email, nasc, sexo, senha) values ('{$_POST['nome']}','{$_POST['cpf']}','{$_POST['email']}','{$_POST['nasc']}','{$_POST['sexo']}','$senha')";

        $result_insere = mysqli_query($con,$insere);


        if ($result_insere) {
            $file_name = $_FILES['foto']['name'];
            $last_id = mysqli_insert_id($con);
    
            $nFt = $last_id;
            $ext = '.png';
            move_uploaded_file($_FILES['foto']['tmp_name'], 'teste/'.$nFt.$ext);
    
            $nomeFoto = $nFt.$ext;
    
            $update = "UPDATE usuarios SET foto = '{$nomeFoto}' WHERE id = {$last_id} ";
            mysqli_query($con, $update);

            echo "<script>alert('Cadastro realizado com sucesso'); window.location.replace('Home.php');</script>";
        }
    }

    else {
            $mensagem = "As senhas não conferem!";
            echo "<script>alert('$mensagem');</script>";
        }
   
    }
    
    

?>
</body>
</html>