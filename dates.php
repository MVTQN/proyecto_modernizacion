<?php
$dates_included = true;
require_once("include/databaseN.php");
$mydbHD = new DatabaseN();
$mydbHD->setQuery("SELECT * FROM  `tblholidays` where HLDCOUNTRYID=1");
$cur = $mydbHD->loadResultList();
global $holidayDays;
foreach ($cur as $result) {
    $holidayDays[] = $result->HLDDATE;
} 
$mydbHD->close_connection();

function ConsumedVacationDays($lempid, $startdate){
    try{
        $mydbVD = new DatabaseN();
        $today = date("yy-m-d");
        $query = "SELECT IFNULL((SELECT sum(lnotaken) AS T FROM tblleavetaken WHERE lempid=".$lempid." AND datestart>='".$startdate."' AND dateend<='".$today."'), 0) AS ConsumedVacationDays";
        $mydbVD->setQuery($query);
        $result = $mydbVD->loadSingleResult(); 
        $mydbVD->close_connection();
        return $result;
    }catch(Exception $e){
        return 0;
    }
}

/*for($x=0;$x<=count($restingDays)-1;$x++){
    echo $restingDays[$x]."<br>";
}
echo Achieved_VacationDays('2019-07-02', '2020-04-06');
*/

function DaysTaken($DateStart, $DateEnd, $holidayDays){
    $restingDays = array();
    list ($years, $months, $days) = Months_BetweenDates($DateStart, $DateEnd);
    WorkingDays($DateStart, $DateEnd, $holidayDays, $restingDays);
    return count($restingDays);
}

function Tenure($StartDate){
    $today = date("yy-m-d");
    $date1=date_create($StartDate);
    $date2=date_create($today);
    $c=date_diff($date1,$date2);
    $difformat='%a';
    $result= $c->format($difformat)/365;
    return $result;
}

function Achieved_VacationDays(string $date1, string $date2){
    try{
        if($date2<=$date1){
            return 0;
        }else{
            list ($years, $months, $days) = Months_BetweenDates($date1, $date2);
            return floor($months*1.25);
        }
    }catch (Exception $e) {
        return 0;
    }
}

function WorkingDays(string $date1, string $date2, $arrayHoliDays, &$restingDays){
    //echo Months_BetweenDates($date1, $date2);
    $firstYear=substr($date1, 0, 4);
    $lastYear=substr($date2, 0, 4);
    $firstDay=(int)substr($date1, 8, 2);
    $lastDay=(int)substr($date2, 8, 2);
    //same year
    if($firstYear==$lastYear){        
        $firstMonth=substr($date1, 5, 2);
        $lastMonth=substr($date2, 5, 2);
        //same month
        if($firstMonth==$lastMonth){
            for($i=$firstDay;$i<=$lastDay;$i++){
                $iterationDay = str_pad($i, 2, "0", STR_PAD_LEFT);
                $itDate = $firstYear."-".$firstMonth."-".$iterationDay;
                $weekDay = date('N', strtotime($itDate));
                if($weekDay<=5){
                    if (!in_array($itDate, $arrayHoliDays)) {
                        $restingDays[] = $itDate;////////////////
                    }
                }
            }
        //same year different month
        }else{
            for($i=(int)$firstMonth;$i<=(int)$lastMonth;$i++){
                $rangeMonths[]=$i;
            }
            //days of each month
            $rangeFirstMonth = str_pad($firstMonth, 2, "0", STR_PAD_LEFT);
            $rangeLastMonth = str_pad($lastMonth, 2, "0", STR_PAD_LEFT);
            //echo $rangeFirstMonth."---";
            for($i=0;$i<=count($rangeMonths)-1;$i++){
                $iterationMonth = str_pad($rangeMonths[$i], 2, "0", STR_PAD_LEFT);
                $daysMonth = cal_days_in_month(CAL_GREGORIAN, $rangeMonths[$i], $firstYear);
                if($iterationMonth==$rangeFirstMonth){
                    $k=$firstDay;
                }else{
                    $k=1;
                }
                if($iterationMonth==$rangeLastMonth){
                    $m=$lastDay;
                }else{
                    $m=$daysMonth;
                }
                for($j=$k;$j<=$m;$j++){
                    $iterationDay = str_pad($j, 2, "0", STR_PAD_LEFT);
                    //echo $firstYear."-".$iterationMonth."-".$iterationDay."<br>";
                    $itDate = $firstYear."-".$iterationMonth."-".$iterationDay;
                    $weekDay = date('N', strtotime($itDate));
                    if($weekDay<=5){
                        if (!in_array($itDate, $arrayHoliDays)) {
                            $restingDays[] = $itDate;
                            //echo $itDate." ---- ".$weekDay."<br>";//////////////////////////////////
                        }
                    }
                }
            }   

        }
    }else{
        $itY = $firstYear;
        for($i=$firstYear;$i<=$lastYear;$i++){
            if($itY==$firstYear){
                $initialDate = $date1;
                $finalDate = $itY."-12-31";
                WorkingDays($initialDate, $finalDate, $arrayHoliDays, $restingDays);
            }else if($itY==$lastYear){
                $initialDate = $itY."-01-01";
                $finalDate = $date2;
                WorkingDays($initialDate, $finalDate, $arrayHoliDays, $restingDays);
            }
            $itY += 1;
        }
    }
}

function Months_BetweenDates(string $date1, string $date2){ 
    $datetime1=new DateTime($date1);
    $datetime2=new DateTime($date2);
    $interval=$datetime2->diff($datetime1); 
    $days = $interval->days;
    $months = ($interval->y * 12 ) + $interval->m;
    $years = $interval->y;
    return array ($years, $months, $days);
}

function YearsEnvolved(string $date1, string $date2){
    $datetime1=substr($date1, 0, 4);
    $datetime2=substr($date2, 0, 4);
    return ($datetime2-$datetime1);
}

function FullWorkingDays(){
    $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)

}
?>