<?php //manage root manager
    $ctrl = 'CDefault'; //controller
    $paramAction = 'default';

    //recupere paramete 'ctrl' avec GET/POST
    if(isset($_REQUEST['ctrl'])){
        $request = filter_var($_REQUEST['ctrl'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        switch($request){ //faire un case pour chaque nouvelle page quon veut faire
            case "auteur": 
                $ctrl = "CAuteur";
                break;
            case "user":
                $ctrl = "CUser";
                break;
            case "bd":
                $ctrl = "CBds";
                break;
        }
        $controller = new $ctrl($config);

        if(!method_exists($controller, $paramAction)) throw new Exception("Action $paramAction non trouvée dans le controleur" + get_class($controller));

        //methode du controlleur pour traiter requete
        call_user_func(array($controller, $paramAction));
    }

?>