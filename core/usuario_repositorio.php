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

$id = (int)$id;

switch($acao) 
{
    
    case 'insert':
        if ($username == "" || $email == "" || $senha == "" || $repita == ""
             || $nome == "" || $telefone == "" || $cpf == ""
         || $especie == "" || $pelagem == "" || $porte == "" || $sexo == "") 
        {
            die(header("HTTP/1.0 401 Preenche todos os campos do formulário"));
        }; 
        
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
            'Email' => $email,
            'Password' => $senha,
            'Nome' => $nome,
            'Dtnasc' => $dtnasc,
            'Telefone' => $telefone,
            'Cpf' => $cpf,
            'Cep' => $cep,
            'Rua' => $rua,
            'Numero' => $numero,
            'Bairro' => $bairro,
            'Cidade' => $cidade,
            'Token' => $token,
            'Secure' => $secure,
            //'Creation' => 'now()',
            'Porte' => $porte,
            'Especie' => $especie,
            'Sexo' => $sexo,
            'Pelagem' => $pelagem,
        ];

        insere(
            'user',
            $dados
        );
        break;
    case 'update': 
        
        $dados = [
            'Porte' => $porte,
            'Especie' => $especie,
            'Sexo' => $sexo,
            'Pelagem' => $pelagem,
        ];

        $criterio = [
            ['id', '=', $id]
        ];

        atualizar(
            'user',
            $dados,
            $criterio
        );

        break;
    case 'delete':
        $criterio = [
            ['Id', '=', $id]
        ];

        deleta(
            'user',
            $criterio
        );

        $criterio1 = [
            ['FK_id_abrigo', '=', $id]
        ];

        deleta(
            'animal',
            $criterio1
        );

        break;
}

//header('Location: ../index.php');

?>