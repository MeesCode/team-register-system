<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /login");
    exit;
}

$err = '';

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $query = "DELETE FROM teams WHERE email = ? AND team_id = ?";
    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("ss", $param_email, $param_team_id);
    // Set parameters
    if($_SESSION["admin"] && isset($_POST["email"])){
        $param_email = trim($_POST["email"]);
    } else {
        $param_email = $_SESSION["email"];
    }
    $param_team_id = trim($_POST["team_id"]);
    
    // Attempt to execute the prepared statement
    if(!$stmt->execute()){
        $err = "Het team kon niet worden verwijderd";
    }
    
    // Close statement
    $stmt->close();
    
    // redirect
    header("location: /");
}
?>