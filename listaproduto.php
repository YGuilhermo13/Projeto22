<?php
#Traz arquivo de conexão do banco
include("conectadb.php");
#Carrega a Página trazendo produtos com s (Produtos ATIVOS)
$sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
$resultado = mysqli_query($link, $sql);
#Atribui s para variavel ativo
$ativo = "s";
#Aguarda ação POST na página
if($_SERVER['REQUEST_METHOD']=='POST'){
    $ativo = $_POST['ativo'];
    #Confere se o POST da Página foi s
    #Se s traga produtos ativos senão traga inativos
    if($ativo == 's'){
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
        $resultado = mysqli_query($link, $sql);
         
    }
    else{
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 'n'";
        $resultado = mysqli_query($link, $sql);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="newestilo.css">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>LISTA PRODUTO</title>
</head>
<body>
<div>
<ul class="menu">
    <li>
    <li><a href="cadastracliario.php">CADASTRA CLIARIO</a></li>
    <li><a href="listacliario.php">LISTA CLIARIO</a></li>
    <li><a href="cadastraproduto.php">CADASTRA PRODUTO</a></li>
    <li><a href="listaproduto.php">LISTA PRODUTO</a></li>
    <li><a href="cadastracliente.php">CADASTRA CLIENTE</a></li>
    <li><a href="listacliente.php">LISTA CLIENTE</a></li>
    <li class="menuloja"><a href="./areacliente/loja.php">LOJA<a><li>
    </li>
</ul>
</div>
    
    <form action="listaproduto.php" method="post" class="lista">
        <!-- Botões que validam se o produto é listado somente ativos ou inativos-->
        <!-- onclick="submit()" é um javascript que já faz um submit na página usando o navegador como recurso -->
        <!-- <//?=$ativo== Valida se o radio foi acionado (checked) e mantém a escolha se não ele traz em branco-->
        <input type="radio" name="ativo" value='s' required onclick="submit()" <?=$ativo=='s'?"checked":""?>>ATIVOS<br>
        <input type="radio" name="ativo" value='n' required onclick="submit()" <?=$ativo=='n'?"checked":""?>>INATIVO
    </form>
    <div class="container">
        <table border="1">
            <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>DESCRIÇÃO</th>
                    <th>QUANTIDADE</th>
                    <th>PRECO</th>
                    <th>IMAGEM</th>
                    <th>ALTERAR</th>
                    <th>ATIVO</th>
            </tr>
            <?php
                #Preenchimento da tabela com os dados do banco
                while($tbl = mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td><?= $tbl[0]?></td>
                        <td><?= $tbl[1]?></td>
                        <td><?= $tbl[2]?></td>
                        <td><?= $tbl[3]?></td>
                        <!-- linha abaixo converte formato da $tbl[3] usando 2 casas após a virgula e aplicando , ao lugar de ponto -->
                        <td>R$ <?= number_format($tbl[4],2,',','.')?></td>
                        <td><img src="data:image/jpeg;base64,<?=$tbl[7]?>" width="100" height="100"></td>
                        <td><a href="alteraproduto.php?id=<?= $tbl[0]?>"><input type="button" value="ALTERAR"></a></td>
                        <!-- tbl[5] verifica se é s que está vindo do banco de dados, se sim. Escreva SIM senão escreva NÃO -->
                        <td><?= $check = ($tbl[6] == 's')?"SIM":"NÃO"?></td>
                    </tr>
                    <?php
                }
                ?>
        </table>
    </div>
</body>
</html>