<?php

session_start();

require "conf.inc.php";
require "functions.php";

if( !isset($_GET['accesstoken']) || strlen($_GET['accesstoken']) != 32  ){

	die("error");

}
	
//Se connecter a la bdd
$db = connectDb();

//Préparer la requete
$query = $db->prepare(" SELECT id FROM users WHERE accesstoken=:tata");

//Executer et récupérer l'information
$query->execute(["tata"=>$_GET['accesstoken']]);
$results = $query->fetch();
if( !empty($results) ){
	//il existe on prépare une autre requête
	$query = $db->prepare(" UPDATE users SET status = 1 WHERE accesstoken=:cequonveut");
	//On execute la nouvelle requete
	$query->execute(["cequonveut"=>$_GET['accesstoken']]);
	header("Location: login.php");

}else{
	die("Error");
}
//et si il n'existe pas on die
?>





