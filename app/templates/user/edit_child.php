<?php
/**
 * @var $errors array
 * @var $success string|boolean
 * @var $pageTitle
 * @var $child \System\Children\Child
 */

?>


<div class="container">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <h1>Kind toevoegen</h1>
            <?php if (!empty($errors)): ?>
                <ul class="errors">
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if ($child !== false): ?>
            <h3><?= $pageTitle ?></h3>
            <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="child-name">Naam</label>
                    <input type="text" class="form-control" id="child-name" name="child-name" value="<?= $child->name ?>">
                </div>
                <div class="form-group">
                    <label for="date">Geboortedatum</label>
                    <input type="date" class="form-control" id="date" name="birthdate" value="<?= $child->birthdate ?>">
                </div>
                <div class="form-group">
                    <label for="development">Ontwikkeling</label>
                    <textarea class="form-control" name="development" id="development" rows="10"><?= $child->development ?></textarea>
                </div>

                <input type="submit" class="btn btn-primary" name="add-child" value="Aanpassen">
                <a href="<?= BASE_PATH ?>dashboard" class="btn btn-secondary">Terug naar dashboard</a>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>
