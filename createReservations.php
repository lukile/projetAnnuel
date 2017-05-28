<?php 

    $message = null;

    $service = null;
    //Get Europe current locale time 
    setlocale(LC_TIME, 'fr_FR');
    date_default_timezone_set("Europe/Brussels");

    $planeLength = filter_input(INPUT_POST, 'planeLength');
    $maxWeight = filter_input(INPUT_POST, 'maxWeight');

    $startDate = filter_input(INPUT_POST, 'statDateDebut');
    $endDate = filter_input(INPUT_POST, 'statDateFin');
    $startHour = filter_input(INPUT_POST, 'statHeureDebut');
    $endHour = filter_input(INPUT_POST, 'statHeureFin');

    $aviDate = filter_input(INPUT_POST, 'aviDate');
    $aviHeure = filter_input(INPUT_POST, 'aviHeure');

    $attDate = filter_input(INPUT_POST, 'attDate');
    $attHeure = filter_input(INPUT_POST, 'attHeure');

    $netDate = filter_input(INPUT_POST, 'netDate');
    $netHeure = filter_input(INPUT_POST, 'netHeure');

    $paraDate = filter_input(INPUT_POST, 'paraDate');
    $paraHeure = filter_input(INPUT_POST, 'paraHeure');

    $ulmDate = filter_input(INPUT_POST, 'ulmDate');
    $ulmHeure = filter_input(INPUT_POST, 'ulmHeure');

    $baptDate = filter_input(INPUT_POST, 'baptDate');
    $baptHeure = filter_input(INPUT_POST, 'baptHeure');

    $leconDate = filter_input(INPUT_POST, 'leconDate');
    $leconHeure = filter_input(INPUT_POST, 'leconHeure');


