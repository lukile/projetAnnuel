<?php 
include "header.php";
?>
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Réservation </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Accueil</a>
                    </li>
                    <li class="active">Réservation</li>
                </ol>
            </div>
        </div>
            


<table class="table">
    <thead>
        <tr>
            <th>Services</th>
            <th>Choix</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Date</th>
            <th>Heure</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Stationnement</th>
            <td>
                <fieldset class="form-group">
                    <input type="checkbox" id="checkBoxStat" name="checkBoxStat">
                    <label for="checkBoxStat"></label>
                </fieldset>
            </td>
            <td>Ashley</td>
            <td>Lynwood</td>
            <td>@ashow</td>
            <td>
            <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" value="" placeholder="date de debut" readonly name="statDateDebut" id="statDateDebut">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>

                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" value="" placeholder="Date de fin" readonly name="statDateFin" id="statDateFin">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                    <input size="16" type="text" value="" placeholder="heure d'arrivée" readonly name="statHeureDebut" id="statHeureDebut">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-time icon-time"></i></span>
                </div>
                <input type="hidden" id="dtp_input3" value="" /><br/>

            </div>
             <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                    <input size="16" type="text" value="" placeholder="heure de départ" readonly name="statHeureFin" id="statHeureFin">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-time icon-time"></i></span>
                </div>
                <input type="hidden" id="dtp_input3" value="" /><br/>
            </td>
        </tr>
        <tr>
            <th scope="row">Avitaillement</th>
            <td>
                <fieldset class="form-group">
                    <input type="checkbox" id="checkBoxAvi" name="checkBoxAvi">
                    <label for="checkBoxAvi"></label>
                </fieldset>
            </td>
            <td>Billy</td>
            <td>Cullen</td>
            <td>@cullby</td>
            <td>
                <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" value="" readonly name="aviDate" id="aviDate">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
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
            <th scope="row">Nettoyage d'intérieur</th>
            <td>
                <fieldset class="form-group">
                    <input type="checkbox" id="checkBoxNet" name="checkBoxNet">
                    <label for="checkBoxNet"></label>
                </fieldset>
            </td>
            <td>Ariel</td>
            <td>Macy</td>
            <td>@arielsea</td>
            <td>
                <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" value="" readonly name="netDate" id="netDate">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
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
                    <input type="checkbox" id="checkBoxPara" name="checkBoxPara">
                    <label for="checkBoxPara"></label>
                </fieldset>
            </td>
            <td>Ashley</td>
            <td>Lynwood</td>
            <td>@ashow</td>
            <td>
                <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" value="" readonly name="paraDate" id="paraDate">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
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
                    <input type="checkbox" id="checkBoxUlm" name="checkBoxUlm">
                    <label for="checkBoxUlm"></label>
                </fieldset>
            </td>
            <td>Billy</td>
            <td>Cullen</td>
            <td>@cullby</td>
            <td>
                <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" value="" readonly name="ulmDate" id="ulmDate">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
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
                    <input type="checkbox" id="checkBoxBapt" name="checkBoxBapt">
                    <label for="checkBoxBapt"></label>
                </fieldset>
            </td>
            <td>Ariel</td>
            <td>Macy</td>
            <td>@arielsea</td>
            <td>
               <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" value="" readonly name="baptDate" id="baptDate">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
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
                    <input type="checkbox" id="checkBoxLecon" name="checkBoxLecon">
                    <label for="checkBoxLecon"></label>
                </fieldset>
            </td>
            <td>Ashley</td>
            <td>Lynwood</td>
            <td>@ashow</td>
            <td>
               <div class="control-group">
                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" value="" readonly name="leconDate" id="leconDate">
                    <span class="add-on"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="add-on"><i class="glyphicon glyphicon-th icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            </td>

            <td>
            <div class="control-group">
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
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
             <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Valider</button>
         </div>
      <div class="col-md-8 red">
        <h3>Reservation et confirmation 24h à l'avance</h3>
    </div>       

         
<script type="text/javascript" src="calendar/bootstrapv3/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="calendar/bootstrapv3/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="calendar/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="calendar/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
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
        minView: 0,
        maxView: 1,
        forceParse: 0
    });
</script>

</body>
<footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Projet annuel 2A, Lucile, Damien, Sacha</p>
                </div>
            </div>
    </footer>
</html>