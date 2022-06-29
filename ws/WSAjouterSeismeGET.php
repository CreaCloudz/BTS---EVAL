<?php 
    //  WSAjouterSeisme.php?date=1999-12-05&heure=18:12:56&lat=44.5&long=12.4&magn=5.2&prof=58&nbe_stations=12&ville=aire-sur-l-adour&distance=22
    include( 'seismes.php'); 
    try { 
        $seismes=new seismes(); 
    } catch(Exception $e) { 
        header("HTTP/1.0 500 Internal Server Error");
        echo '{"error":"Impossible de se connecter a la base" }'; 
    };

     if ($_SERVER['REQUEST_METHOD'] != 'GET' ){
        header("HTTP/1.0 405 Method Not Allowed");
        echo '{"error":"il faut utiliser la methode GET" }';
    } else if ((empty($_GET['date'])) ||(empty($_GET['heure'])) ||(empty($_GET['lat'])) ||(empty($_GET['long'])) ||(empty($_GET['magn'])) ||(empty($_GET['prof'])) ||(empty($_GET['nbe_stations'])) ||(empty($_GET['ville'])) ||(empty($_GET['distance']))  ){
        header("HTTP/1.0 400 Bad Request");
        echo '{"error":"Parametres manquants" }'; 
    } else if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$_GET['date'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La date doit etre au format yyyy-mm-dd" }';
    } else if (!preg_match("/^([0-9]+):([0-5][0-9]):([0-5][0-9])$/",$_GET['heure'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"L\'heure doit etre au format hh:mm:ss" }';
    } else if (!preg_match("/^-?(?:\d+|\d*\.\d+)$/",$_GET['lat'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La latitude doit etre un float" }';
    } else if (!preg_match("/^-?(?:\d+|\d*\.\d+)$/",$_GET['long'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La latitude doit etre un float" }'; 
    } else if (!preg_match("/^-?(?:\d+|\d*\.\d+)$/",$_GET['magn'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La magnitude doit etre un float" }';
    } else if (!preg_match("/^0*[1-9]\d*$/",$_GET['prof'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La profondeur doit etre un entier" }';
    } else if (!preg_match("/^0*[1-9]\d*$/",$_GET['nbe_stations'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"Le nombre de stations doit etre un entier" }';
    } else if (!preg_match("/^0*[1-9]\d*$/",$_GET['distance'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La distance doit etre un entier" }';
    } else if (!preg_match("/^[\p{L}-. ]*$/u",$_GET['ville'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La ville doit etre une chaine de caracteres (le tiret - est admis comme separateur ex: aire-sur-l-adour)" }';
        
//    } else if(){
//    } else if(){
//    } else if(){
    
    } else {
        
        // expression reguliere
        // concatenation heure date
            $dateHeure = $_GET['date']." ".$_GET['heure'];
           $data = $seismes->AjouterSeisme($dateHeure,$_GET['lat'],$_GET['long'],$_GET['magn'],$_GET['prof'],$_GET['nbe_stations'],$_GET['ville'],$_GET['distance']);
    
        if($data){ 
            echo'{"succes":"Le seisme a ete enregistre" }';
        } else {
              header("HTTP/1.0 500 Internal Server Error");
        echo '{"error":"Echec de l enregistrement" }'; 
        }
       
    }


 
 ?>   