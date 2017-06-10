<?php
	require_once(__DIR__. '/class/DatabaseManager.php');

            $hostname = "localhost";
            $database = "aen";
            $username = "root";
            $password = "";

try{
    $connect = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
 }catch (PDOException $e){
        exit('problème de connexion à la base');
      }

if( !isset($_GET['activationKey']) && !isset($_GET['mail'])){

	die("Pas de token");

}
$activationKey = $_GET['activationKey'];
$mail = $_GET['mail'];
echo $activationKey;
echo $mail;

$query = $connect->prepare("SELECT id FROM user WHERE mail='$mail'");

//Executer et récupérer l'information
$query->execute(["mail"=>$_GET['mail']]);
$results = $query->fetch();

if( !empty($results) ){
	//il existe on prépare une autre requête
	$query = $connect->prepare("UPDATE user SET active = 1 WHERE mail='$mail'");
	//On execute la nouvelle requete
	$query->execute(["mail"=>$_GET['mail']]);
	header("Location: index.php");

}else{
	die("Erreur a la fin, bdd pas mise a jour");
}
//et si il n'existe pas on die
?>
