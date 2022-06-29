<?php 
    //  WSAjouterSeisme.php?date=1999-12-05&heure=18:12:56&lat=44.5&long=12.4&magn=5.2&prof=58&nbe_stations=12&ville=aire-sur-l-adour&distance=22
    include( 'seismes.php'); 
    try { 
        $seismes=new seismes(); 
    } catch(Exception $e) { 
        header("HTTP/1.0 500 Internal Server Error");
        echo '{"error":"Impossible de se connecter a la base" }'; 
    };

     if ($_SERVER['REQUEST_METHOD'] != 'POST' ){
        header("HTTP/1.0 405 Method Not Allowed");
        echo '{"error":"il faut utiliser la methode POST" }';
    } else if (empty($_POST['magn'])){
        header("HTTP/1.0 400 Bad Request");
        echo '{"error":"Magnitude manquante" }'; 
    } else if (!preg_match("/^-?(?:\d+|\d*\.\d+)$/",$_POST['magn'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La magnitude doit etre un float" }';
     
        
//    } else if(){
//    } else if(){
//    } else if(){
    
    } else {
        
        // expression reguliere
        
           $data = $seismes->AjouterSeisme(date("Y-m-d H:i:s"),'43.70', '-0.2616',$_POST['magn'],'0','1','Aire-sur-l-adour','0');
    
        if($data){ 
            echo'{"succes":"Le seisme a ete enregistre" }';
        } else {
              header("HTTP/1.0 500 Internal Server Error");
        echo '{"error":"Echec de l enregistrement" }'; 
        }
       
    }


 
 ?>   