<?php 

require_once("class/ComputePriceService.php");
require_once("class/OrderFormManager.php");

require_once("class/Service.php");
require_once("class/User.php");
require_once("class/OrderFormService.php");

    if(!isConnected()){
        header("Location:login.php");
        die();
    }

    $message = null;

    //Get Europe current locale time 
    setlocale(LC_TIME, 'fr_FR');
    date_default_timezone_set("Europe/Brussels");

    $service = null;

    $planeLength = filter_input(INPUT_POST, 'planeLength');
    $planeWidth = filter_input(INPUT_POST, 'planeWidth');
    $maxWeight = filter_input(INPUT_POST, 'maxWeight');
    
    $endDate = filter_input(INPUT_POST, 'statDateFin');
    $startHour = filter_input(INPUT_POST, 'statHeureDebut');
    $endHour = filter_input(INPUT_POST, 'statHeureFin');
    $priceParking = filter_input(INPUT_POST, "priceParking");
    $shelter = filter_input(INPUT_POST, 'shelter');

    $aviHeure = filter_input(INPUT_POST, 'aviHeure');
    $qteFuel = filter_input(INPUT_POST, 'qteFuel');

    $attHeure = filter_input(INPUT_POST, 'attHeure');

    $netHeure = filter_input(INPUT_POST, 'netHeure');

    $paraHeure = filter_input(INPUT_POST, 'paraHeure');

    $ulmHeure = filter_input(INPUT_POST, 'ulmHeure');

    $baptHeure = filter_input(INPUT_POST, 'baptHeure');

    $leconHeure = filter_input(INPUT_POST, 'leconHeure');
    $serviceDateArray = [
        "parking" => filter_input(INPUT_POST, 'statDateDebut'), 
        "refueling" => filter_input(INPUT_POST, 'aviDate'),
        "landing" => filter_input(INPUT_POST, 'attDate'),
        "inside_cleaning" => filter_input(INPUT_POST, 'netDate'),
        "parachuting" => filter_input(INPUT_POST, 'paraDate'), 
        "ulm" => filter_input(INPUT_POST, 'ulmDate'),
        "first_flying" => filter_input(INPUT_POST, 'baptDate'), 
        "flying_lesson" => filter_input(INPUT_POST, 'leconDate')
    ];

    $serviceHourArray = ["parking" => $startHour, "refueling" => $aviHeure, "landing" => $attHeure,
                        "inside_cleaning" => $netHeure, "parachuting" => $paraHeure, "ulm" => $ulmHeure, 
                        "first_flying" => $baptHeure, "flying_lesson" => $leconHeure];
    $surface = $planeLength * $planeWidth;


//Récupération des valeurs des options du select
if(isset($_POST['ffa'], $_POST['planeSelecter']) && isset($_POST['fuel']) && isset($_POST['category']) && isset($_POST['acousticGroup'], $planeLength, $maxWeight, $planeWidth)){
    $ffa = $_POST['ffa'];
    $plane = $_POST['planeSelecter'];
    $fuel = $_POST['fuel'];
    $acousticGroup = $_POST['acousticGroup'];
    $category = $_POST['category'];

    $planeLength = trim($planeLength) != '' ? $planeLength : null;
    $planeWidth = trim($planeWidth) != '' ? $planeWidth : null;
    $maxWeight = trim($maxWeight) != '' ? $maxWeight : null;

    if(isset($plane, $fuel, $category, $acousticGroup, $planeLength, $maxWeight, $planeWidth)){
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
                         
                $fuelValues = explode(' ', $fuel);
                foreach($_POST['services'] as $service){ 
                        $idService = Service::getIdFromService($service);
                        $idUser = User::getIdFromDb();
                         

                        $insert_fkCoeffId_orderForm = "INSERT INTO order_form(validation, user_id, acoustic_group) VALUES(0, :userId, :acoustic_group)";
                        $fkCoeffId_orderForm_prep = $connect->prepare($insert_fkCoeffId_orderForm);
                        $fkCoeffId_orderForm_exec = $fkCoeffId_orderForm_prep->execute(array(':userId'=>$idUser,':acoustic_group'=>$acousticGroup));
                       
                        $id_orderForm = $connect->lastInsertId();
                        
                        $computePriceService = ComputePriceService::getSharedInstance();
                        $orderFormManager = OrderFormManager::getSharedInstance();

                        $serviceStartDate = $orderFormManager->findInArray($service, $serviceDateArray, "");
                        
                        $serviceEndDate = ($service == "parking") ? $endDate : $serviceStartDate;
                        $serviceStartHour = $orderFormManager->findInArray($service, $serviceHourArray, "");
                        
                        $serviceEndHour = ($service == "parking") ? $endHour : $serviceStartHour;

                        $serviceHtPriceArray = [
                            "refueling" => $computePriceService->refuelingHTPrice($fuelValues, $qteFuel),
                            "landing" => $computePriceService->landingHTPrice($plane),
                            "parachuting" => 80,
                            "ulm" => 120,
                            "first_flying" => 70,
                            "flying_lesson" => 99999,
                            "parking" => ($shelter == "Oui") 
                                ? $computePriceService->priceHTShelter($priceParking, $surface, $maxWeight)
                                : $computePriceService->computeHTParkingPrice($priceParking, $surface)
                        ];
                        $serviceHtPrice = $orderFormManager->findInArray($service, $serviceHtPriceArray);

                        $serviceTtcPriceArray = [
                            "landing" => $computePriceService->landingTTCPrice($plane, $serviceStartHour),
                            "refueling" => $computePriceService->refuelingTTCPrice($fuelValues, $qteFuel),
                            "parking" => ($shelter == "Oui") 
                                ? $computePriceService->priceTTCShelter($priceParking, $surface, $maxWeight)
                                :$computePriceService->computeTTCParkingPrice($priceParking, $surface)
                        ];
                        
                        $serviceTtcPrice = $orderFormManager->findInArray($service, $serviceTtcPriceArray);
                        
                        $serviceCategory = "";
                        if ($service == "parking" && $shelter == "Oui") {
                            $serviceCategory = $computePriceService->categoryShelter($maxWeight, $surface);
                        }

                        $fuel = $computePriceService->typeRefueling($fuelValues);  
                        $qteFuel = ($service == "refueling") ? $qteFuel : 0;
                        
                        $serviceObject = new Service();
                        $serviceObject->setName($service);
                        
                        try {
                            $orderFormService = new OrderFormService($serviceStartDate, $serviceEndDate, $serviceStartHour, $serviceEndHour, $id_orderForm, $idService, null);
                            $royalty = new Royalty($fuel, $plane, $qteFuel, $serviceCategory, $planeLength, $maxWeight, $planeWidth, $surface, $serviceHtPrice, $serviceTtcPrice, $ffa, $idService, $acousticGroup);

                            $orderFormManager->insertOrderFormService($orderFormService, $royalty, $serviceObject);
                        } catch (Exception $e) {
                            $message = $e->getMessage();
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