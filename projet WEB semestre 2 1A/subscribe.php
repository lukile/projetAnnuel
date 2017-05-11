<?php
	require "init.php";
    include "header.php";
?>

<section id="sectionfullpage">



<?php

	$msg_error = "";
	$error = false;
	$list_of_country = ["fr"=>"France", "es"=>"Espagne", "pl"=>"Pologne"];

	
	//	On vérifie qu'il existe dans la variable superglobale $_POST tous les champs du formulaire
	
	if(
		isset( $_POST['name'] ) && 
		isset( $_POST['surname'] ) && 
		isset( $_POST['email'] ) && 
		isset( $_POST['password'] ) && 
		isset( $_POST['password2'] ) && 
		isset( $_POST['country'] ) && 
		isset( $_POST['captcha'] )
		){

			$_POST['name'] = trim($_POST['name']);
			$_POST['surname'] = trim($_POST['surname']);
			$_POST['email'] = trim($_POST['email']);

			//Le nom doit faire plus d'un caractère
			if( strlen($_POST['name']) < 2 ){
				$msg_error .= "<li>Le nom doit faire plus d'un caractère";
				$error = true;
			}

			//Le prénom doit faire plus d'un caractère
			if( strlen($_POST['surname']) < 2 ){
				$msg_error .= "<li>Le prénom doit faire plus d'un caractère";
				$error = true;
			}
			//L'email doit être valide
			if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
				$msg_error .= "<li>L'email n'est pas valide";
				$error = true;
			}
			//Le mot de passe doit faire en 8 et 32 caractères
			if( strlen($_POST['password']) < 8 || strlen($_POST['password']) > 32 ){
				$msg_error .= "<li>Le mot de passe doit faire entre 8 et 32 caractères";
				$error = true;
			}
			//Les mots de passe doivent correspondre
			else if( $_POST['password'] != $_POST['password2'] ){
				$msg_error .= "<li>Les mots de passe sont différents";
				$error = true;
			}
			//Le pays doit correspondre à un tableau PHP créé au préalable(a faire)
			if ( ! array_key_exists($_POST['country'], $list_of_country) ){
				$msg_error .= "<li>Le pays n'existe pas dans nos données";
				$error = true;
			}

			/*
			if($_POST["captcha"] != $_SESSION['captcha']){
				$msg_error .= "<li>Le captcha ne correspond pas";
				$error = true;
			}
			*/

			if(emailExist($_POST['email'])){
				$msg_error .= "<li>L'email est déjà utilisé";
				$error = true;
			}


			//CGU doit être coché (Attention piège)
			if(! isset($_POST['cgu'])){
				$msg_error .= "<li>Vous devez accepter les CGUs";
				$error = true;
			}




			if( !$error ){


				$accesstoken = md5(uniqid());

				//Se connecter à la base de données
				$db = connectDb();

				//Prépare une requête sql INSERT INTO utilisateur (nom, prenom) VALUES (xxxx, xxxx);
				$query = $db->prepare( " INSERT INTO users (name, surname, email, password, country, accesstoken) 
								VALUES ( :toto, :titi, :tutu, :tata, :toutou, :tintin ) " );

				//executer la requête en donnant les valeurs à intégrer
				$pwd = password_hash($_POST['password'], PASSWORD_DEFAULT);


				$query->execute([
									"toto"=> $_POST['name'],
									"titi"=>$_POST['surname'],
									"tutu"=>$_POST['email'],
									"tata"=>$pwd,
									"toutou"=>$_POST['country'],
									"tintin"=>$accesstoken
								]);


				$url = "http://".$_SERVER["SERVER_NAME"]."/validemail.php?accesstoken=".$accesstoken;

				$from = "y.skrzypczyk@gmail.com";
				$to = $_POST['email'];
				$subject = "Validation de l'inscription";
				$body = "Veuillez cliquer sur ce lien pour activer votre compte. ".$url;

				$headers = 'From: '. $from . "\r\n" .
			     'Reply-To: '. $from . "\r\n" .
			     'X-Mailer: PHP/' . phpversion();

			     

				//On redirige l'internaute sur la page d'accueil


			}

	}




	if($error){
		echo "<ul>";
		echo $msg_error;
		echo "</ul>";
	}


?>




	<form method="POST" action="subscribe.php" id="formsubscription">

		<input type="text" name="name" placeholder="Votre nom" value="<?php echo (isset( $_POST["name"] ))? $_POST["name"]:"";?>"><br>
		<input type="text" name="surname" placeholder="Votre prénom" value="<?php echo (isset( $_POST["surname"] ))? $_POST["surname"]:"";?>"><br>
		<input type="email" name="email" placeholder="Votre email" value="<?php echo (isset( $_POST["email"] ))? $_POST["email"]:"";?>"><br>
		<input type="password" name="password" placeholder="Votre mot de passe"><br>
		<input type="password" name="password2" placeholder="Confirmation du mot de passe"><br>
		
		<select name="country">
			<?php 
				foreach ($list_of_country as $key => $value) {
                       
                     echo "<option ".(( isset($_POST["country"]) && $_POST["country"] == $key)?
                                           "selected='selected'":'')."value='" .$key."'>".$value."</option>";
               }
			?>
		</select><br>

		<img src="captcha.php">
		<input type="text" name="captcha"><br>
		


		<label>
			<input type="checkbox" name="cgu">J'accepte les CGUs<br>
		</label>



		<input width="50" type="image" src="public/img/clipboard105.png">

	</form>
	
</section>



<?php

	include "footer.php";

?>