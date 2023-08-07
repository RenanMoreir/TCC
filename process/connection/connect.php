<?php
    /*$con = mysqli_connect("localhost", "root", "", "quicktalk");
    mysqli_query($con, "SET time_zone='+00:00'");

    date_default_timezone_set("UTC");

    if(mysqli_connect_errno())
    {
        echo "Falha ao ligar a base de dados: ".mysqli_connect_error();
        exit();
    }*/

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "quicktalk";
    $port = 3307;
    $con = mysqli_connect($hostname, $username,$password, $database, $port);
    mysqli_query($con, "SET time_zone='+00:00'");

    date_default_timezone_set("UTC");

    if(mysqli_connect_errno())
    {
        echo "Falha ao ligar a base de dados: ".mysqli_connect_error();
        exit();
    }



?>



