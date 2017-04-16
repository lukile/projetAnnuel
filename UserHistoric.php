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
        private $emergency_mail_;
        private $comments_;
        private $application_fee_;
        private $user_id_;

        public function __construct($firstname, $lastname, $archiving_date, $login, $password, $phone, $mail, $emergency_mail, $comments, $application_fee, $user_id){
            $this->firstname_ = $firstname;
            $this->lastname_ = $lastname;
            $this->archiving_date_ = $archiving_date;
            $this->login_ = $login;
            $this->password_ = $password;
            $this->phone_ = $phone;
            $this->mail_ = $mail;
            $this->emergency_mail_ = $emergency_mail;
            $this->comments_ = $comments;
            $this->application_fee_ = $application_fee;
            $this->user_id_ = $user_id;
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
        public function setArchivingDate($archiving_date){
            $this->archiving_date_ = $archiving_date;
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

        public function getComments(){
            return $this->comments_;
        }
        public function setComments($comments){
            $this->comments_ = $comments;
        }

        public function getApplicationFee(){
            return $this->application_fee_;
        }
        public function setApplicationFee($application_fee){
            $this->application_fee_ = $application_fee;
        }

        public function getUserId(){
            return $this->user_id_;
        }
        public function setUserId($user_id){
            $this->user_id_ = $user_id;
        }

    }
?>