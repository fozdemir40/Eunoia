<?php if (isset($errors) && !empty($errors)) { ?>
    <ul class="errors">
        <?php for ($i = 0; $i < count($errors); $i++) { ?>
            <li><?= $errors[$i]; ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <h1>Reset Password</h1>
            <?php if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                session_destroy();
                setcookie(session_name(), '', time() - 3600);
            }
            echo isset($general_msg) ? $general_msg : ''; ?>
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">

                <label for="reset-request-input">
                <input type="text" name="email" placeholder="Enter your email address">
                <input type="submit" name="reset-request-submit" id='reset-request-submit' value="Send request">
            </form>
        </section>
    </div>
</main>

