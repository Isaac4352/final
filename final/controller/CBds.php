<?php 

    class CBds extends Controller {

        private MBd $auteur;

        function __construct(BDConfig $config) {
            parent::__construct($config);
            $this->auteur = new MBd($config, "test", "test", new DateTime("today"), "nom_edition", false, 1); //MBD.php
        }

        function consulter() {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $Bd = $this->auteur->select($id);

            $vue = new ViewCreator("view/VAuteur.php"); //auteur dans view??
            echo "test";
            echo $Bd->getNom();
            $vue->assign("Bd", $Bd);
            echo $vue->render();
        }

        function default() {$this->consulter();}
    }
?>