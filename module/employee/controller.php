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
		if(isset($_POST['employid'])){$EMPLOYID = Secure::Sanitize($_POST['employid']);}
		if(isset($_POST['name'])){$EMPNAME = Secure::Sanitize($_POST['name']);}
		if(isset($_POST['identification'])){$IDENTIFICATION = Secure::Sanitize($_POST['identification']);}
		if(isset($_POST['emprole'])){$EMPROLE = Secure::Sanitize($_POST['emprole']);}
		if(isset($_POST['username'])){$USERNAME = Secure::Sanitize($_POST['username']);}
		if(isset($_POST['empstatus'])){$EMPSTATUS = Secure::Sanitize($_POST['empstatus']);}
		if(isset($_POST['sex'])){$EMPSEX = Secure::Sanitize($_POST['sex']);}
		if(isset($_POST['birthday'])){$BIRTHDAY = Secure::Sanitize($_POST['birthday']);}
		if(isset($_POST['mgname'])){$MGNAME = Secure::Sanitize($_POST['mgname']);}
		if(isset($_POST['pass'])){$PASSWRD = Secure::Sanitize($_POST['pass']);}
		if(isset($_POST['strdate'])){
			$STRDATE = Secure::Sanitize($_POST['strdate']);
			$ONBOARDINGDATE = date('Y-m-d', strtotime($STRDATE. ' + 90 days'));
		}
		if(isset($_POST['empphone'])){$EMPPHONE = Secure::Sanitize($_POST['empphone']);}
		if(isset($_POST['empaddress'])){$EMPADDRESS = Secure::Sanitize($_POST['empaddress']);}
		if(isset($_POST['company'])){$COMPANY = Secure::Sanitize($_POST['company']);}
		if(isset($_POST['empshift'])){$EMPSHIFT = Secure::Sanitize($_POST['empshift']);}
		if(isset($_POST['empmgr'])){$EMPMGR = Secure::Sanitize($_POST['empmgr']);}
		if(isset($_POST['department'])){$DEPARTMENT = Secure::Sanitize($_POST['department']);}
		if(isset($_POST['type'])){$EMPPOSITION = Secure::Sanitize($_POST['type']);}

		if(isset($_POST['country'])){$COUNTRY = Secure::Sanitize($_POST['country']);}
		if(isset($_POST['city'])){$CITY = Secure::Sanitize($_POST['city']);}
		if(isset($_POST['emplob'])){$LOB = Secure::Sanitize($_POST['emplob']);}

				$user = new User();
				$user->EMPLOYID    		= $EMPLOYID;
				$user->EMPNAME     		= $EMPNAME;
				$user->IDENTIFICATION 	= $IDENTIFICATION;
				$user->EMPROLE 			= $EMPROLE;
				$user->USERNAME    		= $USERNAME;
				$user->EMPSTATUS 		= $EMPSTATUS;
				$user->EMPSEX      		= $EMPSEX;
				$user->BIRTHDAY   		= $BIRTHDAY;
				$user->MGNAME   		= $MGNAME;
				$user->STRDATE     		= $STRDATE;
				$user->EMPPHONE    		= $EMPPHONE;
				$user->EMPADDRESS     	= $EMPADDRESS;
				if(!isset($PASSWRD)){
					$PASSWRD = "";
				}else{
					$user->PASSWRD    	= sha1($PASSWRD);
				}
				$user->COMPANY     		= $COMPANY;
				$user->EMPSHIFT     	= $EMPSHIFT;
				$user->EMPMGR     		= $EMPMGR;
				$user->DEPARTMENT  		= $DEPARTMENT;
				$user->EMPPOSITION 		= $EMPPOSITION;
				$user->COUNTRY 			= $COUNTRY;
				$user->CITY 			= $CITY;
				$user->LOB 				= $LOB;
				$user->EMPONBOARDING	= $ONBOARDINGDATE;

				$datanew = $EMPLOYID.'*/*'.$EMPNAME.'*/*'.$IDENTIFICATION.'*/*'.$EMPROLE.'*/*'.$USERNAME.'*/*'.$EMPSTATUS.'*/*'.$EMPSEX.'*/*'.$BIRTHDAY.'*/*'.$MGNAME.'*/*'.$STRDATE.'*/*'.$EMPPHONE.'*/*'.$EMPADDRESS.'*/*'.sha1($PASSWRD).'*/*'.$COMPANY.'*/*'.$EMPSHIFT.'*/*'.$EMPMGR.'*/*'.$DEPARTMENT.'*/*'.$EMPPOSITION.'*/*'.$COUNTRY.'*/*'.$CITY.'*/*'.$LOB.'*/*'.$ONBOARDINGDATE;
				$dataold = retrieveOldData($EMPLOYID);	
	}

