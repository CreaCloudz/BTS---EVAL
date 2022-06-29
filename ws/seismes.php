<?php
class seismes 
{ 
  private $connexion;
    private $utilisateur = "maelb" ;
    private $motDePasse = "09091999";
    private $mabase = "maelb";
    private $serveur="localhost";
  private $options = array(  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                             PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
  
  function __construct() 
  { 
     $this->connexion = new PDO('mysql:host='.$this->serveur.';dbname='.$this->mabase,	$this->monlogin, $this->monpassword, $this->options);
  } 
    
    
       
  public function RechercherTous()   {  
      $requete="SELECT * FROM seismes ORDER BY date_heure DESC";
      $resultat =$this->connexion->query($requete);
      $tableau = $resultat->fetchAll(PDO::FETCH_ASSOC);
      return $tableau;
  
  }
    
    public function Rechercher10Derniers()   {  
      $requete="SELECT * FROM seismes ORDER BY date_heure DESC LIMIT 0,10";
      $resultat =$this->connexion->query($requete);
      $tableau = $resultat->fetchAll(PDO::FETCH_ASSOC);
      return $tableau;
  
  } 
    

    
    public function RechercherParVille($ville)   {  
      $requete="SELECT * FROM seismes WHERE ville = '$ville' ";
      $resultat =$this->connexion->query($requete);
      $tableau = $resultat->fetchAll(PDO::FETCH_ASSOC);
      return $tableau;
  
  } 
    
     public function RechercherParMagnitude($magn)   {  
      $requete="SELECT * FROM seismes WHERE magn > '$magn' ";
      $resultat =$this->connexion->query($requete);
      $tableau = $resultat->fetchAll(PDO::FETCH_ASSOC);
      return $tableau;
  
  } 
    
  public function RechercherParDebutVille($ville)   {  
      $requete="SELECT * FROM seismes WHERE ville LIKE '$ville%' ";
      $resultat =$this->connexion->query($requete);
      $tableau = $resultat->fetchAll(PDO::FETCH_ASSOC);
      return $tableau;
  
  } 
      public function RechercherLePlusFort()   {  
      $requete="SELECT * FROM seismes ORDER BY magn DESC LIMIT 0,1";
      $resultat =$this->connexion->query($requete);
      $tableau = $resultat->fetch(PDO::FETCH_ASSOC);
      return $tableau;
  
  }
    
        public function RechercherLeDernier()   {  
      $requete="SELECT * FROM seismes ORDER BY date_heure DESC LIMIT 0,1";
      $resultat =$this->connexion->query($requete);
      $tableau = $resultat->fetch(PDO::FETCH_ASSOC);
      return $tableau;
  
  }
   public function ListerVilles()   {  
      $requete="SELECT DISTINCT ville FROM seismes ORDER BY ville ASC";
      $resultat =$this->connexion->query($requete);
      $tableau = $resultat->fetchAll(PDO::FETCH_COLUMN);
      return $tableau;
  
  }
    
    public function AjouterSeisme($dateHeure,$lat,$long,$magn,$prof,$nbe_stations,$ville,$distance){
        $requete = "INSERT INTO seismes (`date_heure`, `lat`, `long`, `magn`, `prof`, `nbe_stations`, `ville`, `distance`) VALUES ('$dateHeure', '$lat', '$long', '$magn', '$prof', '$nbe_stations', '$ville', '$distance');";
        $resultat = $this->connexion->exec($requete);
        return $resultat;
    }
}
?>
