<?php
/* Indique le bon format des entêtes (par défaut apache risque de les envoyer au standard ISO-8859-1)*/

/* Initialisation de la variable du message de réponse*/
$message = null;

/* Récupération des variables issues du formulaire par la méthode post*/
$lastname = filter_input(INPUT_POST, 'lastname');
$firstname = filter_input(INPUT_POST, 'firstname');
$mail = filter_input(INPUT_POST, 'mail');
$pseudo = filter_input(INPUT_POST, 'pseudo');
$pass = md5(filter_input(INPUT_POST, 'pass'));
$pass_validation = md5(filter_input(INPUT_POST, 'pass_validation'));
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
                            $admin = 0;
                            $active = 0;
                            $applicationFee = 0;

                            $user = new User($admin,
                                             $_POST['firstname'],
                                             $_POST['lastname'],
                                             $_POST['pseudo'],
                                             $_POST['pass'], 
                                             $_POST['mail'], 
                                             $_POST['phone'],
                                             $activationKey,
                                             $active,
                                             $_POST['comments'],
                                             $applicationFee); 

                            InscriptionDAO::create($user);

                        }else{
                            $messag = 'Les deux mots de passe doivent être identiques';
                        }
                    }else{    
                        $messag = 'Le mot de passe doit faire plus de 4 caractères'; 
                    }
                }else{
                    $messag = 'Le format de l\'adresse mail est incorrect ';
                }
            }else{            
                $messag = 'Tous les champs doivent être renseignés';
            }
        }
?>
