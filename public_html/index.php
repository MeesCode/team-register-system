<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /registreren");
    exit;
}
?>
 
<?php require_once("components/head.php"); ?>

<div class="page-header">
    <h1>Hi, <b><?= htmlspecialchars($_SESSION["name"]); ?></b>. Welkom op uw persoonlijke overzichtspagina.</h1>
</div>
<p>Vanaf een week voor aanvang van de wedstrijd kunt u uw gegevens niet meer aanpassen. Vragen en/of opmerkingen over dit registratiesysteem kunt u mailen naar : <a href="mailto:mees@robocupjunior.nl">mees@robocupjunior.nl</a></p>
<?php require_once "utilities/get_teams.php"; ?>
<div class="alert alert-danger" role="alert" <?php echo (empty($err)) ? 'hidden' : ''; ?>>
    <?= $err ?>
</div>
<p>
    <a href="teamaanmelden" class="btn btn-primary mt-3">Een team toevoegen</a>
</p>

<?php require_once "utilities/get_users.php"; ?>

<b>uw gegevens:</b><br/>
naam: <?= $_SESSION["name"] ?><br/>
email: <?= $_SESSION["email"] ?><br/>
school: <?= $_SESSION["school"] ?><br/>

<p>
    <a href="/wachtwoord_wijzigen" class="mt-3 btn btn-secondary">Wachtwoord wijzigen</a>
    <a href="utilities/logout.php" class="mt-3 btn btn-secondary">Uitloggen</a>
</p>

<?php require_once("components/footer.php"); ?>