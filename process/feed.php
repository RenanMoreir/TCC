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
<div class="container-feed">
<?php
         $hostname = "localhost";
         $username = "root";
         $password = "";
         $database = "quicktalk";
         $port = 3307;
         $conn = mysqli_connect($hostname, $username,$password, $database, $port);
         mysqli_query($conn, "SET time_zone='+00:00'");
     
         date_default_timezone_set("UTC");
     
         if(mysqli_connect_errno())
         {
             echo "Falha ao ligar a base de dados: ".mysqli_connect_error();
             exit();
         }

$p = "preto";

// Query para selecionar os valores de porte e cor da tabela animal
$sql = "SELECT porte, cor, raca, nome, idade FROM animal";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Array de perfis fictícios
    $perfis = [];

    while ($row = $result->fetch_assoc()) {
    $perfis[] = ["porte" => $row["porte"], "cor" => $row["cor"], "raca" => $row['raca'], "nome" => $row['nome'], "idade" => $row['idade']/*, "foto" => $row['foto']*/];
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
                echo '<button class="profile-like-button" onclick="location.reload();">Gostei</button>';
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
$conn->close();
?>
</div>
</body>
</html>