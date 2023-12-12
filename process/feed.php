<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/feed.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Feed</title>
</head>

<body>
    <div class="container" style="width: 90%; height: 90vh; overflow-y: scroll;">
        <?php
        //include('connection/connect.php');
        include_once('../includes/busca.php');
        // repositorio;
        include("connection/connect.php");
        require_once '../core/conexao_mysql.php';
        require_once '../core/sql.php';
        require_once '../core/mysql.php';

        $id = $_COOKIE["ID"];
        $criterio = [
            ['ID', '=', $id]
        ];

        $preferencias = buscar(
            'user',
            [
                'Porte',
                'Especie',
                'Sexo',
                'Pelagem'
            ],
            $criterio
        );

        foreach ($preferencias as $preferencia) {
            $porte = $preferencia['Porte'];
            $especie = $preferencia['Especie'];
            $sexo = $preferencia['Sexo'];
            $pelagem = $preferencia['Pelagem'];

        }

        /* 
    $porte = isset($_POST['porte']) ? $_POST['porte'] : '';
    $especie = isset($_POST['especie']) ? $_POST['especie'] : '';
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : ''; */

        // Verifique se pelo menos uma das variáveis de busca foi fornecida
        if ($porte !== '' || $especie !== '' || $sexo !== ''|| $pelagem !== '') {
                $animais = buscaAnimais($porte, $especie, $sexo, $pelagem);

            // Exibir os animais encontrados
            if (!empty($animais)) {
                foreach ($animais as $animal) {
                    $sql_abrigo = "SELECT Nome, Email, Telefone, Id_abrigo FROM usuario_abrigo where Id_abrigo = " . $animal['FK_id_abrigo'];
                    $result_abrigo = $con->query($sql_abrigo);

                    if ($result_abrigo and mysqli_num_rows($result_abrigo) != 0) {
                        $row_abrigo = $result_abrigo->fetch_assoc();

                        echo '<div class="profile-card" style="border: 5px solid blue; padding: 20px;">';
                        // Certifique-se de ajustar para a coluna correta na tabela animal
                        echo '<img src="../animalPics/' . $animal["Imagem"] . '" class="img-fluid" alt="Imagem do Animal" style="width: 50%;">';
                        echo '<p class="profile-porte">Nome: ' . $animal['Nome'] . '</p>';
                        echo '<p class="profile-cor">Idade: ' . $animal['Idade'] . '</p>';
                        echo '<p class="profile-porte">Porte: ' . $animal['Porte'] . '</p>';
                        echo '<p class="profile-cor">Cor: ' . $animal['Cor'] . '</p>';
                        echo '<p class="profile-porte">Raça: ' . $animal['Raca'] . '</p>';
                        echo '<p class="profile-porte">Especie: ' . $animal['Especie'] . '</p>';
                        echo '<p class="profile-porte">Sexo: ' . $animal['Sexo'] . '</p>';
                        echo '<p class="profile-porte">Pelagem: ' . $animal['Pelagem'] . '</p>';
                        echo '<p class="profile-porte">Descrição: ' . $animal['Descricao'] . '</p>';
                        echo '<p class="profile-porte">Nome do abrigo: ' . $row_abrigo['Nome'] . '</p>';
                        echo '<p class="profile-porte">Telefone: ' . $row_abrigo['Telefone'] . '</p>';
                        echo '<p class="profile-porte">Email: ' . $row_abrigo['Email'] . '</p>';
                        echo '<button class="profile-like-button btn btn-success" onclick="chat(' . $animal["FK_id_abrigo"] . ',12)">Dar Match';
                        echo '</button>';
                        // echo '<button class="profile-like-button" onclick="location.reload();">Passo</button>';
                        echo '</div><br>';

                    } else {
                        echo "Erro." . $con->error;
                    }
                }
            } else if (empty($animais)){
                $sql = "SELECT * FROM animal";
                $result = $con->query($sql);
                $animais = $result->fetch_all(MYSQLI_ASSOC);

                foreach ($animais as $animal) {
                    $sql_abrigo = "SELECT Nome, Email, Telefone, Id_abrigo FROM usuario_abrigo where Id_abrigo = " . $animal['FK_id_abrigo'];
                    $result_abrigo = $con->query($sql_abrigo);

                    if ($result_abrigo and mysqli_num_rows($result_abrigo) != 0) {
                        $row_abrigo = $result_abrigo->fetch_assoc();

                        echo '<div class="profile-card" style="border: 5px solid blue; padding: 20px;">';
                        // Certifique-se de ajustar para a coluna correta na tabela animal
                        echo '<img src="../animalPics/' . $animal["Imagem"] . '" class="img-fluid" alt="Imagem do Animal" style="width: 50%;">';
                        echo '<p class="profile-porte">Nome: ' . $animal['Nome'] . '</p>';
                        echo '<p class="profile-cor">Idade: ' . $animal['Idade'] . '</p>';
                        echo '<p class="profile-porte">Porte: ' . $animal['Porte'] . '</p>';
                        echo '<p class="profile-cor">Cor: ' . $animal['Cor'] . '</p>';
                        echo '<p class="profile-porte">Raça: ' . $animal['Raca'] . '</p>';
                        echo '<p class="profile-porte">Especie: ' . $animal['Especie'] . '</p>';
                        echo '<p class="profile-porte">Sexo: ' . $animal['Sexo'] . '</p>';
                        echo '<p class="profile-porte">Pelagem: ' . $animal['Pelagem'] . '</p>';
                        echo '<p class="profile-porte">Descrição: ' . $animal['Descricao'] . '</p>';
                        echo '<p class="profile-porte">Nome do abrigo: ' . $row_abrigo['Nome'] . '</p>';
                        echo '<p class="profile-porte">Telefone: ' . $row_abrigo['Telefone'] . '</p>';
                        echo '<p class="profile-porte">Email: ' . $row_abrigo['Email'] . '</p>';
                        echo '<button class="profile-like-button btn btn-success" onclick="chat(' . $animal["FK_id_abrigo"] . ',12)">Dar Match';
                        echo '</button>';
                        // echo '<button class="profile-like-button" onclick="location.reload();">Passo</button>';
                        echo '</div><br>';

                    } else {
                        echo "Erro." . $con->error;
                    }
                }
            } else {
                echo "nenhum animal encontrado.";
            }
        }  
        ?>



    </div>
</body>

</html>