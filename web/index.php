<!DOCTYPE html>
<html>
<head>
	<title>Comparatif d'appareils photo</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

			<h1 class="title">Comparatif d'appareils photo</h1>
			 
<?php	
       include "appareils.php"; 
		try { 
        $photos = new appareils(); 
        } 
    catch(Exception $e) 
        { 
        echo 'Impossible de se connecter à la base<br>Message: ' .$e->getMessage();
        };
		
       
    echo "<h2>"."La definition Max"."</h2>";
    
        $tableauMax = $photos->Max();
        echo "<p>"."Le ".$tableauMax["marque"]." ".$tableauMax["modele"]." a la definition max qui est de : ".$tableauMax["definition"]."</p>";
    
    
    echo "<h2>"."La definition Min"."</h2>";
    
        $tableauMin = $photos->Min();
        echo "<p>"."Le ".$tableauMin["marque"]." ".$tableauMin["modele"]." a la definition min qui est de : ".$tableauMin["definition"]."</p>";
    
    
     echo "<h2>"."La definition Moyenne"."</h2>";
    
        $tableauMoy = $photos->Moy();
        echo "<p>"."Le ".$tableauMoy["marque"]." ".$tableauMoy["modele"]." a la definition moyenne qui est de : ".$tableauMoy["definition"]."</p>";
    ?>
    
    
     <form action="" method="get">
            <select name="definition">
           <option value="Touts">Toutes les definition</option>
           <?php
            $tableau = $photos->ListerDefinition();
            foreach ($tableau as $ligne)
                {
                echo "<option>$ligne </option>";
                }
            
            ?>
         </select>
     <input type="submit">
    </form>
    
    
    
    
    
    
    <?
    
    if( isset($_GET["definition"]) && $_GET["definition"] != "Touts")
    {
         $tableau = $photos->AfficherParDefinition($_GET["definition"]);
    }
    else
    {
        $tableau =$photos->Tous();
    }
    
    
    
    
    
		echo "<table>".
		    "<tr>".
		        "<th>"."marque"."</th>".
		        "<th>"."modele"."</th>".
		        "<th>"."avis"."</th>".
		        "<th>"."prix"."</th>".
		        "<th>"."definition"."</th>".
		        "<th>"."techno"."</th>".
		        "<th>"."isoMax"."</th>".
		       "<th>"."ecran"."</th>".
		        "<th>"."poids"."</th>".
		    "</tr>";
		  
            
           
            
            foreach($tableau as $ligne)
            {
           echo "<tr>";
                echo "<td>".$ligne["marque"]."</td>";
                echo "<td>".$ligne["modele"]."</td>";
                echo "<td>".$ligne["avis"]."</td>";
                 echo "<td>".$ligne["prix"]."</td>";
                echo "<td>".$ligne["definition"]."</td>";
                echo "<td>".$ligne["techno"]."</td>";
                 echo "<td>".$ligne["isoMax"]."</td>";
                echo "<td>".$ligne["ecran"]."</td>";
                echo "<td>".$ligne["poids"]."</td>";
            echo "</tr>";
      
            }
            
   
           
		    
	echo	"</table>";
        
         echo "<h2>"."trie par prix"."</h2>";
            
    if( isset($_GET["definition"]) && $_GET["definition"] != "Touts")
    {
         $tableau2 = $photos->AfficherPrixDefinition($_GET["definition"]);
    }
    else
    {
        $tableau2 =$photos->TousPrix();
    }
        
        echo "<table>".
		    "<tr>".
		        "<th>"."marque"."</th>".
		        "<th>"."modele"."</th>".
		        "<th>"."avis"."</th>".
		        "<th>"."prix"."</th>".
		        "<th>"."definition"."</th>".
		        "<th>"."techno"."</th>".
		        "<th>"."isoMax"."</th>".
		       "<th>"."ecran"."</th>".
		        "<th>"."poids"."</th>".
		    "</tr>";
		  
            
           
           
           echo "<tr>";
                echo "<td>".$ligne2["marque"]."</td>";
                echo "<td>".$ligne2["modele"]."</td>";
                echo "<td>".$ligne2["avis"]."</td>";
                 echo "<td>".$ligne2["prix"]."</td>";
                echo "<td>".$ligne2["definition"]."</td>";
                echo "<td>".$ligne2["techno"]."</td>";
                 echo "<td>".$ligne2["isoMax"]."</td>";
                echo "<td>".$ligne2["ecran"]."</td>";
                echo "<td>".$ligne2["poids"]."</td>";
            echo "</tr>";
      
            
            
            
            
           
		    
	echo	"</table>"
        
        
        
        
        
        
			?>	
</body>
</html>
