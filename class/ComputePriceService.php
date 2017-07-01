<?php

require_once("Coefficient.php");

require_once("DatabaseManager.php");
require_once("DateHourManager.php");
require_once("/function.php");

class ComputePriceService{
    private static $instance;

    public static function getSharedInstance() {
        if(ComputePriceService::$instance == null) {
            ComputePriceService::$instance = new ComputePriceService();
        }
        return ComputePriceService::$instance;
    }

    public function computeHTParkingPrice($priceParking, $surface){
        $htPrice = $priceParking * $surface;

        return $htPrice;
    }

    public function computeTTCParkingPrice($priceParking, $surface){
        $htPrice = $this->computeHTParkingPrice($priceParking, $surface);

        $computedPrice = ($htPrice * 20)/100;
        $ttcPrice = $computedPrice + $htPrice;

        return $ttcPrice;
    }

    public function priceHTShelter($priceParking, $surface, $maxWeight){
        $dateManager = new DateHourManager();

        $htPrice = $this->computeHTParkingPrice($priceParking, $surface);

            if($maxWeight < 0.5 && $surface < 60 || $maxWeight < 0.5 && $surface >= 60 && $surface < 100 || $maxWeight >= 0.5 && $maxWeight < 1){
                //cat2
                $htPrice += 7.29;
            }else if($maxWeight > 1 && $surface < 60 || 
                     $maxWeight >= 0.5 && $maxWeight < 1 && $surface >= 60 && $surface < 100 ||
                     $maxWeight > 1 && $surface >= 60 && $surface < 100 ||
                     $maxWeight < 0.5 && $surface > 100 ||
                     $maxWeight >= 0.5 && $maxWeight < 1 && $surface > 100){
            
                $htPrice += 4.42;            
            }else if($maxWeight > 1 && $surface > 100){
                //cat1
                $htPrice += 9.38;
            }
        return $htPrice;
    }

    public function priceTTCShelter($priceParking, $surface, $maxWeight){
        $ttcPrice = $this->computeTTCParkingPrice($priceParking, $surface);

            if($maxWeight < 0.5 && $surface < 60 || $maxWeight < 0.5 && $surface >= 60 && $surface < 100 || $maxWeight >= 0.5 && $maxWeight < 1){
                $ttcPrice += 140;
            }else if($maxWeight > 1 && $surface < 60 || 
                     $maxWeight >= 0.5 && $maxWeight < 1 && $surface >= 60 && $surface < 100 ||
                     $maxWeight > 1 && $surface >= 60 && $surface < 100 ||
                     $maxWeight < 0.5 && $surface > 100 ||
                     $maxWeight >= 0.5 && $maxWeight < 1 && $surface > 100){
                $ttcPrice += 85;
            }else if($maxWeight > 1 && $surface > 100){
                $ttcPrice += 180;
            }
        return $ttcPrice;
    }

    public function categoryShelter($maxWeight, $surface){
        $category = null;

        if($maxWeight < 0.5 && $surface < 60 || $maxWeight < 0.5 && $surface >= 60 && $surface < 100 || $maxWeight >= 0.5 && $maxWeight < 1){
            $category = "cat2";
        }else if($maxWeight > 1 && $surface < 60 || 
                     $maxWeight >= 0.5 && $maxWeight < 1 && $surface >= 60 && $surface < 100 ||
                     $maxWeight > 1 && $surface >= 60 && $surface < 100 ||
                     $maxWeight < 0.5 && $surface > 100 ||
                     $maxWeight >= 0.5 && $maxWeight < 1 && $surface > 100){
            $category = "cat3";
        }else if($maxWeight > 1 && $surface > 100){
            $category = "cat1";
        }     
       
        return $category;
    }

    public function typeRefueling($fuelValues){
        $fuel = $fuelValues[0];

        return $fuel;
    }

    public function refuelingHTPrice($fuelValues, $qteFuel){
        $htPrice = $fuelValues[1] * $qteFuel;
        
        return $htPrice;
    }

    public function refuelingTTCPrice($fuelValues, $qteFuel){
        $htPrice = $this->refuelingHTPrice($fuelValues, $qteFuel);
        
        $computedPrice = ($htPrice * 20)/100;
        $ttcPrice = $computedPrice + $htPrice;

        return $ttcPrice;

    }

