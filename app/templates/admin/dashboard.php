<?php
/**
 * @var $errors array
 * @var $bookings
 */

?>
<?php if (isset($_SESSION['admin'])): ?>
    <div class="container">
        <div class="row">
            <?php if (isset($_GET['booking'])) {
                if ($_GET['booking'] == 'success') {
                    echo '<div class="col-md-12"><div class="alert alert-success">Afspraak is succesvol afgerond!</div></div>';
                }
            } ?>
        </div>
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
                <a href="<?= BASE_PATH; ?>admin/history" class="btn btn-success">Afspraak geschiedenis</a>
            </div>
            <div class="col-sm-3">
                <a href="<?= BASE_PATH; ?>logout" class="btn btn-primary">logout here</a>
            </div>
        </div>
        <?php if (!empty($bookings)): ?>
            <div class="row">
                <h3>Reservering</h3>
                <table class="table table-sm table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Tijd</th>
                        <th>Kind</th>
                        <th>Hulpvraag</th>
                        <th>Verwachting</th>
                        <th>Belangrijke zaken</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody >
                    <?php foreach ($bookings as $booking): ?>
                        <?php if(!$booking->completed == 1): ?>
                        <tr>
                            <td><?= $booking->first_name ?></td>
                            <td><?= $booking->email ?></td>
                            <td><?= $booking->date ?></td>
                            <td><?= $booking->start_at . ' - ' . $booking->end_at ?></td>
                            <td><?= $booking->for_child ?></td>
                            <td><?= $booking->hulpvraag ?></td>
                            <td><?= $booking->verwachting ?></td>
                            <td><?= $booking->belangrijke_zaken ?></td>
                            <td>
                                <a class="btn btn-primary" href="<?= BASE_PATH ?>admin/complete?id=<?= $booking->reservation_id ?>">Afronden</a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        <?php endif; ?>
    </div>


<?php endif; ?>
