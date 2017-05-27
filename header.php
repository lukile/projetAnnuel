<!DOCTYPE html>
<?php 
    require "function.php";
?>
<html lang="en">

<head>
    

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/logoAEN.png"/>
    <title>Aérodrome D'Evreux Normandie</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/css.css" rel="stylesheet" type="text/css">
    <script src="js/verify.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

            <!-- bootstrap Calendar Ne pas Toucher -->
    <link href="calendar/bootstrapv3/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="calendar/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <img class="navbar-brand" src="img/logoAENBlack.png"/>
                <a class="navbar-brand" href="index.php">Accueil</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                    <?php 
                    if(!isConnected()):
                    ?>
                    <li>
                        <a href="inscription.php">Inscription</a>
                    </li>    
                    <li>
                        <a href="login.php">Connexion</a>
                    </li> 
                    <li>
                        <a href="services.php">Services</a>
                    </li>
                    <li>
                        <a href="pricing.php">Tarifs</a>
                    </li>
                    <li>
                        <a href="about.php">A propos</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <li>
                        <a href="faq.php">FAQ</a>
                    </li>
                    <li>
                        <a href="about.php">A propos</a>
                    </li>
                    <?php endif;?>   
                    <?php if(isConnected()): ?>  
                    <li>
                        <a href="reservation.php">Reservation</a>
                    </li>
                    <li>
                        <a href="weather.php">Météo</a>
                    </li>
                    <li>
                        <a href="services.php">Services</a>
                    </li>
                    <li>
                        <a href="pricing.php">Tarifs</a>
                    <li>
                        <a href="about.php">A propos</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <li>
                        <a href="faq.php">FAQ</a>
                    </li>
                    <li>
                        <a href="logout.php">Deco</a>   
                    </li>
                    <?php endif;?>
                         
                </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>