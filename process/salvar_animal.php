<?php
    include("../../process/connection/connect.php");

    if(isset($_POST['animal_nome']) && isset($_POST['descricao'])) {

        // Normalization
        $animal_nome = $_POST["animal_nome"];
        $pelagem = $_POST["pelagem"];
        $raca = $_POST["raca"];
        $cor = $_POST["cor"];
        $sexo = $_POST["sexo"];
        $porte = $_POST["porte"];
        $especie = $_POST["especie"];
        $descricao = $_POST["descricao"];


        // Check if values are okay
        if ( $nome == "" || $pelagem == "" || $raca == "" || $cor == "" || $sexo== "" ||
        $porte == "" ||  $especie == "" || $descricao == "") {
            die(header("HTTP/1.0 401 Preenche todos os campos do formulário"));
        }

       /*  // Check if username already exists
        $checkUsername = $con->prepare("SELECT Id_abrigo FROM usuario_abrigo WHERE Nome = ?");
        $checkUsername->bind_param("s", $username);
        $checkUsername->execute();
        $count = $checkUsername->get_result()->num_rows;
        if ($count > 0) {
            die(header("HTTP/1.0 401 Username existente"));
        } */

        /* // Check if email already exists
        $checkEmail = $con->prepare("SELECT Id_abrigo FROM usuario_abrigo WHERE Email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $count = $checkEmail->get_result()->num_rows;
        if ($count > 0) {
            die(header("HTTP/1.0 401 Conta registada com este e-mail existente"));
        } */
        
        /* // Verify password repeat
        if ($senha != $repsenha) {
            die(header("HTTP/1.0 401 Passwords diferentes"));
        }

        // Ecrypt password
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        
        // Create secure code and token
        $token = bin2hex(openssl_random_pseudo_bytes(20));
        $secure = rand(1000000000, 9999999999); */
        
        // Queries for creation and collection

        $stmt = $con->prepare("INSERT INTO animal (`Nome`, `Descricao`, `Telefone`, `Cnpj`, `Estado`, `Rua`, `Cidade`, `Bairro`, `Numero`, `Cep`, `Email`, `Senha`, `Token`, `Secure`, `Creation`) 
                                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())");
        $stmt->bind_param("sssssssssssssi", $username, $descricao, $telefone, $cnpj, $estado, $rua, $cidade, $bairro, $numero, $cep, $email, $senha, $token, $secure);
        $stmt->execute();

        $getUser = $con->prepare("SELECT Id_abrigo, Token, Secure FROM usuario_abrigo WHERE Email = ?");
        $getUser->bind_param("s", $email);
        $getUser->execute();
        $user = $getUser->get_result()->fetch_assoc();

        if ($stmt && $user) {
            $escolha = 0;
            setcookie("ID", $user['Id_abrigo'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("TOKEN", $user['Token'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("SECURE", $user['Secure'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("ESCOLHA", $escolha, time() + (10 * 365 * 24 * 60 * 60));
            return true;
        } else {
            die(header("HTTP/1.0 401 Ocorreu um erro na base de dados"));
        }
    } else {
        die(header("HTTP/1.0 401 Formulário de autenticação inválido"));
    }
?>
