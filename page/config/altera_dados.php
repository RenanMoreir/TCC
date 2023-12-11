<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/config/estiloAltera.css">
    <title>Alterar Dados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="img\favicon.ico">
</head>

<body>
    <header>
        <div class="top-header">
            <nav>
                <a class="logo" href="#">MatchPet</a>
                <div class="mobile-menu">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
                <ul class="nav-list">
                    <li><a href="#sobre" target="_self">Sobre</a></li>
                    <li><a href="#contato" target="_self">Contato</a></li>
                    <li><a href="page/login/index.html" target="_self">Entrar</a></li>
                    <li><a href="page/register/index.html" target="_self" id="principal">Cadastre-se</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section>
        <div class="forms">
            <p>Cadastro de Usuário</p>
            <form action="altera_usuario_exe.php" method="post">
                <input type="hidden" name="id_usuario">
                <div>
                    <label for="nome">Nome: </label>
                    <input type="text" name="nome" id="nome">
                </div>
                <div>
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email">
                </div>
                <div>
                    <label for="fone">Telefone: </label>
                    <input type="tel" name="fone" id="fone" placeholder="(18)9999-8888" pattern="\([0-9]{2}\)([9]{1})?[0-9]{4}-[0-9]{4}">
                </div>
                <div>
                    <label for="senha">Senha: </label>
                    <input type="password" name="senha" id="senha">
                </div>
                <div>
                    <input type="file" name="foto" id="foto" accept="image/*">
                </div>
                <input type="submit" value="Salvar">
            </form>
        </div>
    </section>
</body>

</html>