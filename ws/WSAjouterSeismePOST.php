<?php 
    //  WSAjouterSeisme.php
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
    } else if ((empty($_POST['date'])) ||(empty($_POST['heure'])) ||(empty($_POST['lat'])) ||(empty($_POST['long'])) ||(empty($_POST['magn'])) ||(empty($_POST['prof'])) ||(empty($_POST['nbe_stations'])) ||(empty($_POST['ville'])) ||(empty($_POST['distance']))  ){
        header("HTTP/1.0 400 Bad Request");
        echo '{"error":"Parametres manquants" }'; 
    } else if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$_POST['date'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La date doit etre au format yyyy-mm-dd" }';
    } else if (!preg_match("/^([0-9]+):([0-5][0-9]):([0-5][0-9])$/",$_POST['heure'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"L\'heure doit etre au format hh:mm:ss" }';
    } else if (!preg_match("/^-?(?:\d+|\d*\.\d+)$/",$_POST['lat'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La latitude doit etre un float" }';
    } else if (!preg_match("/^-?(?:\d+|\d*\.\d+)$/",$_POST['long'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La latitude doit etre un float" }'; 
    } else if (!preg_match("/^-?(?:\d+|\d*\.\d+)$/",$_POST['magn'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La magnitude doit etre un float" }';
    } else if (!preg_match("/^0*[1-9]\d*$/",$_POST['prof'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La profondeur doit etre un entier" }';
    } else if (!preg_match("/^0*[1-9]\d*$/",$_POST['nbe_stations'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"Le nombre de stations doit etre un entier" }';
    } else if (!preg_match("/^0*[1-9]\d*$/",$_POST['distance'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La distance doit etre un entier" }';
    } else if (!preg_match("/^[\p{L}-. ]*$/u",$_POST['ville'])) {
         header("HTTP/1.0 400 Bad Request");
        echo '{"error":"La ville doit etre une chaine de caracteres (le tiret - est admis comme separateur ex: aire-sur-l-adour)" }';
        
//    } else if(){
//    } else if(){
//    } else if(){
    
    } else {
        
        // expression reguliere
        // concatenation heure date
            $dateHeure = $_POST['date']." ".$_POST['heure'];
           $data = $seismes->AjouterSeisme($dateHeure,$_POST['lat'],$_POST['long'],$_POST['magn'],$_POST['prof'],$_POST['nbe_stations'],$_POST['ville'],$_POST['distance']);
    
        if($data){ 
            echo'{"succes":"Le seisme a ete enregistre" }';
        } else {
              header("HTTP/1.0 500 Internal Server Error");
        echo '{"error":"Echec de l enregistrement" }'; 
        }
       
    }


 
 ?>   