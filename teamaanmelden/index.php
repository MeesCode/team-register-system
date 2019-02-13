<?php

// Initialize the session
session_start();

// Check if the user is already logged in, if no then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login");
    exit;
}

// Include config file
require_once "../utilities/config.php";

$err = '';

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    foreach ($_POST as $key => $value) {
        if($value == '' && $key != "comment"){
            $err = 'gelieve alle velden in te vullen';
            goto page;
        }
    }

    $query = "INSERT INTO teams (email, name, type_id, members, comment) VALUES (?, ?, ?, ?, ?);";
    $stmt = $mysqli->prepare($query);    
    $stmt->bind_param("ssiis", $param_email, $param_name, $param_type_id, $param_members, $param_comment);
 
    // Set parameters
    if($_SESSION["admin"] && isset($_POST["email"])){
        $param_email = trim($_POST["email"]);
    } else {
        $param_email = $_SESSION["email"];
    }
    $param_name = trim($_POST["name"]);
    $param_type_id = trim($_POST["type_id"]);
    $param_members = trim($_POST["members"]);
    $param_comment = trim($_POST["comment"]);
    
    // Attempt to execute the prepared statement
    if($stmt->execute()){
        // Redirect to login page
        $stmt->close();
        header("location: /");
    } else{
        $stmt->close();
        $err = "Er ging iets mis, probeer het later opnieuw";
        if($_SESSION["admin"] && isset($_POST["email"])){
            $err = $err."<br/>bestaat het email adres al?";
        }
        goto page;
    }
}

page:
?>
 
<?php require_once("../components/head.php"); ?>

<h2>Team aanmelden</h2>
<p>Om een team achteraf aan te passen moet u hem verwijderen en opniew toevoegen</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <?php if($_SESSION["admin"]) { ?>
    <div class="form-group">
        <label>Email (leeg laten om huidig administratie email te gebruiken)</label>
        <input type="email" name="email" class="form-control">
    </div>  
    <?php } ?>
    <div class="form-group">
        <label>Teamnaam</label>
        <input type="text" name="name" class="form-control">
    </div>  
    <div class="form-group">
        <label>Wedstrijd</label><br/>
        <?php require("../utilities/get_types.php"); ?>
    </div>   
    <div class="form-group">
        <label>Hoeveelheid teamleden</label>
        <input type="number" name="members" class="form-control" min="1">
    </div>   
    <div class="form-group">
        <label>Opmerking</label>
        <textarea type="text" name="comment" class="form-control"></textarea>
    </div>  
    <div class="alert alert-danger" role="alert" <?php echo (empty($err)) ? 'hidden' : ''; ?>>
        <?= $err ?>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Submit">
        <input type="reset" class="btn btn-default" value="Reset">
    </div>
</form>

   
<?php require_once("../components/footer.php"); ?>