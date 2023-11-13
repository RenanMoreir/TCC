<?php
include("../process/connection/connect.php");
//require_once '../includes/valida_login.php';
require_once '../includes/funcoes.php';
require_once 'conexao_mysql.php';
require_once 'sql.php';
require_once 'mysql.php';

foreach($_POST as $indice => $dado) {
    $$indice = limparDados($dado);
}

foreach($_GET as $indice => $dado) {
    $$indice = limparDados($dado);
}



switch($acao) 
{
    
    case 'insert':
        // Check if values are okay
        if ($username == "" || $email == "" || $senha == "" || $repita == "" 
        || $descricao == "" || $telefone == "" || $cnpj == "" || $estado == "" ||
        $rua == "" || $cidade == "" || $bairro == "" || $numero == "" || $cep == "") {
            die(header("HTTP/1.0 401 Preenche todos os campos do formulário"));
        }
        
        // Check if username already exists
        $checkUsername = $con->prepare("SELECT Id_abrigo FROM usuario_abrigo WHERE Nome = ?");
        $checkUsername->bind_param("s", $username);
        $checkUsername->execute();
        $count = $checkUsername->get_result()->num_rows;
        if ($count > 0) {
            die(header("HTTP/1.0 401 Username existente"));
        }
        // Check if email already exists
        $checkEmail = $con->prepare("SELECT Id_abrigo FROM usuario_abrigo WHERE Email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $count = $checkEmail->get_result()->num_rows;
        if ($count > 0) {
            die(header("HTTP/1.0 401 Conta registada com este e-mail existente"));
        }
        // Verify password repeat
        if ($senha != $repita) {
            die(header("HTTP/1.0 401 Passwords diferentes"));
        }

        // Ecrypt password
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        
        // Create secure code and token
        $token = bin2hex(openssl_random_pseudo_bytes(20));
        $secure = rand(1000000000, 9999999999);
        
        $dados = [
            'Username' => $username,
            'Nome' => $Nome,
            'Descricao' => $descricao,
            'Telefone' => $telefone,
            'Cnpj' => $cnpj,
            'Estado' => $estado,
            'Rua' => $rua,
            'Cidade' => $cidade,
            'Bairro' => $bairro,
            'Numero' => $numero,
            'Cep' => $cep,
            'Email' => $email,
            'Senha' => $senha,
            'Secure' => $secure,
            'Creation' => 'now()',
            'Token' => $token,
        ];

        insere(
            'usuario_abrigo',
            $dados
        );
        break;
    case 'update': 
        $dados = [
            'Username' => $username,
            'Nome' => $email,
            'Descricao' => $senha,
            'Telefone' => $nome,
            'Cnpj' => $dtnasc,
            'Estado' => $telefone,
            'Rua' => $cpf,
            'Cidade' => $cep,
            'Bairro' => $rua,
            'Numero' => $numero,
            'Cep' => $bairro,
            'Email' => $cidade,
            'Senha' => $token,
            'Secure' => $secure,
            'Creation' => 'now()',
            'Token' => $token,
        ];

        $criterio = [
            ['id', '=', $id]
        ];

        atualizar(
            'usuario_abrigo',
            $dados,
            $criterio
        );

        break;
    case 'delete':
        $criterio = [
            ['id', '=', $id]
        ];

        delete(
            'usuario_abrigo',
            $criterio
        );

        break;
}

//header('Location: ../index.php');

?>