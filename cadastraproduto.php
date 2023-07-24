<?php
include("conectadb.php");

session_start();

$nomeusuario = $_SESSION["nomeusuario"];

if($_SERVER['REQUEST_METHOD']=='POST')
{
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$quantidade = $_POST['quantidade'];
$custo = $_POST['custo'];
$preco = $_POST['preco'];

if(isset($_FILES['imagem']) && $_FILES['imagem']['error']===UPLOAD_ERR_OK)
{
$imagem_temp = $_FILES['imagem']['tmp_name'];
$imagem = file_get_contents($imagem_temp);
$imagem_base64 = base64_encode($imagem);
}



$sql = "SELECT COUNT(pro_id) FROM produtos WHERE pro_nome = '$nome'";
$retorno = mysqli_query($link, $sql);
while($tbl = mysqli_fetch_array($retorno))
{
    $cont = $tbl[0];

    if($cont == 1)
    {
        echo"<script>window.alert('PRODUTO JÁ CADASTRADO');</script>";
    }
    else
    {
        $sql = "INSERT INTO produtos (pro_nome, pro_descricao, pro_quantidade, pro_custo, pro_preco,
        pro_ativo, imagem1)
        VALUES ('$nome', '$descricao', '$quantidade', '$custo', '$preco', 's', '$imagem_base64')";

        mysqli_query($link, $sql);

         echo"<script>window.alert('PRODUTO CADASTRADO COM SUCESSO!');</script>";
         echo"<script>window.location.href='listaproduto.php';</script>";
    }

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

<form action="cadastraproduto.php" method= "post" enctype="multipart/form-data">
    <label for="">NOME DO PRODUTO</label>
    <input type="text" name="nome" id="nome">
    <br>
    <label for="">DESCRIÇÃO DO PRODUTO</label>
    <textarea name="descricao" id="descricao"  rows="10" resize="none"></textarea>
    <br>
    <label for="">QUANTIDADE</label>
    <input type="number" name="quantidade" id="quantidade">
    <br>
    <label for="">CUSTO</label>
    <input type="decimal" name="custo" id="custo">
    <br>
    <label for="">PREÇO</label>
    <input type="decimal" name="preco" id="preco">
    <br>
    <label for="">IMAGEM</label>
    <input type="file" name="imagem" id="imagem">

    <input type="submit" name="cadastrar" id="cadastrar">
</form>
</body>
</html>