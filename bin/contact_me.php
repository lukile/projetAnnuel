<?php
// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
   
    $hostname = "localhost";
            $database = "aen";
            $username = "root";
            $password = "";

try{
    $connect = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
 }catch (PDOException $e){
        exit('problème de connexion à la base');
      }

$name = strip_tags(htmlspecialchars($_POST['name']));
$mail = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
// Create the email and send the message,,
		$query = $connect->prepare("INSERT INTO messages(userMessage, mail, content) VALUES (?, ?, ?)");
  		$query->execute([$name, $mail,$message]);

return true;         
?>
