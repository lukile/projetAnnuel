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

            return true;
        }else{
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
    $pass = md5($pass);
    $pwd = $result["pass"];

    if(!empty($pwd) && $pwd == $pass){
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

function validate($startDate){
    $dateFormat = date_create_from_format('d-m-Y', $startDate);
    $formattedDate = $dateFormat->format('Y-m-d');

    if($formattedDate < strftime('%Y-%m-%d')){
        $message = 'La date de réservation ne peut s\'effectuer avant la date courante';   
        printf($message);
        return false;
    }
    return true;
}

function insertServiceValues($startDate, $startHour, $orderFormId, $serviceId){
    $manager = DatabaseManager::getsharedInstance();
    $connect = $manager->connect(); 
   
    $select = "INSERT INTO order_form_service(booking_start_date, booking_start_hour, order_form_id, service_id) VALUES(:startDate, :startHour, :orderFormId, :serviceId)";
    $prep = $connect->prepare($select);
    $exec = $prep->execute(array(':startDate'=>$startDate, ':startHour'=>$startHour, ':orderFormId'=>$orderFormId, ':serviceId'=>$serviceId));
    echo 'insertion ok';
    return $exec;
}

function insertRoyalties($plane, $fuel, $category, $planeLength, $maxWeight, $idService, $acousticGroup){
    $manager = DatabaseManager::getsharedInstance();
    $connect = $manager->connect();

    $insert = "INSERT INTO royalties(landing_type, petroleum_type, rate_type, plane_length, plane_weight, service_id, acoustic_group) VALUES(:plane, :fuel, :category, :planeLength, :maxWeight, :idService, :acoustic_group)";
    $insert_prep = $connect->prepare($insert);
    $insert_exec = $insert_prep->execute(array(':plane'=>$plane, ':fuel'=>$fuel, ':category'=>$category, ':planeLength'=>$planeLength, ':maxWeight'=>$maxWeight,'idService'=>$idService,':acoustic_group'=>$acousticGroup));
}
function sendMail(){


}

?>