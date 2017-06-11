<?php 
require_once(__DIR__. "/class/DatabaseManager.php");

function connect(){
    $manager = DatabaseManager::getsharedInstance();
    $connect = $manager->connect();

    return $connect;
}

function isConnected(){
    if(!empty($_SESSION["activation_key"]) && !empty($_SESSION["mail"])){
        
        $query = connect()->prepare("SELECT id FROM user where mail=:mail AND activation_key=:activation_key");
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

    $query = connect()->prepare("SELECT activation_key WHERE mail=:mail AND activation_key=:activation_key");
    $query->execute(["mail"=> $_SESSION['mail'], "activation_key"=>$_SESSION['activation_key']]);
    $result = $query->fetch();

    if(!empty($result)){
        return $_GET["activation_key"];
    }else{
        echo 'Une erreur s\'est produite';
    }
}

function login($mail, $pass){

    $query = connect()->prepare("SELECT pass FROM user WHERE mail=:mail");
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

    $query = connect()->prepare('UPDATE user SET activation_key=:activation_key WHERE mail=:mail');

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

function insertServiceValues($startDate, $endDate, $startHour, $orderFormId, $serviceId){
   
    $select = "INSERT INTO order_form_service(booking_start_date, booking_end_date, booking_start_hour, order_form_id, service_id) VALUES(:startDate, :endDate, :startHour, :orderFormId, :serviceId)";
    $prep = connect()->prepare($select);
    $exec = $prep->execute(array(':startDate'=>$startDate, ':endDate'=>$endDate, ':startHour'=>$startHour, ':orderFormId'=>$orderFormId, ':serviceId'=>$serviceId));

    return $exec;
}
function insertRoyalties($plane, $fuel, $qutyFuel, $category, $planeLength, $maxWeight, $idService, $acousticGroup){
    $manager = DatabaseManager::getsharedInstance();
    $connect = $manager->connect();
    $insert = "INSERT INTO royalties(landing_type, petroleum_type, fuel_quantity, rate_type, plane_length, plane_weight, service_id, acoustic_group) VALUES(:plane, :fuel, :qutyFuel, :category, :planeLength, :maxWeight, :idService, :acoustic_group)";
    $insert_prep = $connect->prepare($insert);
    $insert_exec = $insert_prep->execute(array(':plane'=>$plane, ':fuel'=>$fuel, ':qutyFuel'=>$qutyFuel, ':category'=>$category, ':planeLength'=>$planeLength, ':maxWeight'=>$maxWeight,'idService'=>$idService,':acoustic_group'=>$acousticGroup));
} 

function displayListUsers(){
  $listUsers = connect()->query("SELECT firstname, lastname, pseudo, mail, phone, comments, registration_date, active, application_fee FROM user");

    while($data = $listUsers->fetch()){
        echo '<tr> <td>'.$data['firstname'].'</td>';
        echo '<td>'.$data['lastname'].'</td>';
        echo '<td>'.$data['pseudo'].'</td>';
        echo '<td>'.$data['mail'].'</td>';
        echo '<td>'.$data['phone'].'</td>';
        echo '<td>'.$data['comments'].'</td>';
        echo '<td>'.$data['registration_date'].'</td>';
        echo '<td>'.$data['active'].'</td>';
        echo '<td>'.$data['application_fee'].'</td> </tr>';
    }  
}





?>