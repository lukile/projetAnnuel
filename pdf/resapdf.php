<?php 
session_start();
?>
<!DOCTYPE html>
<?php 
    require "../function.php";
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/css.css" rel="stylesheet" type="text/css">
    <script src="../js/verify.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING:../ Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

            <!-- bootstrap Calendar Ne pas Toucher -->
    <link href="calendar/bootstrapv3/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="calendar/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

</head>
<?php
include "../createReservations.php";
?>
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Réservation </h1>
                <ol class="breadcrumb">
                    <li><a href="../index.php">Accueil</a>
                    </li>
                    <li class="active">Réservation</li>

                </ol>
            </div>
        </div>
            
<table class="table">
    <thead>
        <tr>
            <th>Avion</th>
            <th>Taille</th>
            <th>Masse maximum</th>
            <th>Carburant</th>
            <th>Groupe Acoustique</th>
            <th>Catégorie</th>
        </tr>
    </thead>
    <tbody>
    <form method="POST" name="form1" action="resa.php" target="_blank" >
        <tr>
            <th scope="row">
                <select name="planeSelecter" class="selectpricker" required>
                    <option value=""disabled selected> Type d'Avion</option>
                    <option value="monoBiTurbine">Mono-turbine/Bi-Turbine</option>
                    <option value="monoMulti">Réacteur mono/multi</option>
                </select>
            </th>
            <th scope="row">
                <input type="text" name="planeLength" placeholder="Taille appareil en mètre" required/>
            </th>
            <th>
                <input type="text" name="maxWeight" placeholder="Poids max au décollage" required/>
            </th>
            <th scope="row">
                <select name="fuel" class="selectpricker" required>
                    <option value=""disabled selected> Type de carburant</option>
                    <option value="essJST">JETAI Sans TIC</option>
                    <option value="JAT">JETAI A1 +TRIC</option>
                    <option value="AV100">AVGAS 100LL</option>
                    <option value="AV100T">AVGAS 100LL TIC</option>
                </select>
            </th>
             <th scope="row">
                <select name="acousticGroup" class="selectpricker" required>
                    <option value=""disabled selected> Groupe Acoustique</option>
                    <option value="ga1">1</option>
                    <option value="ga2">2</option>
                    <option value="ga3">3</option>
                    <option value="ga4">4</option>
                    <option value="ga5a">5a</option>
                    <option value="ga5b">5b</option>
                </select>
            </th>
            <th scope="row">
                <select name="category" class="selectpricker" required>
                    <option value=""disabled selected>Catégorie</option>
                    <option value="cat1">1</option>
                    <option value="cat2">2</option>
                    <option value="cat3">3</option>
                </select>
            </th>
        </tr>

    </tbody>       
<table>        

