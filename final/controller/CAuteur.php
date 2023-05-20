<?php 

    class CAuteur extends Controller {

        private MAuteur $auteur;

        function __construct(BDConfig $config) {
            parent::__construct($config);
            $this->auteur = new MAuteur($config, "test", "test", new DateTime("today"), 1, false); //MBD.php
        }

        function consulter() {
            $idAuteur = filter_input(INPUT_GET, 'id_auteur', FILTER_SANITIZE_NUMBER_INT);
            $auteur = $this->auteur->select($idAuteur);

            $vue = new ViewCreator("view/VAuteur.php"); //auteur dans view??
            echo "test";
            echo $auteur->getNom();
            $vue->assign("auteur", $auteur);
            echo $vue->render();
        }

        function default() {$this->consulter();}
    }
?>