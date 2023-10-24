<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta dados do forms
    $animal_nome = $_POST["animal_nome"];
    $pelagem = $_POST["pelagem"];
    $raca = $_POST["raca"];
    $cor = $_POST["cor"];
    $sexo = $_POST["sexo"];
    $porte = $_POST["porte"];
    $especie = $_POST["especie"];
    $descricao = $_POST["descricao"];

    // Salva os dados no banco de dados
    $file = fopen("animais.txt", "a");
    fwrite($file, "Nome do Animal: $animal_nome\n");
    fwrite($file, "Pelagem: $pelagem\n");
    fwrite($file, "Raça: $raca\n");
    fwrite($file, "Cor: $cor\n");
    fwrite($file, "Sexo: $sexo\n");
    fwrite($file, "Porte: $porte\n\n");
    fwrite($file, "Espécie: $especie\n");
    fwrite($file, "Descrição: $descricao\n\n");
    fclose($file);

    // Redireciona de volta para a página de cadastro de animais
    header("Location: cadastro_animal.html");
}
?>
