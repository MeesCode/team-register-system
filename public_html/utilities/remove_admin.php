<?php 

    if(!$_SESSION["admin"]){
        header("location: /");
    }

    require_once "config.php";

    $query = "UPDATE users SET admin='0' WHERE email=?";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", trim($_POST['email']));

    if(!$stmt->execute()){
        $err = "er is iets mis gegaan";
        $stmt->close();
        header("location: /");
    } else {
        $stmt->close();
        header("location: /");
    }

?>