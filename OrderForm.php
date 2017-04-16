<?php 
    class OrderForm{
        private $id_;
        private $invoice_;
        private $booking_date_;
        private $validation_;
        private $user_id_;

        public function __construct($invoice, $booking_date, $validation, $user_id){
            $this->invoice_ = $invoice;
            $this->booking_date_ = $booking_date;
            $this->validation_ = $validation;
            $this->user_id_ = $user_id;
        }

        public function getInvoice(){
            return $this->invoice_;
        }
        public function setInvoice($invoice){
            $this->invoice_ = $invoice;
        }

        public function getBookingDate(){
            return $this->booking_date_;
        }
        public function setBookingDate($booking_date){
            $this->booking_date_ = $booking_date;
        }

        public function getValidation(){
            return $this->validation_;
        }
        public function setValidation($validation){
            $this->validation_ = $validation;
        }

        public function getUserId(){
            return $this->user_id_;
        }
        public function setUserId($user_id){
            $this->user_id_ = $user_id;
        }
    }
?>