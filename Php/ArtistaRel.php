<?php
    include('conexao.php');
    include('sqlFunctions.php');
    include('verifica.php');

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
    <title>Relatorio de artistas</title>
</head>
<body>
    <div class="top_menu">
        <div class="top_menu_item"> 
        <span><a href="Painel.php">Painel de controle</a></span>      
        <span><a href="HomeAuth.php">Home</a></span>        
        </div> <!--top_menu_item-->
    </div> <!--top_menu -->
    <form action="#" method="POST">
        <div class="header">
            <h2>Filtros</h2>
        </div>
        <div class="rel-filter-wrapper artist-filter">
            <div class="rel-d-input-wrapper">
                <input type="text" placeholder="Nome do artista" name="nome">
            </div>
            <div class="rel-d-input-wrapper">
                <select name="situacao">
                    <option value="" disabled selected>Situação</option>
                    <option value="">Ambos</option>
                    <option value="S">Ativo</option>
                    <option value="N">Inativo</option>
                </select>
            </div>
        </div>
        <div class="rel-filter-wrapper select-d">
            <div class="rel-d-input-wrapper">
                <input type="submit" name="botao" value="Pesquisar">
            </div>            
            <div class="rel-d-input-wrapper">
                <input type="submit" name="botao" value="Exportar">
            </div>
            <div class="rel-d-input-wrapper">
               <a href="#" onclick="print()">Imprimir</a>
            </div>
        </div>
    </form>
    <div class="database-wrapper">
        <div class="data-header"><!--Corpo que está juntando dos itens do cabeçalho-->
           <div class="header-column">
                <span>Artista</span>
            </div>
           <div class="header-column">
                <span>Situação</span>
           </div>
           <div class="header-column data-value">
                <span>Editar</span>
            </div>
        </div>
        
        <?php
            $select = "SELECT a.id as 'Id', a.nome as 'Nome', IF(a.ativo = 'S', 'Ativo', 'Inativo') as 'Situacao'
            FROM artistas a WHERE a.id > 0";

            if(@$_REQUEST['botao'] == "Pesquisar") { 
                $select .= ($_POST['nome'] ? " AND a.nome LIKE '%{$_POST['nome']}%' " : "");
                $select .= (@$_POST['situacao'] ? " AND a.ativo = '{$_POST['situacao']}' " : "");
            }

            $query = mysqli_query($con, $select);
            while($sql=mysqli_fetch_assoc($query)) { ?>

        <div class="data-content">
            <div class="data-row">
                <span><?php echo $sql['Nome'] ?></span>
           </div>
            <div class="data-row">
                <span><?php echo $sql['Situacao'] ?></span>
            </div>
            <div class="data-row data-value">
                <a href="ArtistaEditar.php?id=<?php echo $sql['Id']?>">
                    <img src="../images/edit.svg" alt="">
                </a>
            </div>
        </div>
        <?php
            }
        ?>
    </div>

</body>
</html>