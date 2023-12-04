<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/feed.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Feed</title>
</head>
<body>
<div class="container">
<?php
include_once('connection/connect.php');
include_once('../includes/busca.php');

$porte = isset($_POST['porte']) ? $_POST['porte'] : '';
$especie = isset($_POST['especie']) ? $_POST['especie'] : '';
$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';

// Buscar os animais que correspondem aos critérios de pesquisa
$animais = buscaAnimais($porte, $especie, $sexo);

// Exibir os animais encontrados
foreach ($animais as $animal) {
    $sql_abrigo = "SELECT Nome, Email, Telefone, Id_abrigo FROM usuario_abrigo where Id_abrigo = ".$animal['FK_id_abrigo'];
    $result_abrigo = $con->query($sql_abrigo);
    $row_abrigo = $result_abrigo->fetch_assoc(); 

    echo '<div class="profile-card">';
    echo '<img src="../animalPics/'.$perfilAleatorio["imagem"].'" class="img-fluid" alt="Imagem do Animal" style="width: 50%;">';
    echo '<p class="profile-porte">Nome: ' . $animal['nome'] . '</p>';
    echo '<p class="profile-cor">Idade: ' . $animal['idade'] . '</p>';
    echo '<p class="profile-porte">Porte: ' . $animal['porte'] . '</p>';
    echo '<p class="profile-cor">Cor: ' . $animal['cor'] . '</p>';
    echo '<p class="profile-porte">Raça: ' . $animal['raca'] . '</p>';
    echo '<p class="profile-porte">Nome do abrigo: ' . $row_abrigo['Nome'] . '</p>';
    echo '<p class="profile-porte">Telefone: ' . $row_abrigo['Telefone'] . '</p>';
    echo '<p class="profile-porte">Email: ' . $row_abrigo['Email'] . '</p>';
    echo '<button class="profile-like-button" onclick="chat('.$animal["FK_id_abrigo"].',12)">Gostei';
    echo '</button>';
    echo '<button class="profile-like-button" onclick="location.reload();">Passo</button>';
    echo '</div>';
}
?>
</div>
</body>
</html>
