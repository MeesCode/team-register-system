<p><b>contactpersonen: </b></p>

<?php 

    if(!$_SESSION["admin"]){
        goto page;
    }

    require_once "config.php";

    $query = "SELECT email, school, admin, address, name, phone FROM users";

    $stmt = $mysqli->prepare($query);

    if(!$stmt->execute()){
        $err = "er is iets mis gegaan";
        $stmt->close();
        goto page;
    }

    $stmt->store_result();

    $stmt->bind_result($email, $school, $admin, $address, $name, $phone);

    ?>
        <div class="card-columns">
    <?php
    while ($stmt->fetch()){
        require(dirname(__FILE__)."/../components/user.php");
    }
    ?>
        </div>
    <?php

    $stmt->close();
    page:
?>
