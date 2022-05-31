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
    <title>Home</title>
</head>
<body>
    <div class="top_menu">
        <div class="top_menu_item">
            <span><a href="#">Página inicial</a></span>
            <span><a href="#">Meu perfil</a></span>            
        </div> <!--top_menu_item-->
    </div> <!--top_menu-->
    <div class="hr"></div>
    <div class="main-wrapper">
        <div class="left-option-wrapper">
            <div class="label-wrapper-pw">
                <span>Filtrar por:</span>
            </div> <!-- label-wrapper-pw -->
            <form action="#" method="POST">
                <div class="input-wrapper-pw">                    
                    <select name="ordern">
                        <option value="" disabled selected>Ordenação</option>
                        <option value="1">Ordenar por nome do artista</option>
                        <option value="2">Ordenar por nome do disco</option>
                    </select>
                </div><!--input-wrapper-pw-->
                <div class="input-wrapper-pw">                    
                    <input type="text" name="nome_disco" placeholder="Nome do disco">
                </div><!--input-wrapper-pw-->
                <div class="input-wrapper-pw">                    
                    <input type="text" name="nome_artista" placeholder="Nome do artista">
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
            INNER JOIN artistas a on d.id_artista = a.id WHERE a.ativo = 'S' ";

            $query = mysqli_query($con, $select);

        while($sql=mysqli_fetch_array($query)) { ?> 
            <div class="product-wrapper">
                <div class="image-wrapper">
                    <img src="<?php echo $sql['Foto'] ?>" onerror="this.src='../images/vinyl.svg';this.class='image-error'" alt="Capa do disco">
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
                        <a href="Home.php?<?php echo $sql['Id']?>">Visualizar</a>
                    </div>
                </div>
            </div> 

        <?php } #Fim do while ?> 
        </div> <!--product-wrapper-->
    </div> <!--main-wrapper-->
</body>
</html>