<!DOCTYPE html>
<?php
    include('conexao.php');
    include('sqlFunctions.php');
    include('verifica.php');
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
    <div class="main-wrapper-register"><!--main-wrapper-register-->
        <div class="form-1"><!--form-1-->
            <div class="label-header">
                <h2>Cadastre-se</h2>
            </div><!--label-header-->         
            <form action="#" method="POST">
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
                    <input type="file">
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
   
        //if ($senha == "d41d8cd98f00b204e9800998ecf8427e") {
        //$mensagem = "Senha não foi inserida!";
    
  
    if ($senha == $confirmasenha) {
    
    

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

            echo "<script>alert('Cadastro realizado com sucesso'); window.location.replace('Login.php');</script>";
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