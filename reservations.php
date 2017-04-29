<?php 
    include "reservation.php";

    $message = null;

    $planeLength = filter_input(INPUT_POST, 'planeLength');
    $maxWeight = filter_input(INPUT_POST, 'maxWeight');
    


//Récupération des valeurs des options du select
if(isset($_POST['planeSelecter']) && isset($_POST['fuel']) && isset($_POST['category']) && isset($_POST['acousticGroup'], $planeLength, $maxWeight)){
    $plane = $_POST['planeSelecter'];
    $fuel = $_POST['fuel'];
    $acousticGroup = $_POST['acousticGroup'];
    $category = $_POST['category'];


    foreach($_POST['services'] as $service){
        echo "La checkbox $service a été cochée";
    }

    $planeLength = trim($planeLength) != '' ? $planeLength : null;
    $maxWeight = trim($maxWeight) != '' ? $maxWeight : null;

    if(isset($plane, $fuel, $category, $acousticGroup, $planeLength, $maxWeight, $service)){
        if(isset($plane, $fuel, $category)){
            $hostname = "localhost";
            $database = "aen";
            $username = "root";
            $password = "";

            /* Désactive l'éumlateur de requêtes préparées (hautement recommandé)  */
            $pdo_options[PDO::ATTR_EMULATE_PREPARES] = false;
                    
            /* Active le mode exception */
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    
            /* Indique le charset */
            $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
                    
            /* Connexion */
            try{
                $connect = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password, $pdo_options);
            }catch (PDOException $e){
                exit('problème de connexion à la base');
            }

            $insertion = "INSERT INTO royalties(landing_type, petroleum_type, rate_type, plane_length, plane_weight) VALUES(:plane, :fuel, :category, :planeLength, :maxWeight)";
            $insertion_acousticGroup = "INSERT INTO coefficient(acoustic_group) VALUES(:acousticGroup)";
            $insertion_services = "INSERT INTO services(type) VALUES(:service)";

            $insert_prep = $connect->prepare($insertion);
            $insert_prep2 = $connect->prepare($insertion_acousticGroup);
            $insert_prep3 = $connect->prepare($insertion_services);

            $inser_exec = $insert_prep->execute(array(':plane'=>$plane, ':fuel'=>$fuel, ':category'=>$category, ':planeLength'=>$planeLength, ':maxWeight'=>$maxWeight));
            $inser_exec2 = $insert_prep2->execute(array(':acousticGroup'=>$acousticGroup));
            $inser_exec3 = $insert_prep3->execute(array(':service'=>$service));
            
            if($inser_exec === true){
                echo 'La réservation est bien enregistrée !';
            }
        }else{
            echo 'Tous les champs doivent être renseignés';
        }
    }else{
        echo 'Tous les champs doivent être renseignés';
    }
}

?>