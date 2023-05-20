<?php
/**
 * Contrôleur par défaut. Il permet d'afficher la page d'accueil.
 */
class CDefault extends Controller
{
    function accueil()
    {
        $vue = new ViewCreator('view/VAuteur.php');
        echo $vue->render();
    }

    function default()
    {
        $this->accueil();
    }
}
