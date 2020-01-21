<?php
/**
 * @var $availabilities array
 * @var $errors array
 * @var $monthName
 * @var $month
 * @var $year
 * @var $adminTools
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
<div class="container">
    <div class="row">
        <?php if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            setcookie(session_name(), '', time() - 3600);
        } ?>
        <?php if (isset($_GET['booking'])) {
            if ($_GET['booking'] == 'success') {
                echo '<div class="col-md-12"><div class="alert alert-success">Uw afspraak is gereserveerd!</div></div>';
            }
        } ?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3><?= $monthName ?>
                <a href="<?= BASE_PATH; ?>calendar?m=<?= date('m', mktime(0, 0, 0, $month - 1, 1, $year)) ?>&y=<?= date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) ?>"><</a>
                <a href="<?= BASE_PATH; ?>calendar?m=<?= date('m', mktime(0, 0, 0, $month + 1, 1, $year)) ?>&y=<?= date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) ?>">></a>
            </h3>
            <h5><?= $year ?></h5>
        </div>
    </div>
    <div class="row ">
        <div class="col-lg-2">
            <h2>Ma</h2>
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
                                <a class="btn btn-primary" href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>


        <div class="col-md-2">
            <h2>Di</h2>
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
                                <a class="btn btn-primary" href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>


        <div class="col-md-2">
            <h2>Wo</h2>
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
                                <a class="btn btn-primary" href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>


        <div class="col-md-2">
            <h2>Do</h2>
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
                                <a class="btn btn-primary" href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>


        <div class="col-md-2">
            <h2>Vr</h2>
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
                                <a class="btn btn-primary" href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="col-md-2">
            <h2>Za</h2>
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
                                <a class="btn btn-primary" href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>


        <div class="col-md-2">
            <h2>Zo</h2>
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
                                <a class="btn btn-primary" href="<?= BASE_PATH; ?>calendar/book?id=<?= $availability['id'] ?>">Reserveren</a>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
    <?php if ($adminTools): ?>
        <div class="row justify-content-end">
            <div class="col-md-3 float-right">
                <a class="btn btn-success" href="<?= BASE_PATH; ?>admin/add_availability">+ Beschikbaarheid
                    Toevoegen</a>
                <a href="<?= BASE_PATH ?>dashboard" class="btn btn-secondary">Terug naar dashboard</a>
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
