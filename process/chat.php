<?php
include("check.php");
if ($_COOKIE['ADM'] == 1) {
    include_once('adm.php');
} else if ($_COOKIE['ESCOLHA'] == 0 and $_GET['id'] == 0) {
    include('aparecer_animal.php');
} else if (isset($_GET["id"]) && $_GET["id"] > 0 and $_COOKIE['ESCOLHA'] == 0) {
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
                success: function(data) {
                    $("#sendMessage")[0].reset();
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Mensagem não enviada',
                        text: error.statusText,
                        icon: 'error',
                        confirmButtonText: 'Tentar novamente'
                    })
                }
            });
        }

        $("#messageInput").on('keyup', function(e) {
            if (e.keyCode === 13 && ($("#messageInput").val().length > 0)) {
                sendMessage()
            }
        });

        $("#sendImage").change(function() {
            sendMessage();
            console.log("SEND");
        });

        //clearInterval(intervalo);

        function StopInterval() {
            clearInterval(intervalo);
        };

        StopInterval();
        var intervalo = setInterval(() => {
            $.ajax({
                url: '../process/retrieve.php?id=<?php echo $user_id; ?>',
                success: function(data) {
                    $('#chat .innerContainer').html(data);
                    $('#chat .innerContainer').scrollTop($('#chat .innerContainer').prop("scrollHeight"));
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Erro de chat',
                        text: error.statusText,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                }
            });
        }, 1500);
    </script>
<?php
} else {
?>
    <div class="empty" style="width:100%;">
        <?php
        if ($_COOKIE['ESCOLHA'] == 1 and $_GET['id'] == 0) {
            include("feed.php");
        } else if ($_COOKIE['ESCOLHA'] == 0) {
            //include("../page/cadastro_animal.html");
            //include("../includes/busca.php");
        }
        ?>
    </div>
<?php
}

if (isset($_GET["id"]) && $_GET["id"] > 0 and $_COOKIE['ESCOLHA'] == 1) {
    $user_id = $_GET["id"];

    // Get user
    $getUser = $con->prepare("SELECT Username FROM usuario_abrigo WHERE (Id_abrigo LIKE ?) LIMIT 1");
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
                success: function(data) {
                    $("#sendMessage")[0].reset();
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Mensagem não enviada',
                        text: error.statusText,
                        icon: 'error',
                        confirmButtonText: 'Tentar novamente'
                    })
                }
            });
        }

        $("#messageInput").on('keyup', function(e) {
            if (e.keyCode === 13 && ($("#messageInput").val().length > 0)) {
                sendMessage()
            }
        });

        $("#sendImage").change(function() {
            sendMessage();
            console.log("SEND");
        });

        //clearInterval(intervalo);

        function StopInterval() {
            clearInterval(intervalo);
        };

        StopInterval();
        var intervalo = setInterval(() => {
            $.ajax({
                url: '../process/retrieve.php?id=<?php echo $user_id; ?>',
                success: function(data) {
                    $('#chat .innerContainer').html(data);
                    $('#chat .innerContainer').scrollTop($('#chat .innerContainer').prop("scrollHeight"));
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Erro de chat',
                        text: error.statusText,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                }
            });
        }, 1500);
    </script>
<?php
} else {
?>
    <div class="empty" style="width:100%;">

        <?php

        if ($_COOKIE['ESCOLHA'] == 1 and $_GET['id'] == 0 and $_COOKIE['ADM'] == 0) {
            include_once("feed.php");
        } else if ($_COOKIE['ESCOLHA'] == 0) {
        }
        ?>
    </div>
<?php
}
?>