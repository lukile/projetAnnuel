<a href="index.php" title="infobulle" >Index</a>

<?php
	
  require "init.php";
	include "header.php";
	
  

	$db = connectDb();

	$req = $db->query('SELECT id, name, surname, email, country FROM users');

?>	
	
<html>
<p>
  <table>
 			<tr>
        <th>ID</th>
 				<th>Nom</th>
 				<th>Prenom</th>
 				<th>Email</th>
 				<th>Pays</th>
        <th>Supprimer</th>
        <th>Modifier un user</th>
 			</tr>	
 		
  <?php	

 while($data = $req->fetch()){

	 ?> 

	 				  	
  			<tr>
            <td><?php echo $data['id']; ?> </td>
  			   	<td><?php echo $data['name']; ?> </td>
        		<td><?php echo $data['surname']; ?> </td>
        		<td><?php echo $data['email']; ?> </td>
        		<td><?php echo $data['country'].'<br>'; ?> </td>
            <td><a href="delete.php?id=<?php echo $data['id']?>">Supprimer</a></td>
            <td><a href="modify.php?id=<?php echo $data['id']?>">Modifier</a></td>
    		</tr>
    	
     <?php 
   

   }
   echo"</table>";
$req->closeCursor();

?> 

<?php
	//include "footer.php";
?>		

