<?php 
    include( 'seismes.php'); 
    try { 
        $seismes=new seismes(); 
    } catch(Exception $e) { 
        header("HTTP/1.0 500 Internal Server Error");
        echo '{"error":"Impossible de se connecter a la base" }'; 
    };
    $ligne = $seismes->RechercherLeDernier();
    echo json_encode($ligne);
 ?>   