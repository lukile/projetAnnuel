<?php 
    class Royalty{
        private $id;
        private $petroleumProduct;
        private $plan;
        private $qteFuel;
        private $category;
        private $planLength;
        private $maxWeight;
        private $planWidth;
        private $surface;
        private $htPrice;
        private $ttcPrice;
        private $ffa;
        private $serviceId;
        private $coeffAcousticGroup;

        public function __construct($petroleumProduct, $plan, 
                                    $qteFuel, $category, $planLength, 
                                    $maxWeight, $planWidth, $surface,
                                    $htPrice, $ttcPrice, $ffa, $serviceId, $coeffAcousticGroup){
            $this->petroleumProduct = $petroleumProduct;
            $this->plan = $plan;
            $this->qteFuel = $qteFuel;
            $this->category = $category;
            $this->planLength = $planLength;
            $this->maxWeight = $maxWeight;
            $this->planWidth = $planWidth;
            $this->surface = $surface;
            $this->htPrice = $htPrice;
            $this->ttcPrice = $ttcPrice;
            $this->ffa = $ffa;
            $this->serviceId = $serviceId;
            $this->coeffAcousticGroup = $coeffAcousticGroup;
        }

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }

        public function getPetroleumProduct(){
            return $this->petroleumProduct;
        }

        public function getPlan(){
            return $this->plan;
        }
        
        public function getQteFuel(){
            return $this->qteFuel;
        }

        public function getCategory(){
            return $this->category ;
        }

        public function getPlanLength(){
            return $this->planLength;
        }

        public function getMaxWeight(){
            return $this->maxWeight;
        }
    
        public function getPlanWidth(){
            return $this->planWidth;
        }
         
        public function getSurface(){
            return $this->surface;
        }
        public function getHtPrice(){
            return $this->htPrice;
        }

        public function getTtcPrice(){
            return $this->ttcPrice;
        }
        
        public function getFfa(){
            return $this->ffa;
        }

        public function getServiceId(){
            return $this->serviceId;
        }

        public function getCoeffAcousticGroup(){
            return $this->coeffAcousticGroup;
        }

        public function setHtPrice($htPrice){
            $this->htPrice = $htPrice;
        }

        public function setTtcPrice($ttcPrice){
            $this->ttcPrice = $ttcPrice;
        }

        public function setServiceId($serviceId){
            $this->serviceId = $serviceId;
        }

        public function setCoeffAcousticGroup($coeffAcousticGroup){
            $this->coeffAcousticGroup = $coeffAcousticGroup;
        }
    }
?>