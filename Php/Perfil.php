<?php
    include('conexao.php');
    include('sqlFunctions.php');
    include('verifica.php');    

    $id =  $_SESSION['id_usuario'];

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
<?php
    $select =  "SELECT * from usuarios WHERE id = '{$id}'";
    $query = mysqli_query($con, $select);

    while($sql=mysqli_fetch_assoc($query)) { ?>
    <div class="profile-wrapper">
        <div class="profile-image-wrapper">
            <img src="<?php echo $sql['foto']?>" onerror="this.className='image-error'; this.src='../images/no-foto.svg';" alt="imagem">
        </div>
        <form action="#" method="POST" enctype="multipart/form-data">
        <div class="input-login-wrapper register-input">
            <div class="input-login">
                <span>Email</span>
                <input type="email" name="email" value="<?php echo $sql['email']?>">
            </div>         
        </div>
        <div class="input-login-wrapper register-input">
            <div class="input-login">
                <span>Foto</span>
                <input type="file" name="foto">
            </div>         
        </div>
        <div class="input-login-wrapper register-input">
            <div class="input-login">
                <span>Senha:</span>
                <input type="password" name="senha" value="">
            </div>         
        </div>
        <div class="input-login-wrapper input-submit-login">
            <div class="input-login">
                <input id="btnCad" type="submit" name="botao" value="Atualizar">
            </div>     
        </div>
    </form>
    </div>

    <?php }

if(@$_REQUEST['botao'] == "Atualizar"){
    
        $senha = md5($_POST['senha']);
    
        $update = "UPDATE usuarios SET 
        email = '{$_POST['email']}', 
        senha = IF('{$senha}' = 'd41d8cd98f00b204e9800998ecf8427e', usuarios.senha, '{$senha}')
        WHERE id = '{$id}' ";


        $result_update = mysqli_query($con,$update);

        if ($result_update) {
            @$file_name = $_FILES['foto']['name'];
            $last_id = mysqli_insert_id($con);
    
            $nFt = $id;
            $ext = '.png';
            move_uploaded_file(@$_FILES['foto']['tmp_name'], 'fotos/'.$nFt.$ext);
    
            $nomeFoto = $nFt.$ext;
    
            $update = "UPDATE usuarios SET foto = '{$nomeFoto}' WHERE id = '{$last_id}' ";
            mysqli_query($con, $update);

            echo "<script>alert('Cadastro atualizado com sucesso'); window.location.replace('Home.php');</script>";
        }
}
    ?>
</body>
</html>