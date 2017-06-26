<?php
require_once('DatabaseManager.php');
require_once('OrderFormService.php');
require_once('ComputePriceService.php');

require_once('Royalty.php');
require_once('Service.php');

class OrderFormManager {

    private static $instance;

    public function insertOrderFormService(OrderFormService $orderFormService, Royalty $royalty, Service $service) {
        if(!validate($orderFormService->getStartDate())) {
            throw new Exception("StartDate non valide");
        }
        $computePriceService = ComputePriceService::getSharedInstance();

        //Service parking
        if ($service->isParking()) {
            $startDateFormat = date_create_from_format('d-m-Y', $orderFormService->getStartDate());
            $formattedStartDate = $startDateFormat->format('Y-m-d');
            $endDateFormat = date_create_from_format('d-m-Y', $orderFormService->getEndDate());
            $formattedEndDate = $endDateFormat->format('Y-m-d');

            if($formattedStartDate < strftime('%Y-%m-%d')) {
                throw new Exception('La date de réservation ne peut s\'effectuer avant la date courante.');
            }
            if ($formattedEndDate < $formattedStartDate) {
                throw new Exception('La date de fin ne peut pas être antérieure à la date de début');
            }
        }

        $lastInsertId = $this->insertRoyalties($royalty);        
        $orderFormService->setRoyaltyId($lastInsertId);
 
        $this->insertOrderFormServiceValues($orderFormService);
    }

    private function insertRoyalties(Royalty $royalty){
        $manager = DatabaseManager::getsharedInstance();
        $connect = $manager->connect();

        $insert = "INSERT INTO royalties(landing_type, petroleum_type, fuel_quantity, rate_type, plane_length, plane_weight, wingspan, parking_surface, HT_price, TTC_price, ffa, service_id, acoustic_group) 
        VALUES(:plane, :fuel, :qutyFuel, :category, :planeLength, :maxWeight, :planeWidth, :surface, :htPrice, :ttcPrice, :ffa, :idService, :acoustic_group)";
        
        $insert_prep = $connect->prepare($insert);
        
        $insert_exec = $insert_prep->execute(array(
            ':plane'=>$royalty->getPlan(), 
            ':fuel'=>$royalty->getPetroleumProduct(), 
            ':qutyFuel'=>$royalty->getQteFuel(), 
            ':category'=>$royalty->getCategory(), 
            ':planeLength'=>$royalty->getPlanLength(), 
            ':maxWeight'=>$royalty->getMaxWeight(),
            ':planeWidth'=>$royalty->getPlanWidth(),
            ':surface'=>$royalty->getSurface(),
            ':htPrice'=>$royalty->getHtPrice(),
            ':ttcPrice'=>$royalty->getTtcPrice(),
            ':ffa'=>$royalty->getFfa(),
            ':idService'=>$royalty->getServiceId(),
            ':acoustic_group'=>$royalty->getCoeffAcousticGroup()
            ));
            
        return $connect->lastInsertId();
    }

    private function insertOrderFormServiceValues(OrderFormService $orderFormService){  
        $select = "INSERT INTO order_form_service(booking_start_date, booking_end_date, booking_start_hour, booking_end_hour, order_form_id, service_id, royalties_id) 
        VALUES(:startDate, :endDate, :startHour, :endHour, :orderFormId, :serviceId, :royalties_id)";
        $prep = connect()->prepare($select);
        
        $array = array(
            ':startDate'=>$orderFormService->getStartDate(), 
            ':endDate'=>$orderFormService->getEndDate(), 
            ':startHour'=>$orderFormService->getStartHour(),
            ':endHour'=>$orderFormService->getEndHour(), 
            ':orderFormId'=>$orderFormService->getOrderFormId(), 
            ':serviceId'=>$orderFormService->getServiceId(),
            ':royalties_id'=>$orderFormService->getRoyaltyId()
            );
        $exec = $prep->execute($array);

        return $exec;
    }

    public function findInArray($search, $array, $defaultValue = 0) {
        foreach ($array as $key => $val) {
            if ($search == $key)
                return $val;
        }
        return $defaultValue;
    }

    public static function getSharedInstance() {
        if (OrderFormManager::$instance == null) {
            OrderFormManager::$instance = new OrderFormManager();
        }
        return OrderFormManager::$instance;
    }

}

?>