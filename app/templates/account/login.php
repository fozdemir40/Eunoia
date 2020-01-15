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

<fieldset>
    <legend>Login</legend>
    <?php if (isset($_GET['newpwd'])) {
        if ($_GET['newpwd'] == 'passwordupdated') {
            echo '<div class="alert alert-success">Uw wachtwoord is succevol gewijzigd!</div>';
        }
    } ?>
    <?php echo isset($msg) ? $msg : ''; ?>
    <form id="login" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
        <p>
            <label for="email">E-mail: </label>
            <input type="text" name="email" id="email" value="<?= ($email !== false ? $email : '') ?>"/>

        </p>
        <p>
            <label for="password">Wachtwoord: </label>
            <input type="password" name="password" id="password"/>

        </p>
        <p>
            <a href="<?= BASE_PATH ?>reset_password">Forgot password? Click here.</a>
        </p>
        <p>
            <input type="submit" name="submit" value="Login"/>
        </p>
    </form>
</fieldset>
