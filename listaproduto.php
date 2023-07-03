<?php
include("conectadb.php");

session_start();

$nomeusuario = $_SESSION["nomeusuario"];

$sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
$retorno = mysqli_query($link, $sql);
$ativo = "s";

if($_SERVER['REQUEST_METHOD']=='POST')
{
    if($ativo == 's')
    {
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
        $retorno = mysqli_query($link, $sql);
    }
    else
    {
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 'n'";
        $retorno = mysqli_query($link, $sql);
    }
}

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
    <!--  O menu geral da aplicação -->
<ul class="menu">
    <li>
    <li><a href="cadastrausuario.php">CADASTRA USUARIO</a></li>
    <li><a href="listausuario.php">LISTA USUARIO</a></li>
    <li><a href="cadastraproduto.php">CADASTRA PRODUTO</a></li>
    <li><a href="listaproduto.php">LISTA PRODUTO</a></li>
    <li><a href="cadastracliente.php">CADASTRA CLIENTE</a></li>
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

<div>
    <form action="listaproduto.php" method="post">
        <input type="radio" name="ativo" class="radio" value="s" required onclick="submit()" <?=$ativo =='s'?"checked":""?>>ATIVOS

        <input type="radio" name="ativo" class="radio" value="n" required onclick="submit()" <?=$ativo =='s'?"checked":""?>>INATIVOS
    </form>
</div>

<div class="container">
    <table border="1">
        <tr>
            <th>ID PRODUTO</th>
            <Th>NOME</Th>
            <Th>DESCRIÇÃO</Th>
            <Th>QUANTIDADE ESTOQUE</Th>
            <Th>CUSTO</Th>
            <Th>PREÇO</Th>
            <Th>IMAGEM</Th>
            <Th>ALTERAR</Th>
            <TH>ATIVO?</TH>
        </tr>
        <?php
        while($tbl = mysqli_fetch_array($retorno))
        {
            ?>
        }
        <tr>
        <td><?=[0]?></td>
        <td><?=[1]?></td>
        <td><?=[2]?></td>
        <td><?=[3]?></td>
        <td>R$<?=number_format($tbl[4],2,',','.')?></td>
        <td>R$<?=number_format($tbl[5],2,',','.')?></td>
        <td><img src="data:image/jpeg;base64, <?=[7]?>" width="100" height="100"></td>
        <td><a href="alteraproduto.php?id=<?=[0]?>"><input type="button" value="ALTERAR"></td>
        <td><?= $check = ($tbl[7]=='s')?"SIM":"NÃO"?></td>
        </tr>

    </table>
</div>
</body>
</html>