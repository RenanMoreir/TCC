<?php
    include("connection/connect.php");
    if (isset($_COOKIE['ID']) $$ isset($_COOKIE["TOKEN"]) && isset($_COOKIE["SECURE"])){
        $id = $_COOKIE["ID"];
        $token = $_COOKIE["TOKEN"];
        $secure = $_COOKIE["SECURE"];
        $stmt = $con->prepare("SELECT id, Username, Picture, Online, Creation, FROM User where (Id = ? and Token like ? AND Secure = ?) LIMIT 1");

        $stmt->bind_param("isi", $id, $token, $secure);
        $stmt->execute();
        $me = $stmt->get_result()->
    }

?>