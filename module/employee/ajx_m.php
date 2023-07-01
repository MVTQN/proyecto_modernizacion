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
    if(!isset($_GET['b2'])){header("HTTP/1.0 404 Not Found");exit();}

    require($toRoot."include/databaseN.php");
    if(isset($_GET['a1'])){$a1 = Secure::Sanitize($_GET['a1']);}
    if(isset($_GET['a2'])){$a2 = Secure::Sanitize($_GET['a2']);}
    if(isset($_GET['b1'])){$b1 = Secure::Sanitize($_GET['b1']);}
    if(isset($_GET['b2'])){$b2 = Secure::Sanitize($_GET['b2']);}

if($_SESSION['tokenPostSess']==$b1){
    $Name = Get_Data($a1, $a2, $b2);
    echo $Name;
}else{
    header("HTTP/1.0 404 Not Found");
}

function Get_Data($a1, $a2, $b2){
    try{
        $tptoken = md5($a1);
        if($b2=="1"){
            $parts = explode("[*]",base64_decode($a1));
            $query = "INSERT INTO tblapproversmatrix VALUES(LAST_INSERT_ID(), '".$tptoken."', ".$parts[0].", '".$parts[1]."', '".$a2."');";    
        }else if($b2=="2"){
            $query = "DELETE FROM tblapproversmatrix  WHERE appr_token='".$tptoken."'";    
        }

        $mydbVD = new DatabaseN();
        $mydbVD->setQuery($query);
        $mydbVD->executeQuery(); 
        $mydbVD->close_connection();
        return "done";
    }catch(Exception $e){
        return "";
    }
}
?>