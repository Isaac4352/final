<?php //ICI, LA LISTE
    if(isset($Bd)){
        echo '<h1>' . $Bd->getNom() . '</h1>';
        echo '<h3>par <a href="index.php?ctrl=">';
        echo '<button class="deconnect">deconnexion</button>';
        $auteurs = array();
        $auteurs = $auteur->selectAll();
        echo '<div class=divtab>';
        foreach ($auteurs as $ind_auteur) {
            echo '<div class="divtab">' . $bd->getPrenom() . '</div>';
        }
        echo '</div>';
        
    }
    else{
        echo 'Auteur inconnu';
    }
?>