<?php 
require("databaseN.php");
if(isset($_GET['a1'])){$opt1 = $_GET['a1'];}else{$opt1 = 0;}
if(isset($_GET['a2'])){$opt2 = $_GET['a2'];}else{$opt2 = 0;}
if(isset($_GET['a3'])){$opt3 = $_GET['a3'];}else{$opt3 = 0;}

if(isset($opt1)){
    switch ($opt1) {
        case 0:
            echo "0";
            break;
        case 1:
                switch ($opt2) {
                    case 0:
                        echo "0";
                    break;
                    case 1:
                        $query1 = 'SELECT * FROM tbldepts Where DEPTCODE='.$opt3.' LIMIT 1';
                    break;
                    case 3:
                        $query1 = 'SELECT * FROM tblleavetype Where LEAVECODE='.$opt3.' LIMIT 1';
                    break;
                    case 4:
                        $query1 = 'SELECT * FROM tblleavetype Where LEAVETYPE=\''.$opt3.'\' LIMIT 1';
                    break;
                }
                $mydbDPT = new DatabaseN();
                $mydbDPT->setQuery($query1);
			    $cur = $mydbDPT->num_rows();
			    echo $cur;
                break;
    }
}
?>