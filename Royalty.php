<?php 
    class Royalty{
        private $id_;
        private $petroleumProduct_;
        private $shelterFeature_;
        private $landingType_;
        private $landingPeriod_;
        private $timeUnit_;
        private $parkingSurface_;
        private $parkingWeek_;
        private $rate_;
        private $rateType_;
        private $htPrice_;
        private $ttcPrice_;
        private $tvaPrice_;
        private $serviceId_;
        private $coeffAcousticGroup_;

        public function __construct($id, $petroleumProduct, $shelterFeature, $landingType, $landingPeriod, $timeUnit, $parkingSurface, $parkingWeek, $rate, $rateType, $htPrice, $ttcPrice, $tvaPrice, $serviceId, $coeffAcousticGroup){
            $this->id_ = $id;
            $this->petroleumProduct_ = $petroleumProduct;
            $this->shelterFeature_ = $shelterFeature;
            $this->landingType_ = $landingType;
            $this->landingPeriod_ = $landingPeriod;
            $this->timeUnit_ = $timeUnit;
            $this->parkingSurface_ = $parkingSurface;
            $this->parkingWeek_ = $parkingWeek;
            $this->rate_ = $rate;
            $this->rateType_ = $rateType;
            $this->htPrice_ = $htPrice;
            $this->ttcPrice_ = $ttcPrice;
            $this->tvaPrice_ = $tvaPrice;
            $this->serviceId_ = $serviceId;
            $this->coeffAcousticGroup_ = $coeffAcousticGroup;
        }

        public function getId(){
            return $this->id_;
        }
        public function setId($id){
            $this->id_ = $id;
        }

        public function getPetroleumProduct(){
            return $this->petroleumProduct_;
        }
        public function setPetroleumProduct($petroleumProduct){
            $this->petroleumProduct_ = $petroleumProduct;
        }

        public function getShelterFeature(){
            return $this->shelterFeature_;
        }
        public function setShelterFeature($shelterFeature){
            $this->shelterFeature = $shelterFeature;
        }
        
        public function getLandingType(){
            return $this->landingType_;
        }
        public function setLandingType($landingType){
            $this->landingType_ = $landingType;
        }

        public function getLandingPeriod(){
            return $this->landingPeriod_;
        }
        public function setLandingPeriod($landingPeriod){
            $this->landingPeriod_ = $landingPeriod;
        }

        public function getTimeUnit(){
            return $this->timeUnit_;
        }
        public function setTimeUnit($timeUnit){
            $this->timeUnit_ = $timeUnit;
        }

        public function getParkingSurface(){
            return $this->parkingSurface_;
        }
        public function setParkingSurface($parkingSurface){
            $this->parkingSurface_ = $parkingSurface;
        }
        
        public function getParkingWeek(){
            return $this->parkingWeek_;
        }
        public function setParkingWeek($parkingWeek){
            $this->parkingWeek_ = $parkingWeek;
        }

        public function getRate(){
            return $this->rate_;
        }
        public function setRate($rate){
            $this->rate_ = $rate;
        }

        public function getRateType(){
            return $this->rateType_;
        }
        public function setRateType($rateType){
            $this->rateType_ = $rateType;
        }

        public function getHtPrice(){
            return $this->htPrice_;
        }
        public function setHtPrice($htPrice){
            $this->htPrice_ = $htPrice;
        }

        public function getTtcPrice(){
            return $this->ttcPrice_;
        }
        public function setTtcPrice($ttcPrice){
            $this->ttcPrice_ = $ttcPrice;
        }

        public function getTvaPrice(){
            return $this->tvaPrice_;
        }
        public function setTvaPrice($tvaPrice){
            $this->tvaPrice_ = $tvaPrice;
        }

        public function getServiceId(){
            return $this->serviceId_;
        }
        public function setServiceId($serviceId){
            $this->serviceId_ = $serviceId;
        }

        public function getCoeffAcousticGroup(){
            return $this->coeffAcousticGroup_;
        }
        public function setCoeffAcousticGroup($coeffAcousticGroup){
            $this->coeffAcousticGroup_ = $coeffAcousticGroup;
        }
    }
?>