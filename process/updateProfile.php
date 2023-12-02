<?php
    include("check.php");
if ($_COOKIE['ESCOLHA'] == 1){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $imagename = $username."_".rand(999, 999999).$_FILES['imgInp']['name'];
        $imagetemp = $_FILES['imgInp']['tmp_name'];
        $imagePath = "../profilePics/";

        if (is_uploaded_file($imagetemp)) {
            if (move_uploaded_file($imagetemp, $imagePath . $imagename)) {
                $stmt = $con->prepare("UPDATE User SET `Picture` = ? WHERE Id = ?");
                $stmt->bind_param("si", $imagename, $uid);
                $stmt->execute();
                if ($stmt) {
                    return true;
                } else {
                    die(header("HTTP/1.0 401 Erro ao guardar imagem na base de dados"));
                }
            } else {
                die(header("HTTP/1.0 401 Erro ao guardar imagem"));
            }
        } else {
            die(header("HTTP/1.0 401 Erro ao carregar imagem"));
        }
    } else {
        die(header("HTTP/1.0 401 Faltam parametros"));
    }
} else if ($_COOKIE['ESCOLHA'] == 0){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $imagename = $username."_".rand(999, 999999).$_FILES['imgInp']['name'];
        $imagetemp = $_FILES['imgInp']['tmp_name'];
        $imagePath = "../profilePics/";

        if (is_uploaded_file($imagetemp)) {
            if (move_uploaded_file($imagetemp, $imagePath . $imagename)) {
                $stmt = $con->prepare("UPDATE usuario_abrigo SET `Picture` = ? WHERE Id_abrigo = ?");
                $stmt->bind_param("si", $imagename, $uid);
                $stmt->execute();
                if ($stmt) {
                    return true;
                } else {
                    die(header("HTTP/1.0 401 Erro ao guardar imagem na base de dados"));
                }
            } else {
                die(header("HTTP/1.0 401 Erro ao guardar imagem"));
            }
        } else {
            die(header("HTTP/1.0 401 Erro ao carregar imagem"));
        }
    } else {
        die(header("HTTP/1.0 401 Faltam parametros"));
    }
}
?>