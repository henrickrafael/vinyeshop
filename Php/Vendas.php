<?php
    include('conexao.php');
    include('sqlFunctions.php');
    include('verifica.php');

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
    <title>Relatorio de vendas</title>
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
        <div class="rel-filter-wrapper">
            <div class="rel-d-input-wrapper">
                <input type="text" placeholder="Nome do disco" name="disco">
            </div>
            <div class="rel-d-input-wrapper">
                <input type="text" placeholder="Cliente" name="cliente">
            </div>
            <div class="rel-d-input-wrapper">
                <input type="text" placeholder="Gênero" name="genero">
            </div>
            <div class="rel-d-input-wrapper">
                <input type="number" min="0" placeholder="Limite de registros" name="lmt">
            </div>
            <div class="rel-d-input-wrapper">
                <select name="sexo">
                    <option value="" disabled selected>Sexo</option>
                    <option value="">Ambos</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>                   
                </select>
            </div>
            <div class="rel-d-input-wrapper">
                <select name="pagamento">
                    <option value="" disabled selected>Pagamento</option>
                    <option value="">Ambos</option>
                    <option value="B">Boleto</option>
                    <option value="C">Cartão</option>
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
            <div class="header-column r">
                <span>Venda</span>
            </div>
            <div class="header-column r">
                <span>Disco</span>
            </div>
            <div class="header-column r">
                <span>Gênero</span>
            </div>
            <div class="header-column r">
                <span>Cliente</span>
            </div>
            <div class="header-column r">
                <span>Sexo</span>
            </div>
            <div class="header-column r">
                <span>Quantidade</span>
            </div>
            <div class="header-column r">
                <span>Total</span>
            </div>
            <div class="header-column r">
                <span>Data</span>
            </div>
            <div class="header-column r">
                <span>Pagamento</span>
            </div>
        </div>
        
        <?php

            $handle = fopen("../images/VendasRel.txt", "w+");
            $expo = "Venda;Disco;Gênero;Cliente;Sexo;Quantidade;Total;Data;Pagamento\n";
            fwrite($handle, $expo);

            $select = 
            "SELECT v.id as 'Id', v.qtd as 'Qtd', v.data_compra as 'Data', IF(v.tipo_pagamento = 'C', 'Cartão', 'Boleto') as 'Pgto', 
             v.valor_total as 'Vt', d.nome as 'Disco', u.nome as 'Usuario', IF(u.sexo = 'F', 'Feminino', 'Masculino') as 'Sexo', g.nome as 'Genero'
             FROM venda v  
             INNER JOIN discos d on v.id_discos = d.id
             INNER JOIN usuarios u on v.id_usuario = u.id
             INNER JOIN genero g on d.id_genero = g.id";


            if(@$_REQUEST['botao'] == "Pesquisar") { 
                $select .= ($_POST['disco'] ? " AND d.nome LIKE '%{$_POST['disco']}%' " : "");
                $select .= ($_POST['cliente'] ? " AND u.nome LIKE '%{$_POST['cliente']}%' " : "");
                $select .= ($_POST['genero'] ? " AND g.nome LIKE '%{$_POST['genero']}%' " : "");
                $select .= (@$_POST['sexo'] ? " AND u.sexo = '{$_POST['sexo']}' " : "");
                $select .= (@$_POST['pagamento'] ? " AND v.tipo_pagamento = '{$_POST['pagamento']}' " : "");
                $select .= ($_POST['lmt'] ? " LIMIT {$_POST['lmt']} " : "");
            }

             $query = mysqli_query($con, $select);
             while($sql=mysqli_fetch_assoc($query)) { ?>

        <div class="data-content">
            <div class="data-row data-genre">
                <span><?php echo $sql['Id'] ?></span>
            </div>
            <div class="data-row data-genre">
                <span><?php echo $sql['Disco'] ?></span>
            </div>
            <div class="data-row data-genre">
                <span><?php echo $sql['Genero'] ?></span>
            </div>
            <div class="data-row data-genre">
                <span><?php echo $sql['Usuario'] ?></span>
            </div>
            <div class="data-row data-genre">
                <span><?php echo $sql['Sexo'] ?></span>
            </div>
            <div class="data-row data-genre">
                <span><?php echo $sql['Qtd'] ?></span>
            </div>
            <div class="data-row data-genre">
                <span>R$ <?php echo $sql['Vt'] ?></span>
            </div>
            <div class="data-row data-genre">
                <span><?php echo formataData($sql['Data']) ?></span>
            </div>
            <div class="data-row data-genre">
                <span><?php echo $sql['Pgto'] ?></span>
            </div>
        </div>
        <?php
         
         $expo = $sql['Id'].";".$sql['Disco'].";".$sql['Genero'].";". $sql['Usuario'].";".$sql['Sexo'].";".$sql['Qtd'].";".$sql['Vt'].";".$sql['Data'].";".$sql['Pgto']."\n";
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