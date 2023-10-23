<?php
    include("check.php");

    if (isset($_GET["id"]) && $_GET["id"] > 0){
        $user_id = $_GET["id"];

        // Get user
        $getUser = $con->prepare("SELECT Username FROM User WHERE (Id LIKE ?) LIMIT 1");
        $getUser->bind_param("i", $user_id);
        $getUser->execute();
        $user = $getUser->get_result()->fetch_assoc();

        ?>
        <div class="topMenu">
            <img src="../img/close.png" onclick="chat()" />
            <p class="title"><?php echo $user["Username"]; ?></p>
        </div>

        <div class="innerContainer"></div>

        <form method="POST" enctype="multipart/form-data" id="sendMessage">
            <input type="number" value="<?php echo $user_id; ?>" name="id" hidden />
            <input type="text" maxlength="500" name="message" id="messageInput" placeholder="Escreva aqui a sua mensagem" />
            <input type='file' name="image" accept="image/x-png,image/jpeg" id="sendImage" hidden />
            <label for="sendImage"><img src="../img/image.png" /></label>
        </form>

        <script>
          //var intervalo = setInterval();
          
          function sendMessage() {
                var formData = new FormData($("#sendMessage")[0]);
                $.ajax({
                    type: 'post',
                    url: '../process/send.php',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $("#sendMessage")[0].reset();
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Mensagem não enviada',
                            text: error.statusText,
                            icon: 'error',
                            confirmButtonText: 'Tentar novamente'
                        })
                    }
                });
            }

            $("#messageInput").on('keyup', function (e) {
                if (e.keyCode === 13 && ($("#messageInput").val().length > 0)) {
                    sendMessage()
                }
            });

            $("#sendImage").change(function() {
                sendMessage();
                console.log("SEND");
            });

            //clearInterval(intervalo);
            
           function StopInterval(){
            clearInterval(intervalo);
           };

           StopInterval();
           var intervalo = setInterval(() => {
                $.ajax({
                    url: '../process/retrieve.php?id=<?php echo $user_id; ?>',
                    success: function (data) {
                        $('#chat .innerContainer').html(data);
                        $('#chat .innerContainer').scrollTop($('#chat .innerContainer').prop("scrollHeight"));
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Erro de chat',
                            text: error.statusText,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                    }
                });
            },1500);
           
          
        </script>
        <?php
    } else {
        ?>
        <div class="empty">
        <?php
         $hostname = "localhost";
         $username = "root";
         $password = "";
         $database = "banco";
         $port = 3307;
         $conn = mysqli_connect($hostname, $username,$password, $database, $port);
         mysqli_query($conn, "SET time_zone='+00:00'");
     
         date_default_timezone_set("UTC");
     
         if(mysqli_connect_errno())
         {
             echo "Falha ao ligar a base de dados: ".mysqli_connect_error();
             exit();
         }

$p = "preto";

// Query para selecionar os valores de porte e cor da tabela animal
$sql = "SELECT porte, cor, raca, nome, idade FROM animal";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Array de perfis fictícios
    $perfis = [];

    while ($row = $result->fetch_assoc()) {
        $perfis[] = ["porte" => $row["porte"], "cor" => $row["cor"], "raca" => $row['raca'], "nome" => $row['nome'], "idade" => $row['idade']];
    }

    // Inicialize um array vazio para armazenar os índices dos perfis exibidos
    $perfisExibidos = [];

    // Verifique se todos os perfis já foram exibidos
    if (count($perfisExibidos) === count($perfis)) {
        echo '<h1>Todos os perfis foram exibidos</h1>';
    } else {
        do {
            // Escolha aleatoriamente um índice de perfil
            $indiceAleatorio = array_rand($perfis);
            $perfilAleatorio = $perfis[$indiceAleatorio];

            // Verifique se o perfil já foi exibido e se a idade corresponde
            if (!in_array($indiceAleatorio, $perfisExibidos) && $p == $perfilAleatorio['cor']) {
                // Adicione o índice do perfil aos perfis exibidos
                $perfisExibidos[] = $indiceAleatorio;

                // Div para cada perfil
                echo '<div class="profile-card">';
                // '<img src="' . $perfilAleatorio['foto'] . '" alt="Foto do perfil">';
                echo '<p class="profile-porte">Nome: ' . $perfilAleatorio['nome'] . '</p>';
                echo '<p class="profile-cor">Idade: ' . $perfilAleatorio['idade'] . '</p>';
                echo '<p class="profile-porte">Porte: ' . $perfilAleatorio['porte'] . '</p>';
                echo '<p class="profile-cor">Cor: ' . $perfilAleatorio['cor'] . '</p>';
                echo '<p class="profile-porte">Raça: ' . $perfilAleatorio['raca'] . '</p>';
                echo '<button class="profile-like-button" onclick="location.reload();">Gostei</button>';
                echo '<button class="profile-like-button" onclick="location.reload();">Passo</button>';
                echo '</div>';
                break; // Saia do loop
            }
        } while (true);
    }
} else {
    echo "Nenhum perfil encontrado no banco de dados.";
}

// Feche a conexão com o banco de dados
$conn->close();
?>
        </div>
        <?php
    }
?>