//Récupération des valeurs des options du select
if(isset($_POST['planeSelecter']) && isset($_POST['fuel']) && isset($_POST['category']) && isset($_POST['acousticGroup'], $planeLength, $maxWeight)){
    $plane = $_POST['planeSelecter'];
    $fuel = $_POST['fuel'];
    $acousticGroup = $_POST['acousticGroup'];
    $category = $_POST['category'];

    $planeLength = trim($planeLength) != '' ? $planeLength : null;
    $maxWeight = trim($maxWeight) != '' ? $maxWeight : null;

    if(isset($plane, $fuel, $category, $acousticGroup, $planeLength, $maxWeight)){
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

            if(isset($_POST["services"])){
                         
            
                foreach($_POST['services'] as $service){            
                        
                        $select_services = "SELECT id from services WHERE type=:service";
                        $insertion_prep_services = $connect->prepare($select_services);
                        $insertion_prep_services->execute(array(':service'=>$service));
                        $fetch_query = $insertion_prep_services->fetch();
                        $id = $fetch_query['id'];

                        
                        $select_orderFormId = "SELECT id FROM order_form WHERE coefficient_id=:coefficient_id";
                        $orderFormId_prep = $connect->prepare($select_orderFormId);
                        $orderFormId_prep->execute(array(':coefficient_id'=>$acousticGroup));
                        $fetch_orderFormId = $orderFormId_prep->fetch();
                        $id_orderForm = $fetch_orderFormId['id'];

                        if($service == "parking"){
                            if($startDate > strftime('%d-%m-%y') && $endDate > strftime('%d-%m-%y') && $endDate > $startDate){
                                $insert_parking = "INSERT INTO order_form_service(booking_start_date, booking_end_date, booking_start_hour, booking_end_hour, order_form_id, service_id) VALUES(:startDate, :endDate, :startHour, :endHour, :orderFormId, :coeffId)";
                                $park_prep = $connect->prepare($insert_parking);
                                $park_exec = $park_prep->execute(array(':startDate'=>$startDate, ':endDate'=>$endDate, ':startHour'=>$startHour, ':endHour'=>$endHour, ':orderFormId'=>$id_orderForm, ':coeffId'=>$id));
                             }else{
                                $message = 'La date de réservation ne peut s\'effectuer avant la date courante. La date de fin ne peut pas être antérieure à la date de début';
                            }
                        }
                        if($service == "refueling"){
                           if($service == "parking"){
                                if($aviDate > strftime('%d-%m-%y')){
                                    $insert_refuel = "INSERT INTO order_form_service(booking_start_date, booking_start_hour, order_form_id, service_id) VALUES(:aviDate, :aviHeure, :orderFormId, :coeffId)";
                                    $refuel_prep = $connect->prepare($insert_refuel);
                                    $refuel_exec = $refuel_prep->execute(array(':aviDate'=>$aviDate, ':aviHeure'=>$aviHeure, ':orderFormId'=>$id_orderForm, ':coeffId'=>$id));
                                }else{
                                    $message = 'La date de réservation ne peut s\'effectuer avant la date courante';
                                }
                            }else{
                                $message = 'Vous devez d\'abord vous sélectionner le service "stationnement" afin de pouvoir bénéficier de ce service';
                            }
                        }
                        if($service == "landing"){
                            if($service == "parking"){
                                if($attDate > strftime('%d-%m-%y')){
                                    $insert_land = "INSERT INTO order_form_service(booking_start_date, booking_start_hour, order_form_id, service_id) VALUES(:attDate, :attHeure, :orderFormId, :coeffId)";
                                    $land_prep = $connect->prepare($insert_land);
                                    $land_exec = $land_prep->execute(array(':attDate'=>$attDate, ':attHeure'=>$attHeure, ':orderFormId'=>$id_orderForm, ':coeffId'=>$id));
                                }else{
                                    $message = 'La date de réservation ne peut s\'effectuer avant la date courante';
                                }
                            }else{
                                 $message = 'Vous devez d\'abord vous sélectionner le service "stationnement" afin de pouvoir bénéficier de ce service';
                            }
                        }
                        if($service == "inside_cleaning"){
                            if($service == "parking"){
                                if($netDate > strftime('%d-%m-%y')){
                                    $insert_inClean = "INSERT INTO order_form_service(booking_start_date, booking_start_hour, order_form_id, service_id) VALUES (:netDate, :netHeure, :orderFormId, :coeffId)";
                                    $inClean_prep = $connect->prepare($insert_inClean);
                                    $inClean_exec = $inClean_prep->execute(array(':netDate'=>$netDate, ':netHeure'=>$netHeure, ':orderFormId'=>$id_orderForm, ':coeffId'=>$id));
                                }else{
                                    $message = 'La date de réservation ne peut s\'effectuer avant la date courante';
                                }
                            }else{
                                 $message = 'Vous devez d\'abord vous sélectionner le service "stationnement" afin de pouvoir bénéficier de ce service';
                            }
                        }
                        if($service == "parachuting"){
                            if($paraDate > strftime('%d-%m-%y')){
                                $insert_para = "INSERT INTO order_form_service(booking_start_date, booking_start_hour, order_form_id, service_id) VALUES(:paraDate, :paraHeure, :orderFormId, :coeffId)";
                                $para_prep = $connect->prepare($insert_para);
                                $para_exec = $para_prep->execute(array(':paraDate'=>$paraDate, ':paraHeure'=>$paraHeure, ':orderFormId'=>$id_orderForm, ':coeffId'=>$id));
                            }else{
                                $message = 'La date de réservation ne peut s\'effectuer avant la date courante';
                            }
                        }
                        if($service == "ulm"){
                            if($ulmDate > strftime('%d-%m-%y')){
                                $insert_ulm = "INSERT INTO order_form_service(booking_start_date, booking_start_hour, order_form_id, service_id) VALUES(:ulmDate, :ulmHeure, :orderFormId, :coeffId)";
                                $ulm_prep = $connect->prepare($insert_ulm);
                                $ulm_exec = $ulm_prep->execute(array(':ulmDate'=>$ulmDate, ':ulmHeure'=>$ulmHeure, ':orderFormId'=>$id_orderForm, ':coeffId'=>$id));
                            }else{
                                $message = 'La date de réservation ne peut s\'effectuer avant la date courante';
                            }
                        }
                        if($service == "first_flight"){
                            if($baptDate > strftime('%d-%m-%y')){
                                $insert_fFlight = "INSERT INTO order_form_service(booking_start_date, booking_start_hour, order_form_id, service_id) VALUES (:baptDate, :baptHeure, :orderFormId, :coeffId)";
                                $fFlight_prep = $connect->prepare($insert_fFlight);
                                $fFlight_exec = $fFlight_prep->execute(array(':baptDate'=>$baptDate, ':baptHeure'=>$baptHeure, ':orderFormId'=>$id_orderForm, ':coeffId'=>$id));
                            }else{
                                $message = 'La date de réservation ne peut s\'effectuer avant la date courante';
                            }
                        }
                        if($service == "flying_lesson"){
                            if($leconDate > strftime('%d-%m-%y')){
                                $insert_fLesson = "INSERT INTO order_form_service(booking_start_date, booking_start_hour, order_form_id, service_id) VALUES (:leconDate, :leconHeure, :orderFormId, :coeffId)";
                                $fLesson_prep = $connect->prepare($insert_fLesson);
                                $fLesson_exec = $fLesson_prep->execute(array(':leconDate'=>$leconDate, ':leconHeure'=>$leconHeure, ':orderFormId'=>$id_orderForm, ':coeffId'=>$id));
                            }else{
                                $message = 'La date de réservation ne peut s\'effectuer avant la date courante';
                            }
                        }
                }

                $insertion_acousticGroup = "INSERT INTO coefficient(acoustic_group) VALUES(:acousticGroup)";
                $insert_prep_acousticGroup = $connect->prepare($insertion_acousticGroup);
                $inser_exec_acousticGroup = $insert_prep_acousticGroup->execute(array(':acousticGroup'=>$acousticGroup));


                $select_coeffId = "SELECT id FROM coefficient WHERE acoustic_group =:acoustic_group";
                $coeffId_prep = $connect->prepare($select_coeffId);
                $coeffId_prep->execute(array(':acoustic_group'=>$acousticGroup));
                $fetch_coeffId = $coeffId_prep->fetch();
                $id_coeffId = $fetch_coeffId['id']; 

                $insert_fkCoeffId_orderForm = "INSERT INTO order_form(coefficient_id) VALUES(:id)";
                $fkCoeffId_orderForm_prep = $connect->prepare($insert_fkCoeffId_orderForm);
                $fkCoeffId_orderForm_exec = $fkCoeffId_orderForm_prep->execute(array(':id'=>$id_coeffId));

                $insert_fkIds_royalties = "INSERT INTO royalties(service_id, coeff_id) VALUES(:idService, :idCoeff)";
                $fkIds_royalties_prep = $connect->prepare($insert_fkIds_royalties);
                $fkIds_royalties_exec = $fkIds_royalties_prep->execute(array('idService'=>$id,':idCoeff'=>$id_coeffId));
                
                $insertion = "INSERT INTO royalties(landing_type, petroleum_type, rate_type, plane_length, plane_weight) VALUES(:plane, :fuel, :category, :planeLength, :maxWeight)";

                $insert_prep = $connect->prepare($insertion);

                    
                            
                $inser_exec = $insert_prep->execute(array(':plane'=>$plane, ':fuel'=>$fuel, ':category'=>$category, ':planeLength'=>$planeLength, ':maxWeight'=>$maxWeight));

            }else{
                 $message = 'Vous devez sélectionner au moins un service pour effectuer une réservation';
            }
        }else{
            $message =  'Tous les champs doivent être renseignés';
        }
        $message = "Votre réservation a bien été prise en compte";
    }

    

 



?>