    public function landingHTPrice($service, $plane, $date, $hour, $acousticGroup, $order_form_id){
        $dateManager = new DateHourManager();

        $start = $dateManager->formatDateInTimestamp($date);
        $end = $start;

        $openDays = $dateManager->getOpenDays($start, $end);

        $coefficient = new Coefficient();
        $period = $coefficient->dayOrNightPeriod($acousticGroup, $hour);        

        if($plane == "monoMulti" && $openDays == 0){          
            $htPrice = 41.17 * $period;
        }elseif($plane == "monoBiTur" && $openDays == 0){
            $htPrice = 34.50 * $period;
        }elseif($plane == "monoMulti" && $openDays > 0){
            $htPrice = 37.17 * $period;
        }elseif($plane == "monoBiTur" && $openDays > 0){
            $htPrice = 31.17 * $period;
        }
        
        return $htPrice;
    }

    public function landingTTCPrice($service, $plane, $date, $hour, $acousticGroup, $order_form_id){
        $dateManager = new DateHourManager();
        $start = $dateManager->formatDateInTimestamp($date);
        $end = $start;

        $openDays = $dateManager->getOpenDays($start, $end);

        $coefficient = new Coefficient();
        $period = $coefficient->dayOrNightPeriod($acousticGroup, $hour);

         if($plane == "monoMulti" && $openDays == 0){
            $ttcPrice = 49.40 * $period;
        }elseif($plane == "monoBiTur" && $openDays == 0){
            $ttcPrice = 41.40 * $period;
        }elseif($plane == "monoMulti" && $openDays > 0){
            $ttcPrice = 44.60 * $period;
        }elseif($plane == "monoBiTur" && $openDays > 0){
            $ttcPrice = 37.40 * $period;
        }
        return $ttcPrice;
    }

    public function landingParkingHTPrice($order_form_id, $plane, $idRoyalties, $htPrice, $startDate, $endDate){
        $dateManager = new DateHourManager();
        $request = connect()->prepare("UPDATE royalties SET HT_price=:htPrice WHERE id=:idRoyalties");   

        if($plane == "monoMulti" && $dateManager->isMonth($startDate, $endDate)){
            $htPrice += 120.0;    
            $request->execute(array(':htPrice'=>$htPrice, ':idRoyalties'=>$idRoyalties));
        }elseif($plane == "monoMulti"){
            $htPrice += 18.0;
            $request->execute(array(':htPrice'=>$htPrice, ':idRoyalties'=>$idRoyalties));
        }elseif($plane == "monoBiTur" && $dateManager->isMonth($startDate, $endDate)){
            $htPrice += 113.0;
            $request->execute(array(':htPrice'=>$htPrice, ':idRoyalties'=>$idRoyalties));
        }elseif($plane == "monoBiTur"){
            $htPrice += 15.25;
            $request->execute(array(':htPrice'=>$htPrice, ':idRoyalties'=>$idRoyalties));
        }
        return $htPrice;
    }

    public function landingParkingTTCPrice($order_form_id, $plane, $idRoyalties, $ttcPrice, $startDate, $endDate){
        $dateManager = new DateHourManager();
        $request = connect()->prepare("UPDATE royalties SET TTC_price=:ttcPrice WHERE id=:idRoyalties");   
       
        if($plane == "monoMulti" && $dateManager->isMonth($startDate, $endDate)){
            $ttcPrice += 144.0;
            $request->execute(array(':ttcPrice'=>$ttcPrice, ':idRoyalties'=>$idRoyalties));
        }elseif($plane == "monoMulti"){
            $ttcPrice += 21.60;
            $request->execute(array(':ttcPrice'=>$ttcPrice, ':idRoyalties'=>$idRoyalties));
        }elseif($plane == "monoBiTur" && $dateManager->isMonth($startDate, $endDate)){
            $ttcPrice += 135.60;
            $request->execute(array(':ttcPrice'=>$ttcPrice, ':idRoyalties'=>$idRoyalties));       
        }elseif($plane == "monoBiTur"){
            $ttcPrice += 18.30;
            $request->execute(array(':ttcPrice'=>$ttcPrice, ':idRoyalties'=>$idRoyalties));
        }
        return $ttcPrice;
    }

