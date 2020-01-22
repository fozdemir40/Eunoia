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
            <?php if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                setcookie(session_name(), '', time() - 3600);
            }
            echo isset($general_msg) ? $general_msg : ''; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mx-auto min-vh-100 d-flex flex-column justify-content-center">
            <h1>Wachtwoord resetten</h1>
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                    <div class="form-group">
                        <input class="form-control" type="text" name="email" placeholder="Enter your email address">
                    </div>
                    <input class="btn btn-primary" type="submit" name="reset-request-submit" id='reset-request-submit' value="Send request">
                    <a class="btn btn-secondary" href="<?= BASE_PATH?>login">Terug</a>
            </form>
        </div>
    </div>
</div>






