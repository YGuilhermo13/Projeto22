<?php
 include("../conectadb.php");

 session_start();
 
 $sessao_nomecliente = $_SESSION["nomecliente"];
 $sessao_idcliente = $_SESSION["idcliente"];
 $sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
 $retorno = mysqli_query($link, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/loja.css">
    <title>LOJA PRODUTOS</title>
</head>

<body>
    <header>
        <nav>
            <ul class="menu">
                <li><a href="loja.php"></a>HOME</li>
                <li><a href="#"></a>PRODUTOS</li>
                <?php
                if(isset($_SESSION['idcliente'])){
                    ?>
                    <form class="formmenu" action="logout.php" method="post">
                        <h3 class="menu-right2">Olá <?= $_SESSION['nomecliente'];?></h3>
                        <li class="menu-right"><a href="perfil.php?id=<?=$sessao_idcliente?>">PERFIL</a></li>
                        <li class="menu-right"><a href="logout.php">LOGOUT</a></li>
                    </form>
                    <?php
                    }else{
                        ?>
                        <form action="formmenu2">
                            <li class="menu-right"> <a href="logincliente.php" style=" float: right">ENTRAR</a></li>
                            <li class="menu-right"> <a href="cadastracliente.php">CADASTRAR</a></li>
                        </form>
                        <?php
                    }
                    ?>
            </ul>
        </nav>
    </header>

    <div class="conteudo">

<?php
    while($tbl = mysqli_fetch_array($retorno))
            {
?>
<div class="card">

        <img src="data:image/jpeg;base64, <?= $tbl[7]?>" style="width: 300px; height: 300px;">
        <h1 class="tituloprod"><?=$tbl[1]?></h1>
        <p class="price">R$ <?= number_format($tbl[5],2,',','.')?></p>
        <p><?=$tbl[2]?></p>
        <p><a class="botao" href="verproduto.php?id=<?=$tbl[0]?>">
        <input type="button" class="botao" value="VISUALIZAR DETALHES"></a></p>
</div>

</div>
<?php
            }
?>

</body>

</html>