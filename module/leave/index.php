<?php
	/* Open Required Header in all scripts */
		$pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
		$toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
		if(!isset($security_included)){require($toRoot."include/security.php");}
		Secure::session_verify($toRoot);
	/* Close Required Header in all scripts */

	$action = (isset($_GET['vw']) && $_GET['vw'] != '') ? $_GET['vw'] : '';

	if($action !=''){
		if(!is_numeric($action)){
			Header("Location: index.php");
			exit();
		}	
	}

	if(!isset($initialize_included)){
		require($toRoot."include/initialize.php");
	}

	if(!isset($secid_included)){
		require("sec_conf.php");
	}

	$permission = 0;
	$mydbA = new DatabaseN();
	$mydbA->setQuery("SELECT MTXS".$secid." FROM tblusermatrix WHERE MTXUSRNAME='".$_SESSION['EMPPOSITION']."'");
 	$resultA = $mydbA->executeQuery();
		if ($resultA->num_rows > 0) {
			while($rowA = $resultA->fetch_array()) {
				$permission = $rowA[0];
			}
		}
	$mydbA->close_connection();

 	$title="Leave Module"; 
	$header=$action; 

switch ($action) {
	case 0 :
		$content    = 'list.php';//all
		$_SESSION['LeaveOption'] = 0;	
		break;
	case 1 :
		$content    = 'add.php';		
		break;
	case 2 :
		$content    = 'edit.php';		
		break;
    case 3 :
		$content    = 'view.php';		
		break;
	case 4 :
		$content    = 'list.php';//approved
		$_SESSION['LeaveOption'] = 1;		
		break;
	case 5 :
		$content    = 'list.php';//rejected
		$_SESSION['LeaveOption'] = 2;		
		break;
	default :
		$content    = 'list.php';//all
		$_SESSION['LeaveOption'] = 0;	
}
require_once ($toRoot."theme/template.php");
?>