<?php
/**
 * @var $availabilities array
 * @var $errors array
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
    <div class="row ">

            <div class="col-lg-2">
                <h2>Ma</h2>
                <?php if ($displayMon): ?>
                <?php foreach ($availabilities['Mon'] as $availability): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $availability['date'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                - <?= $availability['end_at'] ?> </h6>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>


            <div class="col-md-2">
                <h2>Di</h2>
                <?php if ($displayTue): ?>
                <?php foreach ($availabilities['Tue'] as $availability): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $availability['date'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                - <?= $availability['end_at'] ?> </h6>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>


            <div class="col-md-2">
                <h2>Wo</h2>
                <?php if ($displayWed): ?>
                <?php foreach ($availabilities['Wed'] as $availability): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $availability['date'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                - <?= $availability['end_at'] ?> </h6>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>


            <div class="col-md-2">
                <h2>Do</h2>
                <?php if ($displayThu): ?>
                <?php foreach ($availabilities['Thu'] as $availability): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $availability['date'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                - <?= $availability['end_at'] ?> </h6>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>


            <div class="col-md-2">
                <h2>Vr</h2>
                <?php if ($displayFri): ?>
                <?php foreach ($availabilities['Fri'] as $availability): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $availability['date'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                - <?= $availability['end_at'] ?> </h6>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="col-md-2">
                <h2>Za</h2>
                <?php if ($displaySat): ?>
                <?php foreach ($availabilities['Sat'] as $availability): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $availability['date'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                - <?= $availability['end_at'] ?> </h6>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>


            <div class="col-md-2">
                <h2>Zo</h2>
                <?php if ($displaySun): ?>
                <?php foreach ($availabilities['Sun'] as $availability): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $availability['date'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $availability['start_at'] ?>
                                - <?= $availability['end_at'] ?> </h6>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

    </div>
</div>
