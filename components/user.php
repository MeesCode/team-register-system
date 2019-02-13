
<div class="card">
    <div class="card-header"><?= $name ?></div>
    <div class="card-body">
        name: <?= $name ?><br/>
        email: <?= $email ?><br/>
        school: <?= $school ?><br/>
        adres: <?= $address ?><br/>
        telefoon: <?= $phone ?><br/>
        <?php
            if($admin){
            ?>
                <form action="/utilities/remove_admin.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="email" value="<?= $email ?>">
                        <input type="submit" class="btn btn-sm btn-danger mt-1" value="verwijder als admin">
                    </div>
                </form>
            <?php
            } else {
            ?>
                <form action="/utilities/add_admin.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="email" value="<?= $email ?>">
                        <input type="submit" class="btn btn-sm btn-success mt-1" value="Maak admin">
                    </div>
                </form>
            <?php
            }
        ?>
    </div>
</div>
