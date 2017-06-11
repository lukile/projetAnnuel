<?php
    class User{
        private $id_;
        private $firstname_;
        private $lastname_;
        private $login_;
        private $password_;
        private $mail_;
        private $phone_;
        private $comments_;
        private $activationKey;
        private $active_;
        private $registrationDate_;
        private $applicationFee_;

        public function __construct($admin = NULL, $firstname = NULL, $lastname = NULL, $login = NULL, $password = NULL, $mail = NULL, $phone = NULL, $activationKey = NULL, $active = NULL, $comments = NULL, $applicationFee = NULL){
                $this->admin_ = $admin;
                $this->firstname_ = $firstname;
                $this->lastname_ = $lastname;
                $this->login_ = $login;
                $this->password_ = $password;
                $this->phone_ = $phone;
                $this->mail_ = $mail;
                $this->activationKey_ = $activationKey;
                $this->active_ = $active;
                $this->comments_ = $comments;
                $this->applicationFee_ = $applicationFee;
            }
            
        public function getId(){
            return $this->id_;
        }
        public function setId($id){
            $this->id_ = $id;
        }

        public function getAdmin(){
            return $this->admin_;
        }
        public function setAdmin($admin){
            $this->admin_ = $admin;
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