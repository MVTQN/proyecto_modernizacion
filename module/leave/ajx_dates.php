<?php
    require("dates.php");
    if(isset($_GET['a1'])){
        $d1 = $_GET['a1'];
    }
    if(isset($_GET['a2'])){
        $d2 = $_GET['a2'];
    }
    if(isset($d1)){
        echo DaysTaken($d1, $d2, $holidayDays);
    }
?>