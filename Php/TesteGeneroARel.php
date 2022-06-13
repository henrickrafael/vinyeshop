<?php
    include('conexao.php');
    include('sqlFunctions.php');

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
        </div> <!--top_menu_item-->
    </div> <!--top_menu -->
    <form action="#" method="POST">
        <div class="header">
            <h2>Filtros</h2>
        </div>
        <div class="rel-filter-wrapper">
            <div class="rel-d-input-wrapper">
                <select name="tipo">                             
                    <option value="" disabled selected>Tipo</option>
                    <option value="1">Artista</option>
                    <option value="2">Gênero</option>                    
                </select>  
            </div>
        
            <div class="rel-d-input-wrapper">
                <input type="text" placeholder="Nome" name="nome">
            </div>
            <div class="rel-d-input-wrapper">
                <input type="number" min="0" placeholder="Limite de registros" name="lmt">
            </div>
            <div class="rel-d-input-wrapper">
                <select name="ordenacao">
                    <option value="" disabled selected>Odernar por</option>
                    <option value="1">Ordenação padrão</option>
                    <option value="2">Nome</option>
                </select>
            </div>
            <div class="rel-d-input-wrapper">
                <select name="situacao">
                    <option value="" disabled selected>Situação</option>
                    <option value="1">Ambos</option>
                    <option value="2">Ativo</option>
                    <option value="3">Inativo</option>
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
                <span>Nome</span>
           </div>
           <div class="header-column">
                <span>Situação</span>
           </div>
           <div class="header-column data-value">
                <span>Editar</span>
            </div>
        </div>
        
        <?php

            #Visão Artistas
            if(@$_REQUEST['botao'] == "Pesquisar" && isset($_POST['ordenacao'])) {
              
                if( @$_POST['tipo'] == 1){
                $select = 
                "SELECT * from artistas";
              
                switch ($_POST['ordenacao']) {
                    #Case = 1 -> Ordenação padrão, ou seja a ordem do banco mesmo como está, não precisa de alteração
                    case "1":
                        $select .= ' ';
                        $select .= ($_POST['lmt'] ? " LIMIT {$_POST['lmt']} " : "");
                        break;
                    #Case = 2 -> Nome do disco    
                    case "2":
            } #Switch
            $query = mysqli_query($con, $select);
        }

                else if (@$_POST['tipo'] == 2){
                    $select = 
                    "SELECT * from genero";
                  
                    switch ($_POST['ordenacao']) {
                        #Case = 1 -> Ordenação padrão, ou seja a ordem do banco mesmo como está, não precisa de alteração
                        case "1":
                            $select .= ' ';
                            $select .= ($_POST['lmt'] ? " LIMIT {$_POST['lmt']} " : "");
                            break;
                        #Case = 2 -> Nome do disco    
                        case "2":
                } #Switch
                $query = mysqli_query($con, $select);
            }
      
             while($sql=mysqli_fetch_assoc($query)) { ?>

        <div class="data-content">
            <div class="data-row">
                <span><?php echo $sql['nome'] ?></span>
           </div>
            <div class="data-row">
                <span><?php echo $sql['ativo'] ?></span>
            </div>
            <?php 
            if( @$_POST['tipo'] == 1){?>
            <div class="data-row data-value">
                <a href="ArtistaEditar.php?id=<?php echo $sql['id']?>">
                    <img src="../images/edit.svg" alt="">
                </a>
            </div>
            <?php
            }
            if( @$_POST['tipo'] == 2){?>
                <div class="data-row data-value">
                    <a href="GeneroEditar.php?id=<?php echo $sql['id']?>">
                        <img src="../images/edit.svg" alt="">
                    </a>
                </div>
                <?php
            }       
        ?>
        </div>
        <?php
            }
              }# Fim do IF

              
        ?>

        
    </div>

</body>
</html>