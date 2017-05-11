<?php
	session_start();
	header("Content-type: image/png");	
	
	$nombre_de_caractere = 4;
	$caracteres_possibles = "abcdefghijklmnopqrstuvwxyzABCDEGHIJKLMNOPQRSTUVWXYZ0123456789";
	$nb_formes = 5;
	$path_font = "public/font/";

	//Je mélange la chaine
	$caracteres_possibles = str_shuffle($caracteres_possibles);
	//couper la chaine depuis le 1er caractère jusqu'au $nombre_de_caractere
	$captcha = substr($caracteres_possibles, 0, $nombre_de_caractere);
	$_SESSION['captcha'] = $captcha;

	$image = imagecreate(100,50);

	$list_of_colors[]= imagecolorallocate($image, 255, 255, 255);
	$list_of_colors[]= imagecolorallocate($image, 0, 0, 0);
	$list_of_colors[]= imagecolorallocate($image, 255, 0, 0);

	shuffle($list_of_colors);

	$back = $list_of_colors[0];
	$text = $list_of_colors[1];

	//Avoir un fond aléatoire
	imagefill ($image , 0, 0 , $back );


	//Créer des formes géomtriques aléatoires
	for($i=0;$i<$nb_formes;$i++){
		$aleatoire = rand(0,3);

		$x1 = rand(0,100);
		$x2 = rand(0,100);
		$y1 = rand(0,50);
		$y2 = rand(0,50);
		$largeur = rand(0,100);
		$hauteur = rand(0,50);


		switch ($aleatoire) {
			case 1:
				ImageLine ($image, $x1, $y1, $x2, $y2, $text); 
				break;

			case 2:
				ImageEllipse ($image, $x1, $y1, $largeur, $hauteur, $text);  
				break;

			case 3:
				ImageRectangle ($image, $x1, $y1, $x2, $y2, $text); 
				break;
			
		}

	}

	//Modifier la font des caractères et la couleur de manière aléatoires
	$list_of_font = scandir($path_font);
	
	unset($list_of_font[0]);
	unset($list_of_font[1]);
	unset($list_of_font[2]);
	shuffle($list_of_font);
	$font = $path_font.$list_of_font[0];
	imagettftext ( $image , 20 , 0 , 20, 30 , $text , $font , $captcha );

	// Option : changer la couleur et la police d'un caractère à l'autre


	//Rajouter un lecteur pour les malvoyants +5 en enregistrant sa voix	


	imagepng($image);
?>