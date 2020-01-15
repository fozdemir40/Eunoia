<?php if (isset($errors) && !empty($errors)) { ?>
    <ul class="errors">
        <?php for ($i = 0; $i < count($errors); $i++) { ?>
            <li><?= $errors[$i]; ?></li>
        <?php } ?>
    </ul>
<?php }
    $s = $_GET['s'];
    $v = $_GET['v'];

    $display_form = FALSE;

    if (empty($s) || empty($v)) {
        header('Location:' . BASE_PATH . 'notfound');
        exit();
    } else {
        if (ctype_xdigit($s) !== false && ctype_xdigit($v) !== false) {
            $display_form = TRUE;
        }
    }

?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <?php if (isset($display_form)): ?>
                <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
                    <input type="hidden" name="s" value="<?php echo $s ?>">
                    <input type="hidden" name="v" value="<?php echo $v ?>">
                    <input type="password" name="password" placeholder="Nieuwe wachtwoord.">
                    <input type="password" name="cpassword" placeholder="Bevestig je nieuwe wachtwoord.">
                    <input type="submit" name="reset-password-submit" value="Reset wachtwoord">
                </form>
            <?php else: ?>
                <div class="alert alert-danger">Wrong Validation!</div>
            <?php endif; ?>
        </section>
    </div>
</main>


