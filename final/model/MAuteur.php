<?php
class MAuteur extends Connection{
    #VARIABLES
    private int $id_auteur;
    private string $nom;
    private string $prenom;
    private ?DateTime $date_naissance;
    private int $nb_livres_cree;
    private bool $travail_courant_bd;

    private MUser $User;

    public function __construct(BDConfig $config, string $nom, string $prenom, ?DateTime $date_naissance, int $nb_livres_cree, bool $travail_ccourant_bd){
        parent::__construct($config);
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->nb_livres_cree = $nb_livres_cree;
        $this->travail_courant_bd = $travail_ccourant_bd;
    }

    #GETS
    public function getId_auteur() : int { return $this->id_auteur;} 
    public function getNom() : string { return $this->nom;} 
    public function getPrenom() : string { return $this->prenom;} 
    public function getDate() : ?DateTime { return $this->date_naissance;} 
    public function getNbLivres() : int { return $this->nb_livres_cree;} 
    public function getTravailCourant() : bool { return $this->travail_courant_bd;} 

    #SETS
    public function setNom(string $nom) : self {
        $this->nom = trim($nom);
        return $this;
    }
    public function setPrenom(string $prenom) : self {
        $this->prenom = trim($prenom);
        return $this;
    }

    public function setDate(?DateTime $date_naissance) : self {
        if($date_naissance > date("Y-m-d")){ //format peut etre mauvais
            throw new Exception("la date de naissance est impossible");
        }
        $this->date_naissance = $date_naissance;
        return $this;
    }

    //pas de set pour nombre livre, juste prendre de la liste

    public function setTravailCourant(bool $travail_courant_bd) : self {
        $this->travail_courant_bd = $travail_courant_bd;
        return $this;
    }

    //----------------LOADERS--------------------- comme dans le model repository
    private function constructAuteur($record) : ?MAuteur{
        $auteur = null;
        $User = $this->User->select($record['utilisateur_id']);
        if($User != null) {
            $auteur = new MAuteur(
                $this->config,
                $record['nom'],
                $record['prenom'],
                $record['date_naissance'],   
                $record['nb_livres_cree'],
                $record['travail_courant_bd']
            );
        }

    }

    #FONCTIONS
    public function selectAll($userID = null) : Array{ //comment obtenir une liste de tout les auteurs?
        $sql = "SELECT * FROM auteur";
        //$requete->bindValue("") comprend pas comment cel pourrait aider. surement seulement pour lexemple des users dans la video
        if($userID != null) $sql = $sql . "WHERE utilisateur_id=:userID"; //pas sur si marchera avec le reste
        $requete = $this->connect->prepare($sql);
       $requete->bindValue(":userID", $userID);

        $requete->execute();
        $auteurs = array();
        while($record = $requete->fetch()) {
            $auteur = $this->constructAuteur($record);
            if($auteur != null) $auteurs[] = $auteur; //est-ce vraiment un add dans la liste?
        
        }
        return $auteurs;
    }

    public function select($id) : ?MAuteur { //voir si doit changer en MAuteur
        $auteur = null;

        $requete = $this->connect->prepare("SELECT * FROM auteur WHERE id_auteur=:id");
        $requete->bindValue(":id",$id);
        $requete->execute();

        if($record = $requete->fetch()) {
            $auteur = $this->constructAuteur($record);
            if($auteur = null) {
                $auteurs[] = $auteur;
            }
        }
        return $auteur;
    }
}
?>