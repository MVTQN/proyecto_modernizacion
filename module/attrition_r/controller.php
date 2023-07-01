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
		if(isset($_POST['ATTRID_R'])){$ATTID = Secure::Sanitize($_POST['ATTRID_R']);}
		if(isset($_POST['attrname_r'])){$ATTRNAME_R = Secure::Sanitize($_POST['attrname_r']);}
		if(isset($_POST['attrdesc'])){$ATTRDESC = Secure::Sanitize($_POST['attrdesc']);}

		$Attr_r = new Attr_r();
		$Attr_r->ATTRNAME_R   = $ATTRNAME_R;
		$Attr_r->ATTRDESC     = $ATTRDESC;

		$datanew = $ATTRNAME_R.'*/*'.$ATTRDESC.'';

	}
	switch ($action) {
		case 1 :  		//add
			doInsert($Attr_r, $datanew, $dataold);
			break;
		case 2 :		//edit
			$dataold = retrieveOldData($ATTID);
			doEdit($Attr_r, $datanew, $dataold);
			break;
		case 3 :		//delete
			doDelete($datanew, $dataold);
			break;
		case 4 :		//photos
			doupdateimage($datanew, $dataold);
			break;
	}
	
	function doInsert($Attr_r, $datanew, $dataold){
		if (isset($_POST['save']) ) {
			$istrue = $Attr_r->create(); 
			if ($istrue == 1){
				message("New reason [".$Attr_r->ATTRNAME_R."] has been created successfully!", "success");
				Header("Location: index.php");
				exit();		 	
			}
		}
	}

	function doEdit($Attr_r, $datanew, $dataold){
		if(isset($_POST['ATTRID_R'])){$ATTRID = Secure::Sanitize($_POST['ATTRID_R']);}
		if(isset($_POST['save'])){
			InsertTrail("tblattrition_r", $dataold, $datanew, "edit");
			$Attr_r->update($ATTRID);
			message("[".$Attr_r->ATTRNAME_R."] has been updated!", "success");
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
				$Attr_r = new Attr_r();
				$dataold = retrieveOldData($EMPID);	
				InsertTrail("tblattrition_r", $dataold, "", "delete");
				$Attr_r->delete($EMPID);
				message("Reason has been deleted!", "success");
			}
			Header("Location: index.php");
			exit();
		}
	} 


	function retrieveOldData($EMPID){
		$mydb1 = new DatabaseN();
		$mydb1->setQuery("SELECT * FROM  `tblattrition_r` where ATTRID_R=".$EMPID);
		$cur = $mydb1->loadResultList();
		foreach ($cur as $result) {
			$data = $result->ATTRID_R.'*/*'.$result->ATTRNAME_R.'*/*'.$result->ATTRDESC.'';
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