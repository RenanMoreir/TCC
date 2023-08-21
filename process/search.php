<?php
    include('check.php');

    if( isset($_GET["term"])){
        $username = mysqli_real_escape_string($con, $_GET["term"]);

        $stmt = $con->prepare("SELECT Id, Username, Picture FROM User WHERE (Username LIKE '%$username%' AND Id != '$uid') ORDER BY userName DESC LIMIT 20");
        $stmt-> execute();

        $result = $stmt->get_result();
        $count = $result->num_rows;

        if ($count < 1) {
            echo '<p class="noResult">Sem resultado </p>';
        } else {
            while ($user = $result->fetch_assoc()){
                ?>
                <div class="row" onclick="$('#searchContainer').hide(); chat('<?php echo $user['Id'];?>');">
                    <img src="../profilePics/<?php echo $user["Picture"];?>" />
                    <p> <?php echo $user['Username']; ?></p>
                </div>
                <?php
            }
        }
    }


?>