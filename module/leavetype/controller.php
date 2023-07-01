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

	if (isset($_POST['save']) ) {
		//`LEAVTID`, `LEAVETYPE`, `DESCRIPTION`
		if(isset($_POST['leavecode'])){$LEAVECODE = Secure::Sanitize($_POST['leavecode']);}
		if(isset($_POST['leavetype'])){$LEAVETYPE = Secure::Sanitize($_POST['leavetype']);}
		if(isset($_POST['desc'])){$DESCRIPTION = Secure::Sanitize($_POST['desc']);}
		if(isset($_POST['leaveapprovers'])){$APPROVERS = Secure::Sanitize($_POST['leaveapprovers']);}
			
		$leave = new Leavetype();
		$leave->LEAVECODE       = $LEAVECODE;
		$leave->LEAVETYPE       = $LEAVETYPE;
		$leave->DESCRIPTION     = $DESCRIPTION;
		$leave->APPROVERS_COUNT = $APPROVERS;

		$datanew = $LEAVECODE.'*/*'.$LEAVETYPE.'*/*'.$DESCRIPTION.'*/*'.$APPROVERS.'';
		$dataold = retrieveOldData($LEAVECODE);
	}

	switch ($action) {
		case 1 :  		//add
			doInsert($leave, $datanew, $dataold);
			break;
		case 2 :		//edit
			doEdit($leave, $datanew, $dataold);
			break;
		case 3 :		//delete
			doDelete($datanew, $dataold);
			break;
	}

	function doInsert($leave, $datanew, $dataold){
		if (isset($_POST['save']) ) {
			$istrue = $leave->create(); 
			if ($istrue == 1){
				message("NewLeave Type [".$leave->LEAVETYPE."] has been created successfully!", "success");
				Header("Location: index.php");
				exit();		 	
			}
		}
	} 
	function doEdit($leave, $datanew, $dataold){
		if(isset($_POST['LEAVTID'])){$LEAVTID = Secure::Sanitize($_POST['LEAVTID']);}
		if(isset($_POST['save'])){
			InsertTrail("tblleavetype", $dataold, $datanew, "edit");
			$leave->update($LEAVTID);
			message("[".$leave->LEAVETYPE."] has been updated!", "success");
			Header("Location: index.php");
			exit();
		}
	}

	function doDelete($datanew, $dataold){
		if(isset($_GET['d'])){$EMPID = Secure::Sanitize($_GET['d']);}
		if(isset($_GET['h'])){$HashSent = Secure::Sanitize($_GET['h']);}
		if(isset($_GET['d'])){
			$hash2 = ((3*$EMPID)+($EMPID+3)+date("md"))*date("md")*$EMPID;
			if($HashSent==$hash2){
				$leave = New Leavetype();
				$dataold = retrieveOldData($EMPID);	
				InsertTrail("tblleavetype", $dataold, "", "delete");
				$leave->delete($EMPID);
				message("Leave type has been deleted!", "success");
			}
			Header("Location: index.php");
			exit();
		}
	} 

	function retrieveOldData($EMPID){
		$mydb1 = new DatabaseN();
		$mydb1->setQuery("SELECT * FROM  `tblleavetype` where LEAVTID=".$EMPID);
		$cur = $mydb1->loadResultList();
		foreach ($cur as $result) {
			$data = $result->LEAVTID.'*/*'.$result->LEAVECODE.'*/*'.$result->LEAVETYPE.'*/*'.$result->DESCRIPTION.'*/*'.$result->APPROVERS_COUNT.'';
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