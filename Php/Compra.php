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
    <title>Finalizar pedido</title>
</head>
<body>
    <div class="main-wrapper-register main-request request-wrapper">
        <div class="form-1">
            <div class="label-header">
                <h2>Finalizar pedido</h2>
            </div><!--label-header--> 
            <div class="img-product-info">
                <div class="label-header final">
                    <span class="header">Produto:</span>
                    <span class="span-info">In Utero</span>
                </div><!--label-header--> 
                <div class="quantity-label">
                    <span class="header">Quantidade:</span>
                    <span class="span-info">6</span>
                </div>
                <div class="quantity-label">
                    <span class="header">Total:</span>
                    <span class="span-info">R$ 39,90</span>
                </div>
                <form action="#" method="POST">
                    <div class="quantity-label">
                    <span class="header">Tipo de pagamento:</span>
                    <input type="radio" name="pgto" value="C">
                    <label class="radio-label">Cartão</label>
                    <input type="radio" name="pgto" value="B">
                    <label class="radio-label">Boleto</label>
                    </div>
                    <div class="button-label">
                        <div class="input-wrapper-pw input-wrapper-submit-pw">
                            <a href="#">Finalizar compra</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>