<?php

include('connection/connect.php');
include('../includes/busca.php');

$p = "Amarela";

// Função para buscar animais com base nas preferências
function buscaAnimais($p) {
    global $con;

    // Query para selecionar os valores de porte e cor da tabela animal
    $sql = "SELECT porte, cor, raca, nome, idade, FK_id_abrigo, curtidas FROM animal";

    $result = $con->query($sql);

    // Verifique se a busca retornou algum resultado
    if ($result->num_rows > 0) {
        // Array de perfis fictícios
        $perfis = [];

        while ($row = $result->fetch_assoc()) {
            $perfis[] = ["porte" => $row["porte"], "cor" => $row["cor"], "raca" => $row['raca'], "nome" => $row['nome'], "idade" => $row['idade'], "FK_id_abrigo" => $row['FK_id_abrigo'], "curtidas" => $row['curtidas']];
        }

        // Filtre os perfis com base nas preferências do usuário
        $perfisFiltrados = array_filter($perfis, function ($perfil) use ($p) {
            return $perfil['cor'] == $p;
        });

        return $perfisFiltrados;
    } else {
        return [];
    }
}

$perfisFiltrados = buscaAnimais($p);

?>

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

    // Verifique se a busca retornou algum resultado
    if (count($perfisFiltrados) > 0) {
        // Inicialize um array vazio para armazenar os índices dos perfis exibidos
        $perfisExibidos = [];

        do {
            // Escolha aleatoriamente um índice de perfil
            $indiceAleatorio = array_rand($perfisFiltrados);
            $perfilAleatorio = $perfisFiltrados[$indiceAleatorio];

            $sql_abrigo = "SELECT Nome, Email, Telefone, Id_abrigo FROM usuario_abrigo where Id_abrigo = ".$perfilAleatorio['FK_id_abrigo'];
            $result_abrigo = $con->query($sql_abrigo);
            $row_abrigo = $result_abrigo->fetch_assoc(); 

            // Verifique se o perfil já foi exibido
            if (!in_array($indiceAleatorio, $perfisExibidos)) {
                // Adicione o índice do perfil aos perfis exibidos
                $perfisExibidos[] = $indiceAleatorio;

                // Div para cada perfil
                echo '<div class="profile-card">';
                echo '<p class="profile-porte">Nome: ' . $perfilAleatorio['nome'] . '</p>';
                echo '<p class="profile-cor">Idade: ' . $perfilAleatorio['idade'] . '</p>';
                echo '<p class="profile-porte">Porte: ' . $perfilAleatorio['porte'] . '</p>';
                echo '<p class="profile-cor">Cor: ' . $perfilAleatorio['cor'] . '</p>';
                echo '<p class="profile-porte">Raça: ' . $perfilAleatorio['raca'] . '</p>';
                echo '<p class="profile-porte">Nome do abrigo: ' . $row_abrigo['Nome'] . '</p>';
                echo '<p class="profile-porte">Telefone: ' . $row_abrigo['Telefone'] . '</p>';
                echo '<p class="profile-porte">Email: ' . $row_abrigo['Email'] . '</p>';
                //echo '<p class="profile-porte" id="curtida">Curtidas: ' . $perfilAleatorio['curtidas'] . '</p>';
                echo '<button class="profile-like-button" onclick="chat('.$perfilAleatorio["FK_id_abrigo"].',)">Enviar mensagem</button>';
                echo '<button class="profile-like-button" onclick="location.reload();">Passo</button>';
                echo '</div>';
                break; // Saia do loop
            }
        } while (true);
    } else {
        echo "Nenhum perfil encontrado no banco de dados com base nas preferências.";
    }
    ?>
</div>

<script>



</script>
</body>
</html>