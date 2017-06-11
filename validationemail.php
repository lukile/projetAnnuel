<?php
	require_once(__DIR__. '/class/DatabaseManager.php');
	include "header.php";

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
//echo $activationKey;
//echo $mail;

$query = $connect->prepare("SELECT id FROM user WHERE mail='$mail'");

//Executer et récupérer l'information
$query->execute(["mail"=>$_GET['mail']]);
$results = $query->fetch();

if( !empty($results) ){
	//il existe on prépare une autre requête
	$query = $connect->prepare("UPDATE user SET active = 1 WHERE mail='$mail'");
	//On execute la nouvelle requete
	$query->execute(["mail"=>$_GET['mail']]);

}else{
	die("Erreur a la fin, bdd pas mise a jour");
}
?>
<div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Activation de compte
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Accueil</a>
                    </li>
                    <li class="active">Activation reussie</li>
                </ol>
                <div>
                    <h4>Votre compte est maintenant activé vous pouvez maintenant commencer à reserver des services, redirection vers la page d'accueil.</h4>
                </div>
            </div>
        </div>
                   
<script>
setTimeout("location.href='index.php';", 4000);
</script>

<?php

include "footer.php";


//et si il n'existe pas on die
?>
