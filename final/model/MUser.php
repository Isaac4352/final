<?php
class MUser extends Connection{

    #VARIABLES
    private int $id_user;
    private int $type;
    private string $username;
    private string $password;

    public function __construct(BDConfig $config, string $username = "", string $password, int $type = 2){
        parent::__construct($config);
        $this->type = $type;
        $this->username = $username;
        $this->password = $password;
    }

    #GETS
    public function getId_user() : int { return $this->id_user;} 
    public function getType() : int { return $this->type;} 
    public function getUsername() : string { return $this->username;} 
    public function getPassword() : string { return $this->password;}

    #SETS
    public function setType(int $type) : self {
        if($type != 1 && $type != 2) throw new Exception("Le tyoe ($type) d'un utilisateur doit etre 1 ou 2");
    
        $this->type = $type;
        return $this;
    }
    public function setUsername(string $username) : self {
        $username = trim($username);
        if(strlen($username) > 50 || empty($username)) throw new Exception("Le username '$username' dout etre entre 1 et 50 de characteres");
        $this->username = $username;
        return $this;
    }
    public function setPassword(string $password) : self {
        $password = trim($password);
        if(strlen($password) > 50 || empty($password)) throw new Exception("Le mot de passe '$password' dout etre entre 1 et 50 de characteres");
        $this->password = $password;
        return $this;
    }
    //----------------LOADERS--------------------- comme dans le model repository
    private function constructUser($record) : ?MUser{
       return new MUser(
        $this->config,
        $record['username'],
        $record['password'].
        $record['type']
       );
    }

    #public function selectAll($userID = null) : Array{ //comment obtenir une liste de tout les auteurs?
   #     $sql = "SELECT * FROM auteur";
        //$requete->bindValue("") comprend pas comment cel pourrait aider. surement seulement pour lexemple des users dans la video
   #     if($userID != null) $sql = $sql . "WHERE utilisateur_id=:userID"; //pas sur si marchera avec le reste
  #      $requete = $this->connect->prepare($sql);
 #      $requete->bindValue(":userID", $userID);
#
    #    $requete->execute();
    #    $auteurs = array();
   #     while($record = $requete->fetch()) {
        #    $auteur = $this->constructAuteur($record);
       #     if($auteur != null) $auteurs[] = $auteur; //est-ce vraiment un add dans la liste?
      #  
     #   }
    #    return $auteurs;
   # }

   #FONCTIONS
    public function select($id) : ?MUser {
        $user = null;

     $requete = $this->connect->prepare("SELECT * FROM user WHERE id=:id");
        $requete->bindValue(":id",$id);
        $requete->execute();
        if($record = $requete->fetch()) {
            $user = $this->constructUser($record);
            if($user = null) {
                $auteurs[] = $user;
            }
        }
        return $user;
    }
}
?>