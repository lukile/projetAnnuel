<?php 
require_once("DatabaseManager.php");
require_once("DateHourManager.php");

    class Coefficient{
        private $acousticGroup;
        private $dayPeriod;
        private $nightPeriod;

        public function getAcousticGroup(){
            return $this->acousticGroup;
        }
        public function setAcousticGroup($acousticGroup){
            $this->acousticGroup = $acousticGroup;
        }

        public function getDayPeriod(){
            return $this->dayPeriod;
        }
        public function setDayPeriod($dayPeriod){
            $this->dayPeriod = $dayPeriod;
        }

        public function getNightPeriod(){
            return $this->$nightPeriod;
        }
        public function setNightPeriod($nightPeriod){
            $this->nightPeriod = $nightPeriod;
        }

        public function dayOrNightPeriod($acousticGroup, $hour){
            $hourManager = new DateHourManager();
            
            $request = connect()->prepare("SELECT day_period, night_period
                        FROM coefficient 
                        WHERE acoustic_group=:acousticGroup");
            $request->execute(array(':acousticGroup'=>$acousticGroup));
            $result = $request->fetch(PDO::FETCH_OBJ);

            $dayPeriod = $result->day_period;
            $nightPeriod = $result->night_period;
   
            $startHour = date('06:00:00');
            $endHour = date('22:00:00'); 

            $formattedHour = $hourManager->formatHour($hour);
           
            if($formattedHour > $startHour && $formattedHour < $endHour){
                return $dayPeriod;

            }elseif($formattedHour < $startHour || $formattedHour > $endHour){
                return $nightPeriod;
            }
        }
    }
?>