<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="post" enctype="multipart/form-data">
        <input type="file" name="foto" id="ft">
        <input type="submit" name="botao" id="">
    </form>
<?php
    if(@$_REQUEST['botao']) {

    $file_name = $_FILES['foto']['name'];

    $milliseconds = round(microtime(true) * 10);
    $data = date("d-m-Y-g-h-s").$milliseconds;


      $nFt = $data;
      $nFt = str_replace('Array','', $nFt);
      $ext = '.png';


     move_uploaded_file($_FILES['foto']['tmp_name'], 'fotos/'.$nFt.$ext);
    }
?>

</body>
</html>