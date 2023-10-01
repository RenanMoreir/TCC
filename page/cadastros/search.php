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
                    <p id="carac"> <?php echo $user['Caracteristica']; ?> <button onclick="adicionar">+</button></p>
                </div>
                <?php
            }
        }
    }


?>