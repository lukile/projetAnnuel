<?php
    class User{
        private $id_;
        private $firstname_;
        private $lastname_;
        private $login_;
        private $password_;
        private $phone_;
        private $mail_;
        private $emergencyMail_;
        private $activationKey;
        private $active_;
        private $comments_;
        private $registrationDate_;
        private $applicationFee_;

        public function __construct($firstname = NULL, $lastname = NULL, $login = NULL, $password = NULL, $phone = NULL, $mail = NULL, $emergencyMail = NULL, $activationKey = NULL, $active = 0, $comments = NULL, $registrationDate, $applicationFee = 0.0){
                $this->firstname_ = $firstname;
                $this->lastname_ = $lastname;
                $this->login_ = $login;
                $this->password_ = $password;
                $this->phone_ = $phone;
                $this->mail_ = $mail;
                $this->emergencyMail_ = $emergencyMail;
                $this->activationKey_ = $activationKey;
                $this->active_ = $active;
                $this->comments_ = $comments;
                $this->registrationDate_ = $registrationDate;
                $this->applicationFee_ = $applicationFee;

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
            return $this->emergencyMail_;
        }
        public function setEmergencyMail($emergencyMail){
            $this->emergencyMail_ = $emergencyMail;
        }

        public function getActivationKey(){
            return $this->activationKey_;
        }
        public function setActivationKey($activationKey){
            $this->activationKey_ = $activationKey;
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
            return $this->registrationDate_;
        }
        public function setRegistrationDate($registrationDate){
            $this->registrationDate_ = $registrationDate;
        }

        public function getApplicationFee(){
            return $this->applicationFee_;
        }
        public function setApplicationFee($applicationFee){
            $this->applicationFee_ = $applicationFee;
        }
    }
?>