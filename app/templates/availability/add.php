<?php
/**
 * @var $errors array
 * @var $success string|boolean
 * @var $availability \System\Availabilities\Availability
 */

?>


<div class="container">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <h1>Beschikbaarheid toevoegen</h1>
            <?php if (!empty($errors)): ?>
                <ul class="errors">
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if ($success !== false) { ?>
                <div class="alert alert-success"><?= $success; ?></div>
            <?php } ?>
            <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="date">Datum</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="form-group">
                    <label for="time">Start tijd</label>
                    <input type="time" class="form-control" id="time" name="start-time">
                </div>
                <div class="form-group">
                    <label for="time">Eind Tijd</label>
                    <input type="time" class="form-control" id="time" name="end-time">
                </div>

                <input type="submit" class="btn btn-primary" name="add-availability" value="Toevoegen">
            </form>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-md-3">
            <a href="<?= BASE_PATH?>admin/dashboard" class="btn btn-secondary">Terug naar dashboard</a>
        </div>
    </div>
</div>

