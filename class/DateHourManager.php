<?php 
class DateHourManager{
    public function getOpenDays($startDate, $endDate){
        $publicHolidayArray = array();

        //Dans le cas où l'année de départ est différente de l'année de fin
        $yearDiff = date('Y', $endDate) - date('Y', $startDate);
        for($i = 0; $i<= $yearDiff; $i++){
            $year = (int)date('Y', $startDate) + $i;
            //Liste des jours fériés
            //Jour de l'an 
            $publicHolidayArray[] = '1_1_'.$year;
            //Fête du travail
            $publicHolidayArray[] = '1_5_'.$year;
            //Victoire 1945
            $publicHolidayArray[] = '8_5_'.$year;
            //Fête nationale
            $publicHolidayArray[] = '14_7_'.$year;
            //Assomption
            $publicHolidayArray[] = '15_8_'.$year;
            //Toussaint
            $publicHolidayArray[] = '1_11_'.$year;
            //Armistice
            $publicHolidayArray[] = '11_11_'.$year;
            //Noël
            $publicHolidayArray[] = '25_12_'.$year;

            //Pâques, car variable d'une année sur l'autre
            $easterDay = easter_date($year);
            $publicHolidayArray[] = date('j_n_'.$year, $easterDay + 86400);
            //Ascension
            $publicHolidayArray[] = date('j_n_'.$year, $easterDay + (86400 * 39));
            //Pentecôte
            $publicHolidayArray[] = date('j_n_'.$year, $easterDay + (86400 * 50));

            $publicDays = 0;

            while($startDate <= $endDate){
                //Si jour suivant n'est pas un dimanche (0) ou un samedi (6), ni un jour férié, on incrémente les jours ouvrés
                if(!in_array(date('w', $startDate), array(0,6)) 
                    && !in_array(date('j_n_'.date('Y', $startDate), $startDate), $publicHolidayArray)){
                    $publicDays++;
                }
                $startDate = mktime(date('H', $startDate), 
                                    date('i', $startDate), 
                                    date('s', $startDate), 
                                    date('m', $startDate), 
                                    date('d', $startDate) + 1, 
                                    date('Y', $startDate));
            }
            $startDate = strtotime($startDate);
            $endDate = strtotime($endDate);

            return $publicDays;
        }
    }

    public function formatDateInTimestamp($date){
        $dateFormat = date_create_from_format('d-m-Y', $date);
        $formattedDate = $dateFormat->format('Y-m-d');

        $start = strtotime($formattedDate);

        return $start;
    }

    public function formatHour($hour){
        $hourFormat = date_create_from_format('H:i:s', $hour);
        $formattedHour = $hourFormat->format('H:i:s');

        return $hour;            
    }

    public function isMonth($startDate, $endDate){
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        $interval = $end->diff($start);
        $formatInterval = $interval->format('%m');
        
        if($formatInterval >= 1){
            return true;
        }else{
            return false;
        }
    }
}

?>