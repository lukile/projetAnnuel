<?php 
session_start();

include "header.php";
$listUsers = connect()->query("SELECT id, firstname, lastname, pseudo, mail, phone, comments, registration_date, active, application_fee FROM user");

?>
<div class="container">
    <div class="row">
            <div class="box clearfix">
            <h3>Modification d'un utilisateur</h3>

            <table class="table table-hover" id="bootstrap-table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                    <th>Phone</th>
                    <th>Commentaires</th>
                    <th>Date d'inscription</th>
                    <th>Etat compte <br>1 = actif<br>0 = inactif</th>
                    <th>Frais de dossier</th>
                    <th>Modification</th>
                </tr>
                </thead>
                <tbody>
<?php                    while($data = $listUsers->fetch()){ ?>
                    <tr>
                    <td><?php echo $data['id']; ?> </td>
                    <td><?php echo $data['firstname']; ?> </td>
                    <td><?php echo $data['lastname']; ?> </td>
                    <td><?php echo $data['pseudo']; ?> </td>
                    <td><?php echo $data['mail']; ?> </td>
                    <td><?php echo $data['phone']; ?> </td>
                    <td><?php echo $data['comments']; ?> </td>
                    <td><?php echo $data['registration_date']; ?> </td>
                    <td><?php echo $data['active']; ?></td>
                    <td><?php echo $data['application_fee'].'<br>'; ?> </td>
                    
                    <td><a href="modifyUser.php?id=<?php echo $data['id']?>">Modifier</a></td>
                    </tr>    
<?php } ?>
               </tbody>
            </table>
            <div class="login-register">
                <a href="admin.php"><i class="fa fa-arrow-circle-left" aria-hidden="true"> Retour</i></a>
            </div>
        </div>
        </div>
    </div>
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
</body>
</html>