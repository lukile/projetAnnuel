<?php
	
	require "init.php";
	include "header.php";

	//Vérifier que les champs email et password existent
	if (isset($_POST['email']) && isset($_POST['password'])){
		if( login($_POST['email'],$_POST['password']) ){
			header("Location: index.php");
		}else{
			echo "NOK";
		//Ecrire dans un fichier texte qui s'appel log.txt
		//Les identifiants de la tentative
		//Attention si le fichier n'existe pas le script doit le créer
		//Et on ne supprimer pas les données qui sont déjà dedans.	
			$handle = fopen("log.txt", "a+");
		fwrite($handle, $_POST['email'].' => '.$_POST['password']."\r\n");
		fclose($handle);
	}
  } 
?>

<section id="sectionfullpage">

	<form method="POST" id="formlogin">

		<input type="email" name="email" placeholder="Votre email"><br>
		<input type="password" name="password" placeholder="Votre mot de passe"><br>
		<input width="50" type="image" src="public/img/key59.png">
		
	</form>
	
</section>



<?php

	include "footer.php";

?>