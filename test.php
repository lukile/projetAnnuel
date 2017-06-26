<?php 
session_start();
include "header.php";

include "createReservations.php";
?>
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->      

<table class="container">
    <thead>
        <tr>
            <th>Services</th>
            <th>Choix</th>
            <th>A partir de</th>
            <th>Spécial</th>
            <th>Date</th>
            <th>Heure</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Stationnement
                <input type="hidden" id="priceStat" name="priceStat" value="2.30" />
            <br/>
            </th>
            <td>
                <fieldset class="form-group">
                    <input type="checkbox" id="checkBoxStat" name="services[]" value="parking">
                    <input type="hidden" name="priceParking" value="2.30">
                    <label for="checkBoxStat"></label>
                </fieldset>
            </td>
            <td>2.76€ /m²</td>
            <td>
            <div class="control-group">
                <div>
                    <input size="16" type="hidden" value="" placeholder="">
                </div>
             </td>   
            <td>
            <div class="form-group">
                <div class="input-group input-append date form_date col-md-5" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
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
        
<?php 
    if(isActive()):
        ?>
        <div class="form-group ">
             <input type="submit" class="btn btn-primary btn-lg btn-block login-button" onsubmit="return verifyChecked(this)"></button>
         </div>
      <div class="col-md-8 red">
        <h3>N'oubliez pas de confirmer votre réservation 24h à l'avance !</h3>
        <p id = "message"><?= $message?:'' ?></p>
     </div>     
     <?php 
     endif;
        if(!isActive()):
            ?>
            <div class="form-group ">
             <input type="submit" class="btn btn-primary btn-lg btn-block login-button" disabled="disabled"></button>
         </div>

          <?php 
            endif;
            ?>

    </form>
    
             
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
    include "footer.php";
?>   
</html>      


