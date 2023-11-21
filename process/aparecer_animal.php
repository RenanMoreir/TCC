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

    foreach($animais as $animal)
    {
        print_r($animal);
    }


?>