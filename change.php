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

      $email = ($result[0]['mail']);
      $pass = md5($result[0]['pass']);
   
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
    $mail->AddAddress($email,$email);
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Cliquez sur le lien suivant pour rénitialiser votre mot de passe : '.$link.'';
    if($mail->Send())
    {
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
                    <li class="active">Rénitialisation en cours</li>
                </ol>
                <div>
                    <h4>Veuillez vérifiez dans votre boite mail le lien pour rénitialiser votre mot de passe. Pensez à verifier vos spams !</h4><br>
                    <h5>Redirection vers la page d'accueil, vous pouvez également fermer cette fenêtre. </h5>
                </div>
            </div>
        </div>
                   
<script>
setTimeout("location.href='index.php';", 4000);
</script>

<?php


    
}
      echo "";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
      echo "L'adresse que vous avez renseigné n'existe pas"; 
    }
    
  }
    include "footer.php";

?>

       

