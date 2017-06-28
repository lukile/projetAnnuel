<?php

require_once("DatabaseManager.php");
require_once("/function.php");

class ComputePriceService{
    private static $instance;

    public static function getSharedInstance() {
        if(ComputePriceService::$instance == null) {
            ComputePriceService::$instance = new ComputePriceService();
        }
        return ComputePriceService::$instance;
    }

    function computeHTParkingPrice($priceParking, $surface){
        $htPrice = $priceParking * $surface;

        return $htPrice;
    }

    function computeTTCParkingPrice($priceParking, $surface){
        $htPrice = $this->computeHTParkingPrice($priceParking, $surface);

        $computedPrice = ($htPrice * 20)/100;
        $ttcPrice = $computedPrice + $htPrice;

        return $ttcPrice;
    }

    function priceHTShelter($priceParking, $surface, $maxWeight){
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

    function priceTTCShelter($priceParking, $surface, $maxWeight){
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

    function categoryShelter($maxWeight, $surface){
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

    function typeRefueling($fuelValues){
        $fuel = $fuelValues[0];

        return $fuel;
    }

    function refuelingHTPrice($fuelValues, $qteFuel){
        $htPrice = $fuelValues[1] * $qteFuel;
        
        return $htPrice;
    }

    function refuelingTTCPrice($fuelValues, $qteFuel){
        $htPrice = $this->refuelingHTPrice($fuelValues, $qteFuel);
        
        $computedPrice = ($htPrice * 20)/100;
        $ttcPrice = $computedPrice + $htPrice;

        return $ttcPrice;

    }

    function landingHTPrice($plane, $startDate, $endDate){
        $dateFormat = date_create_from_format('d-m-Y', $startDate);
        $formattedDate = $dateFormat->format('Y-m-d');
        

        $start = strtotime($formattedDate);
        $end = strtotime($formattedDate);

        echo 'start date '.$start. ' end date '.$end;
        $jouvre = getOpenDays($start, $end);
        echo 'il y a '.$jouvre.' jour ouvrés entre le '.date('d/m/Y', $start). ' et le '.date('d/m/Y', $end); 
        if($plane == "monoMulti"){           
            $htPrice = 34.50;
        }else if($plane == "monoBiTur"){
            $htPrice = 41.75;
        }

        return $htPrice;
    }

    public function landingTTCPrice($plane, $attHeure){
        $htPrice = null;
         if($plane == "monoMulti"){
            $ttcPrice = 41.40;

        }else if($plane == "monoBiTur"){
            $htPrice = 49.40;
        }

        return $htPrice;
    }

    private function connect(){
        $manager = DatabaseManager::getsharedInstance();
        $connect = $manager->connect();

        return $connect;
    }


}
?>