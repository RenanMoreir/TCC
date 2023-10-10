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

        <div id="teste">
        </div>
        <input type="submit" value="salvar">



    </form> 
    
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

    function criar() {
        var container = document.getElementById("teste");
        var paragrafo = document.createElement("input");
        paragrafo.type="text";
        paragrafo.value= "teste"; //deve ser mudado para pegar do panco a caracteristica;
        paragrafo.readOnly="True";
        paragrafo.className="gostos";
        container.append(paragrafo);
    }
    </script>

    

</body>
</html>