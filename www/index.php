<!DOCTYPE html>
<html>

<head>
    <title>Séismes</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1>Séismes</h1>
    <div><a href="" >Accueil</a></div>
     
    <?php 
    include( 'seismes.php'); 
    try { 
        $seismes=new seismes(); 
        } 
    catch(Exception $e) 
        { 
        echo 'Impossible de se connecter à la base<br>Message: ' .$e->getMessage();
        };
    
    
    ?>
    <h2>Le plus fort seisme</h2>
    <?
        $tableau = $seismes->RechercherLePlusFort();
        echo "<p>"."Magnitude: ".$tableau["magn"]." a ".$tableau["distance"]."km de ".$tableau["ville"]." (".$tableau["date_heure"].")"."</p>";
    ?>
    
    <h2>Dernier séisme</h2>
    <?
        $tableau = $seismes->RechercherLeDernier();
        echo "<p>"."A ".$tableau["ville"]." ".$tableau["distance"]."km de le: ".$tableau["date_heure"]." Magnitude: ".$tableau["magn"].
            ", a une profondeur de ".$tableau["prof"]."km"."</p>";
    ?>
      
      <form action="" method="post">
            <select name="ville">
           <option value="Toutes">Toutes</option>
           <?php
            $tableau = $seismes->ListerVilles();
            foreach ($tableau as $ligne)
                {
                echo "<option>$ligne </option>";
                }
            
            ?>
         </select>
     <input type="submit">
    </form>
    
     <form action="" method="post">
            <select name="magn">
           <option value="Toutes">Toutes</option>
           <option value= "1">1</option>
           <option value= "2">2</option>
           <option value= "3">3</option>
         </select>
     <input type="submit">
    </form>
   
   <h2>Historique des 10 derniers séismes</h2>
   <?
     
    if( isset($_POST["ville"]) && $_POST["ville"] != "Toutes")
    {
         $tableau = $seismes->RechercherParVille($_POST["ville"]);
    }
    else
    {
        if( isset($_POST["magn"]) && $_POST["magn"] != "Toutes")
        {
            $tableau = $seismes->RechercherParMagnitude($_POST["magn"]);
        }
        else
        {
            $tableau = $seismes->Rechercher10Derniers();
        }
        
    }
    
        echo "<table>".
                "<tr>".
                    "<th>"."date"."</th>".
                    "<th>"."Latitude"."</th>".
                    "<th>"."Longitude"."</th>".
                    "<th>"."Magnitude"."</th>".
                    "<th>"."Pronfondeur"."</th>".
                    "<th>"."Nombre de stations"."</th>".
                    "<th>"."Ville"."</th>".
                "</tr>";
       
        foreach($tableau as $ligne)
        {
           echo "<tr>";
                echo "<td>".$ligne["date_heure"]."</td>";
                echo "<td>".$ligne["lat"]."</td>";
                echo "<td>".$ligne["long"]."</td>";
                 echo "<td>".$ligne["magn"]."</td>";
                echo "<td>".$ligne["prof"]."</td>";
                echo "<td>".$ligne["nbe_stations"]."</td>";
                 echo "<td>".$ligne["ville"]."</td>";
            echo "</tr>";
      
        }
          echo "</table>";
    ?>
       
        <footer>BTS SNIR</footer>
</body>

</html>
