<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro pessoa</title>

    <link rel="stylesheet" href="../../style/sweetalert2.css">
    <script src="../../js/jquery.js"></script>
    <script src="../../js/sweetalert2.js"></script>
</head>
<body>

    <form action="#" method="post">
        <div>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="noem">
        </div>
        <div>
            <label for="sobrenome">Sobrenome</label>
            <input type="text" name="sobrenome" id="sobrenome">
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone">
        </div>
        <div>
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf">
        </div>
        <div>
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
        </div>
        <div>
            <label for="repita">Repita a senha</label>
            <input type="password" name="repita" id="repita">
        </div>

        <br><br> <!-- temporario, eu sei qeu esta feio -- resolve ai leonardo-->

        <input type="text" maxlength="15" name="username" class="searchField" onkeyup="search()"
                placeholder="Pesquisar Utilizador">
        <div id="searchContainer"></div>

        <div class="exibir">
            <ul id="lista"></ul>
        </div>

        <button>Cadastrar</button>
    </form> 
    
    <?php
    include("../../process/connection/connect.php");

    if( isset($_GET["term"])){
        $pesquisa = mysqli_real_escape_string($con, $_GET["term"]);

        $stmt = $con->prepare("SELECT Id, Caracteristica FROM caracteristica WHERE (Caracteristica LIKE '%$pesquisa%') ORDER BY Caracteristica DESC LIMIT 20");
        $stmt-> execute();

        $result = $stmt->get_result();
        $count = $result->num_rows;

        if ($count < 1) {
            echo '<p class="noResult">Sem resultado </p>';
        } else {
            while ($user = $result->fetch_assoc()){
                ?>
                <div class="row" onclick="$('#searchContainer').hide(); chat('<?php echo $user['Id'];?>');">
                    <p id="carac"> <?php echo $user['Caracteristica']; ?> <button onclick="adicionar()">+</button></p>
                </div>
                <?php
            }
        }
    }

?>

    <script>

    function search() {
                var term = $('input.searchField').val();
                if (term.length >= 3) {
                    $.ajax({
                        url: 'search.php?term=' + term,
                        success: function (data) {
                            $('#searchContainer').html(data);
                            $('#searchContainer').show();
                        }
                    })
                } else {
                    $('#searchContainer').hide();
                }
            }

        // https://pt.stackoverflow.com/questions/437869/inser%C3%A7%C3%A3o-de-elementos-em-uma-lista-html

        var nomes = ["Diego", "Gabriel", "Lucas"];
        
    function adicionar() {
             var coleta = document.getElementById("carac").value;
             var nomeDig = document.createElement('li');

             nomes.push(coleta);
             nomeDig.innerHTML = coleta;
             lista.appendChild(nomeDig);
   }


    </script>

</body>
</html>