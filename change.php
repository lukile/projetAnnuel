<?php 
require_once(__DIR__. '/class/DatabaseManager.php');
include"header.php";

            $hostname = "localhost";
            $database = "aen";
            $username = "root";
            $password = "";

if(isset($_POST['submit_reset']) && $_POST['mail'])
{

try{
    $connect = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
 }catch (PDOException $e){
        exit('problème de connexion à la base');
      }
    $email = filter_input(INPUT_POST, 'mail');

    $query = $connect->prepare("SELECT mail, pass FROM user WHERE mail='$email'");
    $query->execute(["mail" => $_POST['mail']]);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
    if(count($result) == 1)
    {

      $email=($result[0]['mail']);
      $pass=md5($result[0]['pass']);
   
    $link="<a href='http://localhost/projects/projetAnnuel/reset.php?key=".$email."&reset=".$pass."'>Cliquez pour renitialiser votre mot de passe</a>";
    
    require_once('phpmailer/PHPMailerAutoload.php');

    $mail = new PHPMailer();
    $mail->CharSet = "utf-8";
    $mail->IsSMTP();
    $mail->SMTPAuth = true;                  
    $mail->Username = "aensld@zoho.eu";
    $mail->Password = "!PassAENsld";
    $mail->SMTPSecure = "tls";  
    $mail->Host = "smtp.zoho.eu";
    $mail->Port = 587;
    $mail->From=$mail->Username;
    $mail->FromName='Equipe AEN';
    $mail->AddAddress($email,'nom');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Cliquez sur le lien suivant pour rénitialiser votre mot de passe : '.$link.'';
    if($mail->Send())
    {
      echo "Veuillez vérifiez dans votre boite mail le lien pour rénitialiser votre mot de passe. Pensez à verifier vos spams !";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  } 
}

?>

       

