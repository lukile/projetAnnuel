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

                        $insert_fkCoeffId_orderForm = "INSERT INTO order_form(acoustic_group) VALUES(:acoustic_group)";
                        $fkCoeffId_orderForm_prep = $connect->prepare($insert_fkCoeffId_orderForm);
                        $fkCoeffId_orderForm_exec = $fkCoeffId_orderForm_prep->execute(array(':acoustic_group'=>$acousticGroup));
                       
                        $select_orderFormId = "SELECT id FROM order_form WHERE acoustic_group=:acoustic_group";
                        $orderFormId_prep = $connect->prepare($select_orderFormId);
                        $orderFormId_prep->execute(array(':acoustic_group'=>$acousticGroup));
                        $fetch_orderFormId = $orderFormId_prep->fetch();
                        $id_orderForm = $fetch_orderFormId['id'];

                        if($service == "parking"){
                            $startDateFormat = date_create_from_format('d-m-Y', $startDate);
                            $formattedStartDate = $startDateFormat->format('Y-m-d');    

                            $endDateFormat = date_create_from_format('d-m-Y', $endDate);
                            $formattedEndDate = $endDateFormat->format('Y-m-d');

                            if($formattedStartDate > strftime('%Y-%m-%d')){
                                if($formattedEndDate >= $formattedStartDate){
                                    $insert_parking = "INSERT INTO order_form_service(booking_start_date, booking_end_date, booking_start_hour, booking_end_hour, order_form_id, service_id) VALUES(:startDate, :endDate, :startHour, :endHour, :acousticGroup, :coeffId)";
                                    $park_prep = $connect->prepare($insert_parking);
                                    $park_exec = $park_prep->execute(array(':startDate'=>$startDate, ':endDate'=>$endDate, ':startHour'=>$startHour, ':endHour'=>$endHour, ':acousticGroup'=>$id_orderForm, ':coeffId'=>$id));
                                }else{
                                    $message = 'La date de fin ne peut pas être antérieure à la date de début';
                                }
                            }else{
                                $message = 'La date de réservation ne peut s\'effectuer avant la date courante. Piou';
                            }
                        }
                        if($service == "refueling"){
                            $aviDateFormat = date_create_from_format('d-m-Y', $aviDate);
                            $formattedAviDate = $aviDateFormat->format('Y-m-d');
                            
                            if($formattedAviDate >= strftime('%Y-%m-%d')){
                                /*if($service == "parking"){*/
                                    $insert_refuel = "INSERT INTO order_form_service(booking_start_date, booking_start_hour, order_form_id, service_id) VALUES(:aviDate, :aviHeure,:acousticGroup, :coeffId)";
                                    $refuel_prep = $connect->prepare($insert_refuel);
                                    $refuel_exec = $refuel_prep->execute(array(':aviDate'=>$aviDate, ':aviHeure'=>$aviHeure, ':acousticGroup'=>$id_orderForm, ':coeffId'=>$id));
                                /*}else{
                                    $message = 'Vous devez d\'abord sélectionner le service "stationnement" afin de pouvoir bénéficier de ce service';    
                                }*/
                            }else{
                                $message = 'La date de réservation ne peut s\'effectuer avant la date courante pouet';
                            }
                            echo " services : " .$service;
                        }
                        if($service == "landing"){
                            $attDateFormat = date_create_from_format('d-m-Y', $attDate);
                            $formattedAttDate = $attDateFormat->format('Y-m-d');      

                            if($formattedAttDate >= strftime('%Y-%m-%d')){
                                /*if($service == "parking"){ */
                                    $insert_land = "INSERT INTO order_form_service(booking_start_date, booking_start_hour, order_form_id, service_id) VALUES(:attDate, :attHeure, :acousticGroup, :coeffId)";
                                    $land_prep = $connect->prepare($insert_land);
                                    $land_exec = $land_prep->execute(array(':attDate'=>$attDate, ':attHeure'=>$attHeure, ':acousticGroup'=>$id_orderForm, ':coeffId'=>$id));
                                /*}else{
                                 $message = 'Vous devez d\'abord sélectionner le service "stationnement" afin de pouvoir bénéficier de ce service';
                                }*/    
                            }else{
                                $message = 'La date de réservation ne peut s\'effectuer avant la date courante';
                            }
                        }
                        if($service == "inside_cleaning"){
                            $netDateFormat = date_create_from_format('d-m-Y', $netDate);
                            $formattedNetDate = $netDateFormat->format('Y-m-d');

                            if($formattedNetDate >= strftime('%Y-%m-%d')){
                                /*if($service == "parking"){*/
                                    $insert_inClean = "INSERT INTO order_form_service(booking_start_date, booking_start_hour, order_form_id, service_id) VALUES (:netDate, :netHeure, :acousticGroup, :coeffId)";
                                    $inClean_prep = $connect->prepare($insert_inClean);
                                    $inClean_exec = $inClean_prep->execute(array(':netDate'=>$netDate, ':netHeure'=>$netHeure, ':acousticGroup'=>$id_orderForm, ':coeffId'=>$id));
                               /* }else{
                                 $message = 'Vous devez d\'abord sélectionner le service "stationnement" afin de pouvoir bénéficier de ce service';
                                }*/    
                            }else{
                                $message = 'La date de réservation ne peut s\'effectuer avant la date courante';
                            }                            
                        }
                        if($service == "parachuting"){
                            $paraDateFormat = date_create_from_format('d-m-Y', $paraDate);
                            $formattedParaDate = $paraDateFormat->format('Y-m-d');

                            if($formattedParaDate >= strftime('%Y-%m-%d')){
                                $insert_para = "INSERT INTO order_form_service(booking_start_date, booking_start_hour,order_form_id, service_id) VALUES(:paraDate, :paraHeure, :acousticGroup, :coeffId)";
                                $para_prep = $connect->prepare($insert_para);
                                $para_exec = $para_prep->execute(array(':paraDate'=>$paraDate, ':paraHeure'=>$paraHeure,  ':acousticGroup'=>$id_orderForm, ':coeffId'=>$id));
                            }else{
                                $message = 'La date de réservation ne peut s\'effectuer avant la date courante';
                            }
                        }

                        if($service == "ulm"){
                            $ulmDateFormat = date_create_from_format('d-m-Y', $ulmDate);
                            $formattedUlmDate = $ulmDateFormat->format('Y-m-d');
                            
                            if($formattedUlmDate >= strftime('%Y-%m-%d')){
                                $insert_ulm = "INSERT INTO order_form_service(booking_start_date, booking_start_hour,order_form_id, service_id) VALUES(:ulmDate, :ulmHeure, :acousticGroup, :coeffId)";
                                $ulm_prep = $connect->prepare($insert_ulm);
                                $ulm_exec = $ulm_prep->execute(array(':ulmDate'=>$ulmDate, ':ulmHeure'=>$ulmHeure,  ':acousticGroup'=>$id_orderForm, ':coeffId'=>$id));
                            }else{
                                $message = 'La date de réservation ne peut s\'effectuer avant la date courante';
                            }
                        }

                        if($service == "first_flying"){
                            $baptDateFormat = date_create_from_format('d-m-Y', $baptDate);
                            $formattedBaptDate = $baptDateFormat->format('Y-m-d');

                            if($formattedBaptDate >= strftime('%Y-%m-%d')){
                                $insert_fFlight = "INSERT INTO order_form_service(booking_start_date, booking_start_hour, , order_form_idservice_id) VALUES (:baptDate, :baptHeure,:acousticGroup, :coeffId)";
                                $fFlight_prep = $connect->prepare($insert_fFlight);
                                $fFlight_exec = $fFlight_prep->execute(array(':baptDate'=>$baptDate, ':baptHeure'=>$baptHeure,  ':acousticGroup'=>$id_orderForm, ':coeffId'=>$id));
                            }else{
                                $message = 'La date de réservation ne peut s\'effectuer avant la date courante';
                            }
                        }
                        if($service == "flying_lesson"){
                            $leconDateFormat = date_create_from_format('d-m-Y', $leconDate);
                            $formattedLeconDate = $leconDateFormat->format('Y-m-d');    

                            if($formattedLeconDate > strftime('%Y-%m-%d')){
                                $insert_fLesson = "INSERT INTO order_form_service(booking_start_date, booking_start_hour, order_form_id, service_id) VALUES (:leconDate, :leconHeure,:acousticGroup, :coeffId)";
                                $fLesson_prep = $connect->prepare($insert_fLesson);
                                $fLesson_exec = $fLesson_prep->execute(array(':leconDate'=>$leconDate, ':leconHeure'=>$leconHeure,  ':acousticGroup'=>$id_orderForm, ':coeffId'=>$id));
                            }else{
                                $message = 'La date de réservation ne peut s\'effectuer avant la date courante';
                            }
                        }
                    }
                
                
                
