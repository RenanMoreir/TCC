<?php
include("../process/connection/connect.php");

function buscaAnimais($conexao, $user) 
{
    $pelagem = $user['pelagem'];
    $porte = $user['porte'];
    $cor = $user['cor'];

    $query = "SELECT * FROM animal WHERE pelagem = ? AND porte = ? AND cor = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("sss", $pelagem, $porte, $cor);
    $stmt->execute();

    $result = $stmt->get_result();
    $animais = $result->fetch_all(MYSQLI_ASSOC);

    return $animais;
}
?>