<?php
/**
 * @var $availabilities array
 * @var $errors array
 * @var $monthName
 * @var $month
 * @var $year
 * @var $adminTools
 * @var $currentMonth
 * @var $currentYear
 */
$displayMon = false;
$displayTue = false;
$displayWed = false;
$displayThu = false;
$displayFri = false;
$displaySat = false;
$displaySun = false;

if (array_key_exists('Mon', $availabilities)) {
    $displayMon = true;
}

if (array_key_exists('Tue', $availabilities)) {
    $displayTue = true;
}

if (array_key_exists('Wed', $availabilities)) {
    $displayWed = true;
}

if (array_key_exists('Thu', $availabilities)) {
    $displayThu = true;
}

if (array_key_exists('Fri', $availabilities)) {
    $displayFri = true;
}

if (array_key_exists('Sat', $availabilities)) {
    $displaySat = true;
}

if (array_key_exists('Sun', $availabilities)) {
    $displaySun = true;
}


?>
<?php if (isset($errors) && !empty($errors)) { ?>
    <ul class="errors">
        <?php for ($i = 0; $i < count($errors); $i++) { ?>
            <li><?= $errors[$i]; ?></li>
        <?php } ?>
    </ul>
<?php } ?>
<div class="container-fluid">
    <div class="row">
        <?php if (isset($_GET['booking'])) {
            if ($_GET['booking'] == 'success') {
                echo '<div class="col-md-12"><div class="alert alert-success">Uw afspraak is gereserveerd!</div></div>';
            }
        } ?>
    </div>
    <div class="row align-items-start" style="margin: 0 75px;">
        <div class="col-md-2">
            <h4><?= $monthName ?> <?php if ($currentMonth == $month && $currentYear == $year): ?>

                <?php else: ?>
                    <a href="<?= BASE_PATH; ?>calendar?m=<?= date('m', mktime(0, 0, 0, $month - 1, 1, $year)) ?>&y=<?= date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) ?>"><</a>
                <?php endif; ?>

                <a href="<?= BASE_PATH; ?>calendar?m=<?= date('m', mktime(0, 0, 0, $month + 1, 1, $year)) ?>&y=<?= date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) ?>">></a>
            </h4>


        </div>
        <div class="col-md-2">
            <h5><?= $year ?></h5>
        </div>


    </div>
    <div class="calendar-wrap"
    ">
    <div class="row ">
        <div class="col-md-7 d-flex" style="padding: 0 75px;">
            <div class="col-md-3 no-padding">
                <h4 class="text-center">Ma</h4>
                <?php if ($displayMon): ?>
                    <?php foreach ($availabilities['Mon'] as $availability): ?>
                        <?php if ($availability['taken'] == 0): ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $availability['date'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                        - <?= $availability['end_at'] ?> </h6>
                                </div>

                                <?php if ($adminTools): ?>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-warning"
                                           href="<?= BASE_PATH; ?>admin/edit_availability?id=<?= $availability['id'] ?>">Edit</a>
                                        <a class="btn btn-danger"
                                           href="<?= BASE_PATH; ?>admin/delete_availability?id=<?= $availability['id'] ?>">Delete</a>
                                    </div>

                                <?php else: ?>
                                    <a class="btn btn-primary"
                                       href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>


            <div class="col-md-3 no-padding">
                <h4 class="text-center">Di</h4>
                <?php if ($displayTue): ?>
                    <?php foreach ($availabilities['Tue'] as $availability): ?>
                        <?php if ($availability['taken'] == 0): ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $availability['date'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                        - <?= $availability['end_at'] ?> </h6>
                                </div>

                                <?php if ($adminTools): ?>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-warning"
                                           href="<?= BASE_PATH; ?>admin/edit_availability?id=<?= $availability['id'] ?>">Edit</a>
                                        <a class="btn btn-danger"
                                           href="<?= BASE_PATH; ?>admin/delete_availability?id=<?= $availability['id'] ?>">Delete</a>
                                    </div>

                                <?php else: ?>
                                    <a class="btn btn-primary"
                                       href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>


            <div class="col-md-3 no-padding">
                <h4 class="text-center">Wo</h4>
                <?php if ($displayWed): ?>
                    <?php foreach ($availabilities['Wed'] as $availability): ?>
                        <?php if ($availability['taken'] == 0): ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $availability['date'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                        - <?= $availability['end_at'] ?> </h6>
                                </div>

                                <?php if ($adminTools): ?>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-warning"
                                           href="<?= BASE_PATH; ?>admin/edit_availability?id=<?= $availability['id'] ?>">Edit</a>
                                        <a class="btn btn-danger"
                                           href="<?= BASE_PATH; ?>admin/delete_availability?id=<?= $availability['id'] ?>">Delete</a>
                                    </div>

                                <?php else: ?>
                                    <a class="btn btn-primary"
                                       href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>


            <div class="col-md-3 no-padding">
                <h4 class="text-center">Do</h4>
                <?php if ($displayThu): ?>
                    <?php foreach ($availabilities['Thu'] as $availability): ?>
                        <?php if ($availability['taken'] == 0): ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $availability['date'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                        - <?= $availability['end_at'] ?> </h6>
                                </div>

                                <?php if ($adminTools): ?>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-warning"
                                           href="<?= BASE_PATH; ?>admin/edit_availability?id=<?= $availability['id'] ?>">Edit</a>
                                        <a class="btn btn-danger"
                                           href="<?= BASE_PATH; ?>admin/delete_availability?id=<?= $availability['id'] ?>">Delete</a>
                                    </div>

                                <?php else: ?>
                                    <a class="btn btn-primary"
                                       href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>


            <div class="col-md-3 no-padding">
                <h4 class="text-center">Vr</h4>
                <?php if ($displayFri): ?>
                    <?php foreach ($availabilities['Fri'] as $availability): ?>
                        <?php if ($availability['taken'] == 0): ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $availability['date'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                        - <?= $availability['end_at'] ?> </h6>
                                </div>

                                <?php if ($adminTools): ?>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-warning"
                                           href="<?= BASE_PATH; ?>admin/edit_availability?id=<?= $availability['id'] ?>">Edit</a>
                                        <a class="btn btn-danger"
                                           href="<?= BASE_PATH; ?>admin/delete_availability?id=<?= $availability['id'] ?>">Delete</a>
                                    </div>

                                <?php else: ?>
                                    <a class="btn btn-primary"
                                       href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="col-md-3 no-padding">
                <h4 class="text-center">Za</h4>
                <?php if ($displaySat): ?>
                    <?php foreach ($availabilities['Sat'] as $availability): ?>
                        <?php if ($availability['taken'] == 0): ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $availability['date'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                        - <?= $availability['end_at'] ?> </h6>
                                </div>

                                <?php if ($adminTools): ?>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-warning"
                                           href="<?= BASE_PATH; ?>admin/edit_availability?id=<?= $availability['id'] ?>">Edit</a>
                                        <a class="btn btn-danger"
                                           href="<?= BASE_PATH; ?>admin/delete_availability?id=<?= $availability['id'] ?>">Delete</a>
                                    </div>

                                <?php else: ?>
                                    <a class="btn btn-primary"
                                       href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>


            <div class="col-md-3 no-padding">
                <h4 class="text-center">Zo</h4>
                <?php if ($displaySun): ?>
                    <?php foreach ($availabilities['Sun'] as $availability): ?>
                        <?php if ($availability['taken'] == 0): ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $availability['date'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                        - <?= $availability['end_at'] ?> </h6>
                                </div>

                                <?php if ($adminTools): ?>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-warning"
                                           href="<?= BASE_PATH; ?>admin/edit_availability?id=<?= $availability['id'] ?>">Edit</a>
                                        <a class="btn btn-danger"
                                           href="<?= BASE_PATH; ?>admin/delete_availability?id=<?= $availability['id'] ?>">Delete</a>
                                    </div>

                                <?php else: ?>
                                    <a class="btn btn-primary"
                                       href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <?php if ($adminTools): ?>
        <div class="row justify-content-end">
            <div class="col-md-3 float-right">
                <a class="btn btn-success" href="<?= BASE_PATH; ?>admin/add_availability">+ Beschikbaarheid
                    Toevoegen</a>
                <a href="<?= BASE_PATH ?>admin/dashboard" class="btn btn-secondary">Terug naar dashboard</a>
            </div>
        </div>
    <?php else: ?>
        <div class="row justify-content-end">
            <div class="col-md-3">
                <a href="<?= BASE_PATH ?>dashboard" class="btn btn-secondary">Terug naar dashboard</a>
            </div>
        </div>
    <?php endif ?>
</div>
</div>
