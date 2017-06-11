<?php  
    session_start();

    header('Content-type: text/html; charset=UTF-8');

    include "header.php";
    include "createInscription.php";

    
?>  
  
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
                <div>
                    <h4>Pour pouvoir participer aux services, inscrivez-vous</h4>
                </div>
            </div>
        </div>
    

<div class="main-login main-center">
                    <form class="form-horizontal" method="POST" action="#">
                        
                        <div class="form-group">
                            <label for="firstname" class="cols-sm-2 control-label">Prénom</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="firstname" id="firstname"  placeholder="Prénom" required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="cols-sm-2 control-label">Nom</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="lastname" id="lastname"  placeholder="Nom" required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pseudo" class="cols-sm-2 control-label">Utilisateur</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="pseudo" id="pseudo"  placeholder="Nom d'utilisateur" required/>
                                </div>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="pass" class="cols-sm-2 control-label">Mot de passe</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="pass" id="pass"  placeholder="Saisir le mot de passe"  onblur="verifyPassLength()" required/>
                                    <div id="msgLength"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass_validation" class="cols-sm-2 control-label">Confirmation</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="pass_validation" id="pass_validation"  placeholder="Confirmer le mot de passe" onBlur="verifyPassAgreement()" required/>
                                   <div id="msgAgreement"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="mail" class="cols-sm-2 control-label">E-mail</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="mail" id="mail"  placeholder="Email" required onblur="validMail(this)"/>
                                    <div id="msgMail"></div>
                                </div>
                            </div>
                        </div>     
                       
                        <div class="form-group">
                            <label for="phone" class="cols-sm-2 control-label">Téléphone</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone fa-lg" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="phone" id="phone"  placeholder="Numéro de téléphone" required/>
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
                            <a href="login.php">Déjà un compte ? Cliquez ici pour vous connectez !</a>
                         </div>
                    </form>
                    <p id = "message"><?= $message?:'' ?></p>
                </div>
                
<?php 
    include "footer.php";
?>   

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>          