<?php if (isset($errors) && !empty($errors)) { ?>
    <ul class="errors">
        <?php for ($i = 0; $i < count($errors); $i++) { ?>
            <li><?= $errors[$i]; ?></li>
        <?php } ?>
    </ul>
<?php } ?>

    <fieldset>
        <legend>Register</legend>
        <?php if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            session_destroy();
            setcookie(session_name(),'',time()-3600);
        }
        echo isset($general_msg)?$general_msg:''; ?>
        <form id="register" action="<?= $_SERVER['REQUEST_URI']?>" method="POST">
            <p>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username"/>
            </p>
            <p>
                <label for="email">E-mail: </label>
                <input type="text" name="email" id="email" />

            </p>
            <p>
                <label for="first_name">First name: </label>
                <input type="text" name="first_name" id="first_name" />
            </p>
            <p>
                <label for="last_name">Last name: </label>
                <input type="text" name="last_name" id="last_name" />

            </p>
            <p>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" />

            </p>
            <p>
                <label for="cpassword">Confirm password: </label>
                <input type="password" name="cpassword" id="cpassword" />

            </p>
            <p>
                <input type="submit" name="register" value="Meld aan" />
            </p>
        </form>
    </fieldset>

