<?php 
    class Service{
        private $id_;
        private $type_;
        private $orderFormId_;

        public function __construct($id, $type, $orderFormId){
            $this->id_ = $id;
            $this->type_ = $type;
            $this->orderFormId_ = $orderFormId;
        }

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
    }
?>