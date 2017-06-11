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

                            if(validate($aviDate)){
                                insertServiceValues($aviDate, $aviHeure, $id_orderForm, $id);
                                insertRoyalties($plane, $fuel, $category, $planeLength, $maxWeight, $id, $acousticGroup);
                            }
                        }

                        if($service == "landing"){
                            if(validate($attDate)){
                                insertServiceValues($attDate, $attHeure, $id_orderForm, $id);
                                insertRoyalties($plane, $fuel, $category, $planeLength, $maxWeight, $id, $acousticGroup);
                            }
                        }

                        if($service == "inside_cleaning"){
                            if(validate($netDate)){
                                insertServiceValues($netDate, $netHeure, $id_orderForm, $id);
                                insertRoyalties($plane, $fuel, $category, $planeLength, $maxWeight, $id, $acousticGroup);
                            }
                        }

                        if($service == "parachuting"){
                            if(validate($paraDate)){
                                insertServiceValues($paraDate, $paraHeure, $id_orderForm, $id);
                                insertRoyalties($plane, $fuel, $category, $planeLength, $maxWeight, $id, $acousticGroup);
                            }
                        }
                            
                        if($service == "ulm"){
                            if(validate($ulmDate)){
                                insertServiceValues($ulmDate, $ulmHeure, $id_orderForm, $id);
                                insertRoyalties($plane, $fuel, $category, $planeLength, $maxWeight, $id, $acousticGroup);
                            }
                        }
                            
                        if($service == "first_flying"){
                            if(validate($baptDate)){
                                insertServiceValues($baptDate, $baptHeure, $id_orderForm, $id);
                                insertRoyalties($plane, $fuel, $category, $planeLength, $maxWeight, $id, $acousticGroup);
                            }
                        }
                        if($service == "flying_lesson"){
                            if(validate($leconDate)){
                                insertServiceValues($leconDate, $leconHeure, $id_orderForm, $id);
                                insertRoyalties($plane, $fuel, $category, $planeLength, $maxWeight, $id, $acousticGroup);
                            }
                        }
                    }
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