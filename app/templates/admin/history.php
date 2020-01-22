<?php
/**
 * @var $errors array
 * @var $bookings
 */

?>
<?php if (isset($_SESSION['admin'])): ?>
    <div class="container">
        <div class="row">
            <h1>Admin</h1>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <a href="<?= BASE_PATH; ?>admin/add_availability" class="btn btn-success">Voeg beschikbaarheid toe</a>
            </div>
            <div class="col-sm-3">
                <a href="<?= BASE_PATH; ?>calendar" class="btn btn-success">Bekijk Agenda</a>
            </div>
            <div class="col-sm-3">
                <a href="<?= BASE_PATH; ?>admin/dashboard" class="btn btn-secondary">Terug naar dashboard</a>
            </div>
            <div class="col-sm-3">
                <a href="<?= BASE_PATH; ?>logout" class="btn btn-primary">logout here</a>
            </div>
        </div>
        <?php if (!empty($bookings)): ?>
            <div class="row">
                <h3>Afspraak geschiedenis</h3>
                <table class="table table-sm table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Datum</th>
                        <th>Tijd</th>
                        <th>Kind</th>
                        <th>Bericht</th>
                        <th>Afspraak</th>
                    </tr>
                    </thead>
                    <tbody >
                    <?php foreach ($bookings as $booking): ?>
                        <?php if($booking->completed == 1): ?>
                            <tr>
                                <td><?= $booking->first_name . ' ' . $booking->last_name?></td>
                                <td><?= $booking->email ?></td>
                                <td><?= $booking->date ?></td>
                                <td><?= $booking->start_at . ' - ' . $booking->end_at ?></td>
                                <td><?= $booking->for_child ?></td>
                                <td><?= $booking->message ?></td>
                                <td><?= $booking->type ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        <?php endif; ?>
    </div>


<?php endif; ?>