<?php
/**
 * @var $errors array
 * @var $children
 */
?>

<div class="container">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <h1>Afpsraak reserveren</h1>
            <?php if (!empty($errors)): ?>
                <ul class="errors">
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if(!empty($children)): ?>
            <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="hulpvraag">Uw hulpvraag</label>
                    <small>Wat is uw reden voor dit afspraak?</small>
                    <input type="text" class="form-control" id="hulpvraag" name="hulpvraag">
                </div>
                <div class="form-group">
                    <label for="verwachting">Verwachting</label>
                    <small>Wat wordt er door u verwacht van dit afspraak?</small>
                    <textarea class="form-control" id="verwachting" name="verwachting"></textarea>
                </div>
                <div class="form-group">
                    <label for="belangrijke_zaken">Andere belangrijke zaken</label>
                    <small>Zijn er nog andere belangrijke zaken waar u over wilt hebben?</small>
                    <textarea class="form-control" id="belangrijke_zaken" name="belangrijke_zaken"></textarea>
                </div>
                <div class="form-group">
                    <label for="for_child">Voor welke kind maakt u een afspraak?</label>
                    <select name="for_child" id="for_child">
                        <?php foreach ($children as $child):?>
                        <option value="<?= $child->name ?>"><?= $child->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php else: ?>
                <h2>U heeft uw kinderen nog niet toegevoegd <a href="<?= BASE_PATH; ?>add_child" class="btn btn-success">+ Kind Toevoegen</a></h2>
                <?php endif; ?>

                <input type="submit" class="btn btn-primary" name="book-availability" value="Afsrpaak maken">
            </form>
        </div>
    </div>
    <div class="row justify-content-end">
        <a href="<?= BASE_PATH ?>dashboard" class="btn btn-secondary">Terug naar dashboard</a>
    </div>
</div>
