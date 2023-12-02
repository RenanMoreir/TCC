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
include('connection/connect.php');
         
$p = "Amarela";


// Query para selecionar os valores de porte e cor da tabela animal
$sql = "SELECT porte, cor, raca, nome, idade, FK_id_abrigo FROM animal";
//$sql2 = "SELECT Nome, Email, Telefone, Id_abrigo FROM Usuario_abrigo";




$result = $con->query($sql);
//$result2 = $con->query($sql2);


/*if ($result2->num_rows > 0) {
    // Array de perfis fictícios
    $abrigo = [];


    while ($row = $result2->fetch_assoc()) {
    $abrigo[] = ["Nome" => $row["Nome"], "Email" => $row["Email"], "Telefone" => $row['Telefone'], "Id_abrigo" => $row['Id_abrigo']];
    }
}{
    echo "Problemas ao identificar o abrigo.<br>";
}*/
if ($result->num_rows > 0) {
    // Array de perfis fictícios
    $perfis = [];


    while ($row = $result->fetch_assoc()) {
    $perfis[] = ["porte" => $row["porte"], "cor" => $row["cor"], "raca" => $row['raca'], "nome" => $row['nome'], "idade" => $row['idade'], "FK_id_abrigo" => $row['FK_id_abrigo']];
    }


    // Inicialize um array vazio para armazenar os índices dos perfis exibidos
    $perfisExibidos = [];


    // Verifique se todos os perfis já foram exibidos
    if (count($perfisExibidos) === count($perfis)) {
        echo '<h1>Todos os perfis foram exibidos</h1>';
    } else {
        do {
            // Escolha aleatoriamente um índice de perfil
            $indiceAleatorio = array_rand($perfis);
            $perfilAleatorio = $perfis[$indiceAleatorio];

             $sql_abrigo = "SELECT Nome, Email, Telefone, Id_abrigo FROM usuario_abrigo where Id_abrigo = ".$perfilAleatorio['FK_id_abrigo'];
            $result_abrigo = $con->query($sql_abrigo);
            $row_abrigo = $result_abrigo->fetch_assoc(); 
            // Verifique se o perfil já foi exibido e se a idade corresponde
            if (!in_array($indiceAleatorio, $perfisExibidos) && $p == $perfilAleatorio['cor']) {
                // Adicione o índice do perfil aos perfis exibidos
                $perfisExibidos[] = $indiceAleatorio;
                // Div para cada perfil
                echo '<div class="profile-card">';
                //echo '<img src="' . $perfilAleatorio['foto'] . '" alt="Foto do perfil">';
                echo '<p class="profile-porte">Nome: ' . $perfilAleatorio['nome'] . '</p>';
                echo '<p class="profile-cor">Idade: ' . $perfilAleatorio['idade'] . '</p>';
                echo '<p class="profile-porte">Porte: ' . $perfilAleatorio['porte'] . '</p>';
                echo '<p class="profile-cor">Cor: ' . $perfilAleatorio['cor'] . '</p>';
                echo '<p class="profile-porte">Raça: ' . $perfilAleatorio['raca'] . '</p>';
                //if ($abrigo[0]['Id_abrigo'] == $perfilAleatorio['FK_id_abrigo']){
                echo '<p class="profile-porte">Nome do abrigo: ' . $row_abrigo['Nome'] . '</p>';
                echo '<p class="profile-porte">Telefone: ' . $row_abrigo['Telefone'] . '</p>';
                echo '<p class="profile-porte">Email: ' . $row_abrigo['Email'] . '</p>';
                //}
                echo '<button class="profile-like-button" onclick="chat('.$perfilAleatorio["FK_id_abrigo"].',12)">Gostei';
                $gostei = 1;
                echo '</button>';
                echo '<button class="profile-like-button" onclick="location.reload();">Passo</button>';
                echo '</div>';
                break; // Saia do loop
            }
        } while (true);
    }
} else {
    echo "Nenhum perfil encontrado no banco de dados.";
}


// Feche a conexão com o banco de dados

?>



</div>
</body>
</html>