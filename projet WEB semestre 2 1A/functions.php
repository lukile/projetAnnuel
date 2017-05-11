<?php

function connectDb(){

	try{
		$db = new PDO("mysql:dbname=".DBNAME.";host=".DBHOST,DBUSER,DBPWD);
	}catch(Exception $e){
		die("Erreur SQL : ".$e->GetMessage());
	}

	return $db;
}


function emailExist($email){
	//Se connecter la bdd
	$db = connectDb();

	//Préparer la requêt qui me retourne l'utilisateur ayant pour email $email
	$query = $db->prepare(" SELECT id FROM users WHERE email=:titi ");
	$query->execute(["titi" => $email]);
	$result = $query->fetch();
	
	if(empty($result)){
		return false;
	}

	return true;
}

function login($email, $password){

	$db = connectDb();
	$query = $db->prepare("SELECT password FROM users WHERE email=:tutu");
	$query->execute(["tutu"=>$email]);
	$result = $query->fetch();
	$hash = $result["password"];
	if(!empty($hash)&& password_verify($password,$hash) ){
		$_SESSION["accesstoken"]= generateAccessToken($email);
		$_SESSION["email"]= $email;
		return true;
	}

		return false;
}

function generateAccessToken($email){
 	$accesstoken = md5(uniqid());

 	$db = connectDb();
 	$query = $db->prepare("UPDATE users SET accesstoken=:titi WHERE email=:toto");	

	$query->execute(["titi"=>$accesstoken , "toto" => $email]);

 	return $accesstoken;
 }

 function isConnected(){

	if( !empty($_SESSION["accesstoken"]) && !empty($_SESSION["email"])){

	$db = connectDb();
       $query = $db->prepare(" SELECT id FROM users WHERE email=:tutu AND accesstoken=:toto");
       $query->execute(["tutu" => $_SESSION['email'], "toto" => $_SESSION['accesstoken']]);
       $result = $query->fetch();
       
       //Vérifier qu'il existe un utilisateur avec l'email $_SESSION['email'] associé au accesstoken $_SESSION['accesstoken']
       if(!empty($result)){
           // Si oui on regénère un accesstoken et on retourne vrai
           $_SESSION['accesstoken'] = generateAccessToken($_SESSION['email']);
           return true;
       }else{
           // Sinon on retourne faux 
           return false;
       }
       
   }
   
}




function logout() {
	unset($_SESSION['accesstoken']);
	header("Location: index.php");
}
		


















