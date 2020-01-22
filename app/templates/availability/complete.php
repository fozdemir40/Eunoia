<?php
/**
 * @var $errors array
 * @var $success string|boolean
 * @var $allReserveTypes
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


            <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="message">Bericht over gesprek</label>
                    <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="reserv_type">Afspraak soort</label>
                    <select class="form-control" name="reserv_type" id="reserv_type">
                        <?php foreach ($allReserveTypes as $reserveType):?>
                            <option value="<?= $reserveType['reserv_type_id'] ?>"><?= $reserveType['type'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" name="complete-booking" value="Afronden">
            </form>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-md-3">
            <a href="<?= BASE_PATH?>admin/dashboard" class="btn btn-secondary">Terug naar dashboard</a>
        </div>
    </div>
</div>