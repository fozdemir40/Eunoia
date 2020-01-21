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
            <?php if (!empty($errors)): ?>
                <ul class="errors">
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if ($availability !== false): ?>
            <h3>Bewerken - <?= $availability->date ?></h3>
            <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="date">Datum</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?= $availability->date ?>">
                </div>
                <div class="form-group">
                    <label for="time">Start tijd</label>
                    <input type="time" class="form-control" id="time" name="start-time" value="<?= $availability->start_at ?>">
                </div>
                <div class="form-group">
                    <label for="time">Eind Tijd</label>
                    <input type="time" class="form-control" id="time" name="end-time" value="<?= $availability->end_at ?>">
                </div>

                <input type="submit" class="btn btn-primary" name="add-availability" value="Aanpassen">
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>
