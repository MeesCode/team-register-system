
<div class="card">
    <div class="card-header"><?= $name ?></div>
    <div class="card-body">
        <?php if($_SESSION["admin"]) echo "email: ".$email ?><br/>
        wedstrijd: <?= $type_name ?><br/>
        aantal teamleden: <?= $members ?><br/>
        opmerking: <?= $comment ?><br/>
        <form action="/utilities/delete_team.php" method="post">
            <div class="form-group">
                <input type="hidden" name="team_id" value="<?= $team_id ?>">
                <?php if($_SESSION["admin"]) { ?>
                    <input type="hidden" name="email" value="<?= $email ?>">
                <?php } ?>
                <input type="submit" class="btn btn-sm btn-danger mt-1" value="Verwijder team">
            </div>
        </form>
    </div>
</div>
