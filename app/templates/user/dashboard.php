<?php
/**
 * @var $errors array
 * @var $userFirstName
 * @var $children
 */


?>

<?php if (isset($_SESSION['user'])): ?>
    <div class="container">
        <div class="row">
            <h1>Hallo! <?= $userFirstName ?></h1>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <a href="<?= BASE_PATH; ?>calendar" class="btn btn-success">Bekijk Agenda</a>
            </div>
            <div class="col-sm-3">
                <a href="<?= BASE_PATH; ?>history" class="btn btn-success">Afspraak geschiedenis</a>
            </div>
            <div class="col-sm-3">
                <a href="<?= BASE_PATH; ?>logout" class="btn btn-primary">Logout here</a>
            </div>
        </div>
        <div class="row">
            <h3>Mijn kinderen</h3>
        </div>
        <?php if (!empty($children)): ?>
            <div class="row">
                <?php foreach ($children as $child): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $child->name ?></h5>
                        </div>
                        <div class="btn-group" role="group">
                            <a class="btn btn-warning"
                               href="<?= BASE_PATH; ?>edit_child?id=<?= $child->id ?>">Edit</a>
                            <a class="btn btn-danger"
                               href="<?= BASE_PATH; ?>delete_child?id=<?= $child->id ?>">Delete</a>
                        </div>
                    </div>


                <?php endforeach; ?>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-3">
                    <a href="<?= BASE_PATH; ?>add_child" class="btn btn-success">+ Kind Toevoegen</a>
                </div>
            </div>
        <?php else: ?>
            <div class="row justify-content-end">
                <div class="col-md-3">
                    <a href="<?= BASE_PATH; ?>add_child" class="btn btn-success">+ Kind Toevoegen</a>
                </div>
            </div>
        <?php endif; ?>


    </div>
<?php endif; ?>
