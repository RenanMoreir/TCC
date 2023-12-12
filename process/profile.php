<?php
include("check.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    die(header("HTTP/1.0 401 Falta de parametros na chamada"));
}

// Check if is logged user
if ($id == 0) {
    $id = $uid;
    $user_creation = date('d/m/Y', strtotime($user_creation));
?>
    <form method="POST" enctype="multipart/form-data" id="uploadPic">
        <input type='file' name="imgInp" accept="image/x-png,image/jpeg" id="imgInp" hidden />
        <div class="pictureContainer" >
            <img id="userImg" src="../profilePics/<?php echo $user_picture; ?>" />
            <label for="imgInp" style="display: flex;"></label>
        </div>
    </form>
<?php
} else {
    // Query
    if ($_COOKIE['ESCOLHA'] == 0) {
        $stmt = $con->prepare("SELECT Username, Picture, Online, Creation FROM User WHERE (Id = ?) LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
    } else if ($_COOKIE['ESCOLHA'] == 1) {
        $stmt = $con->prepare("SELECT Username, Picture, Online, Creation FROM usuario_abrigo WHERE (Id_abrigo = ?) LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
    }
    // Does user exists
    if (!$user) {
        die(header("HTTP/1.0 401 Erro ao carregar dados do perfil do utilizador"));
    } else {
        $username = $user["Username"];
        $user_picture = $user["Picture"];
        $user_online = strtotime($user["Online"]);
        $user_creation = date('d/m/Y', strtotime($user["Creation"]));
    }

?>
    <div class="pictureContainer">
        <img id="userImg" src="../profilePics/<?php echo $user_picture; ?>" />
    </div>
<?php
}
?>

<p class="name"><?php echo $username; ?></p>
<p class="row">Online <?php echo timing($user_online); ?></p>
<p class="row">Membro desde <?php echo $user_creation; ?>
   
</p>




<?php
if ($_COOKIE['ESCOLHA'] == 0) {
?>
    <p class="row"><button class="btn btn-primary" onclick="$('#chat').load('../page/cadastro_animal.html')">Cadastrar Animal</button></p>
<?php
}
if ($_COOKIE['ESCOLHA'] == 1) {
?>

    <p class="row"><button class="btn btn-primary" onclick="$('#chat').load('../page/preferencias.php')">Minhas Preferencias</button></p>
    <!-- <p class="row">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapse">
            Descrição
        </button>
    </p>
 -->  
<?php
}

?>

<script>


    function previewUpload(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#userImg').attr('src', e.target.result);
                var formData = new FormData($("#uploadPic")[0]);
                $.ajax({
                    type: 'post',
                    url: '../process/updateProfile.php',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    error: function(error) {
                        console.log(error);
                        Swal.fire({
                            title: 'Imagem não alterada',
                            text: error.statusText,
                            icon: 'error',
                            confirmButtonText: 'tente novamente'
                        })
                    }
                })
            }
            reader.readAsDataURL(input.files[0])
        }
    }

    $("#imgInp").change(function() {
        previewUpload(this);
    })
</script>