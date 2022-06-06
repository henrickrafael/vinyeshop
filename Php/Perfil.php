<?php
    include('conexao.php');
    include('sqlFunctions.php');
    //include('verifica.php');    
?>

<!DOCTYPE html>
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
    <title>Meu Perfil</title>
</head>
<body>
    <div class="profile-wrapper">
        <div class="profile-image-wrapper">
            <img src="../images/kill-em-all.jpg" onerror="this.className='image-error'; this.src='../images/no-foto.svg';" alt="imagem">
        </div>
        <form action="#" method="POST">
        <div class="input-login-wrapper register-input">
            <div class="input-login">
                <span>Email</span>
                <input type="email" name="email" value="" required>
            </div>         
        </div>
        <div class="input-login-wrapper register-input">
            <div class="input-login">
                <span>Foto</span>
                <input type="file" name="email" value="" required>
            </div>         
        </div>
        <div class="input-login-wrapper register-input">
            <div class="input-login">
                <span>Senha:</span>
                <input type="password" name="senha" value="" required>
            </div>         
        </div>
        <div class="input-login-wrapper input-submit-login">
            <div class="input-login">
                <input id="btnCad" type="submit" name="botao" value="Atualizar">
            </div>     
        </div>
    </form>
    </div>
</body>
</html>