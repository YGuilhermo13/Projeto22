<?php
## ARQUIV O DE ACESSO AO BANCO DE DADOS 
## ALERTA EM MODO PROFISSIONAL ARQUIVO DEVE-SE MANTER OCULTO E PROTEGIDO
##LOCALIZA O PC OU SERVIDOR COM O BANCO (NOME COMPUTADOR)

$servidor = "localhost:3307";
##NOME DO BANCO
$banco = "projeto22";
##USARIO DE ACESSO 
$usuario = "administrador";
##SENHA DE ACESSO
$senha = "123";

##LINK CONEXAO
    $link = mysqli_connect($servidor, $usuario, $senha, $banco);

?>