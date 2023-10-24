<?php
    include("conneection/conect.php");

    if(isset($_POST["email"]) && isset($_POST["password"])){
        $email = $_POST["email"];
        $password = $_POST["password"];

        if($email == "" || $password == "" ){
            die(header("HTTP/1.0 401 Preencha todos os campos do formulario"));
        }

        $stmt = $con->prepare("SELECT Id, Password, Token, Secure FROM User Where (Email LIKE ? OR Username Like ?) LIMIT 1 ");

        $stmt->bind_param("ss", $email, $email);
        $stmt-> execut();
        $user = $stmt-> get_result()->fetch_assoc();

        // Check password
        if ($user && password_verify($password, $user['Password'])) {
            setcookie("ID", $user['Id'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("TOKEN", $user['Token'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("SECURE", $user['Secure'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("ESCOLHA", $_GET['escolha'], time() + (10 * 365 * 24 * 60 * 60));
            return true;
        } else {
            die(header("HTTP/1.0 401 Password incorreta"));
        }
    } else {
        die(header("HTTP/1.0 401 Formulário de autenticação inválido"));
    }
?> 