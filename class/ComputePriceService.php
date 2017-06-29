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
        $htPrice = $this->computeHTParkingPrice($priceParking, $surface);

            if($maxWeight < 0.5 && $surface < 60 || $maxWeight < 0.5 && $surface >= 60 && $surface < 100 || $maxWeight >= 0.5 && $maxWeight < 1){
                $htPrice += 116.67; 
            
            }else if($maxWeight > 1 && $surface < 60 || 
                     $maxWeight >= 0.5 && $maxWeight < 1 && $surface >= 60 && $surface < 100 ||
                     $maxWeight > 1 && $surface >= 60 && $surface < 100 ||
                     $maxWeight < 0.5 && $surface > 100 ||
                     $maxWeight >= 0.5 && $maxWeight < 1 && $surface > 100){
                $htPrice += 70.83;
            }else if($maxWeight > 1 && $surface > 100){
                $htPrice += 150;
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

        $start = $dateManager->formatDate($date);
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

        if(isParked($order_form_id) && $plane == "monoMulti"){
            $htPrice = 41.17 * $period + 18.0;
        }elseif(isParked($order_form_id) && $plane == "monoBiTur"){
            $htPrice = 34.50 * $period + 15.25;
        }
        
        return $htPrice;
    }

    public function landingTTCPrice($service, $plane, $date, $hour, $acousticGroup, $order_form_id){
        $dateManager = new DateHourManager();
        $start = $dateManager->formatDate($date);
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

    private function connect(){
        $manager = DatabaseManager::getsharedInstance();
        $connect = $manager->connect();

        return $connect;
    }
    
    }

?>