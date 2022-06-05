<form action="#" method="POST" enctype="multipart/form-data">

<input type=file name="foto">
<input type="text" name="m">

<input type="submit" name="botao">

</form>

<?php



if(@$_REQUEST['botao']){

    $file_name = $_FILES['foto']['name'];

    $milliseconds = round(microtime(true) * 1000);
    $data = date("d-m-Y-g-h-s").$milliseconds;


    @$nFt = $data;
      $nFt = str_replace('Array','', $nFt);
      $ext = '.png';

      move_uploaded_file($_FILES['foto']['tmp_name'], 'teste/'.$nFt.$ext);
}

