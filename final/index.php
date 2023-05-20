<?php require_once 'view/import.php'?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>final</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <?php require_once 'view/section/entete.phtml'?>

        <div id="contenu">
            <?php  require_once 'view/section/menu.phtml' ?>
            <?php require_once 'view/content.php' //content ?>
        </div>

        <?php require_once 'view/section/pied.phtml' ?>
    </body>
</html>
