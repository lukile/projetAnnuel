<?php 
    session_start();

    include "header.php";
    include "connexion.php";
    
?>    

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Connexion
                  
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Accueil</a>
                    </li>
                    <li class="active">Connexion</li>
                </ol>
            </div>
        </div> 
<div class="main-login main-center">
                    <form class="form-horizontal" method="post" action="#">
                        
                        <div class="form-group">
                            <label for="mail" class="cols-sm-2 control-label">Mail</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="mail" id="mail"  placeholder="Adresse mail utilisée lors de l'inscription"/>
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
                        
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Connexion</button>
                        </div>
                        <div class="login-register">
                            <a href="forgetpwd.php">Mot de passe oublié ? Cliquez ici !</a>
                         </div>
                    </form>
                    <p id="message"><?= $message?:'' ?><p>
                        
                        <!--<script>
                            setTimeout("location.href='login.php';", 4000);
                        </script> -->
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

    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>          