<table class="table">
    <thead>
        <tr>
            <th>Services</th>
            <th>Choix</th>
            <th>A partir de</th>
            <th>Date</th>
            <th>Heure</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Stationnement
                <input type="hidden" id="priceStat" name="priceStat" value="2.76" />
            </th>
            <td>
                <fieldset class="form-group">
                    <input type="checkbox" id="checkBoxStat" name="services[]" value="parking">
                    <label for="checkBoxStat"></label>
                </fieldset>
            </td>
            <td>2.76€ /m²</td>
            <td>
            <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                    <input size="16" type="text" value="" placeholder="date de debut" readonly name="statDateDebut" id="statDateDebut">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>

                <div class="controls input-append date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                    <input size="16" type="text" value="" placeholder="Date de fin" readonly name="statDateFin" id="statDateFin">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:00:00" data-link-field="dtp_input3" data-link-format="hh:00:00">
                    <input size="16" type="text" value="" placeholder="heure d'arrivée" readonly name="statHeureDebut" id="statHeureDebut">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-time icon-time"></i></span>
                </div>
                <input type="hidden" id="dtp_input3" value="" /><br/>

            </div>
             <div class="controls input-append date form_time" data-date="" data-date-format="hh:00:00" data-link-field="dtp_input3" data-link-format="hh:00:00">
                    <input size="16" type="text" value="" placeholder="heure de départ" readonly name="statHeureFin" id="statHeureFin">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-time icon-time"></i></span>
                </div>
                <input type="hidden" id="dtp_input3" value="" /><br/>
            </td>
        </tr>
        <tr>
            <th scope="row">Avitaillement
                <input type="hidden" id="priceAvi" name="priceStat" value="2" />
            </th>
            <td>
                <fieldset class="form-group">
                    <input type="checkbox" id="checkBoxAvi" name="services[]" value="refueling">
                    <label for="checkBoxAvi"></label>
                </fieldset>
            </td>
            <td>1.01€ / L</td>
            <td>
                <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                    <input size="16" type="text" value="" readonly name="aviDate" id="aviDate">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:00:00" data-link-field="dtp_input3" data-link-format="hh:00:00">
                    <input size="16" type="text" value="" readonly name="aviHeure" id="aviHeure">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-time icon-time"></i></span>
                </div>
                <input type="hidden" id="dtp_input3" value="" /><br/>
            </div>
            </td>
            </td>
        </tr>
        <tr>
            <th scope="row">Atterrissage
                <input type="hidden" id="priceAvi" name="priceStat" value="2" />
            </th>
            <td>
                <fieldset class="form-group">
                    <input type="checkbox" id="checkBoxAtt" name="services[]" value="landing">
                    <label for="checkBoxAvi"></label>
                </fieldset>
            </td>
            <td>21.60€</td>
            <td>
                <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                    <input size="16" type="text" value="" readonly name="attDate" id="attDate">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">

                <div class="controls input-append date form_time" data-date="" data-date-format="hh:00:00" data-link-field="dtp_input3" data-link-format="hh:00:00">
                    <input size="16" type="text" value="" readonly name="attHeure" id="attHeure">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-time icon-time"></i></span>
                </div>
                <input type="hidden" id="dtp_input3" value="" /><br/>
            </div>
            </td>
            </td>
        </tr>
        <tr>
            <th scope="row">Nettoyage d'intérieur</th>
            <td>
                <fieldset class="form-group">
                    <input type="checkbox" id="checkBoxNet" name="services[]" value="inside_cleaning">
                    <label for="checkBoxNet"></label>
                </fieldset>
            </td>
            <td><a href="contact.php">*Contacter le support</td>
            <td>
                <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                    <input size="16" type="text" value="" readonly name="netDate" id="netDate">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:00:00" data-link-field="dtp_input3" data-link-format="hh:00:00">
                    <input size="16" type="text" value="" readonly name="netHeure" id="netHeure">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-time icon-time"></i></span>
                </div>
                <input type="hidden" id="dtp_input3" value="" /><br/>
            </div>
            </td>
            </td>
        </tr>
        <tr>
            <th scope="row">Parachutisme</th>
            <td>
                <fieldset class="form-group">
                    <input type="checkbox" id="checkBoxPara" name="services[]" value="parachuting">
                    <label for="checkBoxPara"></label>
                </fieldset>
            </td>
            <td>60€</td>
            <td>
                <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                    <input size="16" type="text" value="" readonly name="paraDate" id="paraDate">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:00:00" data-link-field="dtp_input3" data-link-format="hh:00:00">
                    <input size="16" type="text" value="" readonly name="paraHeure" id="paraHeure">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-time icon-time"></i></span>
                </div>
                <input type="hidden" id="dtp_input3" value="" /><br/>
            </div>
            </td>
            </td>
        </tr>
        <tr>
            <th scope="row">ULM</th>
            <td>
                <fieldset class="form-group">
                    <input type="checkbox" id="checkBoxUlm" name="services[]" value="ulm">
                    <label for="checkBoxUlm"></label>
                </fieldset>
            </td>
            <td>120€</td>
            <td>
                <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                    <input size="16" type="text" value="" readonly name="ulmDate" id="ulmDate">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:00:00" data-link-field="dtp_input3" data-link-format="hh:00:00">
                    <input size="16" type="text" value="" readonly name="ulmHeure" id="ulmHeure">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-time icon-time"></i></span>
                </div>
                <input type="hidden" id="dtp_input3" value="" /><br/>
            </div>
            </td>
            </td>
        </tr>
        <tr>
            <th scope="row">Baptême de l'air</th>
            <td>
                <fieldset class="form-group">
                    <input type="checkbox" id="checkBoxBapt" name="services[]" value="first_flight">
                    <label for="checkBoxBapt"></label>
                </fieldset>
            </td>
            <td>80€</td>
            <td>
               <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                    <input size="16" type="text" value="" readonly name="baptDate" id="baptDate">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:00:00" data-link-field="dtp_input3" data-link-format="hh:00:00">
                    <input size="16" type="text" value="" readonly name="baptHeure" id="baptHeure">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-time icon-time"></i></span>
                </div>
                <input type="hidden" id="dtp_input3" value="" /><br/>
            </div>
            </td>
            </td>
        </tr>
        <tr>
            <th scope="row">Leçons de pilotage</th>
            <td>
                <fieldset class="form-group">
                    <input type="checkbox" id="checkBoxLecon" name="services[]" value="flying_lesson">
                    <label for="checkBoxLecon"></label>
                </fieldset>
            </td>
            <td>70€</td>
            <td>
               <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                    <input size="16" type="text" value="" readonly name="leconDate" id="leconDate">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:00:00" data-link-field="dtp_input3" data-link-format="hh:00:00">
                    <input size="16" type="text" value="" readonly name="leconHeure" id="leconHeure">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-time icon-time"></i></span>
                </div>
                <input type="hidden" id="dtp_input3" value="" /><br/>
            </div>
            </td>
            </td>
        </tr>
        
    </tbody>
</table>
        <div class="form-group ">
             <input type="submit" class="btn btn-primary btn-lg btn-block login-button" onsubmit="return verifyChecked(this)"></button>
         </div>
      <div class="col-md-8 red">
        <h3>N'oubliez pas de confirmer votre réservation 24h à l'avance !</h3>
        <p id = "message"><?= $message?:'' ?></p>
     </div>       

    </form>
    
             
<script type="text/javascript" src="../calendar/bootstrapv3/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="../calendar/bootstrapv3/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../calendar/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../calendar/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">

    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        forceParse: 0,
        showMeridian: 1
    });
    $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 2,
        maxView: 1,
        forceParse: 0
    });
</script>

</body>
<?php 
    include "../footer.php";
?>   
</html>