<?php
/* Open Required Header in all scripts */
    $pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
    $toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
    if(!isset($security_included)){require($toRoot."include/security.php");}
    Secure::session_verify($toRoot);
/* Close Required Header in all scripts */
    if(!isset($_SESSION['tokenPostSess'])){header("HTTP/1.0 404 Not Found");exit();}
    if(!isset($_GET['a1'])){header("HTTP/1.0 404 Not Found");exit();}
    if(!isset($_GET['b1'])){header("HTTP/1.0 404 Not Found");exit();}

    require($toRoot."include/databaseN.php");
    if(isset($_GET['a1'])){$a1 = Secure::Sanitize($_GET['a1']);}
	if(isset($_GET['b1'])){$b1 = Secure::Sanitize($_GET['b1']);}

if($_SESSION['tokenPostSess']==$b1){
    $Name = Get_Data($a1);
    echo $Name;
}else{
    header("HTTP/1.0 404 Not Found");
}

function Get_Data($mdata){
    try{
        $mydbVD = new DatabaseN();
        $query = "SELECT ATTRNAME_R FROM tblattrition_r WHERE ATTRNAME_R='".$mdata."';";
        $mydbVD->setQuery($query);
        $result = $mydbVD->loadSingleResult(); 
        $mydbVD->close_connection();
        return $result;
    }catch(Exception $e){
        return "";
    }
}
?>