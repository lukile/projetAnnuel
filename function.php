<?php 
require_once(__DIR__. "/class/DatabaseManager.php");

function isConnected(){
    if(!empty($_SESSION["activation_key"]) && !empty($_SESSION["mail"])){
        $manager = DatabaseManager::getsharedInstance();
        $connect = $manager->connect();
        
        $query = $connect->prepare("SELECT id FROM user where mail=:mail AND activation_key=:activation_key");
        $query->execute(["mail" => $_SESSION['mail'], "activation_key" => $_SESSION['activation_key']]);
        $result = $query->fetch();

        if(!empty($result)){
            $_SESSION['activation_key'] = generateactivation_key($_SESSION['mail']);
            echo 'vous êtes connecté';
             
            return true;
        }else{
            echo 'Vous n\'êtes pas connecté';
            return false;
        }

    }
}

function getActivationKey(){
    $manager = DatabaseManager::getsharedInstance();
    $connect = $manager->connect();

    $query = $connect->prepare("SELECT activation_key WHERE mail=:mail AND activation_key=:activation_key");
    $query->execute(["mail"=> $_SESSION['mail'], "activation_key"=>$_SESSION['activation_key']]);
    $result = $query->fetch();

    if(!empty($result)){
        return $_GET["activation_key"];
    }else{
        echo 'Une erreur s\'est produite';
    }
}

function login($mail, $pass){
    $manager = DatabaseManager::getsharedInstance();
    $connect = $manager->connect();
    $query = $connect->prepare("SELECT pass FROM user WHERE mail=:mail");
    $query->execute(["mail"=>$mail]);
    $result = $query->fetch();
    $pwd = $result["pass"];
    if(!empty($pwd)){
        $_SESSION["activation_key"] = generateactivation_key($mail);
        $_SESSION["mail"] = $mail;
        
        return true;
    }else{
        return false;
    }    
}

function generateactivation_key($mail){
    $activation_key = md5(uniqid());

    $manager = DatabaseManager::getsharedInstance();
    $connect = $manager->connect();

    $query = $connect->prepare('UPDATE user SET activation_key=:activation_key WHERE mail=:mail');

    $query->execute(["activation_key"=>$activation_key, "mail"=>$mail]);

    return $activation_key;
}

function logout(){
    session_destroy();
    unset($_SESSION);
    header("Location:index.php");
}

?>