<?php 
require_once(__DIR__. '/class/DatabaseManager.php');
require_once(__DIR__. '/class/User.php');

class InscriptionDAO{
    private function __construct(){}

    public static function create(User $user){
        $manager = DatabaseManager::getsharedInstance();
        $message = null;
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
                /* Résultat du comptage = 0 pour ce mail, on peut donc l'enregistrer */
                            
                /* Pour enregistrer la date actuelle (date/heure/minutes/secondes) on peut utiliser directement la fonction mysql : NOW()*/                
                $insertion = $manager->exec("INSERT INTO user(firstname, lastname, pseudo, pass, mail, phone, comments, registration_date) VALUES(?,?,?,?,?,?,?,NOW())", [
                    $user->getFirstname(),
                    $user->getLastname(),
                    $user->getLogin(),
                    md5($user->getPassword()),
                    $user->getMail(),                                    
                    $user->getPhone(),
                    $user->getComments()
                    ]);
                                
                /* Si l'insertion s'est faite correctement...*/
                    if ($insertion === true) {
                                        
                        /* Démarre une session si aucune n'est déjà existante et enregistre le pseudo dans la variable de session $_SESSION['login'] qui donne au visiteur la possibilité de se connecter.  */
                        if (!session_id())
                            session_start();
                                        
                        $_SESSION['login'] = $mail;
                                        
                         echo 'Votre inscription est bien enregistrée.';
                                    
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