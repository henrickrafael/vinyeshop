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
    <title>Cadastro de gêneros e artistas</title>
</head>
<body>
    <div class="main-wrapper-register main-disco cat-artist"><!--main-wrapper-register-->
        <div class="form-1 disco-form"><!--form-1-->
            <div class="label-header">
                <h2>Cadastrar gênero ou artista</h2>
            </div><!--label-header-->         
            <form action="#" method="POST" enctype="multipart/form-data">
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Nome</span>
                    <input type="text" name="nome" maxlength="35" value="" required>
                </div>         
            </div>              
            <div class="input-login-wrapper register-input cad-disco">
                <select name="tipo">                             
                    <option value="" disabled selected>Tipo do cadastro</option>
                    <option value="1">Artista</option>
                    <option value="2">Gênero</option>                    
                </select>       
            </div>        
            <div class="input-login-wrapper register-input cad-disco">
                <select name="situacao">                             
                    <option value="" disabled selected>Situação do cadastro</option>
                    <option value="S">Ativo</option>
                    <option value="N">Inativo</option>                    
                </select>       
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
    if (@$_REQUEST['botao']){

        if(@$_POST['tipo'] == 1){

        insertArtista($con, $_POST['nome'], $_POST['situacao']);
        }

        else if(@$_POST['tipo'] == 2){
            insertGenero($con, $_POST['nome'], $_POST['situacao']);
        }
    }

    

?>
</body>
</html>