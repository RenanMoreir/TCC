<?php
// Include a ser usado como função de input do tipo "button"
session_start();

if (!isset($_SESSION['Id'])) {
    header("Location: // pra onde tiver que mandar o usuario");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexão com o banco
    include '../conexao.php';
    // Obter o ID do animal a ser favoritado
    $animal = $_POST['Id_animal'];

    // Verificar se o post já foi favoritado pelo usuário
    $user_id = $_SESSION['Id'];
    $check_query = "SELECT * FROM favoritos WHERE Id = $user_id AND Id_animal = $animal";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows == 0) {
        // Se ainda não foi favoritado, adicionar aos favoritos
        $insert_query = "INSERT INTO favoritos (Id, Id_animal) VALUES ($user_id, $animal)";
        $conn->query($insert_query);
    }

    $conn->close();
}

header("Location: // pra onde tiver que mandar o usuario");
exit();
?>