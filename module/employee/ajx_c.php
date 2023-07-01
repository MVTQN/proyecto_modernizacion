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
    if(!isset($_GET['c1'])){header("HTTP/1.0 404 Not Found");exit();}
    if(!isset($_GET['d1'])){header("HTTP/1.0 404 Not Found");exit();}

    require($toRoot."include/databaseN.php");
    if(isset($_GET['a1'])){$a1 = Secure::Sanitize($_GET['a1']);}
    if(isset($_GET['b1'])){$b1 = Secure::Sanitize($_GET['b1']);}
    if(isset($_GET['c1'])){$c1 = Secure::Sanitize($_GET['c1']);}
    if(isset($_GET['d1'])){$d1 = Secure::Sanitize($_GET['d1']);}

   
if($_SESSION['tokenPostSess']==$b1){
    $Name = Get_Data($a1, $c1, $d1);
    echo $Name;
}else{
    header("HTTP/1.0 404 Not Found");
}

function Get_Data($mdata, $c1, $d1){
    try{
        $mydbVD = new DatabaseN();
        $query ="";
        $pdata = explode("[*]", $c1);
        if($d1==1){
            $query = "SELECT COUNTRY FROM tblcompany WHERE COMPANY='".$pdata[0]."' GROUP BY COUNTRY;";
        }else if($d1==2){
            $query = "SELECT CITY FROM tblcompany WHERE COUNTRY='".$pdata[0]."' GROUP BY CITY;";
        }else if($d1==3){
            $query = "SELECT LDEPTNAME FROM tbllob WHERE COMPLOB='".$pdata[1]."' GROUP BY LDEPTNAME;";
        }else if($d1==4){
            $query = "SELECT LOBNAME FROM tbllob WHERE LDEPTNAME='".$pdata[0]."'  GROUP BY LOBNAME;";
        }else if($d1==5){
            $query = "SELECT a.MGRNAME AS MGRNAME1 FROM tblmanager a GROUP BY a.MGRNAME;";
        }
        echo $query;
        $mydbVD->setQuery($query);
        $rol = $mydbVD->loadResultList();
        $result = '';
        $result .= '<option value="">Select option...</option>';
            foreach ($rol as $rolemp) {
                if($d1==1){
                    $result .= '<option value="'.$rolemp->COUNTRY.'">'.$rolemp->COUNTRY.'</option>';
                }else if($d1==2){
                    $result .= '<option value="'. $rolemp->CITY.'">'.$rolemp->CITY.'</option>';
                }else if($d1==3){
                    $result .= '<option value="'. $rolemp->LDEPTNAME.'">'.$rolemp->LDEPTNAME.'</option>';
                }else if($d1==4){
                    $result .= '<option value="'. $rolemp->LOBNAME.'">'.$rolemp->LOBNAME.'</option>';
                }else if($d1==5){
                    $result .= '<option value="'. $rolemp->MGRNAME1.'">'.$rolemp->MGRNAME1.'</option>';
                }
            }
        $mydbVD->close_connection();
       
        return $result;


    }catch(Exception $e){
        return "";
    }
}
?>