<?php 
    class OrderForm{
        private $id_;
        private $invoice_;
        private $bookingDate_;
        private $validation_;
        private $userId_;

        public function __construct($id, $invoice, $bookingDate, $validation, $userId){
            $this->id_ = $id;
            $this->invoice_ = $invoice;
            $this->bookingDate_ = $bookingDate;
            $this->validation_ = $validation;
            $this->userId_ = $userId;
        }

        public function getId(){
            return $this->$id_;
        }
        public function setId($id){
            $this->id_ = $id;
        }

        public function getInvoice(){
            return $this->invoice_;
        }
        public function setInvoice($invoice){
            $this->invoice_ = $invoice;
        }

        public function getBookingDate(){
            return $this->bookingDate_;
        }
        public function setBookingDate($bookingDate){
            $this->bookingDate_ = $bookingDate;
        }

        public function getValidation(){
            return $this->validation_;
        }
        public function setValidation($validation){
            $this->validation_ = $validation;
        }

        public function getUserId(){
            return $this->userId_;
        }
        public function setUserId($userId){
            $this->userId_ = $userId;
        }
    }
?>