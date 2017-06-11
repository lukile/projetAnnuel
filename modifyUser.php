<?php  
    session_start();

    header('Content-type: text/html; charset=UTF-8');

    include "header.php";
?>    
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Modification d'un utilisateur
                  
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Accueil</a>
                    </li>
                    <li class="active">Modification</li>
                </ol>
               
            </div>
        </div>
    

<div class="main-login main-center">

    <?php

    if(isset($_GET['id'])){
    $fetch_id = connect()->prepare("SELECT id, admin, firstname, lastname, pseudo, pass, mail, phone, active, comments, application_fee FROM user WHERE id = :id");
    $fetch_id->execute([':id'=>$_GET['id']]);
    $_POST = $fetch_id->fetch();
    }

    ?>
                    <form class="form-horizontal" method="POST" action="modifyUser.php">
                        
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo (isset( $_POST["id"] ))? $_POST["id"]:"";?>"/>
                        </div>

                        <div class="form-group">
                            <label for="admin" class="cols-sm-2 control-label">Admin</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="admin" id="admin"  placeholder="Admin : 0 -> non 1 -> oui" value="<?php echo (isset($_POST['admin'])) ? $_POST['admin']:"";?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">    
                            <label for="firstname" class="cols-sm-2 control-label">Prénom</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="firstname" id="firstname"  placeholder="Prénom" value="<?php echo (isset($_POST['firstname'])) ? $_POST['firstname']:"";?>"/>
                                </div>
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label for="lastname" class="cols-sm-2 control-label">Nom</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="lastname" id="lastname"  placeholder="Nom"  value="<?php echo (isset($_POST['lastname'])) ? $_POST['lastname']:"";?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pseudo" class="cols-sm-2 control-label">Utilisateur</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="pseudo" id="pseudo"  placeholder="Nom d'utilisateur" value="<?php echo (isset($_POST['pseudo'])) ? $_POST['pseudo']:"";?>"/>
                                </div>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="pass" class="cols-sm-2 control-label">Mot de passe</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="pass" id="pass"  placeholder="Saisir le mot de passe" required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass_validation" class="cols-sm-2 control-label">Confirmation</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="pass_validation" id="pass_validation"  placeholder="Confirmer le mot de passe" required/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="mail" class="cols-sm-2 control-label">E-mail</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="mail" id="mail"  placeholder="Email"value="<?php echo (isset($_POST['mail'])) ? $_POST['mail']:"";?>"/>
                                </div>
                            </div>
                        </div>     
                       
                        <div class="form-group">
                            <label for="phone" class="cols-sm-2 control-label">Téléphone</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone fa-lg" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="phone" id="phone"  placeholder="Numéro de téléphone" value="<?php echo (isset($_POST['phone'])) ? $_POST['phone']:"";?>"/>
                                </div>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="active" class="cols-sm-2 control-label">Activation compte</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="active" id="active"  placeholder="compte activé : 1/désactivé : 0" value="<?php echo (isset($_POST['active'])) ? $_POST['active']:"";?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comments" class="cols-sm-2 control-label">Commentaire</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-comment fa-lg" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="comments" id="comments"  placeholder="Commentaires(facultatif) " value="<?php echo (isset($_POST['comments'])) ? $_POST['comments']:"";?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="application_fee" class="cols-sm-2 control-label">Frais de dossier</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-eur" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="application_fee" id="application_fee"  placeholder="en €" value="<?php echo (isset($_POST['application_fee'])) ? $_POST['application_fee']:"";?>"/>
                                </div>
                            </div>
                        </div>


                        <?php  $query = connect()->prepare("UPDATE user SET admin=:admin, firstname=:firstname, lastname=:lastname, pseudo=:pseudo, pass=:pass, mail=:mail, phone=:phone, active=:active, comments=:comments, application_fee=:application_fee WHERE id=:id");
                                $query->execute([':admin'=>$_POST['admin'],':firstname'=>$_POST['firstname'],':lastname'=>$_POST['lastname'], ':pseudo'=>$_POST['pseudo'],':pass'=>md5($_POST['pass']),':mail'=>$_POST['mail'],':phone'=>$_POST['phone'], ':comments'=>$_POST['comments'], ':active'=>$_POST['active'], ':application_fee'=>$_POST['application_fee'],':id'=>$_POST['id']]);?>

                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Valider</button>
                        </div>
                     
                    </form>
<!--                    <p id = "message"><?= $message?:'' ?></p>
-->                </div>
                
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