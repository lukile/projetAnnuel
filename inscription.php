<?php
/* Indique le bon format des entêtes (par défaut apache risque de les envoyer au standard ISO-8859-1)*/
header('Content-type: text/html; charset=UTF-8');

/* Initialisation de la variable du message de réponse*/
$message = null;

/* Récupération des variables issues du formulaire par la méthode post*/
$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$pseudo = filter_input(INPUT_POST, 'pseudo');
$pass = md5(filter_input(INPUT_POST, 'pass'));
$pass_validation = md5(filter_input(INPUT_POST, 'pass_validation'));
$phone = filter_input(INPUT_POST, 'phone');
$mail = filter_input(INPUT_POST, 'mail');
$comments = filter_input(INPUT_POST, 'comments');

$pass_length = strlen($pass);


/* Si le formulaire est envoyé */
if (isset($firstname, $lastname,$mail, $pseudo, $pass, $pass_validation, $phone, $comments)) {   
            

            /* Check que les valeurs ne sont pas vides ou composées uniquement d'espaces  */ 
            $firstname = trim($firstname) != '' ? $firstname : null;
            $lastname = trim($lastname) != '' ? $lastname : null;
            $pseudo = trim($pseudo) != '' ? $pseudo : null;
            $pass = trim($pass) != '' ? $pass : null;
            $pass_validation = trim($pass_validation) != '' ? $pass_validation : null;
            $phone = trim($phone) != '' ? $phone : null;
            $mail = trim($mail) != '' ? $mail : null;
            $comments = trim($comments) != '' ? $comments : null;

                /* Si les champs sont différents de null */
                if(isset($lastname, $firstname, $pseudo, $pass, $pass_validation, $phone, $mail)) {
                    /* Connexion au serveur : dans cet exemple, en local sur le serveur d'évaluation */
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL) ){
                        if($pass_length > 4){      
                            if($pass == $pass_validation){  
                            $hostname = "localhost";
                            $database = "aen";
                            $username = "root";
                            $password = "";
                                        
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
                                echo 'test 1';
                                /* préparation de l'insertion */
                                $insert_prep = $connect->prepare($insertion);

                                /* Exécution de la requête en passant les marqueurs et leur variables associées dans un tableau*/
                                $inser_exec = $insert_prep->execute(array(':firstname'=>$firstname, ':lastname'=>$lastname, ':pseudo'=>$pseudo,':pass'=>$pass, ':phone'=>$phone, ':mail'=>$mail, ':comments'=>$comments));
                                echo 'test 3';
                                /* Si l'insertion s'est faite correctement...*/
                                if ($inser_exec === true) {
                                    echo 'test 4';
                                    /* Démarre une session si aucune n'est déjà existante et enregistre le pseudo dans la variable de session $_SESSION['login'] qui donne au visiteur la possibilité de se connecter.  */
                                    if (!session_id()) session_start();
                                    echo 'test 5';
                                    $_SESSION['login'] = $mail;
                                    echo 'test 6';
                                    $message = 'Votre inscription est bien enregistrée.';
                                    /*header("Location: menu.php");
                                        exit();  */
                                }   
                            }else{   /* Le mail est déjà utilisé */
                                $message = 'Ce mail existe déjà. Veuillez en choisir un autre.';
                            }
                            }catch (PDOException $e){
                                $message = 'Problème lors d\'insertion';
                                echo 'Erreur : '.$e->getMessage();
                            }                
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

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aérodrome d'Evreux Normandie</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Accueil</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="inscription.php">Inscription</a>
                    </li>  
                    <li>
                        <a href="login.html">Connexion</a>
                    </li>     
                    <li>
                        <a href="about.html">A propos</a>
                    </li>
                    <li>
                        <a href="services.html">Services</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portfolio <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="portfolio-1-col.html">1 Column Portfolio</a>
                            </li>
                            <li>
                                <a href="portfolio-2-col.html">2 Column Portfolio</a>
                            </li>
                            <li>
                                <a href="portfolio-3-col.html">3 Column Portfolio</a>
                            </li>
                            <li>
                                <a href="portfolio-4-col.html">4 Column Portfolio</a>
                            </li>
                            <li>
                                <a href="portfolio-item.html">Single Portfolio Item</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="blog-home-1.html">Blog Home 1</a>
                            </li>
                            <li>
                                <a href="blog-home-2.html">Blog Home 2</a>
                            </li>
                            <li>
                                <a href="blog-post.html">Blog Post</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Pages <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="full-width.html">Full Width Page</a>
                            </li>
                            <li>
                                <a href="sidebar.html">Sidebar Page</a>
                            </li>
                            <li>
                                <a href="faq.html">FAQ</a>
                            </li>
                            <li>
                                <a href="404.html">404</a>
                            </li>
                            <li>
                                <a href="pricing.html">Pricing Table</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Inscription
                  
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Accueil</a>
                    </li>
                    <li class="active">Inscription</li>
                </ol>
            </div>
        </div>
    

<div class="main-login main-center">
                    <form class="form-horizontal" method="POST" action="#">
                        
                        <div class="form-group">
                            <label for="lastname" class="cols-sm-2 control-label">Nom</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="lastname" id="lastname"  placeholder="Nom"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="cols-sm-2 control-label">Prénom</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="firstname" id="firstname"  placeholder="Prénom"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mail" class="cols-sm-2 control-label">E-mail</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="mail" id="mail"  placeholder="Email"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pseudo" class="cols-sm-2 control-label">Utilisateur</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="pseudo" id="pseudo"  placeholder="Nom d'utilisateur"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass" class="cols-sm-2 control-label">Mot de passe</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="pass" id="pass"  placeholder="saisir le mot de passe"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass_validation" class="cols-sm-2 control-label">Confirmation</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="pass_validation" id="pass_validation"  placeholder="Confirmer le mot de passe"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="cols-sm-2 control-label">Téléphone</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone fa-lg" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="phone" id="phone"  placeholder="Numéro de téléphone"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comments" class="cols-sm-2 control-label">Commentaire</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-comment fa-lg" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="comments" id="comments"  placeholder="Commentaires(facultatif) "/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Valider</button>
                        </div>
                        <div class="login-register">
                            <a href="login.html">Déjà un compte ? Cliquez ici pour vous connectez !</a>
                         </div>
                    </form>
                    <p id = "message"><?= $message?:'' ?></p>
                </div>
   <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Projet annuel 2A, Lucile, Damien, Sacha</p>
                </div>
            </div>
    </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">x 

    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>          