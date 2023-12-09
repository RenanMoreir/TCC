<?php
    include("connection/connect.php");
    require_once '../core/conexao_mysql.php';
    require_once '../core/sql.php';
    require_once '../core/mysql.php';

    $usuarios = buscar(
        'user',
        [
            'Id',
            'Username',
            'Email',
            'Nome',
            'Telefone',
            'Creation',
        ]
    );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFs">

        <link rel="stylesheet" type="text/css" href="../style/aparecer_animal.css">
    <meta charset="UTF-8">
    <title>Feed</title>
</head>
<body>
    <div class="container" style="width: 100%; height: 88vh; overflow-y: scroll;" >
    <?php
    $i=0;
        foreach ($usuarios as $usuario)
        {
            ?>

            <div class="card col-md-8" style="height: auto;  margin:auto; border: 3px solid blue;">
            <div class="card-title"><h3>Usuario: <?php echo $usuarios[$i]['Nome'] ?></h3></div>
            <div class="card-body">            
            <p><strong>ID: </strong><?php echo $usuarios[$i]['Id'] ?></p>
            <p><strong>Username: </strong><?php echo $usuarios[$i]['Username'] ?></p>
            <p><strong>E-mail: </strong><?php echo $usuarios[$i]['Email'] ?></p>
            <p><strong>Telefone: </strong><?php echo $usuarios[$i]['Telefone'] ?></p>
            <p><strong>Creation: </strong><?php echo $usuarios[$i]['Creation'] ?></p>
            <form method="post" id="delete_usuario" class="delete-form1 form-vertical" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $usuarios[$i]['Id'] ?>">                                 
                    <input type="hidden" name="acao" value="delete">                    
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este animal?')">Deletar</button>
            </form>
            
            </div>

            </div>
            <br>
            
    <?php
            $i++;
        }
    ?>
    <?php
        $abrigos = buscar(
            'usuario_abrigo',
            [
                'Id_abrigo',
                'Username',
                'Email',
                'Nome',
                'Telefone',
                'Creation',
            ]
        );
    
    ?>
    <div class="container" style="width: 100%; height: 88vh; overflow-y: scroll;" >
        <?php
        $o=0;
            foreach ($abrigos as $abrigo)
            {
                ?>
    
                <div class="card col-md-8" style="height: auto;  margin:auto; border: 3px solid blue;">
                <div class="card-title"><h3>Abrigo: <?php echo $abrigos[$o]['Nome'] ?></h3></div>
                <div class="card-body">            
                <p><strong>ID: </strong><?php echo $abrigos[$o]['Id_abrigo'] ?></p>
                <p><strong>Username: </strong><?php echo $abrigos[$o]['Username'] ?></p>
                <p><strong>E-mail: </strong><?php echo $abrigos[$o]['Email'] ?></p>
                <p><strong>Telefone: </strong><?php echo $abrigos[$o]['Telefone'] ?></p>
                <p><strong>Creation: </strong><?php echo $abrigos[$o]['Creation'] ?></p>
                <form method="post" id="delete_abrigo" class="delete-form2 form-vertical" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $abrigos[$o]['Id_abrigo'] ?>">                                 
                        <input type="hidden" name="acao" value="delete">                    
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este animal?')">Deletar</button>
                </form>
                </div>
    
                </div>
                <br>
                
        <?php
                $o++;
            }
        ?>  
 
    </div>          
    
    <script>
    $('.delete-form2').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);  // Referência ao formulário atual
        $.ajax({
            type: 'post',
            url: '../core/abrigo_repositorio.php',
            xhrFields: {
                withCredentials: true
            },
            crossDomain: true,
            data: form.serialize(),
            success: function (data) {
                Swal.fire({
                    title: 'Usuario removido',
                    text: 'O usuario foi removido com sucesso',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                // Você também pode adicionar lógica para remover o elemento HTML do DOM se necessário
                form.closest('.card').remove();
            },
            error: function (error) {
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
    $('.delete-form1    ').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);  // Referência ao formulário atual
        $.ajax({
            type: 'post',
            url: '../core/usuario_repositorio.php',
            xhrFields: {
                withCredentials: true
            },
            crossDomain: true,
            data: form.serialize(),
            success: function (data) {
                Swal.fire({
                    title: 'Usuario removido',
                    text: 'O usuario foi removido com sucesso',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                // Você também pode adicionar lógica para remover o elemento HTML do DOM se necessário
                form.closest('.card').remove();
            },
            error: function (error) {
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