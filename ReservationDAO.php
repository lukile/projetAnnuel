<?php 
require_once(__DIR__. '/DatabaseManager.php');

class ReservationDAO{
    private function __construct(){}

    public static function create(User $user){
        $manager = DatabaseManager::getsharedInstance();
         /* Requête pour compter le nombre d'enregistrements répondant à la clause : champ du pseudo de la table = pseudo posté dans le formulaire */
                    $requete = "SELECT count(*) FROM user WHERE mail = ?";
                        
                            try{
                            /* préparation de la requête*/
                            $req_prep = $connect->prepare($requete);
                        
                            /* Exécution de la requête en passant la position du marqueur et sa variable associée dans un tableau*/
                            $req_prep->execute(array(0=>$mail));
                        
                            /* Récupération du résultat */
                            $resultat = $req_prep->fetchColumn();
                        
                            if ($resultat == 0){ 
                                /* Résultat du comptage = 0 pour ce pseudo, on peut donc l'enregistrer */
                            
                                /* Pour enregistrer la date actuelle (date/heure/minutes/secondes) on peut utiliser directement la fonction mysql : NOW()*/
                                $insertion = "INSERT INTO user(firstname, lastname, pseudo, pass, phone, mail, comments, registration_date) VALUES(:firstname, :lastname, :pseudo, :pass, :phone, :mail, :comments, NOW())";
                                
                                /* préparation de l'insertion */
                                $insert_prep = $connect->prepare($insertion);

                                /* Exécution de la requête en passant les marqueurs et leur variables associées dans un tableau*/
                                $inser_exec = $insert_prep->execute(array(':firstname'=>$firstname, ':lastname'=>$lastname, ':pseudo'=>$pseudo,':pass'=>$pass, ':phone'=>$phone, ':mail'=>$mail, ':comments'=>$comments));
                                
                                /* Si l'insertion s'est faite correctement...*/
                                if ($inser_exec === true) {
                                    
                                    /* Démarre une session si aucune n'est déjà existante et enregistre le pseudo dans la variable de session $_SESSION['login'] qui donne au visiteur la possibilité de se connecter.  */
                                    if (!session_id()) session_start();
                                    
                                    $_SESSION['login'] = $mail;
                                    
                                    $message = 'Votre inscription est bien enregistrée.';
                                    /*header("Location: menu.php");
                                        exit();  */
                                }else{   /* Le mail est déjà utilisé */
                                    $message = 'Ce mail existe déjà. Veuillez en choisir un autre.';
                                }
                                }   
                            }else{   /* Le mail est déjà utilisé */
                                $message = 'Ce mail existe déjà. Veuillez en choisir un autre.';
                            }
                            }catch (PDOException $e){
                                $message = 'Problème lors d\'insertion';
                                echo 'Erreur : '.$e->getMessage();
                            }                
}

?>