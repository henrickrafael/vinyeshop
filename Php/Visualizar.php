<?php
    include('conexao.php');
    include('sqlFunctions.php');
    session_start();
    $id = @$_GET['id'];

    if(!isset($id)) {
        echo "<script>window.location.replace('Home.php');</script>";
    }

    validaDiscoAtivo($con, $id);
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
    <title>Produto</title>
</head>
<body>

    <?php
        $select = 
        "SELECT d.id as 'Id', d.foto as 'Foto', d.nome as 'Disco', d.descricao as 'Descricao', 
        d.lancamento as 'Lancamento', d.valor as 'Preco',
        a.nome as 'Artista', g.nome as 'Genero', e.quantidade as 'Qtd' FROM discos d
        INNER JOIN artistas a on d.id_artista = a.id
        INNER JOIN genero g on d.id_genero = g.id
        INNER JOIN estoque e on d.id = e.id_discos 
        WHERE d.ativo = 'S' AND d.id = {$id} ";

        $query = mysqli_query($con, $select);

    while($sql=mysqli_fetch_assoc($query)) { ?>
    <div class="main-product-wrapper">
        <div class="img-product-view">
            <div class="img-product-wrapper">
                <img src="<?php echo $sql['Foto']?>" onerror="this.className='image-error'; this.src='../images/vinyl.svg';">
            </div>
        </div>
        <div class="img-product-info">
            <div class="label-header">
                <h2><?php echo $sql['Disco']?></h2>
            </div>
            <div class="product-description">
                <div class="label-header">
                    <h3>Descrição</h3>
                </div>
                <div class="text-info">
                    <p><?php echo $sql['Descricao']?></p>
                </div>
                <div class="artist-label">
                    <span>Artista:</span>
                    <span><?php echo $sql['Artista']?></span>
                 </div>
                 <div class="genre-label">
                    <span>Gênero:</span>
                    <span><?php echo $sql['Genero']?></span>
                 </div>
                 <div class="release-label">
                    <span>Disponíves:</span>
                    <span><?php echo $sql['Qtd'] ?></span>
                 </div>
                 <div class="quantity-label improvised">
                    <span>Lançamento:</span>
                    <span><?php echo formataData($sql['Lancamento'])?></span>                
                 </div>
                 <div class="quantity-label">
                    <span>Preço:</span>
                    <span><?php echo $sql['Preco']?></span>                
                 </div>                 
                 <form action="#" method="GET">
                    <div class="button-label">
                    <!-- <div class="price-wrapper-pw"> 
                        <input name="qtd" id="qtty" type="number" placeholder="Quantidade">
                    </div> -->
                    <?php
                    if(isset( $_SESSION['id_usuario'])){?>
                        <div class="input-wrapper-pw input-wrapper-submit-pw">
                            <!-- <input type="submit" name="botao" value="Comprar"> -->
                            <a id="buy" href="Compra.php?id=<?php echo $id ?>">Comprar</a>
                        </div>
                    <?php } #Fim do iF ?>
                    </div>            
                </form> 
            </div><!--product-description-->
        </div><!--img-product-info-->
    </div><!--main-product-wrapper-->
<?php
    } #Fim do While
?>

</body>
</html>