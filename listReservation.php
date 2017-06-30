<?php 
include "header.php";

$lastname = $_GET['lastname'];
$firstname = $_GET['firstname'];

$id = $_GET['id'];
?>

 <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Liste réservation de <?php  echo $lastname. ' '.$firstname ?>                
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Accueil</a>
                    </li>
                    <li class="active">Réservation</li>
                </ol>
            </div>
        </div>

        <div class="main-login main-center">
            <?php 
                if(isset($_GET['id'])){
                    $request =  connect()->prepare("SELECT u.id, 
                                order_form_id,
                                booking_start_date, booking_end_date,booking_start_hour, booking_end_hour, 
                                type,
                                petroleum_type, fuel_quantity, plane_length, plane_weight, wingspan, landing_type, parking_surface, ffa
                                FROM user u, order_form of, order_form_service ofs, services s, royalties r
                                WHERE u.id in (SELECT user_id FROM order_form WHERE user_id = :id)
                                AND of.id = ofs.order_form_id
                                AND s.id = ofs.service_id
                                AND r.id = ofs.royalties_id

                    ");
                    $request->execute([':id'=>$id]);
                    // $fetchId = $request->fetch();
                }
            ?>
            <table class="table table-hover" id="bootstrap-table">
                <thead>
                    <tr>
                        <th>Identifiant<br>bon de commande</th>
                        <th>Service</th>
                        <th>Date de début<br>Date de fin</th>
                        <th>Heure de début<br>Heure de fin</th>
                        <th>Carburant</th>
                        <th>Quantité carburant</th>
                        <th>Longueur avion</th>
                        <th>Masse max décollage</th>
                        <th>Envergure</th>
                        <th>Type avion</th>
                        <th>Surface</th> 
                        <th>FFA</th>   
                    </tr>                    
                </thead>
                <tbody>
                <?php while($element = $request->fetch()){ ?>
                    <tr>
                        <td><?php  echo $element['order_form_id']?></td>
                        <td><?php  echo $element['type']?></td>
                        <td><?php  echo $element['booking_start_date']?><br><?php echo $element['booking_end_date']?></td>
                        <td><?php  echo $element['booking_start_hour']?><br><?php echo $element['booking_end_hour']?></td>
                        <td><?php  echo $element['petroleum_type']?></td>
                        <td><?php  echo $element['fuel_quantity']?></td>
                        <td><?php  echo $element['plane_length']?></td>
                        <td><?php  echo $element['plane_weight']?></td>
                        <td><?php  echo $element['wingspan']?></td>
                        <td><?php  echo $element['landing_type']?></td>
                        <td><?php  echo $element['parking_surface']?></td>
                        <td><?php  echo $element['ffa']?></td>    
                    </tr>
                    
                    <?php }?>
                </tbody>
            </table>
            <div class="login-register">
                <a href="admin.php"><i class="fa fa-arrow-circle-left" aria-hidden="true"> Retour</i></a>
            </div>
        </div>  
    <?php include "footer.php"; ?>
    </div>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="bootstrap-data-table-master/js/vendor/jquery.sortelements.js" type="text/javascript"></script>
    <script src="bootstrap-data-table-master/js/jquery.bdt.min.js" type="text/javascript"></script>
    <script>
    $(document).ready( function () {
        $('#bootstrap-table').bdt({
            showSearchForm: 0,
            showEntriesPerPageField: 0
        });
    });
</script>
