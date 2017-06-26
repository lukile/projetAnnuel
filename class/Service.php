<?php 
require_once("DatabaseManager.php");

    class Service{
        private $id_;
        private $type_;
        private $orderFormId_;

        private $priceParking;
        private $name;

        public function getId(){
            return $this->id_;
        }
        public function setId($id){
            $this->id_ = $id;
        }

        public function getType(){
            return $this->type_;
        }
        public function setType($type){
            $this->type_ = $type;
        }

        public function getOrderFormId(){
            return $this->orderFormId_;
        }
        public function setOrderFormId($orderFormId){
            $this->orderFormId_ = $orderFormId;
        }

        public function getPriceParking() {
            return $this->priceParking;
        }

        public function setPriceParking($price) {
            $this->priceParking = $price;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function toString() {
            echo "Service[name=".$this->name."]";
        }

        public function isParking() {
            return $this->name == "parking";
        }

        public static function getIdFromService($service) {
            $select_services = "SELECT id from services WHERE type=:service";
            $insertion_prep_services = connect()->prepare($select_services);
            $insertion_prep_services->execute(array(':service'=>$service));
            $fetch_query = $insertion_prep_services->fetch();
            $id = $fetch_query['id'];
         return $fetch_query['id'];
        }
    }
?>