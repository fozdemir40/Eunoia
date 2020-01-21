<?php
/**
 * @var $errors array
 * @var $userFirstName
 */

?>

<?php if (isset($_SESSION['user'])): ?>
    <div class="container">
        <div class="row">
            <h1>Hallo! <?= $userFirstName ?></h1>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <a href="<?= BASE_PATH; ?>add_child" class="btn btn-success">Voeg kind toe</a>
            </div>
            <div class="col-sm-4">
                <a href="<?= BASE_PATH; ?>calendar" class="btn btn-success">Bekijk Agenda</a>
            </div>
            <div class="col-sm-4">
                <a href="<?= BASE_PATH; ?>logout" class="btn btn-primary">logout here</a>
            </div>

        </div>




    </div>
<?php endif; ?>
