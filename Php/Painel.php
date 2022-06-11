<?php
    include('conexao.php');
    include('sqlFunctions.php');
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
    <title>Painel de controle</title>
</head>
<body>
    <div class="top_menu">
        <div class="top_menu_item">
            <span><a href="Perfil.php">Meu perfil</a></span>            
            <span><a href="HomeAuth.php">Home</a></span> 
        </div> <!--top_menu_item-->
    </div> <!--top_menu -->
    <div class="panel-header">
        <h2>Painel de controle</h2>
    </div>
    <div class="panel-manual-wrapper">
        <div class="manual-item">
            <a href="#">Manual do sistema</a>
        </div>
    </div>
    <div class="panel-option-wrapper">
        <div class="panel-option-item">
            <a href="DiscoCad.php">
                <img src="../images/cad_vinyl.svg">
                <!-- <span>Cadastrar discos</span> -->
                <div class="text-container">
                    <span>Cadastrar disco</span>
                </div>
            </a>
        </div>
        <div class="panel-option-item">
            <a href="DiscoCad.php">
                <img src="../images/rel_vinyl.svg">
                <div class="text-container">
                    <span>Relatório de discos</span>
                </div>
            </a>
        </div>
        <div class="panel-option-item">
            <a href="DiscoCad.php">
                <img src="../images/artist_gen.svg">
                <div class="text-container">
                    <span>Cadastrar artista/gênero</span>
                </div>
            </a>
        </div>        
        <div class="panel-option-item">
            <a href="DiscoCad.php">
                <img src="../images/rel_cad-artist.svg">
                <div class="text-container">
                    <span>Relatório de artista/gênero</span>
                </div>
            </a>
        </div>
        <div class="panel-option-item">
            <a href="DiscoCad.php">
                <img src="../images/storage.svg">
                <div class="text-container">
                    <span>Estoque</span>
                </div>
            </a>
        </div>
        <div class="panel-option-item">
            <a href="DiscoCad.php">
                <img src="../images/sales.svg">
                <div class="text-container">
                    <span>Relatório de vendas</span>
                </div>
            </a>
        </div>
    </div>
</body>
</html>