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
    <title>Editar estoque</title>
</head>
<body>

<?php

if (isset($id) && !@$_REQUEST['botao']) {
	
    $select = 
    "SELECT d.id as 'Id', d.nome as 'Disco', e.quantidade as 'Qtd'
        FROM discos d 
        INNER JOIN estoque e on d.id = e.id_discos 
        WHERE d.id=' {$id}'";

	$result = mysqli_query($con,$select);
    
	$row = mysqli_fetch_assoc($result);
	
    foreach( $row as $key => $value )
	{
		$_POST[$key] = $value;
	}
}

?>
  <div class="top_menu">
        <div class="top_menu_item"> 
        <span><a href="Painel.php">Painel de controle</a></span>      
        <span><a href="HomeAuth.php">Home</a></span>    
        <span><a href="Logout.php">Sair</a></span>     
        </div> <!--top_menu_item-->
    </div> <!--top_menu -->

    <div class="main-wrapper-register main-disco cat-artist"><!--main-wrapper-register-->
        <div class="form-1 disco-form"><!--form-1-->
            <div class="label-header">
                <h2>Editar estoque</h2>
            </div><!--label-header-->         
            <form action="#" method="POST" enctype="multipart/form-data">
            <div class="input-login-wrapper register-input">
                <div class="input-login">
                    <span>Nome</span>
                    <input type="text" name="nome" maxlength="35"  value="<?php echo @$_POST['Disco']; ?>" readonly>
                </div>         
            </div>                 
            <div class="input-login-wrapper register-input">
            <div class="input-login">
                <span>Quatidade</span>
                    <input type="text" name="quantidade" maxlength="35"  value="<?php echo @$_POST['Qtd']; ?>" required>
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
    if (@$_REQUEST['botao']){
        updateEstoque($con, $id, $_POST['quantidade']);    
    }
    ?>
</body>
</html>