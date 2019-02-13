
<p><b>uw teams:</b></p>

<?php 
    require_once "config.php";

    if($_SESSION["admin"]){
        $query = "SELECT email, team_id, name, type_name, members, comment FROM teams JOIN game_types ON teams.type_id = game_types.type_id";
        $stmt = $mysqli->prepare($query);
    } else {
        $query = "SELECT team_id, name, type_name, members, comment FROM teams JOIN game_types ON teams.type_id = game_types.type_id WHERE email = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $_SESSION["email"]);
    }

    if(!$stmt->execute()){
        $err = "er is iets mis gegaan";
        $stmt->close();
        goto page;
    }

    $stmt->store_result();

    if($stmt->num_rows() == 0){
        echo "u heeft nog geen teams toegevoegd";
        $stmt->close();
        goto page;
    }
    if($_SESSION["admin"]){
        $stmt->bind_result($email, $team_id, $name, $type_name, $members, $comment);
    } else {
        $stmt->bind_result($team_id, $name, $type_name, $members, $comment);
    }
    
    
?>

<div class="card-columns">

<?php
    while ($stmt->fetch()){
        require(dirname(__FILE__)."/../components/team.php");
    }

?>

</div>

<?php
    $stmt->close();
    page:
?>

