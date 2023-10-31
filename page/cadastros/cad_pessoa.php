<?php
    include("../../process/connection/connect.php");

    if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['repita'])) {

        // Normalization
        $username = $_POST["username"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $repsenha = $_POST["repita"];

        $nome = $_POST["nome"];
        $sobrenome = $_POST["sobrenome"]; 
        $telefone = $_POST["telefone"]; 
        $cpf = $_POST["cpf"]; 

        $especie = $_POST["especie"];
        $raca = $_POST["raca"];
        $pelagem = $_POST["pelagem"];
        $porte = $_POST["porte"];
        $sexo = $_POST["sexo"];
        $idademin = $_POST["idademin"];
        $idademax = $_POST["idademax"];

        // Check if values are okay
        if ($username == "" || $email == "" || $senha == "" || $repsenha == "" || $nome == "" || $sobrenome == "" || $telefone == "" || $cpf == ""
        || $especie == "" || $raca == "" || $pelagem == "" || $porte == "" || $sexo == "" || $idademin == "" || $idademax == "") {
            die(header("HTTP/1.0 401 Preenche todos os campos do formulário"));
        }

        // Check if username already exists
        $checkUsername = $con->prepare("SELECT Id FROM user WHERE Username = ?");
        $checkUsername->bind_param("s", $username);
        $checkUsername->execute();
        $count = $checkUsername->get_result()->num_rows;
        if ($count > 0) {
            die(header("HTTP/1.0 401 Username existente"));
        }

        // Check if email already exists
        $checkEmail = $con->prepare("SELECT Id FROM user WHERE Email = ?");
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
        $stmt = $con->prepare("INSERT INTO user (`Username`, `Email`, `Password`, `Nome`, `Sobrenome`, `Telefone`, `Cpf`,
                                                 `Especie`, `Raca`, `Pelagem`, `Porte`, `Sexo`, `Idademin`, `Idademax`, `Token`, `Secure`, `Creation`) 
                                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())");
        $stmt->bind_param("ssssssssssssiiss", $username, $email, $senha, $nome, $sobrenome, $telefone, $cpf, $especie, $raca, $pelagem, 
                                            $porte, $sexo, $idademin, $idademax, $token, $secure);
        $stmt->execute();

        $getUser = $con->prepare("SELECT Id, Token, Secure FROM user WHERE Email = ?");
        $getUser->bind_param("s", $email);
        $getUser->execute();
        $user = $getUser->get_result()->fetch_assoc();

        if ($stmt && $user) {
            $escolha = 1;
            setcookie("ID", $user['Id'], time() + (10 * 365 * 24 * 60 * 60));
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