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
			if(isset($_POST['attrempcode'])){$ATTREMPCODE = Secure::Sanitize($_POST['attrempcode']);}
			if(isset($_POST['attrempname'])){$ATTREMPNAME = Secure::Sanitize($_POST['attrempname']);}
			if(isset($_POST['attrdate'])){$ATTRDATE = Secure::Sanitize($_POST['attrdate']);}
			if(isset($_POST['attreason'])){$ATTREASON = Secure::Sanitize($_POST['attreason']);}

			$Attr = new Attr();
			$ATTREMPCODE		= $_POST['attrempcode'];
			$ATTREMPNAME		= $_POST['attrempname'];
			$ATTRDATE			= $_POST['attrdate'];
			$ATTREASON			= $_POST['attreason'];
	
			$Attr->ATTREMPCODE  = $ATTREMPCODE;
			$Attr->ATTREMPNAME  = $ATTREMPNAME;
			$Attr->ATTRDATE     = $ATTRDATE;
			$Attr->ATTREASON    = $ATTREASON;

			$datanew = $ATTREMPCODE.'*/*'.$ATTREMPNAME.'*/*'.$ATTRDATE.'*/*'.$ATTREASON.'';
			$dataold = retrieveOldData($ATTREMPCODE);
		}

		switch ($action) {
			case 1 :  		//add
				doInsert($Attr, $datanew, $dataold);
				break;
			case 2 :		//edit
				doEdit($Attr, $datanew, $dataold);
				break;
			case 3 :		//delete
				doDelete($datanew, $dataold);
				break;
			case 4 :		//photos
				doupdateimage($datanew, $dataold);
				break;
		}

		function doInsert($Attr, $datanew, $dataold){
			if (isset($_POST['save']) ) {
				$istrue = $Attr->create(); 
				if ($istrue == 1){
					changeStatus($Attr->ATTREMPCODE, 'Attrited');
					DropPermissions($Attr->ATTREMPCODE);
					message("New attrition [".$Attr->ATTREMPNAME."] has been created successfully!", "success");
					Header("Location: index.php");
					exit();		 	
				}
			}
		}

		function changeStatus($EMPCODE, $mEMPSTATUS){
			$mydbCS = new DatabaseN();
			$query = "UPDATE tblemployee SET EMPSTATUS='".$mEMPSTATUS."' WHERE EMPLOYID=".$EMPCODE.";";
        	$mydbCS->setQuery($query);
        	$result = $mydbCS->executeQuery(); 
			$mydbCS->close_connection();
		}
		
		function DropPermissions($EMPCODE){
			$mydbCS = new DatabaseN();
			$query = "DELETE FROM tblapproversmatrix WHERE appr_user_id=".$EMPCODE.";";
        	$mydbCS->setQuery($query);
			$result = $mydbCS->executeQuery();
			$query1 = "DELETE FROM tbluprivmatrix WHERE priv_user_id=".$EMPCODE.";";
        	$mydbCS->setQuery($query1);
        	$result = $mydbCS->executeQuery();
        	$mydbCS->close_connection();
		}
  
	function doEdit($Attr, $datanew, $dataold){
		if(isset($_POST['ATTRID'])){$ATTRID = Secure::Sanitize($_POST['ATTRID']);}
		if(isset($_POST['save'])){
			InsertTrail("tblattrition", $dataold, $datanew, "edit");
			$Attr->update($ATTRID);
			message("[".$Attr->ATTREMPNAME."] has been updated!", "success");
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
				$Attr = new Attr();
				$dataold = retrieveOldData($EMPID);
				$part = explode("*/*", $dataold);
				InsertTrail("tblattrition", $dataold, "", "delete");
				$Attr->delete($EMPID);
				changeStatus($part[1], 'Active');
				DropPermissions($part[1]);
				message("Attrition status changed to Active!", "success");
			}
			Header("Location: index.php");
			exit();
		}
	} 

	function retrieveOldData($EMPID){
		$mydb1 = new DatabaseN();
		$data = "";
		$mydb1->setQuery("SELECT * FROM  `tblattrition` where ATTRID=".$EMPID);
		$cur = $mydb1->loadResultList();
		foreach ($cur as $result) {
			$data = $result->ATTRID.'*/*'.$result->ATTREMPCODE.'*/*'.$result->ATTREMPNAME.'*/*'.$result->ATTREASON.'*/*'.$result->ATTRDATE.'';
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