<?php 

require_once("class/ComputePriceService.php");
require_once("class/OrderFormManager.php");

require_once("class/Service.php");
require_once("class/User.php");
require_once("class/OrderFormService.php");
require_once("function.php");

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
    $endHour = filter_input(INPUT_POST, 'statHeureFin');
    $priceParking = filter_input(INPUT_POST, "priceParking");
    $shelter = filter_input(INPUT_POST, 'shelter');

    $startParkingDate = filter_input(INPUT_POST, 'statDateDebut');
    $endParkingDate = filter_input(INPUT_POST, 'statDateFin');

    $qteFuel = filter_input(INPUT_POST, 'qteFuel');

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

    $serviceHourArray = [
        "parking" => filter_input(INPUT_POST, 'statHeureDebut'), 
        "refueling" => filter_input(INPUT_POST, 'aviHeure'), 
        "landing" => filter_input(INPUT_POST, 'attHeure'),
        "inside_cleaning" => filter_input(INPUT_POST, 'netHeure'), 
        "parachuting" => filter_input(INPUT_POST, 'paraHeure'), 
        "ulm" => filter_input(INPUT_POST, 'ulmHeure'), 
        "first_flying" => filter_input(INPUT_POST, 'baptHeure'), 
        "flying_lesson" => filter_input(INPUT_POST, 'leconHeure')
    ];
    
    $surface = $planeLength * $planeWidth;


//Récupération des valeurs des options du select
if(isset($_POST['ffa']) && isset($_POST['planeSelecter']) && isset($_POST['fuel']) && isset($_POST['acousticGroup'], $planeLength, $maxWeight, $planeWidth)){
    $ffa = $_POST['ffa'];
    $plane = $_POST['planeSelecter'];
    $fuel = $_POST['fuel'];
    $acousticGroup = $_POST['acousticGroup'];

    $planeLength = trim($planeLength) != '' ? $planeLength : null;
    $planeWidth = trim($planeWidth) != '' ? $planeWidth : null;
    $maxWeight = trim($maxWeight) != '' ? $maxWeight : null;

    if(isset($plane, $fuel, $acousticGroup, $planeLength, $maxWeight, $planeWidth)){
            $manager = DatabaseManager::getSharedInstance();
            $connect = $manager->connect();

            if(isset($_POST["services"])){
                $idUser = User::getIdFromDb();
                $insert_fkCoeffId_orderForm = "INSERT INTO order_form(validation, user_id, acoustic_group) VALUES(0, :userId, :acoustic_group)";
                $fkCoeffId_orderForm_prep = $connect->prepare($insert_fkCoeffId_orderForm);
                $fkCoeffId_orderForm_prep->execute(array(':userId'=>$idUser,':acoustic_group'=>$acousticGroup));
                $id_orderForm = $connect->lastInsertId();

                $fuelValues = explode(' ', $fuel);
                foreach($_POST['services'] as $service){ 
                        $idService = Service::getIdFromService($service);
                        
                        $computePriceService = ComputePriceService::getSharedInstance();
                        $orderFormManager = OrderFormManager::getSharedInstance();

                        $serviceStartDate = $orderFormManager->findInArray($service, $serviceDateArray, "");
                        
                        $serviceEndDate = ($service == "parking") ? $endDate : $serviceStartDate;
                        $serviceStartHour = $orderFormManager->findInArray($service, $serviceHourArray, "");
                        
                        $serviceEndHour = ($service == "parking") ? $endHour : $serviceStartHour;

                        $serviceHtPriceArray = [
                            "refueling" => $computePriceService->refuelingHTPrice($fuelValues, $qteFuel),
                            "landing" => $landingHTPrice =  $computePriceService->landingHTPrice($service, $plane, $serviceStartDate, $serviceStartHour, $acousticGroup, $id_orderForm),
                            "parachuting" => 80,
                            "ulm" => 120,
                            "first_flying" => 80,
                            "flying_lesson" => 70,
                            "parking" => ($shelter == "Oui") 
                                ? $computePriceService->priceHTShelter($priceParking, $surface, $maxWeight)
                                : $computePriceService->computeHTParkingPrice($priceParking, $surface)
                        ];

                        $serviceHtPrice = $orderFormManager->findInArray($service, $serviceHtPriceArray);

                        $serviceTtcPriceArray = [
                            "landing" => $landingTTCPrice = $computePriceService->landingTTCPrice($service, $plane, $serviceStartDate, $serviceStartHour, $acousticGroup, $id_orderForm),
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
                        $qteFuelComputed = ($service == "refueling") ? $qteFuel : 0;
                        
                        $serviceObject = new Service();
                        $serviceObject->setName($service);
                        
                        try {
                            $orderFormService = new OrderFormService($serviceStartDate, $serviceEndDate, $serviceStartHour, $serviceEndHour, $id_orderForm, $idService, null);
                            $royalty = new Royalty($fuel, $plane, $qteFuelComputed, $serviceCategory, $planeLength, $maxWeight, $planeWidth, $surface, $serviceHtPrice, $serviceTtcPrice, $ffa, $idService, $acousticGroup);

                            // $dateHourManager = DateHourManager::isMonth($serviceStartDate, $serviceEndDate);
                            $orderform = $orderFormManager->insertOrderFormService($orderFormService, $royalty, $serviceObject);
                        } catch (Exception $e) {
                            $message = $e->getMessage();
                        }
                    }
                    if(isParked($id_orderForm) && $orderFormManager->isLanding($service)){
                        $landingParkingHtPrice = $computePriceService->landingParkingHTPrice($id_orderForm, $plane, $orderform, $landingHTPrice, $startParkingDate, $endParkingDate);
                        $landingParkingTtcPrice = $computePriceService->landingParkingTTCPrice($id_orderForm, $plane, $orderform, $landingTTCPrice, $startParkingDate, $endParkingDate);
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