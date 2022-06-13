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
    <title>Relatorio de discos</title>
</head>
<body>
    <div class="top_menu">
        <div class="top_menu_item"> 
        <span><a href="Painel.php">Painel de controle</a></span>      
        <span><a href="HomeAuth.php">Home</a></span>  
        <span><a href="Logout.php">Sair</a></span>       
        </div> <!--top_menu_item-->
    </div> <!--top_menu -->
    <form action="#" method="POST">
        <div class="header">
            <h2>Filtros</h2>
        </div>
        <div class="rel-filter-wrapper">
            <div class="rel-d-input-wrapper">
                <input type="text" placeholder="Nome do disco" name="nome">
            </div>
            <div class="rel-d-input-wrapper">
                <input type="text" placeholder="Artista" name="artista">
            </div>
            <div class="rel-d-input-wrapper">
                <input type="text" placeholder="Gênero" name="genero">
            </div>
            <div class="rel-d-input-wrapper">
                <input type="number" min="0" placeholder="Limite de registros" name="lmt">
            </div>
            <div class="rel-d-input-wrapper">
                <select name="ordenacao">
                    <option value="" disabled selected>Odernar por</option>
                    <option value="">Ordenação padrão</option>
                    <option value="1">Nome do disco</option>
                    <option value="2">Artista</option>
                    <option value="3">Gênero</option>
                </select>
            </div>
            <div class="rel-d-input-wrapper">
                <select name="situacao">
                    <option value="" disabled selected>Situação</option>
                    <option value="">Ambos</option>
                    <option value="S">Ativo</option>
                    <option value="N">Inativo</option>
                </select>
            </div>
        </div> <!-- rel-filter-wrapper -->
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
                <span>Disco</span>
           </div>
           <div class="header-column">
                <span>Artista</span>
            </div>
            <div class="header-column">
                <span>Gênero</span>
           </div>
           <div class="header-column">
                <span>Quantidade</span>
           </div>
           <div class="header-column">
                <span>Preço</span>
           </div>
           <div class="header-column">
                <span>Situação</span>
           </div>
           <div class="header-column data-value">
                <span>Editar</span>
            </div>
            <div class="header-column data-delete">
                <span>Remover</span>
           </div>
        </div>
        
        <?php

            $handle = fopen("../images/DiscoRel.txt", "w+");
            $expo = "Disco;Artista;Gênero;Quantidade;Preço;Situação\n";
            fwrite($handle, $expo);

            $select = 
            "SELECT d.id as 'Id', d.nome as 'Disco', d.valor as 'Preco', 
             IF(d.ativo = 'S', 'Ativo', 'Inativo') as 'Ativo', 
             a.nome as 'Artista', g.nome as 'Genero', e.quantidade as 'Qtd'
             FROM discos d
             INNER JOIN artistas a on d.id_artista = a.id
             INNER JOIN genero g on d.id_genero = g.id
             INNER JOIN estoque e on d.id = e.id_discos";


            if(@$_REQUEST['botao'] == "Pesquisar" && isset($_POST['ordenacao'])) {
                switch ($_POST['ordenacao']) {
                    #Case = 1 -> Nome do disco
                    case "1":
                        $select .= ' ORDER BY d.nome';
                        $select .= ($_POST['lmt'] ? " LIMIT {$_POST['lmt']} " : "");
                        break;
                    #Case = 2 -> Nome do artista    
                    case "2":
                        $select .= ' ORDER BY a.nome';
                        $select .= ($_POST['lmt'] ? " LIMIT {$_POST['lmt']} " : "");
                        break;
                    #Case = 2 -> Nome do gênero    
                    case "3":
                        $select .= ' ORDER BY g.nome';
                        $select .= ($_POST['lmt'] ? " LIMIT {$_POST['lmt']} " : "");
                        break;    
                } #Switch
            } elseif(@$_REQUEST['botao'] == "Pesquisar") { 
                $select .= ($_POST['nome'] ? " AND d.nome LIKE '%{$_POST['nome']}%' " : "");
                $select .= ($_POST['artista'] ? " AND a.nome LIKE '%{$_POST['artista']}%' " : "");
                $select .= ($_POST['genero'] ? " AND g.nome LIKE '%{$_POST['genero']}%' " : "");
                $select .= (@$_POST['situacao'] ? " AND d.ativo = '{$_POST['situacao']}' " : "");
                $select .= ($_POST['lmt'] ? " LIMIT {$_POST['lmt']} " : "");
            }

             $query = mysqli_query($con, $select);
             while($sql=mysqli_fetch_assoc($query)) { ?>

        <div class="data-content">
            <div class="data-row">
                <span><?php echo $sql['Disco'] ?></span>
           </div>
           <div class="data-row">
                <span><?php echo $sql['Artista'] ?></span>
            </div>
            <div class="data-row data-genre">
                <span><?php echo $sql['Genero'] ?></span>
            </div>
            <div class="data-row">
                <span><a href="EstoqueEditar.php?id=<?php echo $sql['Id'] ?>">
                    <?php echo $sql['Qtd'] ?></span>
                </a>
            </div>
            <div class="data-row">
                <span>R$ <?php echo $sql['Preco'] ?></span>
            </div>
            <div class="data-row">
                <span><?php echo $sql['Ativo'] ?></span>
            </div>
            <div class="data-row data-value">
                <a href="DiscoCad.php?id=<?php echo $sql['Id']?>">
                    <img src="../images/edit.svg" alt="">
                </a>
            </div>
            <div class="data-row data-delete">
                <a href="deleteDisco.php?id=<?php echo $sql['Id']?>">
                    <img src="../images/del.svg" alt="">
                </a>
            </div>
        </div>
        <?php
         
         $expo = $sql['Disco'].";".$sql['Artista'].";".$sql['Genero'].";". $sql['Qtd'].";".$sql['Preco'].";".$sql['Ativo']."\n";
         fwrite($handle, $expo);
             }
 
             if(@$_REQUEST['botao'] == "Exportar"){
                 fclose($handle);
                 echo "<script>alert('Arquivo gerado com sucesso'); window.location.replace('HomeAuth.php');</script>";
            }
        ?>
    </div>

</body>
</html>