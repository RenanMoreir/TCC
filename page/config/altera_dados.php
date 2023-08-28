<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/config/estiloAltera.css">
    <title>Alterar Dados</title>
    <link rel="icon" type="image/x-icon" href="img\favicon.ico">
</head>
<body> 
    <section>  
    <div class="forms">
    <h1>Configuração de Usuário</h1>
    <form action="altera_usuario_exe.php" method="post">
        <input type="hidden" name="id_usuario" >
        <div>
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome" >
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" >
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
        <input id="enviar" type="submit" value="Salvar">
    </form>
    </div>
    </section>
</body>
</html>