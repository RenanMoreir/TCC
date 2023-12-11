<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/cadastro_animal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/sweetalert2.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/sweetalert2.js"></script>

    <title>Preferencias</title>
</head>

<body>

    <?php
    include("../process/connection/connect.php");
    require_once '../core/conexao_mysql.php';
    require_once '../core/sql.php';
    require_once '../core/mysql.php';
    require_once '../includes/funcoes.php';



    $id = $_COOKIE["ID"];
    $criterio = [
        ['Id', '=', $id]
    ];

    $preferencias = buscar(
        'user',
        [
            'Porte',
            'Especie',
            'Sexo',
            'Pelagem',

        ],
        $criterio
    );

    foreach ($preferencias as $preferencias) {
    ?>
        <div class="container-preferencias mt-5 col-md-12">
            <div class="card col-md-12" style="width: 100%; height: 88vh;">

                <div class="cadastro-form">
                    <button type="button" class="btn btn-danger btn-close" onclick="chat()"></button>

                    <form method="post" id="alterar" class="form-vertical" enctype="multipart/form-data">
                        <h3 style="text-align: center;" class="card-title">Minhas Preferencias:</h3>
                        <input type="hidden" name="acao" value="update">
                        <!--    <input type="hidden" name="id" value="<?php echo $id ?>"> -->


                        <div class="card-body">
                            <div class="form-group">
                                <label for="pelagem" class="col-md-4 control-label">Pelagem:</label>
                                <div class="col-md-12">
                                    <select name="pelagem" class="form-control input-md">
                                        <option value="s_preferencia" <?php if ($preferencias['Pelagem'] == 's_preferencia') {
                                                                            echo 'selected';
                                                                        } ?>>Sem preferencia</option>
                                        <option value="curto" <?php if ($preferencias['Pelagem'] == 'curto') {
                                                                    echo 'selected';
                                                                } ?>>Curto</option>
                                        <option value="medio" <?php if ($preferencias['Pelagem'] == 'medio') {
                                                                    echo 'selected';
                                                                } ?>>Médio</option>
                                        <option value="longo" <?php if ($preferencias['Pelagem'] == 'longo') {
                                                                    echo 'selected';
                                                                } ?>>Longo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sexo" class="col-md-4 control-label">Sexo:</label>
                                <div class="col-md-12">
                                    <select name="sexo" class="form-control input-md">
                                        <option value="s_preferencia" <?php if ($preferencias['Sexo'] == 's_preferencia') {
                                                                            echo 'selected';
                                                                        } ?>>Sem preferencia</option>
                                        <option value="macho" <?php if ($preferencias['Sexo'] == 'macho') {
                                                                    echo 'selected';
                                                                } ?>>Macho</option>
                                        <option value="femea" <?php if ($preferencias['Sexo'] == 'femea') {
                                                                    echo 'selected';
                                                                } ?>>Fêmea</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="porte" class="col-md-4 control-label">Porte:</label>
                                <div class="col-md-12">
                                    <select name="porte" class="form-control input-md">
                                        <option value="s_preferencia" <?php if ($preferencias['Porte'] == 's_preferencia') {
                                                                            echo 'selected';
                                                                        } ?>>Sem preferencia</option>
                                        <option value="pequeno" <?php if ($preferencias['Porte'] == 'pequeno') {
                                                                    echo 'selected';
                                                                } ?>>Pequeno</option>
                                        <option value="medio" <?php if ($preferencias['Porte'] == 'medio') {
                                                                    echo 'selected';
                                                                } ?>>Médio</option>
                                        <option value="grande" <?php if ($preferencias['Porte'] == 'grande') {
                                                                    echo 'selected';
                                                                } ?>>Grande</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="especie" class="col-md-4 control-label">Espécie:</label>
                                <div class="col-md-12">
                                    <select name="especie" class="form-control input-md">
                                        <option value="s_preferencia" <?php if ($preferencias['Especie'] == 's_preferencia') {
                                                                            echo 'selected';
                                                                        } ?>>Sem preferencia</option>
                                        <option value="cachorro" <?php if ($preferencias['Especie'] == 'cachorro') {
                                                                        echo 'selected';
                                                                    } ?>>Cachorro</option>
                                        <option value="gato" <?php if ($preferencias['Especie'] == 'gato') {
                                                                    echo 'selected';
                                                                } ?>>Gato</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <button id="Alterar" name="Alterar" class="btn btn-success" onclick="location.reload()">Alterar</button>
                                    <button id="Cancelar" name="Cancelar" class="btn btn-danger" type="Reset">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <script>
        $('#alterar').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '../core/usuario_repositorio.php',
                xhrFields: {
                    withCredentials: true
                },
                crossDomain: true,
                data: $('#alterar').serialize(),
                success: function(data) {
                    Swal.fire({
                        title: 'Cadastro confirmado',
                        text: 'Alteração realizada com sucesso',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    })
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        title: 'Algo não esta correto!',
                        text: error.statusText,
                        icon: 'error',
                        confirmButtonText: 'Tentar novamente'
                    })
                }
            });
        });
    </script>

</body>

</html>