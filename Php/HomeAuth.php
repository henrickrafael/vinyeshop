<?php
    include('conexao.php');
    include('sqlFunctions.php');
    include('verifica.php');

    $tipo_usr = $_SESSION['tipo_usuario'];
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
    <title>Home</title>
</head>
<body>
    <div class="top_menu">
        <div class="top_menu_item">
        <span><a href="Perfil.php">Meu perfil</a></span>
        <?php
            if($tipo_usr == 'A') { ?>    
            <span><a href="Painel.php">Painel de controle</a></span>
        <?php
            } else {
        ?>          
        <span><a href="HomeAuth.php">Home</a></span> 
        <?php
            }
        ?>
        </div> <!--top_menu_item-->
    </div> <!--top_menu -->
    <div class="hr"></div>
    <div class="main-wrapper">
        <div class="left-option-wrapper">
            <div class="label-wrapper-pw">
                <span>Filtrar por:</span>
            </div> <!-- label-wrapper-pw -->
            <form action="#" method="POST">
                <div class="input-wrapper-pw">                    
                    <select name="ordenacao">
                        <option value="" disabled selected>Ordenação</option>
                        <option value="1">Ordenar por nome do artista</option>
                        <option value="2">Ordenar por nome do disco</option>
                    </select>
                </div><!--input-wrapper-pw-->
                <div class="input-wrapper-pw">                    
                    <input type="text" name="nome_disco" placeholder="Nome do disco" value="<?php echo @$_POST['nome_disco']?>">
                </div><!--input-wrapper-pw-->
                <div class="input-wrapper-pw">                    
                    <input type="text" name="nome_artista" placeholder="Nome do artista" value="<?php echo @$_POST['nome_artista']?>">
                </div><!--input-wrapper-pw-->
                <div class="input-wrapper-pw">                    
                    <input type="number" min="0" name="qtd_registros" placeholder="Quantidade de registros" value="<?php echo @$_POST['qtd_registros']?>">
                </div><!--input-wrapper-pw-->                 
                <div class="price-wrapper-pw">
                    <input type="number" min="0" name="valor_inicial" placeholder="Preço inicial">
                    <input type="number" min="0" name="valor_final" placeholder="Preço final">
                </div>
                <div class="input-wrapper-pw input-wrapper-submit-pw">
                    <input type="submit" name="botao" value="Pesquisar">
                </div>
            </form>
        </div> <!-- left-option-wrapper -->
        <div class="product-main-wrapper">

        <?php
            $select = 
            "SELECT d.id as 'Id', d.nome as 'Disco', d.valor as 'Preco', d.foto as 'Foto', a.nome as 'Artista'
            FROM discos d 
            INNER JOIN artistas a on d.id_artista = a.id 
            INNER JOIN estoque e on d.id = e.id_discos 
            WHERE d.ativo = 'S' AND e.quantidade <> 0 ";

            if(@$_REQUEST['botao'] && isset($_POST['ordenacao'])) {
                switch ($_POST['ordenacao']) {
                    case "1":
                        $select .= ' ORDER BY a.nome';
                        $select .= ($_POST['qtd_registros'] ? " LIMIT {$_POST['qtd_registros']} " : "");
                        break;
                    case "2":
                        $select .= ' ORDER BY d.nome';
                        $select .= ($_POST['qtd_registros'] ? " LIMIT {$_POST['qtd_registros']} " : "");
                        break;
                } 
            } elseif(@$_REQUEST['botao']) {

                $p1 = ($_POST['valor_inicial'] ? $_POST['valor_inicial'] : 0);
                $p2 = ($_POST['valor_final'] ? $_POST['valor_final'] : 999.99);

                $select .= ($_POST['nome_artista'] ? " AND a.nome LIKE '%{$_POST['nome_artista']}%' " : "");
                $select .= ($_POST['nome_disco'] ? " AND d.nome LIKE '%{$_POST['nome_disco']}%' " : "");
                $select .= ($_POST['valor_inicial'] ? " AND d.valor BETWEEN {$p1} AND {$p2} " : "");
                $select .= ($_POST['valor_final'] ? " AND d.valor BETWEEN {$p1} AND {$p2} " : "");
                $select .= ($_POST['qtd_registros'] ? " LIMIT {$_POST['qtd_registros']} " : "");
            } 
            

            $query = mysqli_query($con, $select);

        while($sql=mysqli_fetch_array($query)) { ?> 
            <div class="product-wrapper">
                <div class="image-wrapper">
                    <img src="<?php echo $sql['Foto'] ?>" onerror="this.className='image-error'; this.src='../images/vinyl.svg'; " alt="Capa do disco">
                </div>
                <div class="label-text-produto">
                    <span><?php echo $sql['Disco'] ?></span>
                </div>
                <div class="label-text-produto">
                    <span>Artista: <?php echo $sql['Artista'] ?></span>
                </div>
                <div class="label-text-produto">
                    <span>Preço: <?php echo $sql['Preco'] ?></span>
                </div>
                <div class="label-text-produto lnk-view">
                    <div class="lnk-style">
                        <a href="Visualizar.php?id=<?php echo $sql['Id']?>">Visualizar</a>
                    </div>
                </div>
            </div> 
        <?php } #Fim do while ?> 
        </div> <!--product-wrapper-->
    </div> <!--main-wrapper-->
</body>
</html>