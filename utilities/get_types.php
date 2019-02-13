<?php 
    require_once "config.php";

    $query = "SELECT type_id, type_name FROM game_types";

    $stmt = $mysqli->prepare($query);

    if(!$stmt->execute()){
        $err = "er is iets mis gegaan";
        $stmt->close();
        goto page;
    }

    $stmt->store_result();

    $stmt->bind_result($type_id, $type_name);

    while ($stmt->fetch()){
        ?>
        <input type="radio" name="type_id" value="<?= $type_id ?>" <?php echo ($type_id == 1) ? 'checked' : ''; ?>> <?= $type_name ?><br/>
        <?php
    }

    $stmt->close();
    page:
?>

