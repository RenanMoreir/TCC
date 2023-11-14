<?php

include("../process/connection/connect.php");

// Coleta as preferencias
$raca = $_POST["raca"];
$porte = $_POST["porte"];
$especie = $_POST["especie"];
$sexo = $_POST["sexo"];
$pelagem = $_POST["pelagem"];

// Busca no banco
$sql = "SELECT * FROM user WHERE raca LIKE '%$raca%' AND porte LIKE '%$porte%' AND especie LIKE '%$especie%' AND sexo LIKE '%$sexo%' AND pelagem LIKE '%$pelagem%'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibe resultados
    while ($row = $result->fetch_assoc()) {
        echo "<p>ID: " . $row["id"] . "</p>";
        echo "<p>Nome: " . $row["nome"] . "</p>";
        echo "<p>Raça: " . $row["raca"] . "</p>";
        echo "<p>Porte: " . $row["porte"] . "</p>";
        echo "<p>Espécie: " . $row["especie"] . "</p>";
        echo "<p>Sexo: " . $row["sexo"] . "</p>";
        echo "<p>Pelagem: " . $row["pelagem"] . "</p>";
        echo "<hr>";
    }
} else {
    echo "Nenhum resultado encontrado de acordo com suas preferencias.";
}

?>
