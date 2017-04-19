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
$phone = filter_input(INPUT_POST, 'phone');
$mail = filter_input(INPUT_POST, 'mail');
$emergency_mail = filter_input(INPUT_POST, 'emergency_mail');
$comments = filter_input(INPUT_POST, 'comments');

$pass_length = strlen($pass);


/* Si le formulaire est envoyé */
if (isset($firstname, $lastname, $pseudo, $pass, $phone, $mail, $emergency_mail, $comments)) {   
    if(filter_var($mail, FILTER_VALIDATE_EMAIL) && filter_var($emergency_mail, FILTER_VALIDATE_EMAIL)){
        if($mail != $emergency_mail){
            if($pass_length > 4){

            /* aene que les valeurs ne sont pas vides ou composées uniquement d'espaces  */ 
            $firstname = trim($firstname) != '' ? $firstname : null;
            $lastname = trim($lastname) != '' ? $lastname : null;
            $pseudo = trim($pseudo) != '' ? $pseudo : null;
            $pass = trim($pass) != '' ? $pass : null;
            $phone = trim($phone) != '' ? $phone : null;
            $mail = trim($mail) != '' ? $mail : null;
            $emergency_mail = trim($emergency_mail) != '' ? $emergency_mail : null;
            $comments = trim($comments) != '' ? $comments : null;

                /* Si les champs sont différents de null */
                if(isset($lastname, $firstname, $pseudo, $pass, $mail, $emergency_mail)) {
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
                            $insertion = "INSERT INTO user(firstname, lastname, pseudo,pass, phone, mail, emergency_mail, comments, registration_date) VALUES(:firstname, :lastname, :nom, :password, :phone, :mail, :emergency_mail, :comments, NOW())";
                            
                            /* préparation de l'insertion */
                            $insert_prep = $connect->prepare($insertion);
                            
                            /* Exécution de la requête en passant les marqueurs et leur variables associées dans un tableau*/
                            $inser_exec = $insert_prep->execute(array(':firstname'=>$firstname, ':lastname'=>$lastname, ':nom'=>$pseudo,':password'=>$pass, ':phone'=>$phone, ':mail'=>$mail, ':emergency_mail'=>$emergency_mail, ':comments'=>$comments));
                            
                            /* Si l'insertion s'est faite correctement...*/
                            if ($inser_exec === true) {
                                /* Démarre une session si aucune n'est déjà existante et enregistre le pseudo dans la variable de session $_SESSION['login'] qui donne au visiteur la possibilité de se connecter.  */
                                if (!session_id()) session_start();
                                $_SESSION['login'] = $pseudo;
                            
                                /* A MODIFIER Remplacer le '#' par l'adresse de votre page de destination, sinon ce lien indique la page actuelle.*/
                                $message = 'Votre inscription est bien enregistrée.';
                                /*ou redirection vers une page en cas de succès ex : menu.php*/
                                /*header("Location: menu.php");
                                    exit();  */
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                        <a href="subscribe.html">Inscription</a>
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
                    <form class="form-horizontal" method="POST" action="index.html">
                        
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Nom</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="firstname" id="name"  placeholder="Nom"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Prénom</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="lastname" id="name"  placeholder="Prénom"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">E-mail</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="mail" id="email"  placeholder="Email"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="cols-sm-2 control-label">Utilisateur</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="pseudo" id="username"  placeholder="Nom d'utilisateur"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="cols-sm-2 control-label">Mot de passe</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="pass" id="password"  placeholder="saisir le mot de passe"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirm" class="cols-sm-2 control-label">Confirmation</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="pass" id="confirm"  placeholder="Confirmer le mot de passe"/>
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

    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>          