    public function priceHTShelterCategory($startDate, $endDate, $htPrice, $idRoyalties, $maxWeight, $surface){
        $request = connect()->prepare("UPDATE royalties SET HT_price=:htPrice WHERE id=:idRoyalties");
        
        $dateManager = new DateHourManager();
        
        if($maxWeight < 0.5 && $surface < 60 || $maxWeight < 0.5 && $surface >= 60 && $surface < 100 || $maxWeight >= 0.5 && $maxWeight < 1){
            //cat2
            if($dateManager->isMonth($startDate, $endDate)){
                $htPrice += 116.67;
                $request->execute(array(':htPrice'=>$htPrice, ':idRoyalties'=>$idRoyalties)); 
            }else{
                $htPrice += 4.33;
                $request->execute(array(':htPrice'=>$htPrice, ':idRoyalties'=>$idRoyalties));
            }
        }else if($maxWeight > 1 && $surface < 60 || 
                    $maxWeight >= 0.5 && $maxWeight < 1 && $surface >= 60 && $surface < 100 ||
                    $maxWeight > 1 && $surface >= 60 && $surface < 100 ||
                    $maxWeight < 0.5 && $surface > 100 ||
                    $maxWeight >= 0.5 && $maxWeight < 1 && $surface > 100){
            //cat3
            if($dateManager->isMonth($startDate, $endDate)){
                $htPrice += 70.83;
                $request->execute(array(':htPrice'=>$htPrice, ':idRoyalties'=>$idRoyalties)); 
            }else{
                $htPrice += 2.63;    
                $request->execute(array(':htPrice'=>$htPrice, ':idRoyalties'=>$idRoyalties)); 
            }        
        }else if($maxWeight > 1 && $surface > 100){
            //cat1
            if($dateManager->isMonth($startDate, $endDate)){
                $htPrice += 150;
                $request->execute(array(':htPrice'=>$htPrice, ':idRoyalties'=>$idRoyalties)); 
            }else{
                $htPrice += 5.50;
                $request->execute(array(':htPrice'=>$htPrice, ':idRoyalties'=>$idRoyalties)); 
            }
        }
        return $htPrice;
    }

    public function priceTTCShelterCategory($startDate, $endDate, $ttcPrice, $idRoyalties, $maxWeight, $surface){
        $request = connect()->prepare("UPDATE royalties SET TTC_price=:ttcPrice WHERE id=:idRoyalties");
        
        $dateManager = new DateHourManager();
        
        if($maxWeight < 0.5 && $surface < 60 || $maxWeight < 0.5 && $surface >= 60 && $surface < 100 || $maxWeight >= 0.5 && $maxWeight < 1){
            //cat2
            if($dateManager->isMonth($startDate, $endDate)){
                $ttcPrice += 140.0;
                $request->execute(array(':ttcPrice'=>$ttcPrice, ':idRoyalties'=>$idRoyalties)); 
            }else{
                $ttcPrice += 5.20;
                $request->execute(array(':ttcPrice'=>$ttcPrice, ':idRoyalties'=>$idRoyalties));
            }
        }else if($maxWeight > 1 && $surface < 60 || 
                    $maxWeight >= 0.5 && $maxWeight < 1 && $surface >= 60 && $surface < 100 ||
                    $maxWeight > 1 && $surface >= 60 && $surface < 100 ||
                    $maxWeight < 0.5 && $surface > 100 ||
                    $maxWeight >= 0.5 && $maxWeight < 1 && $surface > 100){
            //cat3
            if($dateManager->isMonth($startDate, $endDate)){
                $ttcPrice += 85.0;
                $request->execute(array(':ttcPrice'=>$ttcPrice, ':idRoyalties'=>$idRoyalties)); 
            }else{
                $ttcPrice += 3.15;    
                $request->execute(array(':ttcPrice'=>$ttcPrice, ':idRoyalties'=>$idRoyalties)); 
            }        
        }else if($maxWeight > 1 && $surface > 100){
            //cat1
            if($dateManager->isMonth($startDate, $endDate)){
                $ttcPrice += 180;
                $request->execute(array(':ttcPrice'=>$ttcPrice, ':idRoyalties'=>$idRoyalties)); 
            }else{
                $ttcPrice += 6.60;
                $request->execute(array(':ttcPrice'=>$ttcPrice, ':idRoyalties'=>$idRoyalties)); 
            }
        }
        return $ttcPrice;
    }    

    private function connect(){
        $manager = DatabaseManager::getsharedInstance();
        $connect = $manager->connect();

        return $connect;
    }
    
    }

?>