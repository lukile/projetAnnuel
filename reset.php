<?php 
require_once(__DIR__. '/class/DatabaseManager.php');
include"header.php";

            $hostname = "localhost";
            $database = "aen";
            $username = "root";
            $password = "";

try{
    $connect = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
 }catch (PDOException $e){
        exit('problème de connexion à la base');
      }


if($_GET['key'] && $_GET['reset'])
{
  $mail = $_GET['key'];
  $pass = $_GET['reset'];

  $query = $connect->prepare("SELECT mail,pass FROM user WHERE mail = '$mail' and md5(pass)='$pass'");
  $query->execute(["mail" => $_GET['key']]);
  $result = $query->fetchAll(PDO::FETCH_ASSOC);

    if(count($result) == 1)
    {
    ?>  
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Rénitialisation mot de passe
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Accueil</a>
                    </li>
                    <li class="active">Rénitialisation</li>
                </ol>
            </div>
        </div>

         <div class="main-login main-center">
                    <form class="form-horizontal" method="POST" action="updatepwd.php" name="formInscription">
                              <input type="hidden" class="form-control" value="<?php echo $mail;?>" name="mail" id="pass_reset"  placeholder="Saisir le mot de passe" required onBlur="verifyPassLength()"/><br/>
                        </div>

                         <div class="form-group">
                            <label for="pass" class="cols-sm-2 control-label"> Nouveau mot de passe</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="pass_reset" id="pass_reset"  placeholder="Saisir le mot de passe" required onBlur="verifyPassLength()"/><br/>
                                        <div id="msgLength"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass_validation" class="cols-sm-2 control-label">Confirmation du nouveau mot de passe</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="pass_validation_reset" id="pass_validation_reset" placeholder="Confirmer le mot de passe" required onBlur="verifyPassAgreement()"/>
                                    <div id="msgAgreement"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <button type="submit" name="resetPassword" class="btn btn-primary btn-lg btn-block login-button">Valider</button>
                        </div>
                </div>
    <?php
  }
}
?>




