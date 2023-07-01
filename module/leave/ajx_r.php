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
    if(!isset($_GET['a3'])){header("HTTP/1.0 404 Not Found");exit();}
    if(!isset($_GET['a4'])){header("HTTP/1.0 404 Not Found");exit();}
    if(!isset($_GET['a5'])){header("HTTP/1.0 404 Not Found");exit();}
    if(!isset($_GET['a7'])){header("HTTP/1.0 404 Not Found");exit();}
    if(!isset($_GET['b1'])){header("HTTP/1.0 404 Not Found");exit();}

    require($toRoot."include/databaseN.php");
    if(isset($_GET['a1'])){$a1 = Secure::Sanitize($_GET['a1']);}
    if(isset($_GET['a2'])){$a2 = Secure::Sanitize($_GET['a2']);}
    if(isset($_GET['a3'])){$a3 = Secure::Sanitize($_GET['a3']);}
    if(isset($_GET['a4'])){$a4 = Secure::Sanitize($_GET['a4']);}
    if(isset($_GET['a5'])){$a5 = Secure::Sanitize($_GET['a5']);}
    if(isset($_GET['a7'])){$a7 = Secure::Sanitize($_GET['a7']);}
    if(isset($_GET['b1'])){$b1 = Secure::Sanitize($_GET['b1']);}

if($_SESSION['tokenPostSess']==$b1){
    $Name = Get_Data($a1, $a2, $a3, $a4, $a5, $a7);
    echo $Name;
}else{
    header("HTTP/1.0 404 Not Found");
}

function Get_Data($a1, $a2, $a3, $a4, $a5, $a7){
    try{
        
        $dgsign = base64_decode($a3)."[*]".date("Y-m-d")."[*]".base64_decode($a4)."[*]".$a5;
        $dgsignencoded = Secure::encrypt($dgsign, "tmmsrprcsdmvdDpdrs2020");
        $afields = "";
        for($j = 1;$j<=($a7);$j++){
                if($j==$a7){
                    $afields .= 'APPR_'.$j;
                }else{
                    $afields .= 'APPR_'.$j.', "[**]",';
                }
        }

        if(base64_decode($a3)=="PENDING"){
            $dgsignencoded ="";
        }
        $query = "UPDATE tblleave SET APPR_".$a2."='".$dgsignencoded."' WHERE LEAVEID=".$a1;    
        $query1 = "select CONCAT(".$afields.") as mString FROM tblleave WHERE LEAVEID=".$a1; 
       
        $mydbVD = new DatabaseN();
        $mydbVD->setQuery($query);
        $mydbVD->executeQuery();
        $mydbVD->setQuery($query1);
        $mydbVD->executeQuery();

        $result = $mydbVD->loadSingleResult();
        $results = explode("[**]", $result);
        $tmpv = "";
        $returnV = "";
        $countA = 0;

        $astatus = "PENDING";
        $rejcount = 0;
        $appcount = 0;
        $pendcount = 0;

        for($i=0;$i<=count($results)-1;$i++){
            $tmpv = Secure::decrypt($results[$i], "tmmsrprcsdmvdDpdrs2020");
            $statustmp = explode("[*]", $tmpv);
            if($statustmp[0]=="REJECTED"){
                $rejcount += 1;
            }else if($statustmp[0]=="PENDING"){
                $pendcount += 1;
            }else if($statustmp[0]=="APPROVED"){
                $appcount += 1;
            }else if($statustmp[0]==""){
                $pendcount += 1;
            }
        }
    
        if($rejcount>0){
            $astatus = "REJECTED";
        }else{
            if($pendcount>0){
                $astatus = "PENDING";
            }else{
                if($appcount==$a7){
                    $astatus = "APPROVED";
                }
            }
        }
       
        $query3 = "UPDATE tblleave SET LEAVESTATUS='".$astatus."' WHERE LEAVEID=".$a1;
        $mydbVD->setQuery($query3);
        $mydbVD->executeQuery();

        if($astatus == "APPROVED"){
            $hasft = $a1;
            $cdedf = Secure::encrypt($hasft, "tmmsrprcsdmvdDpdrs2020");
            $query5 = "UPDATE tblleave SET LVDS='".$cdedf."' WHERE LEAVEID=".$a1; 
            $mydbVD->setQuery($query5);
            $mydbVD->executeQuery();
        }else{
            $query5 = "UPDATE tblleave SET LVDS='' WHERE LEAVEID=".$a1; 
            $mydbVD->setQuery($query5);
            $mydbVD->executeQuery();
        }

        $mydbVD->close_connection();
        return $astatus;
    }catch(Exception $e){
        return "";
    }
}
?>