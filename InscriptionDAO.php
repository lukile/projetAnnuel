<?php 
require_once(__DIR__. '/class/DatabaseManager.php');
require_once(__DIR__. '/class/User.php');

class InscriptionDAO{
    private function __construct(){}

    public static function create(User $user){
        $manager = DatabaseManager::getsharedInstance();
        $mail = filter_input(INPUT_POST, 'mail');
        $mail = trim($mail) != '' ? $mail : null;

         /* Requête pour compter le nombre d'enregistrements répondant à la clause : champ du mail de la table = mail posté dans le formulaire */
        $requete = "SELECT count(*) FROM user WHERE mail = ?";
        $connect = $manager->connect();
        try{
            /* préparation de la requête*/
            $req_prep = $connect->prepare($requete);
                    
            /* Exécution de la requête en passant la position du marqueur et sa variable associée dans un tableau*/
            $req_prep->execute(array(0=>$mail));
                    
            /* Récupération du résultat */
            $resultat = $req_prep->fetchColumn();
                    
            if ($resultat == 0){ 
                $activationKey = md5(uniqid());
                $user->setActivationKey($activationKey);
                /* Résultat du comptage = 0 pour ce mail, on peut donc l'enregistrer */
                            
                /* Pour enregistrer la date actuelle (date/heure/minutes/secondes) on peut utiliser directement la fonction mysql : NOW()*/                
                $insertion = $manager->exec("INSERT INTO user(admin,firstname, lastname, pseudo, pass, mail, phone, activation_key, active, comments, registration_date, application_fee) VALUES(?,?,?,?,?,?,?,?,?,?, NOW(),?)", [
                    $user->getAdmin(),
                    $user->getFirstname(),
                    $user->getLastname(),
                    $user->getLogin(),
                    md5($user->getPassword()),
                    $user->getMail(),                                    
                    $user->getPhone(),
                    $user->getActivationKey(),
                    $user->getActive(),
                    $user->getComments(),
                    $user->getApplicationFee(),
                    ]);
                            
            /* Si l'insertion s'est faite correctement...*/
                if ($insertion === true) {
                                    
                    /* Démarre une session si aucune n'est déjà existante et enregistre le pseudo dans la variable de session $_SESSION['login'] qui donne au visiteur la possibilité de se connecter.  */
                    if (!session_id())
                        session_start();
                                    
                    $_SESSION['login'] = $mail;

                    ?>
                    <div class="container">
            <!-- Page Heading/Breadcrumbs -->
            <div class="row">
                <div class="col-lg-12">
                        </li>
                    </ol>
                    <div>
                        <h4>Veuillez vérifiez dans votre boite mail le lien pour activer votre mot de passe. Pensez à verifier vos spams !</h4><br>
                        <h5>Redirection vers la page d'accueil, vous pouvez également fermer cette fenêtre. </h5>
                    </div>
                </div>
            </div>
            <?php
                    echo 'Votre inscription est bien enregistrée.';

                        $link="<a href='http://localhost/projects/projetAnnuel/validationemail.php?mail=".$mail."&activationKey=".$activationKey."'>ici</a>";
    
                    require_once('phpmailer/PHPMailerAutoload.php');

                        $message = new PHPMailer();
                        $message->CharSet = "utf-8";
                        $message->IsSMTP();
                        $message->SMTPAuth = true;                  
                        $message->Username = "aensld@zoho.eu";
                        $message->Password = "!PassAENsld";
                        $message->SMTPSecure = "tls";  
                        $message->Host = "smtp.zoho.eu";
                        $message->Port = 587;
                        $message->From=$message->Username;
                        $message->FromName='Equipe AEN';
                        $message->AddAddress($mail,$mail);
                        $message->Subject  =  'Activation de compte';
                        $message->IsHTML(true);
                        $message->Body    = 'Cliquez sur le lien suivant pour activer votre compte  : '.$link.'';
                        $message->Send();

            ?>
             <script>
            setTimeout("location.href='index.php';", 4000);
            </script>    

            <?php
                                
                }else{
                   echo 'Un problème est survenue lors de l\'enregistrement';
                }
            /* Le mail est déjà utilisé */            
            }else{   
                echo 'Ce mail existe déjà. Veuillez en choisir un autre.';
            }
                                
        }catch (PDOException $e){
            $message = 'Problème lors d\'insertion';
            echo 'Erreur : '.$e->getMessage();
        }  
    }
    
}

?>