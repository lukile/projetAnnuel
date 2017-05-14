<?php
  
    require_once(__DIR__. '/class/DatabaseManager.php');
    /*require("function.php");*/

    session_start();

    $error_msg = null;
    $message = null;

    $mail = filter_input(INPUT_POST, 'mail');
    $pass = filter_input(INPUT_POST, 'pass');

    if(isset($mail, $pass)){
        $mail = trim($mail) != '' ? $mail : null;
        $pass = trim($pass) != '' ? $pass : null;

        if(isset($mail, $pass)){
  
            $manager = DatabaseManager::getsharedInstance();

            $requete = "SELECT id, mail, pass, activation_key FROM user WHERE mail = :mail";
            $connect = $manager->connect();
            $query = $connect->prepare($requete);
            $query->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetch();    

        
            if($data['pass'] == md5($_POST['pass'])){
                $_SESSION['mail'] = $data['mail'];
                $_SESSION['activation_key'] = $data['activation_key'];
                $_SESSION['id'] = $data['id'];
                $message = '<p> Bienvenue '.$data['mail']. ' '.$data['activation_key'].', vous êtes maintenant connecté !';
            }else{
                $message = 'Le mail et/ou le mot de passe est incorrect';
            }
            $query->CloseCursor();
        }else{
            $message = 'Tous les champs doivent être renseignés';
        }

        if(isConnected()){
            echo 'ok';
        }else{
            echo 'nope';
        }
    }
?>