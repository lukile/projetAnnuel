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
    if($startDate == "") return true;

    $dateFormat = date_create_from_format('d-m-Y', $startDate);
    $formattedDate = $dateFormat->format('Y-m-d');
    if($formattedDate < strftime('%Y-%m-%d')){
        $message = 'La date de réservation ne peut s\'effectuer avant la date courante';   
        printf($message);
        return false;
    }
    return true;
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


function isAdmin() {
    // on verifie que les sessions existent
    if (!empty($_SESSION['activation_key'])) {
    // si oui on se connecte à la bdd
        $db = connect();
    // est ce qu'il existe un user avec l'email de SESSION[email]
    // et l'access token SESSION[accesstoken]
        $query = $db->prepare('SELECT admin FROM user WHERE activation_key=:activation_key');
        $query->execute(['activation_key' => $_SESSION['activation_key']]);
        $result = $query->fetch();
    // si oui on regenere un accesstoken et on retourne vrai
        if ( $result[0] == '1' ) {
            return true;
        }
    } else {
        return false;
    }
}

function msgRead() {
        
    if(isset($_GET['id'])){

    $fetch_id = connect()->prepare("UPDATE messages SET statut = 1 WHERE id = :id");
    $fetch_id->execute([':id'=>$_GET['id']]);
    $_POST = $fetch_id->fetch();
    }

}

function isActive() {
    // on verifie que les sessions existent
    if (!empty($_SESSION['activation_key'])) {
    // si oui on se connecte à la bdd
        $db = connect();
    // est ce qu'il existe un user avec l'email de SESSION[email]
    // et l'access token SESSION[accesstoken]
        $query = $db->prepare('SELECT active FROM user WHERE activation_key=:activation_key');
        $query->execute(['activation_key' => $_SESSION['activation_key']]);
        $result = $query->fetch();
    // si oui on regenere un accesstoken et on retourne vrai
        if ( $result[0] == '1' ) {
            return true;
        }
    } else {
        return false;
    }
}

function getOpenDays($startDate, $endDate){
    $publicHolidayArray = array();

    //Dans le cas où l'année de départ est différente de l'année de fin
    $yearDiff = date('Y', $endDate) - date('Y', $startDate);
    for($i = 0; $i<= $yearDiff; $i++){
        $year = (int)date('Y', $startDate) + $i;
        //Liste des jours fériés
        //Jour de l'an 
        $publicHolidayArray[] = '1_1_'.$year;
        //Fête du travail
        $publicHolidayArray[] = '1_5_'.$year;
        //Victoire 1945
        $publicHolidayArray[] = '8_5_'.$year;
        //Fête nationale
        $publicHolidayArray[] = '14_5_'.$year;
        //Assomption
        $publicHolidayArray[] = '15_8_'.$year;
        //Toussaint
        $publicHolidayArray[] = '1_11_'.$year;
        //Armistice
        $publicHolidayArray[] = '11_11_'.$year;
        //Noël
        $publicHolidayArray[] = '25_12_'.$year;

        //Pâques, car variable d'une année sur l'autre
        $easterDay = easter_date($year);
        $publicHolidayArray[] = date('j_n_'.$year, $easterDay + 86400);
        //Ascension
        $publicHolidayArray[] = date('j_n_'.$year, $easterDay + (86400 * 39));
        //Pentecôte
        $publicHolidayArray[] = date('j_n_'.$year, $easterDay + (86400 * 50));

        $publicDays = 0;

        while($startDate <= $endDate){
            //Si jour suivant n'est pas un dimanche (0) ou un samedi (6), ni un jour férié, on incrémente les jours ouvrés
            if(!in_array(date('w', $startDate), array(0,6)) 
                && !in_array(date('j_n_'.date('Y', $startDate), $startDate), $publicHolidayArray)){
                $publicDays++;
            }
            $startDate = mktime(date('H', $startDate), 
                                date('i', $startDate), 
                                date('s', $startDate), 
                                date('m', $startDate), 
                                date('d', $startDate) + 1, 
                                date('Y', $startDate));
        }
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        return $publicDays;
    }
}

function displayServices(){
  
}

?>

