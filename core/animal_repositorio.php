<?php
//require_once '../includes/valida_login.php';
require_once '../includes/funcoes.php';
require_once 'conexao_mysql.php';
require_once 'sql.php';
require_once 'mysql.php';
//include('../process/check.php');

print_r($_FILES);
print_r($_POST);

foreach($_POST as $indice => $dado) {
    $$indice = limparDados($dado);
}

foreach($_GET as $indice => $dado) {
    $$indice = limparDados($dado);
}

$id = (int)$id;
echo $id;

switch($acao) {
    case 'insert':
        if ( $nome == "" || $pelagem == "" || $raca == "" || $cor == "" || $sexo== "" ||
        $porte == "" ||  $especie == "" || $descricao == "") {
            die(header("HTTP/1.0 401 Preenche todos os campos do formulário"));
        }
        $imagename = $nome."_".rand(999, 999999).$_FILES['imagem']['tmp_name'];
        $imagetemp = $_FILES['imagem']['tmp_name'];
        $imagePath = "../animalPics/"; 
        move_uploaded_file($imagetemp, $imagePath . $imagename);
        //print_r($_FILES);
        $dados = [
            'Raca' => $raca,            
            'Cor' => $cor,
            'Especie' => $especie,
            'Sexo' => $sexo,
            'Pelagem' => $pelagem,
            'Idade' => $idade,
            'Nome' => $nome,
            'Descricao' => $descricao,
            'Porte' => $porte,
            'Fk_id_abrigo' => $_COOKIE['ID'],
            'Imagem' => $imagename
        ];

        insere(
            'animal',
            $dados
        );
    

        break;

    case 'update':
        if ( $nome == "" || $pelagem == "" || $raca == "" || $cor == "" || $sexo== "" ||
        $porte == "" ||  $especie == "" || $descricao == "") {
            die(header("HTTP/1.0 401 Preenche todos os campos do formulário"));
        } 
        $dados = [
            'raca' => $raca,            
            'cor' => $cor,
            'especie' => $especie,
            'sexo' => $sexo,
            'pelagem' => $pelagem,
            //'idade' => $idade,
            'nome' => $nome,
            'descricao' => $descricao,
            'fk_id_abrigo' => $_COOKIE['Id_abrigo'] 
        ];

        $criterio = [
            ['id', '=', $id]
        ];

        atualizar(
            'animal',
            $dados,
            $criterio
        );

        break;
    case 'delete':
        $criterio = [
            ['Id_animal', '=', $id]
        ];

        deleta(
            'animal',
            $criterio
        );

        break;
}

//header('Location: ../index.php');

?>