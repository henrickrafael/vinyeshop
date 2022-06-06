<?php
    include('conexao.php');
    include('sqlFunctions.php');
    include('verifica.php');
    
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
    <title>Finalizar pedido</title>
</head>
<body>

    <?php 
        $select = 
        "SELECT d.id as 'Id', d.nome as 'Disco', d.valor as 'Preco', a.nome as 'Artista', e.quantidade as 'Qtd' 
        FROM discos d
        INNER JOIN artistas a on d.id_artista = a.id
        INNER JOIN estoque e on d.id = e.id_discos 
        WHERE d.ativo = 'S' AND d.id = {$id}";

        $query = mysqli_query($con, $select);

    while($sql=mysqli_fetch_assoc($query)) { ?>
    <div class="main-wrapper-register main-request request-wrapper">
        <div class="form-1">
            <div class="label-header">
                <h2>Finalizar pedido</h2>
            </div><!--label-header--> 
            <div class="img-product-info">
                <div class="label-header final">
                    <span class="header">Produto:</span>
                    <span class="span-info"><?php echo $sql['Disco']?></span>
                </div><!--label-header-->         
                <div class="quantity-label">
                    <span class="header">Artista:</span>
                    <span class="span-info"><?php echo $sql['Artista']?></span>
                </div>       
                <div class="quantity-label">
                    <span class="header">Total:</span>
                    <span class="span-info" id="price">R$ <?php echo $sql['Preco']?></span>
                </div>
                <input class="preco-input" type="number" id="input-price" value="<?php echo $sql['Preco']?>">
                <form action="#" method="POST">
                <div class="quantity-label">
                        <span class="header">Tipo de pagamento:</span>
                        <input type="radio" name="pgto" value="C" required>
                        <label class="radio-label">Cartão</label>
                        <input type="radio" name="pgto" value="B">
                        <label class="radio-label">Boleto</label>
                </div>
                <div class="quantity-label">
                    <div class="price-wrapper-pw"> 
                        <input name="qtd" id="qtty" onkeyup="validateQtd()" type="number" min="1" max="<?php echo $sql['Qtd'] ?>" placeholder="Quantidade" required>
                    </div>
                </div>                   
                    <div class="button-label">
                        <div class="input-wrapper-pw input-wrapper-submit-pw">
                            <input type="submit" name="botao" value="Finalizar compra">
                        </div>
                    </div>
                </form>

                <?php
                
                    if(@$_REQUEST['botao']) {

                        $qtd = $_POST['qtd'];
                        $valor = $sql['Preco'];

                        $total = ($qtd * $valor);
                        echo $total;

                        //INSERT em vendas
                        
                    }
                ?>

            </div>
        </div>
    </div>
    <?php
        }
    ?>
</body>
</html>