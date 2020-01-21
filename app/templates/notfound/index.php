<?php
/**
 * @var $pageTitle string
 */
?>

<h1><?= $pageTitle; ?></h1>
<?php if (isset($_SESSION['user'])): ?>
    <p>404 page not found<a href="<?= BASE_PATH; ?>dashboard">Ga terug naar dashboard</a></p>
<?php elseif(isset($_SESSION['admin'])): ?>
    <p>404 page not found<a href="<?= BASE_PATH; ?>admin/dashboard">Ga terug naar dashboard</a></p>
<?php else: ?>
    <p>404 page not found<a href="<?= BASE_PATH; ?>login">Ga terug</a></p>
<?php endif; ?>
