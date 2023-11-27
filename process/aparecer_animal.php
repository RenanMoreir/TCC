<?php
    include("connection/connect.php");
    require_once '../core/conexao_mysql.php';
    require_once '../core/sql.php';
    require_once '../core/mysql.php';

    /*
    $id = $_COOKIE["ID"]; 

    $getAnimal = $con->prepare("SELECT Id_animal, Nome, Raca, Porte, Cor, Especie, Sexo, Pelagen,
                                Idade, Descricao FROM animal WHERE FK_id_abrigo LIKE ?");
    $getAnimal->bind_param("i", $id);
    $getAnimal->execute();
    $user = $getAnimal->get_result()->fetch_assoc();
    */

    $id = $_COOKIE["ID"]; 
    $criterio = [
        ['FK_id_abrigo', '=', $id]
    ];

    $animais = buscar(
        'animal',
        [
            'Id_animal',
            'Nome',
            'Raca',
            'Porte',
            'Cor',
            'Especie',
            'Sexo',
            'Pelagem',
            'Idade',
            'Descricao'
        ],
        $criterio    
    );
    print_r($animais);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <label for="nome">Nome</label>
    <input type="text" value="<?php echo $animais['1'] ?>" name="nome">
    <label for="raca">Raça</label>
    <input type="text" value="<?php echo $animais['Raca'] ?>" name="raca">
    <label for="porte">Porte</label>
    <input type="text" value="<?php echo $animais['Porte'] ?>" name="porte">
    <label for="cor">Cor</label>
    <input type="text" value="<?php echo $animais['Cor'] ?>" name="cor">
    <label for="especie">Especie</label>
    <input type="text" value="<?php echo $animais['Especie'] ?>" name="especie">
    <label for="sexo">Sexo</label>
    <input type="text" value="<?php echo $animais['Sexo'] ?>" name="sexo">
    <label for="pelgem">Pelagem</label>
    <input type="text" value="<?php echo $animais['Pelagem'] ?>" name="pelagem">
    <label for="idade">Idade</label>
    <input type="text" value="<?php echo $animais['Idade'] ?>" name="idade">
    <label for="descricao">Descrição</label>
    <input type="text" value="<?php echo $animais['Descricao'] ?>" name="descricao">
    

    
</body>
</html>