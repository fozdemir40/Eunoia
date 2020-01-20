
<?php if (isset($_SESSION['admin'])): ?>
    <div class="container">
        <h1>Admin</h1>
        <a href="<?= BASE_PATH; ?>admin/add_availability" class="badge badge-success">Voeg beschikbaarheid toe</a>
        <a href="<?= BASE_PATH; ?>logout" class="badge badge-primary">logout here</a>
    </div>


<?php endif; ?>
