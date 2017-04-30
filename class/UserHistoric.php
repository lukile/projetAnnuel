<?php
    class UserHistoric{
        private $id_;
        private $firstname_;
        private $lastname_;
        private $archiving_date_;
        private $login_;
        private $password_;
        private $phone_;
        private $mail_;
        private $emergencyMail_;
        private $comments_;
        private $applicationFee_;
        private $userId_;

        public function __construct($id, $firstname, $lastname, $archivingDate, $login, $password, $phone, $mail, $emergencyMail, $comments, $applicationFee, $userId){
            $this->id_ = $id;
            $this->firstname_ = $firstname;
            $this->lastname_ = $lastname;
            $this->archivingDate_ = $archivingDate;
            $this->login_ = $login;
            $this->password_ = $password;
            $this->phone_ = $phone;
            $this->mail_ = $mail;
            $this->emergencyMail_ = $emergencyMail;
            $this->comments_ = $comments;
            $this->applicationFee_ = $applicationFee;
            $this->userId_ = $userId;
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
        public function setFirstname($firstnme){
            $this->firstname_ = $firstname;
        }

        public function getLastname(){
            return $this->lastname_;
        }
        public function setLastname($lastname){
            $this->lastname_ = $lastname;
        }

        public function getArchivingDate(){
            return $this->archiving_date_;
        }
        public function setArchivingDate($archivingDate){
            $this->archivingDate_ = $archivingDate;
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

        public function getComments(){
            return $this->comments_;
        }
        public function setComments($comments){
            $this->comments_ = $comments;
        }

        public function getApplicationFee(){
            return $this->applicationFee_;
        }
        public function setApplicationFee($applicationFee){
            $this->applicationFee_ = $applicationFee;
        }

        public function getUserId(){
            return $this->userId_;
        }
        public function setUserId($userId){
            $this->userId_ = $userId;
        }
    }
?>