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

  $query = $connect->prepare("UPDATE user set pass='$pass_reset' where mail='$mail'");
  $query->execute(["mail" => $_POST['mail']]);

  echo "changement reussi";
}



?>