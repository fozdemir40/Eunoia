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
            <h1>Registreren</h1>
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                <div class="form-group">
                    <label for="username">Username: </label>
                    <input class="form-control" type="text" name="username" id="username"/>
                </div>
                <div class="form-group">
                    <label for="email">E-mail: </label>
                    <input class="form-control" type="text" name="email" id="email" />
                </div>
                <div class="form-group">
                    <label for="first_name">First name: </label>
                    <input class="form-control" type="text" name="first_name" id="first_name" />
                </div>
                <div class="form-group">
                    <label for="last_name">Last name: </label>
                    <input class="form-control" type="text" name="last_name" id="last_name" />
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input class="form-control" type="password" name="password" id="password" />
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm password: </label>
                    <input class="form-control"type="password" name="cpassword" id="cpassword" />
                </div>
                <input class="btn btn-primary" type="submit" name="register" value="Meld aan" />
                <a class="btn btn-secondary" href="<?= BASE_PATH?>login">Terug</a>
            </form>
        </div>
    </div>
</div>



<p>

</p>
<p>


</p>
<p>

</p>
<p>


</p>
<p>


</p>
<p>


</p>
<p>

</p>

