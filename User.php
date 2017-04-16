<?php
    class User{
        private $id_;
        private $firstname_;
        private $lastname_;
        private $login_;
        private $password_;
        private $phone_;
        private $mail_;
        private $emergency_mail_;
        private $activation_key;
        private $active_;
        private $comments_;
        private $registration_date_;
        private $application_fee_;

        public function __construct($firstname = NULL, $lastname = NULL, $login = NULL, $password = NULL, $phone = NULL, $mail = NULL, $emergency_mail = NULL, $activation_key = NULL, $active = 0, $comments = NULL, $registration_date, $application_fee = 0.0){
                $this->firstname_ = $firstname;
                $this->lastname_ = $lastname;
                $this->login_ = $login;
                $this->password_ = $password;
                $this->phone_ = $phone;
                $this->mail_ = $mail;
                $this->emergency_mail_ = $emergency_mail;
                $this->activation_key_ = $activation_key;
                $this->active_ = $active;
                $this->comments_ = $comments;
                $this->registration_date_ = $registration_date;
                $this->application_fee_ = $application_fee;
                
            }


        public function getId(){
            return $this->id_;
        }
        public function setId($id){
            $this->id_ = $id;
        }

        public function getFirstname(){
            return $this->firstname_;
        }
        public function setFirstname($firstname){
            $this->firstname_ = $firstname;
        }

        public function getLastname(){
            return $this->lastname_;
        }
        public function setLastname($lastname){
            $this->lastname_ = $lastname;
        }

        public function getLogin(){
            return $this->login_;
        }
        public function setLogin($login){
            $this->login_ = $login;
        }

        public function getPassword(){
            return $this->password_;
        }
        public function setPassword($password){
            $this->password_ = $password;
        }
        
        public function getPhone(){
            return $this->phone_;
        }
        public function setPhone($phone){
            $this->phone_ = $phone;
        }

        public function getMail(){
            return $this->mail_;
        }
        public function setMail($mail){
            $this->mail_ = $mail;
        }

        public function getEmergencyMail(){
            return $this->emergency_mail_;
        }
        public function setEmergencyMail($emergency_mail){
            $this->emergency_mail_ = $emergency_mail;
        }

        public function getActivationKey(){
            return $this->activation_key_;
        }
        public function setActivationKey($activation_key){
            $this->activation_key_ = $activation_key;
        }

        public function getActive(){
            return $this->active_;
        }
        public function setActive($active){
            $this->active_ = $active;
        }

        public function getComments(){
            return $this->comments_;
        }
        public function setComments($comments){
            $this->comments_ = $comments;
        }

        public function getRegistrationDate(){
            return $this->registration_date_;
        }
        public function setRegistrationDate($registration_date){
            $this->registration_date_ = $registration_date;
        }

        public function getApplicationFee(){
            return $this->application_fee_;
        }
        public function setApplicationFee($application_fee){
            $this->application_fee_ = $application_fee;
        }


    }



?>