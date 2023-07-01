<?php
	/* Open Required Header in all scripts */
		$pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
		$toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
		if(!isset($security_included)){require($toRoot."include/security.php");}
		Secure::session_verify($toRoot);
	/* Close Required Header in all scripts */

	if(!isset($initialize_included)){
		require($toRoot."include/initialize.php");
	}

	$action = (isset($_GET['ax']) && $_GET['ax'] != '') ? $_GET['ax'] : '';
	if(!is_numeric($action)){
		Secure::scriptRedirect("index.php");
	}
	$datanew="";
	$dataold="";

	if(!isset($dates_included)){
		require("dates.php");
	}

	if (isset($_POST['save'])){
		if(isset($_POST['LEMPID'])){$LEMPID = Secure::Sanitize($_POST['LEMPID']);}
		if(isset($_POST['LEMPNAME'])){$LEMPNAME = Secure::Sanitize($_POST['LEMPNAME']);}
		if(isset($_POST['LSTRDATE'])){$LSTRDATE = Secure::Sanitize($_POST['LSTRDATE']);}		
		$LCURDATE 	= $today = date("yy-m-d");
		if(isset($_POST['DATESTART'])){$DATESTART = Secure::Sanitize($_POST['DATESTART']);}
		if(isset($_POST['DATEEND'])){$DATEEND = Secure::Sanitize($_POST['DATEEND']);}
		$LTENURE = round(Tenure($LSTRDATE), 2);
		$LNOTAKEN = DaysTaken($DATESTART, $DATEEND, $holidayDays); 
		$LNODAYS 	= Achieved_VacationDays($LSTRDATE, $CurrentDate);		
		if(isset($_POST['TYPEOFLEAVE'])){$TYPEOFLEAVE = Secure::Sanitize($_POST['TYPEOFLEAVE']);}
		if(isset($_POST['REASON'])){$REASON = Secure::Sanitize($_POST['REASON']);}
		if(isset($_POST['LEAVESTATUS'])){$LEAVESTATUS = Secure::Sanitize($_POST['LEAVESTATUS']);}

		$Leave = new Leave();
		$Leave->LEMPID    	= $LEMPID;
		$Leave->LEMPNAME    = $LEMPNAME;
		$Leave->LSTRDATE    = $LSTRDATE;
		$Leave->LCURDATE    = $LCURDATE;
		$Leave->DATESTART   = $DATESTART;
		$Leave->DATEEND     = $DATEEND;
		$Leave->LTENURE     = $LTENURE;
		$Leave->LNOTAKEN   	= $LNOTAKEN;
		$Leave->LNODAYS   	= $LNODAYS;
		$Leave->TYPEOFLEAVE = $TYPEOFLEAVE;
		$Leave->REASON      = $REASON;
		$Leave->LEAVESTATUS = $LEAVESTATUS;

		$datanew = $LEMPID.'*/*'.$LEMPNAME.'*/*'.$LSTRDATE.'*/*'.$LCURDATE.'*/*'.$DATESTART.'*/*'.$DATEEND.'*/*'.$LTENURE.'*/*'.$LNOTAKEN.'*/*'.$LNODAYS.'*/*'.$TYPEOFLEAVE.'*/*'.$REASON.'*/*'.$LEAVESTATUS.'';
		$dataold = retrieveOldData($LEMPID);

	}

	switch ($action) {
		case 1 :  		//add
			doInsert($Leave, $datanew, $dataold);
			break;
		case 2 :		//edit
			doEdit($Leave, $datanew, $dataold);
			break;
		case 3 :		//delete
			doDelete($datanew, $dataold);
			break;
	}

   //`LEAVEID`, `EMPLOYID`, `DATESTART`, `DATEEND`, `NODAYS`, `SHIFTTIME`, `TYPEOFLEAVE`, `REASON`, `LEAVESTATUS`, `ADMINREMARKS`, `DATEPOSTED`
  
   function doInsert($Leave, $datanew, $dataold){
	if (isset($_POST['save']) ) {
		if ($Leave->DATESTART <= $Leave->DATEEND){
			$istrue = $Leave->create(); 
			if ($istrue == 1){
				message("Your leave application has been created successfully!", "success");
				Header("Location: index.php");
				exit();		 	
			}
		}else{
			message("Startdate is incorrect ".$Leave->DATESTART, "error");
			header("Location: index.php");
			exit();
		}
	}
}	
 	
	function doEdit($Leave){
		if (isset($_POST['save'])){
			if($Leave->TYPEOFLEAVE=='Vacation'){
		  		if ($Leave->LEAVESTATUS == 'APPROVED'){
						$Leave->LEAVESTATUS  = 'APPROVED';
						$Leave->update($Leave->LEMPID);
						message("Your leave application is  ". $Leave->LEAVESTATUS ,"success");
						header("Location: index.php");
						exit();
			    }		
				if($Leave->LEAVESTATUS == 'REJECTED'){
						$Leave->LEAVESTATUS  = 'REJECTED';
						$Leave->update($Leave->LEMPID);
						message("Your leave application is  ". $Leave->LEAVESTATUS ,"error");
						header("Location: index.php");
						exit();
				}
				if ($Leave->LEAVESTATUS == 'PENDING') {
						
					$Leave->update($Leave->LEMPID);
					message("Your leave application is  ". $Leave->LEAVESTATUS ,"error");
					header("Location: index.php");
					exit();
				}
		    
			}elseif($Leave->TYPEOFLEAVE!='Vacation'){
					$Leave->update($Leave->LEMPID);
					//$user = new User();			
					//$user->update($EMPID); 
					message("You should have HR approval by  ". $Leave->TYPEOFLEAVE ,"error");
					header("Location: index.php");
					exit();
			}		
		}
				
	}
	
	function retrieveOldData($EMPID){
		$data = "";
		$mydb1 = new DatabaseN();
		$mydb1->setQuery("SELECT * FROM  `tblleave` where LEAVEID=".$EMPID);
		$cur = $mydb1->loadResultList();
		foreach ($cur as $result) {
			$data = $result->LEAVEID.'*/*'.$result->LEMPID.'*/*'.$result->LEMPNAME.'*/*'.$result->LSTRDATE.'*/*'.$result->LCURDATE.'*/*'.$result->DATESTART.'*/*'.$result->DATEEND.'*/*'.$result->LTENURE.'*/*'.$result->LNOTAKEN.'*/*'.$result->LNODAYS.'*/*'.$result->TYPEOFLEAVE.'*/*'.$result->REASON.'*/*'.$result->LEAVESTATUS.'*/*'.$result->LVDS.'';
		}
		$mydb1->close_connection();
		return $data;
	}

	function InsertTrail($table, $dataold, $datanew, $type){
		$mydb1 = new DatabaseN();
		$pid = date("YmdHis");
		$adate = date("Ymd");
		$sql = "INSERT INTO tblaudit_trail VALUES ('".$pid.$_SESSION['EMPID']."', '".str_replace('@nice.com','', $_SESSION['USERNAME'])."', '".$table."', '".$dataold."', '".$datanew."','".$adate."', '".$type."')";
		$mydb1->setQuery($sql);
	 	$mydb1->executeQuery();
	}
?>