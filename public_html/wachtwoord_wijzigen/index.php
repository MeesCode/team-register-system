<?php

// Initialize the session
session_start();

// Include config file
require_once "../utilities/config.php";

$err = '';

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    foreach ($_POST as $key => $value) {
        if($value == ''){
            $err = 'gelieve alle velden in te vullen';
            goto page;
        }
    }

    // validate password check
    if($_POST["password"] !== $_POST["confirm_password"]){
        $err = "Wachtwoorden komen niet overeen, probeer opnieuw";
        goto page;
    }
 
    // Validate email
    $query = "SELECT password FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($query);

    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("s", $param_email);
    $param_email = trim($_SESSION["email"]);
    
    // Attempt to execute the prepared statement
    if($stmt->execute()){
        $stmt->store_result();
        $stmt->bind_result($hashed_password);
        if($stmt->fetch()){
            if(password_verify(trim($_POST["old_password"]), $hashed_password)){

                $query2 = "UPDATE users SET password=? WHERE email = ?";
                $stmt2 = $mysqli->prepare($query2);

                $stmt2->bind_param("ss", $new_hashed_password, $param_email);
                $new_hashed_password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT); // Creates a password hash
                $param_email = trim($_SESSION["email"]);

                if(!$stmt2->execute()){
                    $err = 'het is niet gelukt het wachtwoord te veranderen';
                    $stmt2->close();
                    goto page;
                }

            } else {
                $err = "Oud wachtwoord klopt niet";
                goto page;
            }
        } else{
            // Display an error message if email doesn't exist
            $err = "Geen account gevond met dit email adres";
        }
    } else{
        $err = "Er ging iets mis bij het ophalen van het oude wachtwoord, probeer het later opnieuw";
        $stmt->close();
        goto page;
    }
        
    // Close statement
    $stmt->close();

    // when completed go back to home
    header("location: /");
}

page:
?>
 
<?php require_once("../components/head.php"); ?>

<h2>Wachtwoord wijzigen</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group">
        <label>Oud wachtwoord</label>
        <input type="password" name="old_password" class="form-control">
    </div>  
    <div class="form-group">
        <label>Nieuw wachtwoord</label>
        <input type="password" name="password" class="form-control">
    </div>   
    <div class="form-group">
        <label>Nieuw wachtwoord heralen</label>
        <input type="password" name="confirm_password" class="form-control">
    </div>   
    <div class="error <?php echo (empty($err)) ? 'is-hidden' : ''; ?>">
        <?= $err ?>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="wijzigen">
        <input type="reset" class="btn btn-default" value="Reset">
    </div>
</form>

   
<?php require_once("../components/footer.php"); ?>