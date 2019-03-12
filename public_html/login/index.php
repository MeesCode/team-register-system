<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: /");
    exit;
}
 
// Include config file
require_once "../utilities/config.php";
 
// Define variables and initialize with empty values
$err = '';
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // check if parameters are empty
    foreach ($_POST as $key => $value) {
        if($value == ''){
            $err = 'niet alle waardes lijkt ingevuld te zijn';
        }
    }
    
    // Prepare a select statement
    $query = "SELECT name, email, school, password, admin FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("s", $param_email);
    
    // Set parameters
    $param_email = trim($_POST["email"]);
    
    // Attempt to execute the prepared statement
    if($stmt->execute()){
        // Store result
        $stmt->store_result();
        
        // Check if email exists, if yes then verify password
        if($stmt->num_rows() == 1){                    
            // Bind result variables
            $stmt->bind_result($name, $email, $school, $hashed_password, $admin);
            if($stmt->fetch()){
                if(password_verify(trim($_POST["password"]), $hashed_password)){
                    // Password is correct, so start a new session
                    session_start();
                    
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["email"] = $email;   
                    $_SESSION["school"] = $school;
                    $_SESSION["admin"] = $admin;    
                    $_SESSION["name"] = $name;                             
                    
                    // Redirect user to welcome page
                    header("location: /");
                } else{
                    // Display an error message if password is not valid
                    $err = "Het wachtwoord is ongeldig";
                    $stmt->close();
                    goto page;
                }
            }
        } else{
            // Display an error message if email doesn't exist
            $err = "Geen account gevond met dit email adres";
        }
    } else{
        $err = "Oops! Something went wrong. Please try again later.";
    }
    
    // Close statement
    $stmt->close();
}

page:
?>
 
<?php require_once("../components/head.php"); ?>

<h2>Inloggen</h2>
<p>Vul uw gegevens in om in te loggen</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group">
        <label>email</label>
        <input type="email" name="email" class="form-control">
    </div>    
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="error <?php echo (empty($_err)) ? 'is-hidden' : ''; ?>">
        <?= $err ?>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Login">
    </div>
    <p>Heeft u nog geen account? <a href="/registreren">Registreer hier</a>.</p>
</form>  

<?php require("../components/footer.php"); ?>