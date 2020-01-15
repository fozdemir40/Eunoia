<?php if (isset($errors) && !empty($errors)) { ?>
    <ul class="errors">
        <?php for ($i = 0; $i < count($errors); $i++) { ?>
            <li><?= $errors[$i]; ?></li>
        <?php } ?>
    </ul>
<?php }

if ($display_form){
?>

<form action="<?= $_SERVER['REQUEST_URI']?>" method="POST">
    <p>
        <label for="email">E-mail/username: </label>
        <input type="text" name="email" id="email"/>
    </p>
    <p>
        <input type="submit" name="activate" value="Send activation link"/>
    </p>
</form>


<?php } ?>