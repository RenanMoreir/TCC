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
        'Descricao',
        'Imagem'
    ],
    $criterio
);
//print_r($animais);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFs">

    <link rel="stylesheet" type="text/css" href="../style/aparecer_animal.css">
    <meta charset="UTF-8">
    <title>Feed</title>
</head>

<body>
    <div class="container" style="width: 100%; height: 88vh; overflow-y: scroll;">
        <?php
        $i = 0;
        foreach ($animais as $animal) {
        ?>

            <div class="card col-md-8" style="height: auto;  margin:auto; border: 3px solid blue;">
                <form method="post" id="delete" class="delete-form form-vertical" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $animais[$i]['Id_animal'] ?>">
                    <input type="hidden" name="acao" value="delete">
                    <button type="submit" class="btn btn-danger btn-close" onclick="return confirm('Tem certeza que deseja excluir este animal?')"></button>
                </form>
                <div class="card-title">
                    <h3><?php echo $animais[$i]['Nome'] ?></h3>
                </div>
                <div class="card-body">
                    <img src="../animalPics/<?php echo $animais[$i]['Imagem'] ?>" class="img-fluid" alt="Imagem do Animal" style="width: 60%;">
                    <p><strong>Raça: </strong><?php echo $animais[$i]['Raca'] ?></p>
                    <p><strong>Porte: </strong><?php echo $animais[$i]['Porte'] ?></p>
                    <p><strong>Cor: </strong><?php echo $animais[$i]['Cor'] ?></p>
                    <p><strong>Espécie: </strong><?php echo $animais[$i]['Especie'] ?></p>
                    <p><strong>Sexo: </strong><?php echo $animais[$i]['Sexo'] ?></p>
                    <p><strong>Pelagem: </strong><?php echo $animais[$i]['Pelagem'] ?></p>
                    <p><strong>Idade: </strong><?php echo $animais[$i]['Idade'] ?></p>
                    <p><strong>Descricao: </strong><?php echo $animais[$i]['Descricao'] ?></p>
                </div>

            </div>
            <br>

        <?php
            $i++;
        }
        ?>
    </div>

    <script>
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this); // Referência ao formulário atual
            $.ajax({
                type: 'post',
                url: '../core/animal_repositorio.php',
                xhrFields: {
                    withCredentials: true
                },
                crossDomain: true,
                data: form.serialize(),
                success: function(data) {
                    Swal.fire({
                        title: 'Animal removido',
                        text: 'O animal foi removido com sucesso',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    // Você também pode adicionar lógica para remover o elemento HTML do DOM se necessário
                    form.closest('.card').remove();
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        title: 'Algo não está correto!',
                        text: error.statusText,
                        icon: 'error',
                        confirmButtonText: 'Tentar novamente'
                    });
                }
            });
        });
    </script>

</body>

</html>