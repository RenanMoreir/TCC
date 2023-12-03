<?php
/* include("../process/connection/connect.php");
// a fazer: user a ser buscado deve ser o user logado
// teste executado com foreach
// em casa vou tentar implementar, mas pra isso vou fazer mudanças radicais no codigo do feed, se der certo eu aviso
function buscaAnimais($conexao, $user) {
    $nome = $user['nome'];
    $raca = $user['raca'];
    $pelagem = $user['pelagem'];
    $porte = $user['porte'];
    $cor = $user['cor'];

    $query = "SELECT * FROM animal WHERE nome = ? AND raca = ? AND pelagem = ? AND porte = ? AND cor = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("sssss", $nome, $raca, $pelagem, $porte, $cor);
    $stmt->execute();

    $result = $stmt->get_result();
    $animais = $result->fetch_all(MYSQLI_ASSOC);

    return $animais;
}
?> */