<?php

    require_once(__DIR__. '/class/LoginManager.php');
    /*include("function.php");*/

    $error_msg = null;
    $message = null;

    $mail = filter_input(INPUT_POST, 'mail');
    $pass = filter_input(INPUT_POST, 'pass');

    if(!isset($mail, $pass)) {
        $message = 'Veuillez renseigner tous les champs s\'il vous plaît';
        return;
    }

    $mail = trim($mail) != '' ? $mail : null;
    $pass = trim($pass) != '' ? $pass : null;

    $loginManager = LoginManager::getSharedInstance();
    if (! $loginManager->login($mail, $pass)) {
        $message = 'Vous avez saisi les mauvais identifiants !';
        return;
    }

    $message = 'Vous êtes maintenant connecté '.$mail;
    ?>
    <script>
        setTimeout("location.href='index.php';", 500);
    </script>