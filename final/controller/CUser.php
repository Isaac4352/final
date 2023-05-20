<?php 

    class CUser extends Controller {

        private MUser $user;

        function __construct(BDConfig $config) {
            parent::__construct($config);
            $this->user = new MUser($config, "username", "password", 2); //MBD.php
        }

        function consulter() {
            $idUser = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $user = $this->user->select($idUser);

            $vue = new ViewCreator("view/VUser.php"); //auteur dans view??
            echo "test";
            echo $user->getUsername();
            $vue->assign("auteur", $user);
            echo $vue->render();
        }

        function default() {$this->consulter();}
    }
?>