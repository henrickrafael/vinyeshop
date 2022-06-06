<?php

session_start(); 
session_unset(); 
session_destroy(); 

echo "<script>alert('Logout efetuado com sucesso!');top.location.href='Home.php';</script>"; 
?>