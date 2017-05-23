<?php
    require_once(__DIR__. '/class/DatabaseManager.php');
    
    include"header.php";
    session_start();

    $manager = DatabaseManager::getsharedInstance();
    $connection = $manager->connect();
    $mail = mysqli_real_escape_string($connection,$_POST['mail']);

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) // Validate email address
    {
        $message =  "Adresse email invalide";
    }
    else
    {
        $query = "SELECT id FROM user where mail='".$mail."'";
        $result = mysqli_query($connection,$query);
        $Results = mysqli_fetch_array($result);

        if(count($Results)>=1)
        {
            $encrypt = md5(1290*3+$Results['id']);
            $message = "Le lien pour renitialiser votre mot de passe a été envoyé par mail.";
            $to=$mail;
            $subject="Mot de passe oublié";
            $from = 'recoveypassword@noreply.com';
            $body='Hi, <br/> <br/>Votre ID membre est le  '.$Results['id'].' <br><br>Cliquez ici pour rénitialiser votre mot de passe
                   http://demo.phpgang.com/login-signup-in-php/reset.php?encrypt='.$encrypt.'&action=reset   <br/> <br/>--<br>PHPGang.com<br>Solve your problems.';
            $headers = "De: " . strip_tags($from) . "\r\n";
            $headers .= "Réponse à: ". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            mail($to,$subject,$body,$headers);
        }
        else
        {
            $message = "Compte introuvable veuillez vous inscrire";
        }
    }
?>
?>

    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Mot de passe oublié
                  
                </h1>
                <ol class="breadcrumb">
                    <li><p>Nous utilisons l'email associé à votre compte afin de renitialiser votre mot de passe</p>
                    </li>
                    
                </ol>
            </div>
        </div>
    

      <div class="main-login main-center">
          <form class="form-horizontal" method="post" action="#">
            <div class="form-group">
              <label for="mail" class="cols-sm-2 control-label">E-mail</label>
                <div class="cols-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="mail" id="mail"  placeholder="Email"/>
                </div>
              </div>
            </div>

            <div class="form-group ">
              <button type="button" class="btn btn-primary btn-lg btn-block login-button">Envoyer</button>
            </div>
            
          </form>
        </div>
    
    <hr>


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