switch ($action) {
		case 1 :  		//add
			doInsert($user, $datanew, $dataold);
			break;
		case 2 :		//edit
			doEdit($user, $datanew, $dataold);
			break;
		case 3 :		//delete
			doDelete($datanew, $dataold);
			break;
		case 4 :		//photos
			doresetpass($datanew, $dataold);
			break;
		case 5 :		//permission matrix
			doresetpass($datanew, $dataold);
			break;
	}

	function doInsert($user, $datanew, $dataold){
		if (isset($_POST['save']) ) {
			$istrue = $user->create(); 
			if ($istrue == 1){
				echo "aqui2";

				message("New Employee [".$user->EMPNAME."] has been created successfully!", "success");
				Header("Location: index.php");
				exit();		 	
			}
		}
	}

	function doEdit($user, $datanew, $dataold){
		if(isset($_POST['empid'])){$empid = Secure::Sanitize($_POST['empid']);}
		if(isset($_POST['save'])){
			InsertTrail("tblemployee", $dataold, $datanew, "edit");
			$user->update($empid);
			if($user->EMPSTATUS=='Attrited'){
				DropPermissions($user->EMPLOYID);
			}
			message("[".$user->EMPNAME."] has been updated!", "success");
			Header("Location: index.php");
			exit();
		}
	}

	function doPermission($user, $datanew, $dataold){
		if(isset($_POST['empid'])){$empid = Secure::Sanitize($_POST['empid']);}
		if(isset($_POST['save'])){
			//InsertTrail("tblemployee", $dataold, $datanew, "edit");
			$user->update($empid);
			message("[".$user->EMPNAME."] has been updated!", "success");
			Header("Location: index.php");
			exit();
		}
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

	function doDelete($datanew, $dataold){
		if(isset($_GET['d'])){$EMPID = Secure::Sanitize($_GET['d']);}
		if(isset($_GET['h'])){$HashSent = Secure::Sanitize($_GET['h']);}
		if(isset($_GET['d'])){
			$hash2 = ((3*$EMPID)+($EMPID+3)+date("md"))*date("md")*$EMPID;
			if($HashSent==$hash2){
				$user = New User();
				$dataold = retrieveOldData($EMPID);	
				InsertTrail("tblemployee", $dataold, "", "delete");
				$user->delete($EMPID);
				message("Employee has been deleted!", "success");
			}
			Header("Location: index.php");
			exit();
		}
	} 
	
	function doresetpass()
	{
		$oldpass = sha1($_POST['CURPASS']);
		$newpass = $_POST['newpass'];
		$cpass = $_POST['cpass'];
		$resetparam = $_GET['from'];
		//check if old pass exist!
		if ($oldpass == $_SESSION['PASSWRD'] ) {
			# code...
			//check if new and cpass is equal
		
			if ($newpass == $cpass) {
				$user = new User();
				$user->PASSWRD     = sha1($newpass);
				$user->update($_GET['id']); 
				// if ($istrue == 1){
				 	message("Your password has been reset successfully!", "success");

				 	if ($resetparam=='emp'){
				 		redirect('index.php');
				 	}else{
				 		redirect('index.php?view=edit&id='.$_GET['id']);
				 	}
				 	
				 	
				
			}else{
				
				message("Password and Confirm Password not equal!","error");
				redirect("index.php?view=reset&id=".$_GET['id']);
			}
			

		}else{
			message("Incorrect current Password!","error");
			redirect("index.php?view=reset&id=".$_GET['id']);
		}
	}
   
	function retrieveOldData($EMPID){
		$mydb1 = new DatabaseN();
		$data = "";
		$mydb1->setQuery("SELECT * FROM  `tblemployee` where EMPID=".$EMPID);
		$cur = $mydb1->loadResultList();
		foreach ($cur as $result) {
			$data = $result->EMPID.'*/*'.$result->EMPLOYID.'*/*'.$result->EMPNAME.'*/*'.$result->IDENTIFICATION.'*/*'.$result->EMPROLE.'*/*'.$result->USERNAME.'*/*'.$result->EMPSTATUS.'*/*'.$result->PASSWRD.'*/*'.$result->EMPSEX.'*/*'.$result->BIRTHDAY.'*/*'.$result->MGNAME.'*/*'.$result->STRDATE.'*/*'.$result->EMPPHONE.'*/*'.$result->EMPADDRESS.'*/*'.$result->COMPANY.'*/*'.$result->DEPARTMENT.'*/*'.$result->EMPPOSITION.'*/*'.$result->EMPSHIFT.'*/*'.$result->EMPMGR.'*/*'.$result->COUNTRY.'*/*'.$result->CITY.'*/*'.$result->LOB.'*/*'.$result->EMPONBOARDING;
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