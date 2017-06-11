<?php

    require_once(__DIR__. '/class/DatabaseManager.php');
    /*include("function.php");*/

    $error_msg = null;
    $message = null;

    $mail = filter_input(INPUT_POST, 'mail');
    $pass = md5(filter_input(INPUT_POST, 'pass'));

    if(isset($mail, $pass)){
        $mail = trim($mail) != '' ? $mail : null;
        $pass = trim($pass) != '' ? $pass : null;

        if(isset($mail, $pass)){
            
            if(login($_POST['mail'], $_POST['pass'])){
                $message = 'Vous êtes maintenant connecté '.$_POST['mail'];

            }else{
                $message = 'Vous avez saisi les mauvais identifiants !';
            }
        }else{
            $message = 'Veuillez renseigner tous les champs s\'il vous plaît';
        }
    }
?>