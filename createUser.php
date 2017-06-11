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
                <h1 class="page-header">Création d'un utilisateur
                  
                </h1>
                <ol class="breadcrumb">
                    <li><a href="admin.html">Admin</a>
                    </li>
                    <li class="active">Création</li>
                </ol>
            </div>
        </div>
    
<div class="main-login main-center">
                    <form class="form-horizontal" method="POST" action="#">
                        
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
                            <label for="lastname" class="cols-sm-2 control-label">Nom</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="lastname" id="lastname"  placeholder="Nom"/>
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
                                    <input type="password" class="form-control" name="pass" id="pass"  placeholder="Saisir le mot de passe"/>
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
                            <label for="mail" class="cols-sm-2 control-label">E-mail</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="mail" id="mail"  placeholder="Email"/>
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