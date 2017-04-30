<?php 
    include "reservation.php";

    $message = null;

    $planeLength = filter_input(INPUT_POST, 'planeLength');
    $maxWeight = filter_input(INPUT_POST, 'maxWeight');

    $startDate = filter_input(INPUT_POST, 'statDateDebut');
    $endDate = filter_input(INPUT_POST, 'statDateFin');
    $startHour = filter_input(INPUT_POST, 'statHeureDebut');
    $endHour = filter_input(INPUT_POST, 'statHeureFin');

    $aviDate = filter_input(INPUT_POST, 'aviDate');
    $aviHeure = filter_input(INPUT_POST, 'aviHeure');



//Récupération des valeurs des options du select
if(isset($_POST['planeSelecter']) && isset($_POST['fuel']) && isset($_POST['category']) && isset($_POST['acousticGroup'], $planeLength, $maxWeight)){
    $plane = $_POST['planeSelecter'];
    $fuel = $_POST['fuel'];
    $acousticGroup = $_POST['acousticGroup'];
    $category = $_POST['category'];

    $planeLength = trim($planeLength) != '' ? $planeLength : null;
    $maxWeight = trim($maxWeight) != '' ? $maxWeight : null;

    //if(isset($plane, $fuel, $category, $acousticGroup, $planeLength, $maxWeight)){
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

           
            foreach($_POST['services'] as $service){
                  $insertion_services = "INSERT INTO services(type) VALUES(:service)";
                  
                  $insert_prep_services = $connect->prepare($insertion_services);
                 

                  $inser_exec_services = $insert_prep_services->execute(array(':service'=>$service));
            }

             $insertion = "INSERT INTO royalties(landing_type, petroleum_type, rate_type, plane_length, plane_weight) VALUES(:plane, :fuel, :category, :planeLength, :maxWeight)";
            $insertion_acousticGroup = "INSERT INTO coefficient(acoustic_group) VALUES(:acousticGroup)";


            $insertion_dateHourParking = "INSERT INTO order_form_service(booking_start_date, booking_end_date, booking_start_hour, booking_end_hour) VALUES(:startDate, :endDate, :startHour, :endHour)";
            $insesrtion_dateHourAvi = "INSERT INTO order_form_service(booking_start_date, booking_end_date) VALUES(:aviDate, :aviHeure)";

            $insert_prep = $connect->prepare($insertion_dateHourParking);
            $insert_prep2 = $connect->prepare($insesrtion_dateHourAvi);

            $insert_exec = $insert_prep->execute(array(':startDate'=>$startDate, ':endDate'=>$endDate, ':startHour'=>$startHour, ':endHour'=>$endHour));
            $insert_exec2 = $insert_prep2->execute(array(':aviDate'=>$aviDate, ':aviHeure'=>$aviHeure));
           
           $insert_prep = $connect->prepare($insertion);
            $insert_prep_acousticGroup = $connect->prepare($insertion_acousticGroup);
            

            $inser_exec = $insert_prep->execute(array(':plane'=>$plane, ':fuel'=>$fuel, ':category'=>$category, ':planeLength'=>$planeLength, ':maxWeight'=>$maxWeight));
            $inser_exec_acousticGroup = $insert_prep_acousticGroup->execute(array(':acousticGroup'=>$acousticGroup));
            
            if($insert_exec === true){
                echo 'La réservation est bien enregistrée !';
            }
        }else{
            echo 'Tous les champs doivent être renseignés';
        }
    }else{
        echo 'Tous les champs doivent être renseignés';
    }


?>