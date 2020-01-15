<?php
/**
 * @var $pageTitle string
 * @var $content string
 */
?>
<!doctype html>
<html lang="en">
<head>
    <title>Eunoia</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="<?= RESOURCES_PATH; ?>css/style.css"/>
</head>
<body>
<?= ($content ?? ''); ?>
</body>
</html>