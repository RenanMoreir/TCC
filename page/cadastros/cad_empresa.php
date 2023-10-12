<?php
    echo "<p>teste<\p>";
    include("connection/connect.php");

    if(isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["senha"]) && isset($_POST["repita"])) {

        // Normalization
        $username = $_POST["nome"];
        $descricao = $_POST["desc"];
        $telefone = $_POST["telefone"];
        $cnpj = $_POST["cnpj"];
        $estado = $_POST["estado"];
        $rua = $_POST["rua"];
        $cidade = $_POST["cidade"];
        $bairro = $_POST["bairro"];
        $numero = $_POST["numero"];
        $cep = $_POST["cep"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $repsenha = $_POST["repita"];

        // Check if values are okay
        if ($username == "" || $email == "" || $senha == "" || $repsenha == "" || $descricao == "" || $telefone == "" || $cnpj == "" || $estado == "" ||
        $rua == "" || $cidade == "" || $bairro == "" || $numero == "" || $cep == "") {
            die(header("HTTP/1.0 401 Preenche todos os campos do formulário"));
        }

        // Check if username already exists
        $checkUsername = $con->prepare("SELECT Id FROM usuario_abrigo WHERE Nome = ?");
        $checkUsername->bind_param("s", $username);
        $checkUsername->execute();
        $count = $checkUsername->get_result()->num_rows;
        if ($count > 0) {
            die(header("HTTP/1.0 401 Username existente"));
        }

        // Check if email already exists
        $checkEmail = $con->prepare("SELECT Id FROM usuario_abrigo WHERE Email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $count = $checkEmail->get_result()->num_rows;
        if ($count > 0) {
            die(header("HTTP/1.0 401 Conta registada com este e-mail existente"));
        }
        
        // Verify password repeat
        if ($senha != $repsenha) {
            die(header("HTTP/1.0 401 Passwords diferentes"));
        }

        // Ecrypt password
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        
        // Create secure code and token
        $token = bin2hex(openssl_random_pseudo_bytes(20));
        $secure = rand(1000000000, 9999999999);
        
        // Queries for creation and collection
        $stmt = $con->prepare("INSERT INTO usuario_abrigo (`Nome`, `Descricao`, `Telefone`, `Cnpj`, `Estado`, `Rua`, `Cidade`, `Bairro`, `Numero`, `Cep`, `Email`, `Senha`, `Token`, `Secure`, `Creation`) 
                                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())");
        $stmt->bind_param("ssisssssssssssi", $username, $descricao, $telefone, $cnpj, $estado, $rua, $cidade, $bairro, $numero, $cep, $email, $senha, $token, $secure);
        $stmt->execute();

        $getUser = $con->prepare("SELECT Id, Token, Secure FROM usuario_abrigo WHERE Email = ?");
        $getUser->bind_param("s", $email);
        $getUser->execute();
        $user = $getUser->get_result()->fetch_assoc();

        if ($stmt && $user) {
            setcookie("ID", $user['Id'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("TOKEN", $user['Token'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("SECURE", $user['Secure'], time() + (10 * 365 * 24 * 60 * 60));
            return true;
        } else {
            die(header("HTTP/1.0 401 Ocorreu um erro na base de dados"));
        }
    } else {
        die(header("HTTP/1.0 401 Formulário de autenticação inválido"));
    }
?>