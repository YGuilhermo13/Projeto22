<?php 
include("conectadb.php");

session_start();

$nomeusuario = $_SESSION["nomeusuario"];

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    #cli_cpf	cli_nome	cli_senha	cli_datanasc	cli_telefone	cli_logradouro	cli_numero	cli_cidade
$cpf =$_POST['cpf'];
$nome = $_POST['nome'];
$senha =$_POST['senha'];
$datanasc =$_POST['datanasc'];
$telefone =$_POST['telefone'];
$logradouro =$_POST['logradouro'];
$numero =$_POST['numero'];
$cidade =$_POST['cidade'];
#VERIFICA SE cliente JA EXISTE
$sql = "SELECT COUNT(cli_id) FROM clientes WHERE cli_cpf = '$cpf' AND cli_nome = '$nome' AND cli_senha = '$senha'";
$retorno = mysqli_query($link, $sql);

##TODO RETORNO DO BANCO É RETORNADO EM ARRAY EM PHP
while($tbl = mysqli_fetch_array($retorno))
{
$cont = $tbl[0];
}

##VALIDAÇÃO DE TRUE E FALSE


if($cont == 1){
    echo"<script>window.alert('CLIENTE JÁ EXISTE');</script>";
}
else{
    $sql = "INSERT INTO clientes (cli_cpf, cli_nome, cli_senha, cli_datanasc, cli_telefone, cli_logradouro, cli_numero, cli_cidade, cli_ativo  
    )
    VALUES('$cpf','$nome','$senha','$datanasc','$telefone','$logradouro','$numero','$cidade','n')";
    mysqli_query($link, $sql);
    #CADASTROU USUARIO E JOGA MENSAGEM NA TELA E DIRECIONA PARA LISTA USUARIO
    echo"<script>window.alert('CLIENTE CADASTRADO');</script>";
    echo"<script>window.location.href='listacliente.php';</script>";
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
<ul class="menu">
    <li>
    <li><a href="cadastrausuario.php">CADASTRA USUARIO</a></li>
    <li><a href="listausuario.php">LISTA USUARIO</a></li>
    <li><a href="cadastraproduto.php">CADASTRA PRODUTO</a></li>
    <li><a href="listaproduto.php">LISTA PRODUTO</a></li>
    <li><a href="cadastracliente.php">CADASTRA CLIENTE</a></li>
    <li><a href="listacliente.php">LISTA CLIENTE</a></li>
    <li class="menuloja"><a href="./areacliente/loja.php">LOJA<a><li>
    </li>
</ul>
</div>

<div>
    <form action="cadastracliente.php" method="post">
            <input type="number" name="cpf" id="cpf" placeholder="CPF">
            <br>
            <input type="text" name="nome" id="nome" placeholder="NOME CLIENTE">
            <br>
            <input type="password" name="senha" id="senha" placeholder="SENHA">
            <br>
            <input type="date" name="datanasc" id="datanasc" placeholder="DATA NASCIMENTO">
            <br>
            <input type="number" name="telefone" id="telefone" placeholder="TELEFONE">
            <br>
            <input type="text" name="logradouro" id="logradouro" placeholder="LOGRADOURO">
            <br>
            <input type="text" name="numero" id="numero" placeholder="NUMERO">
            <br>
            <input type="text" name="cidade" id="cidade" placeholder="CIDADE">
            <br>
            <input type="submit" name="cadastrar" id="cadastrar" value="CADASTRAR"> 
            
            
    </form>
</div>


</body>
</html>