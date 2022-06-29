<?php
class appareils 
{ 
  private $connexion; 
  private $utilisateur = "maelb" ;
  private $motDePasse = "09091999";
  private $mabase = "maelb";
  private $serveur="localhost";
  private $options = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");  
  
    
  function __construct() 
  { 
     $this->connexion = new PDO('mysql:host='.$this->serveur.';dbname='.$this->mabase,	$this->utilisateur, $this->motDePasse, $this->options);
  } 
    
    
 public function Tous()   {  
         $requete="  SELECT *
                FROM `photos1` LIMIT 0,30 ";
    $resultat =$this->connexion->query($requete);
    $tableau = $resultat->FETCHAll(PDO::FETCH_ASSOC);
      
	return $tableau;

  } 
public function Max() {
           $requete ="  SELECT *
                 FROM `photos1`
                 ORDER BY `photos1`.`definition` DESC
                LIMIT 0 , 1";
            $resultat =$this->connexion->query($requete);
            $tableau = $resultat->FETCH(PDO::FETCH_ASSOC);                     
            
    return $tableau;
                        }
    
public function Min() {
           $requete ="  SELECT *
                 FROM `photos1`
                 ORDER BY `photos1`.`definition` ASC
                LIMIT 0 , 1";
            $resultat =$this->connexion->query($requete);
            $tableau = $resultat->FETCH(PDO::FETCH_ASSOC);                     
            
    return $tableau;
                        }
    
public function Moy() {
           $requete ="  SELECT *
                 FROM `photos1`
                 ORDER BY  AVG( `definition` ) 
                LIMIT 0 , 1";
            $resultat =$this->connexion->query($requete);
            $tableau = $resultat->FETCH(PDO::FETCH_ASSOC);                     
            
    return $tableau;
                        }
    
public function ListerDefinition()   
    {  
    $requete="  SELECT DISTINCT `definition`
                FROM `photos1` 
                ORDER BY `definition`";
    $resultat =$this->connexion->query($requete);
    $tableau = $resultat->FETCHALL(PDO::FETCH_COLUMN);
      
	return $tableau;     
    } 
    
public function AfficherParDefinition($definition)
    {
        $requete="SELECT * FROM `photos1` WHERE `definition`= '$definition'";
        $resultat=$this->connexion->query($requete);
        $tableau = $resultat->FETCHALL(PDO::FETCH_ASSOC);
        
        return $tableau;
    }
public function AfficherPrixDefinition($definition)
    {
        $requete="SELECT * FROM `photos1` WHERE `definition`= '$definition' ORDER BY `photos1`.`prix` ASC LIMIT 0,1";
        $resultat=$this->connexion->query($requete);
        $tableau = $resultat->FETCH(PDO::FETCH_ASSOC);
        
        return $tableau;
    }      
public function TousPrix()
    {
        $requete="SELECT * FROM `photos1` ORDER BY `photos1`.`prix` ASC LIMIT 0,1";
        $resultat=$this->connexion->query($requete);
        $tableau = $resultat->FETCH(PDO::FETCH_ASSOC);
        
        return $tableau;
    }    
}
?>
