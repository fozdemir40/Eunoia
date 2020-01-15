<?php if (isset($errors)): ?>
    <ul class="errors">
        <?php foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>


<?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])): ?>
    <a href="<?= BASE_PATH; ?>logout">logout here</a>
<?php else: ?>
    <a href="<?= BASE_PATH; ?>login">Inloggen</a>
<?php endif; ?>



