<?php
/**
 * @var $errors array
 * @var $calendar \System\Calendar\Calendar
 */
?>
<?php if (isset($_SESSION['admin'])): ?>
    <div class="container">
        <div class="row">
            <h1>Admin</h1>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <a href="<?= BASE_PATH; ?>admin/add_availability" class="badge badge-success">Voeg beschikbaarheid toe</a>
            </div>
            <div class="col-sm-4">
                <a href="<?= BASE_PATH; ?>admin/calendar" class="badge badge-success">Bekijk Agenda</a>
            </div>
            <div class="col-sm-4">
                <a href="<?= BASE_PATH; ?>logout" class="badge badge-primary">logout here</a>
            </div>

        </div>




    </div>


<?php endif; ?>
