<?php
    include("connection/connect.php");

    if(isset($_POST["email"]) && isset($_POST["password"])) {
        // Normalization
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Check if values are okay
        if ($email == "" || $password == "") {
            die(header("HTTP/1.0 401 Preenche todos os campos do formulário"));
        }

        // Query
        $stmt = $con->prepare("SELECT Id_abrigo, Senha, Token, Secure FROM usuario_abrigo WHERE (Email LIKE ? OR Nome LIKE ?) LIMIT 1");
        $stmt->bind_param("ss", $email, $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        // Check password
        if ($user && password_verify($password, $user['Senha'])) {
            echo "ola";
            setcookie("ID", $user['Id_abrigo'], time() + (10 * 365 * 24 * 60 * 60), '/');
            setcookie("TOKEN", $user['Token'], time() + (10 * 365 * 24 * 60 * 60), '/');
            setcookie("SECURE", $user['Secure'], time() + (10 * 365 * 24 * 60 * 60), '/');
            setcookie("ESCOLHA", $_GET['escolha'], time() + (10 * 365 * 24 * 60 * 60), '/');
            return true;
            
        } else {
            die(header("HTTP/1.0 401 Password incorreta"));
        }
    } else {
        die(header("HTTP/1.0 401 Formulário de autenticação inválido"));
    }
?>