<?php 
//session_start();
//include "function.php";
//include "checkUser.php";
if(isset($_GET['id']) && isset($_GET['mail'])){
		$id = $_GET['id'];
		$email = $_GET['mail'];


    $fetch_id = connect()->prepare("SELECT COUNT(of.id) FROM order_form of WHERE of.id in (SELECT ofs.order_form_id FROM order_form_service ofs WHERE ofs WHERE ofs.service_id = 10) AND of.user_id = :id");
    $fetch_id->execute([':id'=>$_GET['id']]);
    $result = $fetch_id->fetch();

    if ( $result[0] == 10 ) {
     echo "ok";
    // $link="<a href='http://localhost/projet_annuel/reset.php?key=".$email."&reset=".$pass."'>Cliquez pour renitialiser votre mot de passe</a>";
    
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
    $mail->Body    = 'Bonjour à vous, vous avez cumulé plus de 10 cours en leçon de pilotage, nous vous proposons donc de passer un examen afin de recevoir au plus rapidement votre titre confimé.';
    $mail->Send();
     return true;
     
        
    } else {
    	 echo "pas bon";
        return false;
       
    }
}
