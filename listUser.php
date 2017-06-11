<?php 
session_start();

include "header.php";

?>
<div class="container">
    <div class="row">
            <div class="box clearfix">
            <h3>Liste des utilisateurs</h3>

            <table class="table table-hover" id="bootstrap-table">
                <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                    <th>Phone</th>
                    <th>Commentaires</th>
                    <th>Date d'inscription</th>
                    <th>Frais supplémentaires</th>
                </tr>
                </thead>
                <tbody>
                    <?php displayListUsers();?>
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