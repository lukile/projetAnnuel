<?php
/* Indique le bon format des entêtes (par défaut apache risque de les envoyer au standard ISO-8859-1)*/
header('Content-type: text/html; charset=UTF-8');

/* Initialisation de la variable du message de réponse*/
$message = null;

/* Récupération des variables issues du formulaire par la méthode post*/
$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$pseudo = filter_input(INPUT_POST, 'pseudo');
$pass = filter_input(INPUT_POST, 'pass');
//$phone = filter_input(INPUT_POST, 'phone');
$mail = filter_input(INPUT_POST, 'mail');
//$emergency_mail = filter_input(INPUT_POST, 'emergency_mail');
//$comments = filter_input(INPUT_POST, 'comments');

$pass_length = strlen($pass);


/* Si le formulaire est envoyé */
if (isset($firstname, $lastname, $pseudo, $pass, $mail)) {   
    if(filter_var($mail, FILTER_VALIDATE_EMAIL) && filter_var($emergency_mail, FILTER_VALIDATE_EMAIL)){
            if($pass_length > 4){

            /* aene que les valeurs ne sont pas vides ou composées uniquement d'espaces  */ 
            $firstname = trim($firstname) != '' ? $firstname : null;
            $lastname = trim($lastname) != '' ? $lastname : null;
            $pseudo = trim($pseudo) != '' ? $pseudo : null;
            $pass = trim($pass) != '' ? $pass : null;
            //$phone = trim($phone) != '' ? $phone : null;
            $mail = trim($mail) != '' ? $mail : null;
           // $emergency_mail = trim($emergency_mail) != '' ? $emergency_mail : null;
            //$comments = trim($comments) != '' ? $comments : null;

                /* Si les champs sont différents de null */
                if(isset($lastname, $firstname, $pseudo, $pass, $mail)) {
                    /* Connexion au serveur : dans cet exemple, en local sur le serveur d'évaluation
                    A MODIFIER avec vos valeurs */
                    $hostname = "localhost";
                    $database = "aen";
                    $username = "root";
                    $password = "";
                    
                    /* Configuration des options de connexion */
                    
                    /* Désactive l'éumlateur de requêtes préparées (hautement recommandé)  */
                    $pdo_options[PDO::ATTR_EMULATE_PREPARES] = false;
                    
                    /* Active le mode exception */
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    
                    /* Indique le charset */
                    $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
                    
                    /* Connexion */
                    try{
                        $connect = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password, $pdo_options);
                    }catch (PDOException $e){
                        exit('problème de connexion à la base');
                    }
                        
                    
                    /* Requête pour compter le nombre d'enregistrements répondant à la clause : champ du pseudo de la table = pseudo posté dans le formulaire */
                    $requete = "SELECT count(*) FROM user WHERE pseudo = ?";
                    
                    try{
                        /* préparation de la requête*/
                        $req_prep = $connect->prepare($requete);
                    
                        /* Exécution de la requête en passant la position du marqueur et sa variable associée dans un tableau*/
                        $req_prep->execute(array(0=>$pseudo));
                    
                        /* Récupération du résultat */
                        $resultat = $req_prep->fetchColumn();
                    
                        if ($resultat == 0){ 
                            /* Résultat du comptage = 0 pour ce pseudo, on peut donc l'enregistrer */
                        
                            /* Pour enregistrer la date actuelle (date/heure/minutes/secondes) on peut utiliser directement la fonction mysql : NOW()*/
                            $insertion = "INSERT INTO user(firstname, lastname, pseudo,pass, mail, registration_date) VALUES(:firstname, :lastname, :nom, :password, :mail, NOW())";
                            
                            /* préparation de l'insertion */
                            $insert_prep = $connect->prepare($insertion);
                            
                            /* Exécution de la requête en passant les marqueurs et leur variables associées dans un tableau*/
                            $inser_exec = $insert_prep->execute(array(':firstname'=>$firstname, ':lastname'=>$lastname, ':nom'=>$pseudo,':password'=>$pass, ':mail'=>$mail));
                            
                            /* Si l'insertion s'est faite correctement...*/
                            if ($inser_exec === true) {
                                /* Démarre une session si aucune n'est déjà existante et enregistre le pseudo dans la variable de session $_SESSION['login'] qui donne au visiteur la possibilité de se connecter.  */
                                if (!session_id()) session_start();
                                $_SESSION['login'] = $pseudo;
                            
                                /* A MODIFIER Remplacer le '#' par l'adresse de votre page de destination, sinon ce lien indique la page actuelle.*/
                                $message = 'Votre inscription est bien enregistrée.';
                                /*ou redirection vers une page en cas de succès ex : menu.php*/
                                header("Location: index.html");
                                    exit();  
                            }   
                        }else{   /* Le pseudo est déjà utilisé */
                            $message = 'Ce pseudo existe déjà, Veuillez en choisir un autre.';
                        }
                    }catch (PDOException $e){
                        $message = 'Problème lors d\'insertion';
                        echo 'Erreur : '.$e->getMessage();
                    }	
                
                }else {    
                    $message = 'Tous les champs doivent êtres renseignés';
                }
            }else{
                $message = 'Le mot de passe doit faire plus de 4 caractères'; 
            }
        }else{
            $message = 'Les deux adresses mails doivent êtres différentes';
        }
    }else{
        $message = 'Le format de l\'adresse mail est incorrect';
    }

?>
