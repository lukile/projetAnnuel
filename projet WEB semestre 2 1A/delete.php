<?php 
	require "init.php";

// Est ce que l'utilisateur est connecté
	
	if(isConnected()){

//Se connecter a la bdd	
	
	$db = connectDb();

// Supprimer l'utilisateur ayant l'id $_GET["id"]
//Autre que moi	

	$query = $db->prepare("DELETE FROM users WHERE id=:id AND accesstoken <>:accesstoken");
	$query->execute(["id"=>$_GET["id"],"accesstoken" => $_SESSION['accesstoken'] ] );
	$_SESSION["accesstoken"] = generateAccessToken($_SESSION["email"]);

// Rediriger vers la page d'accueil
}

	header("Location: index.php");
