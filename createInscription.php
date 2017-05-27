<?php
ini_set("SMTP","smtp.gmail.com");
ini_set("smtp_port","25");

/* Indique le bon format des entêtes (par défaut apache risque de les envoyer au standard ISO-8859-1)*/

/* Initialisation de la variable du message de réponse*/
$message = null;
$res = [];

/* Récupération des variables issues du formulaire par la méthode post*/
$lastname = filter_input(INPUT_POST, 'lastname');
$firstname = filter_input(INPUT_POST, 'firstname');
$mail = filter_input(INPUT_POST, 'mail');
$pseudo = filter_input(INPUT_POST, 'pseudo');
$pass = filter_input(INPUT_POST, 'pass');
$pass_validation = filter_input(INPUT_POST, 'pass_validation');
$phone = filter_input(INPUT_POST, 'phone');
$comments = filter_input(INPUT_POST, 'comments');

$pass_length = strlen($pass);


/* Si le formulaire est envoyé */
if (isset($lastname, $firstname, $mail, $pseudo, $pass, $pass_validation, $phone, $comments)) {   
            

            /* Check que les valeurs ne sont pas vides ou composées uniquement d'espaces  */ 
            $lastname = trim($lastname) != '' ? $lastname : null;
            $firstname = trim($firstname) != '' ? $firstname : null;
            $mail = trim($mail) != '' ? $mail : null;
            $pseudo = trim($pseudo) != '' ? $pseudo : null;
            $pass = trim($pass) != '' ? $pass : null;
            $pass_validation = trim($pass_validation) != '' ? $pass_validation : null;
            $phone = trim($phone) != '' ? $phone : null;
            $comments = trim($comments) != '' ? $comments : null;

                /* Si les champs sont différents de null */
                if(isset($lastname, $firstname, $pseudo, $pass, $pass_validation, $phone, $mail)) {
                    /* Connexion au serveur : dans cet exemple, en local sur le serveur d'évaluation */
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL) ){
                        if($pass_length > 4){
                            if($pass == $pass_validation){
                            require_once(__DIR__. '/InscriptionDAO.php');
                            $activationKey = md5(uniqid());

                            $user = new User($_POST['firstname'],
                                             $_POST['lastname'],
                                             $_POST['pseudo'],
                                             $_POST['pass'], 
                                             $_POST['mail'], 
                                             $_POST['phone'],
                                             $activationKey,
                                             $_POST['comments']); 

                            InscriptionDAO::create($user);
$mail = 'lucile.1988.ls@gmail.com'; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";
$message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Hey mon ami !";
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"WeaponsB\"<lucile.1988.ls@gmail.com>".$passage_ligne;
$header.= "Reply-to: \"WeaponsB\" <lucile.1988.ls@gmail.com>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
 
//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
//==========
                            
                             
                        }else{
                            $message = 'Les deux mots de passe doivent être identiques';
                        }
                    }else{    
                        $message = 'Le mot de passe doit faire plus de 4 caractères'; 
                    }
                }else{
                    $message = 'Le format de l\'adresse mail est incorrect ';
                }
            }else{            
                $message = 'Tous les champs doivent être renseignés';
            }
        }
?>