/*
                $insert_fkIds_royalties = "INSERT INTO royalties(service_id, coeff_id) VALUES(:idService, :idCoeff)";
                $fkIds_royalties_prep = $connect->prepare($insert_fkIds_royalties);
                $fkIds_royalties_exec = $fkIds_royalties_prep->execute(array('idService'=>$id,':idCoeff'=>$id_coeffId));*/
                
                $insertion = "INSERT INTO royalties(landing_type, petroleum_type, rate_type, plane_length, plane_weight, service_id, acoustic_group) VALUES(:plane, :fuel, :category, :planeLength, :maxWeight, :idService, :acoustic_group)";
                $fkIds_royalties_prep = $connect->prepare($insertion);      
                
                /*$insert_prep = $connect->prepare($insertion);*/
                $fkIds_royalties_exec = $fkIds_royalties_prep->execute(array(':plane'=>$plane, ':fuel'=>$fuel, ':category'=>$category, ':planeLength'=>$planeLength, ':maxWeight'=>$maxWeight,'idService'=>$id,':acoustic_group'=>$acousticGroup));


                
                /*$update = "UPDATE order_form_service SET order_form_id=:order_form_id WHERE service_id=:serviceId";
                $update_prep = $connect->prepare($update);
                $update_prep->execute(array(':order_form_id'=>$id_orderForm, ':serviceId'=>$id));
                $fetch_update = $update_prep->fetch();
                $iddoeir = $fetch_update['order_form_id'];
*/
                echo ' doekdoe :  '.$id_orderForm;
                    
                            
/*                $inser_exec = $insert_prep->execute(array(':plane'=>$plane, ':fuel'=>$fuel, ':category'=>$category, ':planeLength'=>$planeLength, ':maxWeight'=>$maxWeight));
*/
                }else{
                    $message = "Vous devez sélectionner une activité au moins pour valider la réservation";
                }
            }else{
                $message =  'Tous les champs doivent être renseignés';
            }
        }else{
            $message =  'Tous les champs doivent être renseignés';
        }
       

    

 



?>