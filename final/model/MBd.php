<?php
class MBd extends Connection{
    #VARIABLES
    private int $id;
    private string $nom;
    private string $auteur_nom;
    private ?DateTime $date_publie;
    private string $nom_edition;
    private bool $encore_en_impression;
    private int $id_auteur;
    private MUser $User;

    public function __construct(BDConfig $config, string $nom, string $auteur_nom, ?DateTime $date_publie, string $nom_edition, bool $encore_en_impression, int $id_auteur){
        parent::__construct($config);
        $this->nom = $nom;
        $this->auteur_nom= $auteur_nom;
        $this->date_publie = $date_publie;
        $this->nom_edition = $nom_edition;
        $this->encore_en_impression = $encore_en_impression;
        $this->id_auteur = $id_auteur;
    }

    #GETS
    public function getId() : int { return $this->id;} 
    public function getNom() : string { return $this->nom;} 
    public function getAuteur_nom() : string { return $this->auteur_nom;} 
    public function getDatePublie() : ?DateTime { return $this->date_publie;} 
    public function getNom_edition() : string { return $this->nom_edition;} 
    public function getImpression() : bool { return $this->encore_en_impression;}
    public function getId_auteur() : int { return $this->id_auteur;} 

    #SETS
    public function setNom(string $nom) : self {
        $this->nom = trim($nom);
        return $this;
    }
    public function setAuteur_nom(string $auteur_nom) : self {
        $this->auteur_nom = trim($auteur_nom);
        return $this;
    }
    public function setNom_edition(string $nom_edition) : self {
        $this->nom_edition = trim($nom_edition);
        return $this;
    }

    public function setDatePublie(?DateTime $date_publie) : self {
        if($date_publie > date("Y-m-d")){ 
            throw new Exception("la date de publication doit etre au passe");
        }
        $this->date_publie = $date_publie;
        return $this;
    }

    //pas de set pour nombre livre, juste prendre de la liste

    public function setImpression(bool $encore_en_impression) : self {
        $this->encore_en_impression = $encore_en_impression;
        return $this;
    }

    //----------------LOADERS--------------------- comme dans le model repository
    private function constructAuteur($record) : ?MAuteur{
        $auteur = null;
        $User = $this->User->select($record['utilisateur_id']);
        if($User != null) {
            $auteur = new MBd(
                $this->config,
                $record['nom'],
                $record['auteur_nom'],
                $record['date_publie'],   
                $record['nom_edition'],
                $record['encore_en_impression'],
                $record['id_auteur']
            );
        }

    }

    #FONCTIONS
    public function selectAll($userID = null) : Array{ //comment obtenir une liste de tout les auteurs?
        $sql = "SELECT * FROM Bds";
        //$requete->bindValue("") comprend pas comment cel pourrait aider. surement seulement pour lexemple des users dans la video
        if($userID != null) $sql = $sql . "WHERE utilisateur_id=:userID"; //pas sur si marchera avec le reste
        $requete = $this->connect->prepare($sql);
       $requete->bindValue(":userID", $userID);

        $requete->execute();
        $Bds = array();
        while($record = $requete->fetch()) {
            $Bd = $this->constructAuteur($record);
            if($Bd != null) $Bds[] = $Bd; //est-ce vraiment un add dans la liste?
        
        }
        return $Bds;
    }

    public function select($id) : ?MBd { //voir si doit changer en MAuteur
        $Bd = null;

        $requete = $this->connect->prepare("SELECT * FROM auteur WHERE id=:id");
        $requete->bindValue(":id",$id);
        $requete->execute();

        if($record = $requete->fetch()) {
            $Bd = $this->constructAuteur($record);
            if($Bd = null) {
                $Bd[] = $Bd;
            }
        }
        return $Bd;
    }

    public function delete($id) : void {
        $requete = $this->connect->prepare("DELETE * FROM bds WHERE id=:id");
        $requete->bindValue(":id",$id);
        $requete->execute();
    }
}
?>