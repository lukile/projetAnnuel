<?php 
    class Coefficient{
        private $acousticGroup_;
        private $period_;
        private $helicopterUlm_;

        public function __construct($acousticGroup, $period, $helicopterUlm){
            $this->acousticGroup_ = $acousticGroup;
            $this->period_ = $period;
            $this->helicopterUlm_ = $helicopterUlm;
        }

        public function getAcousticGroup(){
            return $this->acousticGroup_;
        }
        public function setAcousticGroup($acousticGroup){
            $this->acousticGRoup_ = $acousticGroup;
        }

        public function getPeriod(){
            return $this->period_;
        }
        public function setPeriod($period){
            $this->period_ = $period;
        }

        public function getHelicopterUlm(){
            return $this->helicopterUlm_;
        }
        public function setHelicopterUlm($helicopterUlm){
            $this->helicopterUlm_ = $helicopterUlm;
        }
    }
?>