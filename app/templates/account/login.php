<?php
/**
 * @var $errors array
 * @var $email string|boolean
 */
?>
<?php if (isset($errors) && !empty($errors)) { ?>
    <ul class="errors">
        <?php for ($i = 0; $i < count($errors); $i++) { ?>
            <li><?= $errors[$i]; ?></li>
        <?php } ?>
    </ul>
<?php } ?>
<div class="container h-100">
    <div class="row">
        <div class="col-lg-12">
            <?php if (isset($_GET['newpwd'])) {
                if ($_GET['newpwd'] == 'passwordupdated') {
                    echo '<div class="alert alert-success">Uw wachtwoord is succevol gewijzigd!</div>';
                }
            } elseif (isset($_GET['newuser'])){
                if($_GET['newuser'] == 'success'){
                    echo '<div class="alert alert-success">Een acteverings email is verstuurd! Om in te loggen moet u eerst uw account activeren.</div>';
                }
            }?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mx-auto min-vh-100 d-flex flex-column justify-content-center">
            <h1 class="login-text">Inloggen</h1>
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                <div class="form-group">
                    <label for="email">E-mail: </label>
                    <input class="form-control" type="text" name="email" id="email" value="<?= ($email !== false ? $email : '') ?>"/>
                </div>
                <div class="form-group">
                    <label for="password">Wachtwoord: </label>
                    <input class="form-control" type="password" name="password" id="password"/>
                </div>
                <div class="util-login mb-3">
                    <div class="forgot-pass">
                        <a href="<?= BASE_PATH ?>reset_password">Wachtwoord vergeten? Klik hier</a>
                    </div>
                    <div class="register">
                        <a href="<?= BASE_PATH ?>register">Nieuw hier? Klik hier</a>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary" name="submit">Log in</button>
            </form>
        </div>

    </div>
</div>










