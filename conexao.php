<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "banco";
$port = 3307;
// $con -> conexão do banco de dados
$con = mysqli_connect($hostname, $username, $password, $database, $port);

if (mysqli_connect_errno())
{
    printf("Erro de conexão: %s\n", mysqli_connect_error());
    exit();
}

?>