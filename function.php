<?php 
require_once(__DIR__. "/class/DatabaseManager.php");

function isConnected(){
    $manager = DatabaseManager::getsharedInstance();

    if(!empty($_SESSION["activation_key"]) && !empty($_SESSION["mail"])){
        $connect = $manager->connect();
        $query = $connect->prepare("SELECT id FROM user where mail=:mail AND activation_key=:activation_key");
        $query->execute(["mail" => $_SESSION['mail'], "activation_key" => $_SESSION['activation_key']]);
        $result = $query->fetch();

        if(!empty($result)){
            echo 'OK';
            return true;
        }else{
            echo 'not ok';
            return false;
        }

    }
}

?>