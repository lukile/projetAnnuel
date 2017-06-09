<?php
require_once(__DIR__. '/class/DatabaseManager.php');
include"header.php";

            $hostname = "localhost";
            $database = "aen";
            $username = "root";
            $password = "";

try{
    $connect = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
 }catch (PDOException $e){
        exit('problème de connexion à la base');
      }


if(isset($_POST['resetPassword']) && $_POST['pass_reset'] && $_POST['pass_validation_reset'])
{
  $mail = $_POST['mail'];
  $pass_reset = $_POST['pass_reset'];
  $pass_validate_reset = $_POST['pass_validation_reset'];

  if($pass_reset == $pass_validate_reset) {

  $pass_reset = md5($pass_reset);
  $query = $connect->prepare("UPDATE user set pass='$pass_reset' where mail =  '$mail'");
  $query->execute(["mail" => $_POST['mail']]);
}
?>

<div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Rénitialisation de mot de passe
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Accueil</a>
                    </li>
                    <li class="active">Rénitialisation réussie</li>
                </ol>
                <div>
                    <h4>Changement de mot de passe réussie, redirection vers la page d'accueil.</h4>
                </div>
            </div>
        </div>
                
<?php 
	//header("Location : index.php");
    //header("Location : index.php");
?>   
<script>
setTimeout("location.href='index.php';", 3);
</script>

<?php

include "footer.php";

	
}

?>