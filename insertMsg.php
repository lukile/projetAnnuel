<?php 
	

	$name = filter_input(INPUT_POST, 'name');
	$mail = filter_input(INPUT_POST, 'mail');
	$content = filter_input(INPUT_POST, 'content');
	print_r($_POST);
	print_r($_GET);

	if(isset($name, $mail, $content)){
		echo "coucou";
		$db = connect();
		$query = $db->prepare("INSERT INTO messages(userMessage, mail, content) VALUES (name, mail, content)");
  		$query->execute(['userMessage'=>$name, 'mail'=>$mail,'content'=>$content]);


} 			