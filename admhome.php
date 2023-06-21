<?php 
    session_start();
    $nomeusuario=$_SESSION['nomeusuario'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>Document</title>
</head>
<body>
    
<div>
<ul class="menu">
    <li>
    <li><a href="cadastrausuario.php">CADASTRA USUARIO</a></li>
    <li><a href="listausuario.php">LISTA USUARIO</a></li>
    <li><a href="cadastraproduto.php">CADASTRA PRODUTO</a></li>
    <li><a href="listaproduto.php">LISTA PRODUTO</a></li>
    <li><a href="listacliente.php">LISTA CLIENTE</a></li>
    <li class="menuloja"><a href="logout.php">SAIR<a></li>
    <?php
        if($nomeusuario != null)
        {
            ?>
            <li class="profile">OLÁ <?=strtoupper($nomeusuario)?></li>
            <?php
        }
        else
        {
            echo"<script>window.alert('USUARIO NÃO AUTENTICADO'); 
            window.location.href='login.php'; </script>";
        }

        ?>
</ul>
</div>



</body>
</html>