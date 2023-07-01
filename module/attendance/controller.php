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
		if(isset($_POST['atempid'])){$ATEMPID = Secure::Sanitize($_POST['atempid']);}
		if(isset($_POST['atempname'])){$ATEMPNAME = Secure::Sanitize($_POST['atempname']);}
		if(isset($_POST['atdate'])){$ATDATE = Secure::Sanitize($_POST['atdate']);}
		if(isset($_POST['attimein'])){$ATTIMEIN = Secure::Sanitize($_POST['attimein']);}
		if(isset($_POST['attimeout'])){$ATTIMEOUT = Secure::Sanitize($_POST['attimeout']);}

		$At = new At();
		$At->ATEMPID    		= $ATEMPID;
		$At->ATEMPNAME     		= $ATEMPNAME;
		$At->ATDATE			    = $ATDATE;
		$At->ATTIMEIN     		= $ATTIMEIN;
		$At->ATTIMEOUT    		= $ATTIMEOUT;

		$datanew = $ATEMPID.'*/*'.$ATEMPNAME.'*/*'.$ATDATE.'*/*'.$ATTIMEIN.'*/*'.$ATTIMEOUT.'';
		$dataold = retrieveOldData($ATEMPID);	
	}

	switch ($action) {
		case 1 :  		//add
			doInsert($At, $datanew, $dataold);
			break;
		case 2 :		//edit
			doEdit($At, $datanew, $dataold);
			break;
		case 3 :		//delete
			doDelete($datanew, $dataold);
			break;
	}

	function doInsert($At, $datanew, $dataold){
		if (isset($_POST['save']) ) {			
			$istrue = $At->create(); 
			if ($istrue == 1){
				message("New Att [".$At->ATEMPNAME."] has been created successfully!", "success");
				Header("Location: index.php");
				exit();		
			}
		}
	}

	function doEdit($At, $datanew, $dataold){
		if(isset($_POST['ATID'])){$ATID = Secure::Sanitize($_POST['ATID']);}
		if(isset($_POST['save'])){
			InsertTrail("tblattendance", $dataold, $datanew, "edit");
			$At->update($ATID);
			message("[".$At->ATEMPNAME."] has been updated!", "success");
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
				$At = new At();
				$dataold = retrieveOldData($EMPID);	
				InsertTrail("tblattendance", $dataold, "", "delete");
				$At->delete($EMPID);
				message(" Att has been deleted!", "success");
			}
			Header("Location: index.php");
			exit();
		}
	} 
	
	function retrieveOldData($EMPID){
		$mydb1 = new DatabaseN();
		$mydb1->setQuery("SELECT * FROM  `tblattendance` where ATID=".$EMPID);
		$cur = $mydb1->loadResultList();
		foreach ($cur as $result) {
			$data = $result->ATID.'*/*'.$result->ATEMPID.'*/*'.$result->ATEMPNAME.'*/*'.$result->ATDATE.'*/*'.$result->ATTIMEIN.'*/*'.$result->ATTIMEOUT.'';
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