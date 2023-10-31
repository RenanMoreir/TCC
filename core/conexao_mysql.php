<?php

function conecta() :mysqli
{
    $servidor = 'localhost';
    $banco = 'quicktalk';
    $port = 3307;
    $usuario = 'root';
    $senha = '';
    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco, $port);

    if(!$conexao){
        echo 'ERRO: Não foi possivel conectar ao MYsql.' . PHP_EOL;
        echo 'Debugginf errno: ' . mysqli_connect_errno() . PHP_EOL;
        echo 'Debugginf error: ' . mysqli_connect_error() . PHP_EOL;
        return null;

    }
    return $conexao;

}

function desconecta($conexao)
{
    mysqli_close($conexao);
}
?>