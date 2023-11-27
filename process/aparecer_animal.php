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
    //print_r($animais);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFs">
    <meta charset="UTF-8">
    <title>Feed</title>
</head>
<body>
    <div class="container justify-content-center" >
    <?php
    $i=0;
        foreach ($animais as $animal)
        {
            ?>
            <div class="card col-md-8" style="height: 50%; display:flex; position:relative; margin:auto;">
            <div class="card-title"><h3><?php echo $animais[$i]['Nome'] ?></h3></div>
            <div class="card-body">            
            <label for="raca">Raça</label>
            <p><?php echo $animais[$i]['Raca'] ?></p>
            <label for="porte">Porte</label>
            <input type="text" value="<?php echo $animais[$i]['Porte'] ?>" name="porte">
            <label for="cor">Cor</label>
            <input type="text" value="<?php echo $animais[$i]['Cor'] ?>" name="cor">
            <label for="especie">Especie</label>
            <input type="text" value="<?php echo $animais[$i]['Especie'] ?>" name="especie">
            <label for="sexo">Sexo</label>
            <input type="text" value="<?php echo $animais[$i]['Sexo'] ?>" name="sexo">
            <label for="pelgem">Pelagem</label>
            <input type="text" value="<?php echo $animais[$i]['Pelagem'] ?>" name="pelagem">
            <label for="idade">Idade</label>
            <input type="text" value="<?php echo $animais[$i]['Idade'] ?>" name="idade">
            <label for="descricao">Descrição</label>
            <input type="text" value="<?php echo $animais[$i]['Descricao'] ?>" name="descricao">
            </div>
            </div>
            <br>
    <?php
            $i++;
        }
    ?>     
    </div>                 
</body>
</html>