<?php

 

//Création des variables

$user = 'root';
$password = '';
$server = 'localhost';
 
// gestion de la connexion

  try
  {
    $connexion= new PDO("mysql:host=$server;dbname=test", $user, $password);
    $connexion->exec("SET CHARACTER SET utf8");	//Gestion des accents   
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connection reussie";
 }
 
//gestion des erreurs

catch(Exception $e)
 {
    echo 'Erreur : '.$e->getMessage().'<br />';
    echo 'N° : '.$e->getCode();
}


?>