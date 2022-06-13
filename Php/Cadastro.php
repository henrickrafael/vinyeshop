<!DOCTYPE html>
<?php
    include('conexao.php');
    include('sqlFunctions.php');
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
    <title>Cadastro</title>
</head>
<body>
<div class="top_menu">
        <div class="top_menu_item">
            <span><a href="Login.php">Entrar</a></span>
            <span><a href="Cadastro.php">Cadastre-se</a></span> 
            <span><a href="Home.php">Home</a></span>            
        </div> <!--top_menu_item-->
    </div> <!--top_menu -->
    <div class="main-wrapper-register"><!--main-wrapper-register-->
        <div class="form-1"><!--form-1-->
            <div class="label-header">
                <h2>Cadastre-se</h2>
            </div><!--label-header-->         
            <form action="#" method="POST" enctype="multipart/form-data">
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Nome completo</span>
                    <input type="text" name="nome" maxlength="35" value="<?php echo @$_POST['nome']; ?>"required>
                </div>         
            </div>
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>CPF</span>
                    <input type="text" name="cpf" maxlength="11" value="<?php echo @$_POST['cpf']; ?>"required>
                </div>         
            </div>        
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Email</span>
                    <input type="email" name="email" value="<?php echo @$_POST['email']; ?>" required>
                </div>         
            </div>
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Data de nascimento</span>
                    <input type="date" name="nasc" value="<?php echo @$_POST['nasc']; ?>" required>
                </div>         
            </div>
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Sexo</span>
                    <input id="M" type="radio" value="M" name="sexo" checked required>
                    <label for="M">Masculino</label>
                    <input id="F" type="radio" value="f" name="sexo">
                    <label for="F">Feminino</label>
                </div>         
            </div>
        </div>
        <div class="form-2">
            <div class="label-header"></div>
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Insira uma senha</span>
                    <input onchange="checkSenha()" type="password" name="senha" id="pwd" required>
                    <span id="msg" class="error-pwd"></span>
                </div>         
            </div>
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Confirme a senha</span>
                    <input onchange="checkSenha()" type="password" name="confirma_senha" id="check_pwd" required>
                </div>         
            </div>
            <div class="input-login-wrapper register-input input-file">
                <div class="input-login">
                    <span>Arquivo para foto de perfil</span>
                    <input name="foto" type="file">
                </div>         
            </div>
            <div class="input-login-wrapper input-submit-login">
                <div class="input-login">
                    <input id="btnCad" type="submit" name="botao" value="Cadastrar">
                </div>     
            </div>
        </div>
        </form>      
    </div>
<?php


if(@$_REQUEST['botao']){

    @$senha = md5(@$_POST['senha']);
    @$confirmasenha = md5(@$_POST['confirma_senha']);
   
        if(validaCPF($_POST['cpf']) == false){
            echo "<script>alert('Cpf invalido');</script>";
            exit;
        }

    if ($senha == $confirmasenha) {

        $file_error = $_FILES["foto"]["error"];

        /*O erro 4 se refere ao erro informado pelo $_FILES quando nenhum aquivo é selecionado e por se tratar de um Array não há como verificar
        se ele está vazio ou não, pois sempre haverá valores dentro dele. O isset também não funcionou, pois ao realizar o REQUEST ele é setado 
        de qualquer forma.*/

        if(($file_error <> 4) && $_FILES["foto"]["type"] !== "image/png") { 
            echo "<script>alert('Imagem não suportada');</script>";
            exit;
        } 

        $insere = 
        "INSERT INTO usuarios (nome, cpf, email, nasc, sexo, senha, tipo) 
         VALUES ('{$_POST['nome']}','{$_POST['cpf']}','{$_POST['email']}','{$_POST['nasc']}','{$_POST['sexo']}','$senha', 'U')";

        $result_insere = mysqli_query($con,$insere);

        if ($result_insere) {
            $file_name = $_FILES['foto']['name'];
            $last_id = mysqli_insert_id($con);
    
            $nFt = $last_id;
            $ext = '.png';
            move_uploaded_file($_FILES['foto']['tmp_name'], '../images/'.$nFt.$ext);
    
            $nomeFoto ="../images/".$nFt.$ext;
    
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