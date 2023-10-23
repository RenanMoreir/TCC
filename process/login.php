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
        $stmt = $con->prepare("SELECT Id, Password, Token, Secure FROM User WHERE (Email LIKE ? OR Username LIKE ?) LIMIT 1");
        $stmt->bind_param("ss", $email, $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if($user = ''){
            $stmt = $con->prepare("SELECT Id, Password, Token, Secure, Tipo FROM usuario_abrigo WHERE (Email LIKE ? OR Username LIKE ?) LIMIT 1");
            $stmt->bind_param("ss", $email, $email);
            $stmt->execute();
            $user_abrigo = $stmt->get_result()->fetch_assoc();

            if ($user && password_verify($password, $user['Password'])) {
                setcookie("ID", $user['Id'], time() + (10 * 365 * 24 * 60 * 60));
                setcookie("TOKEN", $user['Token'], time() + (10 * 365 * 24 * 60 * 60));
                setcookie("SECURE", $user['Secure'], time() + (10 * 365 * 24 * 60 * 60));
                return true;
            } else {
                                die(header("HTTP/1.0 401 Senha incorreta"));
            }
        } else {
        // Check password
        if ($user && password_verify($password, $user['Password'])) {
            setcookie("ID", $user['Id'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("TOKEN", $user['Token'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("SECURE", $user['Secure'], time() + (10 * 365 * 24 * 60 * 60));
            return true;
        } else {
            if ($user_abrigo && password_verify($password, $user_abrigo['Password'])) {
                setcookie("ID", $user_abrigo['Id'], time() + (10 * 365 * 24 * 60 * 60));
                setcookie("TOKEN", $user_abrigo['Token'], time() + (10 * 365 * 24 * 60 * 60));
                setcookie("SECURE", $user_abrigo['Secure'], time() + (10 * 365 * 24 * 60 * 60));
                return true;
            } else {
                die(header("HTTP/1.0 401 Senha incorreta"));
            }
        }
        }
    } else {
        die(header("HTTP/1.0 401 Formulário de autenticação inválido"));
    }
?>