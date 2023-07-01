<?php
/* Open Required Header in all scripts */
    $pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
    $toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
    if(!isset($security_included)){require($toRoot."include/security.php");}
    Secure::session_verify($toRoot);
/* Close Required Header in all scripts */
    if(!isset($_SESSION['tokenPostSess'])){header("HTTP/1.0 404 Not Found");exit();}
    if(!isset($_GET['a1'])){header("HTTP/1.0 404 Not Found");exit();}
    if(!isset($_GET['a2'])){header("HTTP/1.0 404 Not Found");exit();}
    if(!isset($_GET['b1'])){header("HTTP/1.0 404 Not Found");exit();}

    require($toRoot."include/databaseN.php");
    if(isset($_GET['a1'])){$a1 = Secure::Sanitize($_GET['a1']);}
    if(isset($_GET['a2'])){$a2 = Secure::Sanitize($_GET['a2']);}
	if(isset($_GET['b1'])){$b1 = Secure::Sanitize($_GET['b1']);}

if($_SESSION['tokenPostSess']==$b1){
    $Name = GD($a1, $a2);
    if($Name ==""){
        echo "No results found";
    }else{
        echo $Name;
    }
}else{
    header("HTTP/1.0 404 Not Found");
}

function GD($md, $mf){
    try{
        $mydbVD = new DatabaseN();
        if($mf=="1"){
            $fd = "EMPLOYID";
        }else{
            $fd = "EMPNAME";
        }
        $query = "SELECT EMPLOYID, EMPNAME, EMPSTATUS FROM tblemployee WHERE ".$fd." LIKE '%".$md."%' AND (". $_SESSION['MATRIX_FULL-FILTER'].") AND EMPPOSITION IN".$_SESSION['MATRIX_LEVELNAME'].";";
        $mydbVD->setQuery($query);
        $cur = $mydbVD->loadResultList();
        $resstring = "";
		foreach ($cur as $result) {
            if(strtolower($result->EMPSTATUS)=="attrited"){
                //$resstring .= '<div style="font-weight: bold; cursor: pointer;color: #CCC;border-bottom: 1px dashed #CCC">'.$result->EMPLOYID.' - '.$result->EMPNAME.' - Attrited</div>';
            }else{
                $resstring .= '<div style="font-weight: bold; cursor: pointer; border-bottom: 1px dashed #CCC" OnClick="parent.t(\''.$result->EMPLOYID.'\', \''.$result->EMPNAME.'\', \'#attrempcode\', \'#attrempname1\');">'.$result->EMPLOYID.' - '.$result->EMPNAME.'</div>';
            }
        }
        $mydbVD->close_connection();
        return $resstring;
    }catch(Exception $e){
        return "";
    }
}
?>