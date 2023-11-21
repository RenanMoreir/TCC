<?php
include("connection/connect.php");

$id = $_COOKIE["ID"];

$getAnimal = $con->prepare("SELECT Id_animal, Nome, Raca, Porte, Cor, Especie, Sexo, Pelagen,
                            Idade, Descricao FROM animal WHERE FK_id_abrigo LIKE ?");
$getAnimal->bind_param("i", $id);
$getAnimal->execute();
$user = $getAnimal->get_result()->fetch_assoc();


?>