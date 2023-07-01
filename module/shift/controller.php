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

	if (isset($_POST['save'])){
		if(isset($_POST['shiftcode'])){$SHIFTCODE = Secure::Sanitize($_POST['shiftcode']);}
		if(isset($_POST['shiftname'])){$SHIFTNAME = Secure::Sanitize($_POST['shiftname']);}
		if(isset($_POST['shiftimein'])){$SHIFTIMEIN = Secure::Sanitize($_POST['shiftimein']);}
		if(isset($_POST['shiftimeout'])){$SHIFTIMEOUT = Secure::Sanitize($_POST['shiftimeout']);}

		$Shift = new Shift();
		$Shift->SHIFTCODE     = $SHIFTCODE;
		$Shift->SHIFTNAME     = $SHIFTNAME;
		$Shift->SHIFTIMEIN    = $SHIFTIMEIN;				
		$Shift->SHIFTIMEOUT   = $SHIFTIMEOUT;
		
		$datanew = $SHIFTCODE.'*/*'.$SHIFTNAME.'*/*'.$SHIFTIMEIN.'*/*'.$SHIFTIMEOUT.'';
		$dataold = retrieveOldData($SHIFTCODE);
	}

	switch ($action) {
		case 1 :  		//add
			doInsert($Shift, $datanew, $dataold);
			break;
		case 2 :		//edit
			doEdit($Shift, $datanew, $dataold);
			break;
		case 3 :		//delete
			doDelete($datanew, $dataold);
			break;
		case 4 :		//photos
			doupdateimage($datanew, $dataold);
			break;
	}
   
	function doInsert($Shift, $datanew, $dataold){
		if (isset($_POST['save']) ) {
			$istrue = $Shift->create(); 
			if ($istrue == 1){
				message("New shift [".$Shift->SHIFTNAME."] has been created successfully!", "success");
				Header("Location: index.php");
				exit();		 	
			}
		}
	}

	function doEdit($Shift, $datanew, $dataold){
		if(isset($_POST['SHIFTID'])){$SHIFTID = Secure::Sanitize($_POST['SHIFTID']);}
		if(isset($_POST['save'])){
			InsertTrail("tblshift", $dataold, $datanew, "edit");
			$Shift->update($SHIFTID);
			message("[".$Shift->SHIFTNAME."] has been updated!", "success");
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
				$Shift = new Shift();
				$dataold = retrieveOldData($EMPID);	
				InsertTrail("tblshift", $dataold, "", "delete");
				$Shift->delete($EMPID);
				message("Shift has been deleted!", "success");
			}
			Header("Location: index.php");
			exit();
		}
	} 	
	
	function retrieveOldData($EMPID){
		$mydb1 = new DatabaseN();
		$mydb1->setQuery("SELECT * FROM  `tblshift` where SHIFTID=".$EMPID);
		$cur = $mydb1->loadResultList();
		foreach ($cur as $result) {
			$data = $result->SHIFTID.'*/*'.$result->SHIFTCODE.'*/*'.$result->SHIFTNAME.'*/*'.$result->SHIFTIMEIN.'*/*'.$result->SHIFTIMEOUT.'';
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