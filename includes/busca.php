<?php
function buscaAnimais($porte, $especie, $sexo) {
include('../process/connection/connect.php');
    echo "teste";


    // Monta a consulta SQL com os valores fornecidos como parâmetros
    $sql = "SELECT * FROM user WHERE porte='$porte' AND especie='$especie' AND sexo='$sexo'";

    // Executa a consulta e obtém o resultado
    $result = $con->query($sql);

    // Verifica se a consulta foi bem-sucedida
    if (!$result) {
        die("Erro na consulta: " . $con->error);
    }

    // Verifica se há resultados antes de chamar fetch_all
    if ($result->num_rows > 0) {
        // Transforma o resultado em um array associativo
        $animais = $result->fetch_all(MYSQLI_ASSOC);

        // Fecha a conexão


        // Retorna o array de animais encontrados
        return $animais;
    } else {
        // Se não houver resultados, retorne um array vazio
        return array();
    }
}

?>