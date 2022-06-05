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
    <title>Login</title>
</head>
<body>
    <div class="main-login-wrapper">
        <div class="main-login">
            <div class="login-label">
                <h1>Login</h1>   
            </div>
        <form action="#" method="POST">     
            <div class="input-login-wrapper">
                <div class="input-login">
                    <span>Email</span>
                    <input type="email" name="email">
                </div>         
            </div>
            <div class="input-login-wrapper input-password">
                <div class="input-login">
                    <span>Senha</span>
                    <input type="password" name="senha">
                </div>         
            </div>
            <div class="input-login-wrapper input-submit-login">
                <div class="input-login">
                    <input type="submit" name="botao" value="Entrar">
                </div>     
            </div>
            <div class="wrapper-register-option">
                <span>Ou</span>
                <span><a href="Cadastro.php">Cadastre-se</a></span>
            </div>
        </form>
        </div>
        <div class="image-login">
            <img src="../images/vinyl-wpp.jpg" alt="Wallpaper de vinyl">
        </div>
    </div>

    <?php 
if(@$_REQUEST['botao'] == "Entrar"){

    @$email = @$_POST['email'];
    @$senha = md5($_POST['senha']);
    
    $verify = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha' ";
    $query = mysqli_query($con, $verify);
    
    while($row = mysqli_fetch_array($query)){
        $_SESSION['id_usuario'] = $row['id'];
        $_SESSION['nome_usuario'] = $row['nome'];
        $_SESSION['tipo_usuario'] = $row['tipo'];
    
        header('Location:Home.php'); 
		exit; 
    }
   
}

?>
</body>
</html>