<?php
    include"header.php";
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
          <form class="form-horizontal" method="post" action="change.php">
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
              <button type="submit" name="submit_reset" class="btn btn-primary btn-lg btn-block login-button">Envoyer</button>
            </div>
          </form>
        </div>
    <hr>
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