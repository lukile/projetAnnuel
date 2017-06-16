<?php 
session_start();

include "header.php";
//include "modifyMsg.php";

$listMsg = connect()->query("SELECT id, statut, userMessage, mail, content FROM messages");

?>
<div class="container">
    <div class="row">
            <div class="box clearfix">
            <h3>Liste des messages utilisateurs</h3>

            <table class="table table-hover" id="bootstrap-table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom complet</th>
                    <th>Mail</th>
                    <th>Message</th>
                    <th>Statut</th>
                </tr>
                </thead>
                <tbody>
<?php                    while($data = $listMsg->fetch()){ ?>
                    <tr>
                    <td><?php echo $data['id']; ?> </td>
                    <td><?php echo $data['userMessage']; ?> </td>
                    <td><?php echo $data['mail']; ?> </td>
                    <td><?php echo $data['content']; ?> </td>
                    <td><?php echo $data['statut']; ?> </td>
                    
                   <!-- <td><button onclick="readMsg('.$data['id'].')" id="msg<?php //echo $data['id']?>">Valider</button></td> -->
                    <?php 
                        if($data['statut'] == 0){
                    ?>
                    <td><a href="modifyMsg.php?id=<?php echo $data['id']?>">Modifier</a></td>
                    <?php }else{?>
                           <div id="readgreen">
                            <td><p color="green">LU</p></td>
                        </div>
                        <?php
                    }
                    ?>
                <!--  <?php  //echo'<td><button id="msg' .$data['id'].'" onclick="readMsg('.$data['id'].')">Modifier</button>'; ?>
               <?php  // echo'<td><button id="button_animal_' .$id.'" onclick="modifyAnimal('.$data['id'].')">Modifier</button>'; ?> -->
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