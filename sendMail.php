<?php 
//session_start();
//include "function.php";
//include "checkUser.php"
require_once("function.php");
if(isset($_GET['id']) && isset($_GET['mail'])){
		$id = $_GET['id'];
		$email = $_GET['mail'];


    $fetch_id = connect()->prepare("SELECT COUNT(of.id) FROM order_form of WHERE of.id in (SELECT ofs.order_form_id FROM order_form_service ofs WHERE ofs.service_id = 10) AND of.user_id = :id");
    $fetch_id->execute([':id'=>$_GET['id']]);
    $result = $fetch_id->fetch();

    if ( $result[0] == 10) {
     echo "Mail envoyé à ".$email;
     $link="<a href='http://localhost/projet_annuel/contact.php'>Contact support</a>";
    
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
    $mail->Subject  =  'Présentation a l"examen';
    $mail->IsHTML(true);
    $mail->Body    = 'Bonjour,<br/> Vous avez cumulé plus de 10 cours de leçon de pilotage, <br/> nous vous proposons donc de passer un examen afin de recevoir au plus rapidement votre titre confimé. <br/> Contactez l\'AEN pour prendre rendez vous<br/>'.$link ;
    $mail->Send();
     return true;
        
    } else {
    	 echo "Le client n'as pas cumulé plus de 10 cours, il n'a pas accès au passage d'examens";
        return false;
       
    }
}
