<?php
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
        $err = "passwords did not match, please try again";
        goto page;
    }
 
    // Validate email
    $query = "SELECT email FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($query);

    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("s", $param_email);
    $param_email = trim($_POST["email"]);
    
    // Attempt to execute the prepared statement
    if($stmt->execute()){
        $stmt->store_result();
        if($stmt->num_rows() == 1){
            $err = "Dit email adres is al in gebuik";
            $stmt->close();
            goto page;
        }
    } else{
        $err = "Er ging iets mis bij het controleren op email, probeer het later opnieuw";
        $stmt->close();
        goto page;
    }
        
    // Close statement
    $stmt->close();
    
    // Prepare an insert statement
    $query = "INSERT INTO users (email, school, password, address, name, phone) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($mysqli, $query);
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("ssssss", $param_email, $param_school, $param_password, $param_address, $param_name, $param_phone);
    
    // Set parameters
    $param_school = trim($_POST["school"]);
    $param_address = trim($_POST["address"]);
    $param_name = trim($_POST["name"]);
    $param_phone = trim($_POST["phone"]);
    $param_password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT); // Creates a password hash
    
    // Attempt to execute the prepared statement
    if($stmt->execute()){
        // Redirect to login page
        header("location: ../login");
    } else{
        $err = "Er ging iets mis, probeer het later opnieuw";
        $stmt->close();
        goto page;
    }
        
    // Close statement
    $stmt->close();
}

page:
?>
 
<?php require_once("../components/head.php"); ?>

<h2>Registreren</h2>
<p>Heeft u al een account? <a href="../login">Hier kunt u inloggen</a>.</p>
<p>De contactpersoon van de school moet een account aanmaken waarna er teams aangemeld kunnen worden.</p>
<p>Door te registreren gaat u akkoord met ons <a href="https://www.robocupjunior.nl/gdpr-avg/">privacystatement</a>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group">
        <label>Naam contactpersoon</label>
        <input type="text" name="name" class="form-control">
    </div>  
    <div class="form-group">
        <label>Email contactpersoon</label>
        <input type="email" name="email" class="form-control">
    </div>   
    <div class="form-group">
        <label>Telefoonnummer contactpersoon</label>
        <input type="text" name="school" class="form-control">
    </div>   
    <div class="form-group">
        <label>Naam school</label>
        <input type="text" name="school" class="form-control">
    </div>  
    <div class="form-group">
        <label>Plaats school</label>
        <input type="text" name="address" class="form-control">
    </div>  
    <div class="form-group">
        <label>Wachtwoord</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label>Herhaal wachtwoord</label>
        <input type="password" name="confirm_password" class="form-control">
    </div>
    <div class="error <?php echo (empty($err)) ? 'is-hidden' : ''; ?>">
        <?= $err ?>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Submit">
        <input type="reset" class="btn btn-default" value="Reset">
    </div>
</form>

   
<?php require_once("../components/footer.php"); ?>