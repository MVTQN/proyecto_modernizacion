<?php
/* Open Required Header in all scripts */
	$pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
	$toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
	if(!isset($security_included)){require($toRoot."include/security.php");}
	Secure::session_verify($toRoot);$tokenPost = Secure::sToken(true);
	$_SESSION['tokenPostSess'] = $tokenPost;
/* Close Required Header in all scripts */
	$mydb1 = new DatabaseN();
	$currentYear = date("Y");
	global $firstdayYear;
	$firstdayYear = $currentYear."-"."01-01";

	if(!isset($dates_included)){
		require("dates.php");
	} 
	  $percentage = 0;
	  $Adays = Achieved_VacationDays($_SESSION['STRDATE'], $CurrentDate);
	  $Cdays = ConsumedVacationDays($_SESSION['EMPLOYID'], $_SESSION['STRDATE']);
	  $AvailableDays = ($Adays-$Cdays);
	  if($Cdays==0){
			$percentage = 100;
	  }else{
			$percentage = round(($AvailableDays*100)/$Adays);
	  }

	function showCard($AvailableDays){
	echo	'<div class="main-card mb-3 card">
            	<div class="card-header">General</div>
					<div class="card-body"><h5 class="card-title">Status summary</h5>
					<span style="font-weight: bold;">Name: </span>'.$_SESSION['EMPNAME'].'<br>
					<span style="font-weight: bold;">Status: </span>'.$_SESSION['EMPSTATUS'].'<br>
					<span style="font-weight: bold;">Start Date: </span>'.$_SESSION['STRDATE'].'<br>
					<span style="font-weight: bold;">Available Vacation Days: </span>'.$AvailableDays.'
                    </div>
                <div class="card-footer">'.$_SESSION['COMPANY'].'</div>
            </div>';
	}

	function lastDay($date){
		$dateToTest = $date;
		$last = date('t',strtotime($dateToTest));
		return $last;
	}

	function showCharts($chart1, $chart2, $mydb1){
		$currentd = date("Y-m-d");
		$currentdf = date("Y-m-").lastDay($currentd);
		$currentMonth = date("n");
		$sixmonthsback = date("Y-m-d",strtotime($currentd."- 5 month"));
		$sixmonthsback2 = date("Y-m-01",strtotime($currentd."- 5 month"));
		$sixmonthsbackShort = date("Y-m",strtotime($currentd."- 5 month"));
		$backMonth = date("n",strtotime($currentd."- 5 month"));

		for($i=0;$i<=5;$i++){
			$rangeMonths[] = $sixmonthsbackShort;
			$sixmonthsbackShort = date("Y-m",strtotime($sixmonthsbackShort."+ 1 month")); 
		}

		//echo lastDay("2038-02-01");

		$labelsMonth[1] = "January";
	  	$labelsMonth[2] = "February";
	  	$labelsMonth[3] = "March";
	  	$labelsMonth[4] = "April";
		$labelsMonth[5] = "May";
		$labelsMonth[6] = "June";
		$labelsMonth[7] = "July";
		$labelsMonth[8] = "August";
		$labelsMonth[9] = "September";
		$labelsMonth[10] = "October";
		$labelsMonth[11] = "November";
		$labelsMonth[12] = "December";

		$labelsMonthNumber[1] = "01";
	  	$labelsMonthNumber[2] = "02";
	  	$labelsMonthNumber[3] = "03";
	  	$labelsMonthNumber[4] = "04";
		$labelsMonthNumber[5] = "05";
		$labelsMonthNumber[6] = "06";
		$labelsMonthNumber[7] = "07";
		$labelsMonthNumber[8] = "08";
		$labelsMonthNumber[9] = "09";
		$labelsMonthNumber[10] = "10";
		$labelsMonthNumber[11] = "11";
		$labelsMonthNumber[12] = "12";

		for($i=$backMonth;$i<=$currentMonth;$i++){
				$labels[] = $labelsMonth[$i];
				$labelsN[] = $labelsMonthNumber[$i];
		}

		$data[0][0] = "Active[*]green";
		$data[1][0] = "Onboarding[*]blue";
		$data[2][0] = "Attrited[*]red";

		for($i=1;$i<=7;$i++){
			$data[0][$i] = 0;
			$data[1][$i] = 0;
			$data[2][$i] = 0;
		}

		$dstart = $sixmonthsback2;
		$dend = $currentdf;
		//Attrited
		$attrited_query = "SELECT substr(attrdate, 6, 2) AS mMonth, COUNT(*) AS RC, substr(attrdate, 1, 4) AS myear FROM tblattrition
								  WHERE attrdate >='".$dstart."' AND attrdate <='".$dend."'"; 
								  if($_SESSION['EMPPMXLEV']=="10"){
										$attrited_query .= " GROUP BY mMonth ORDER BY myear, mMonth asc";
								  }else{
										$attrited_query .= " AND ATTREMPCODE IN(SELECT employid FROM tblemployee WHERE (". $_SESSION['MATRIX_FULL-FILTER'].")) GROUP BY mMonth ORDER BY myear, mMonth asc";
								  }
	 	$mydb1->setQuery($attrited_query);
		  $result = $mydb1->executeQuery();
		  if ($result->num_rows > 0) {
			while($row = $result->fetch_array()) {
				for($jj=0;$jj<=5;$jj++){
					if($row[0]==$labelsN[$jj]){$data[2][$jj+1] = $row[1];}
				}
			}
		}
		//Onboarding
		//$onboarding_query ="SELECT substr(strdate, 6, 2) AS mMonth, COUNT(*) AS RC, substr(strdate, 1, 4) AS myear FROM tblemployee
	   	//						   WHERE strdate >='".$dstart."'  AND strdate <='".$dend."' AND empstatus = 'onboarding' GROUP BY mMonth ORDER BY myear, mMonth asc";
		$onboarding_query ="SELECT
								sum(CASE WHEN emponboarding >= '".$rangeMonths[0]."-01' AND strdate <= '".$rangeMonths[0]."-31' AND employid NOT IN (SELECT attrempcode FROM tblattrition WHERE attrdate>='".$rangeMonths[0]."-01' AND attrdate<='".$rangeMonths[0]."-31') THEN 1 ELSE 0 END) AS M1,
								sum(CASE WHEN emponboarding >= '".$rangeMonths[1]."-01' AND strdate <= '".$rangeMonths[1]."-31' AND employid NOT IN (SELECT attrempcode FROM tblattrition WHERE attrdate>='".$rangeMonths[1]."-01' AND attrdate<='".$rangeMonths[1]."-31') THEN 1 ELSE 0 END) AS M2,
								sum(CASE WHEN emponboarding >= '".$rangeMonths[2]."-01' AND strdate <= '".$rangeMonths[2]."-31' AND employid NOT IN (SELECT attrempcode FROM tblattrition WHERE attrdate>='".$rangeMonths[2]."-01' AND attrdate<='".$rangeMonths[2]."-31') THEN 1 ELSE 0 END) AS M3,
								sum(CASE WHEN emponboarding >= '".$rangeMonths[3]."-01' AND strdate <= '".$rangeMonths[3]."-31' AND employid NOT IN (SELECT attrempcode FROM tblattrition WHERE attrdate>='".$rangeMonths[3]."-01' AND attrdate<='".$rangeMonths[3]."-31') THEN 1 ELSE 0 END) AS M4,
								sum(CASE WHEN emponboarding >= '".$rangeMonths[4]."-01' AND strdate <= '".$rangeMonths[4]."-31' AND employid NOT IN (SELECT attrempcode FROM tblattrition WHERE attrdate>='".$rangeMonths[4]."-01' AND attrdate<='".$rangeMonths[4]."-31') THEN 1 ELSE 0 END) AS M5,
								sum(CASE WHEN emponboarding >= '".$rangeMonths[5]."-01' AND strdate <= '".$rangeMonths[5]."-31' AND employid NOT IN (SELECT attrempcode FROM tblattrition WHERE attrdate>='".$rangeMonths[5]."-01' AND attrdate<='".$rangeMonths[5]."-31') THEN 1 ELSE 0 END) AS M6";
				if($_SESSION['EMPPMXLEV']=="10"){
					$onboarding_query .= " FROM tblemployee";
				}else{
					$onboarding_query .= " FROM tblemployee WHERE (". $_SESSION['MATRIX_FULL-FILTER'].")";
				}
		$mydb1->setQuery($onboarding_query);
		  $result1 = $mydb1->executeQuery();
		  if ($result1->num_rows > 0) {
			while($row1 = $result1->fetch_array()) {
				for($jj=0;$jj<=5;$jj++){
					$data[1][$jj+1] = $row1[$jj];
				}
			}
		}
		//echo "---<---".$data[1][4]."<br>";
		$active_query ="SELECT
								sum(CASE WHEN strdate <= '".$rangeMonths[0]."-31' AND emponboarding < '".$rangeMonths[0]."-01' AND employid NOT IN (SELECT attrempcode FROM tblattrition WHERE attrdate>='".$rangeMonths[0]."-01' AND attrdate<='".$rangeMonths[0]."-31') THEN 1 ELSE 0 END) AS M1,
								sum(CASE WHEN strdate <= '".$rangeMonths[1]."-31' AND emponboarding < '".$rangeMonths[1]."-01' AND employid NOT IN (SELECT attrempcode FROM tblattrition WHERE attrdate>='".$rangeMonths[1]."-01' AND attrdate<='".$rangeMonths[1]."-31') THEN 1 ELSE 0 END) AS M2,
								sum(CASE WHEN strdate <= '".$rangeMonths[2]."-31' AND emponboarding < '".$rangeMonths[2]."-01' AND employid NOT IN (SELECT attrempcode FROM tblattrition WHERE attrdate>='".$rangeMonths[2]."-01' AND attrdate<='".$rangeMonths[2]."-31') THEN 1 ELSE 0 END) AS M3,
								sum(CASE WHEN strdate <= '".$rangeMonths[3]."-31' AND emponboarding < '".$rangeMonths[3]."-01' AND employid NOT IN (SELECT attrempcode FROM tblattrition WHERE attrdate>='".$rangeMonths[3]."-01' AND attrdate<='".$rangeMonths[3]."-31') THEN 1 ELSE 0 END) AS M4,
								sum(CASE WHEN strdate <= '".$rangeMonths[4]."-31' AND emponboarding < '".$rangeMonths[4]."-01' AND employid NOT IN (SELECT attrempcode FROM tblattrition WHERE attrdate>='".$rangeMonths[4]."-01' AND attrdate<='".$rangeMonths[4]."-31') THEN 1 ELSE 0 END) AS M5,
								sum(CASE WHEN strdate <= '".$rangeMonths[5]."-31' AND emponboarding < '".$rangeMonths[5]."-01' AND employid NOT IN (SELECT attrempcode FROM tblattrition WHERE attrdate>='".$rangeMonths[5]."-01' AND attrdate<='".$rangeMonths[5]."-31') THEN 1 ELSE 0 END) AS M6";

				if($_SESSION['EMPPMXLEV']=="10"){
					$active_query .= " FROM tblemployee";
				}else{
					$active_query .= " FROM tblemployee WHERE (". $_SESSION['MATRIX_FULL-FILTER'].")";
				}
		  $mydb1->setQuery($active_query);
		  $result1 = $mydb1->executeQuery();
		  if ($result1->num_rows > 0) {
			while($row1 = $result1->fetch_array()) {
				for($jj=0;$jj<=5;$jj++){
					$data[0][$jj+1] = $row1[$jj];
				}
			}
		}
		echo 	'<div class="card-header-tab card-header-tab-animation card-header">
					<div class="card-header-title">
						<i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>Charts
					</div>
				</div>';

		if($chart1==true){
			echo 	'<div class="row">
						<div style="width: 100%;display: table-cell;vertical-align: middle;text-align: center;">
							<div style="width: 70%;display: inline-block;vertical-align: middle;text-align: center;">
								<canvas id="canvas1"></canvas><br><br>
							</div>
						</div>';
			echo 	'</div>';
						
					$graphA = new myChart("canvas1", "Employee Status from ".$sixmonthsback2." to ".$dend);
					$graphA->draw_BarsChart($labels, $data, 'true');
							
		}

		if($chart2==true){
			echo '<div class="row">
					<div style="width: 100%;display: table-cell;vertical-align: middle;text-align: center;">
						<div style="width: 80%;display: inline-block;vertical-align: middle;text-align: center;">
							<canvas id="canvas2"></canvas>
						</div>
					</div>';
			echo '</div>';
			
			$graphB = new myChart("canvas2", "Employee Status");
			$graphB->draw_LinesChart($labels, $data, 'false');
		}
		
	}
?>

<div class="row">
<?php
	$Ulevel = $_SESSION['EMPPMXLEV'];
	if($_SESSION['EMPPMXLEV']<=3){//agent - support//$percentageRequests = round(($countpending / $countemployees) * 100);
		$totalLabel1 = "My requests";
		$comments1 ="Comments 1";
		$totalLabel2 = "My Pending Leaves";
		$comments2 ="Total pending";
		$query1 = "SELECT COUNT(*) FROM tblleave WHERE LEMPID=".$_SESSION['EMPLOYID'];
		$query2 = "SELECT COUNT(*) FROM tblleave WHERE leavestatus='pending' AND LEMPID=".$_SESSION['EMPLOYID'];
		$totalLabel3 = "Available % of vacation days";
		//$Ulevel = 1;
		$RequestsTitle ="MY LEAVE REQUESTS";

	}elseif($_SESSION['EMPPMXLEV']>3  && $_SESSION['EMPPMXLEV']<=5){//manager
		$totalLabel1 = "Total employees";
		$comments1 ="Hired this year";
		$totalLabel2 = "Pending Leaves";
		$comments2 ="Total Requests";
		$totalLabel3 = "(%) Attritions current year";
		$query1 = "SELECT COUNT(*) FROM `tblemployee`  WHERE EMPLOYID<>'".$_SESSION['EMPLOYID']."' AND (". $_SESSION['MATRIX_FULL-FILTER'].") AND strdate>='".$firstdayYear."'";
		$query2 = "SELECT COUNT(*) FROM tblleave WHERE LEMPID IN(SELECT EMPLOYID FROM `tblemployee` WHERE (". $_SESSION['MATRIX_FULL-FILTER'].") AND EMPLOYID<>'".$_SESSION['EMPLOYID']."') AND LEAVESTATUS='Pending'";
		//$query3 = "SELECT COUNT(*) AS Attrited FROM tblemployee WHERE (". $_SESSION['MATRIX_FULL-FILTER'].") AND EMPLOYID IN(SELECT ATTREMPCODE FROM tblattrition WHERE attrdate>='".$firstdayYear."')";
		$query3 = "SELECT (SELECT COUNT(*) FROM tblemployee WHERE (". $_SESSION['MATRIX_FULL-FILTER'].") and strdate>='".$firstdayYear."') AS active, (SELECT COUNT(*) FROM tblemployee WHERE strdate>='".$firstdayYear."' AND empstatus = 'Attrited') AS attrited FROM tblemployee LIMIT 1";
		$RequestsTitle ="LEAVE REQUESTS";
		
	}elseif($_SESSION['EMPPMXLEV']>5  && $_SESSION['EMPPMXLEV']<=7){//operative
		$totalLabel1 = "Total employees";
		$comments1 ="Hired this year";
		$totalLabel2 = "Pending Leaves";
		$comments2 ="Total Requests";
		$totalLabel3 = "(%) Attritions current year";
		$query1 = "SELECT COUNT(*) FROM `tblemployee`  WHERE EMPLOYID<>'".$_SESSION['EMPLOYID']."' AND (". $_SESSION['MATRIX_FULL-FILTER'].")AND strdate>='".$firstdayYear."'";
		$query2 = "SELECT COUNT(*) FROM tblleave WHERE LEMPID IN(SELECT EMPLOYID FROM `tblemployee` WHERE (". $_SESSION['MATRIX_FULL-FILTER'].") AND EMPLOYID<>'".$_SESSION['EMPLOYID']."') AND LEAVESTATUS='Pending'";
		//$query3 = "SELECT COUNT(*) AS Attrited FROM tblemployee WHERE (". $_SESSION['MATRIX_FULL-FILTER'].") AND EMPLOYID IN(SELECT ATTREMPCODE FROM tblattrition WHERE attrdate>='".$firstdayYear."')";
		$query3 = "SELECT (SELECT COUNT(*) FROM tblemployee WHERE (". $_SESSION['MATRIX_FULL-FILTER'].") and strdate>='".$firstdayYear."') AS active, (SELECT COUNT(*) FROM tblemployee WHERE strdate>='".$firstdayYear."' AND empstatus = 'Attrited') AS attrited FROM tblemployee LIMIT 1";
		$RequestsTitle ="LEAVE REQUESTS";

	}elseif($_SESSION['EMPPMXLEV']>7  && $_SESSION['EMPPMXLEV']<=9){//executive
		$totalLabel1 = "Total employees";
		$comments1 ="Hired this year";
		$totalLabel2 = "Pending Leaves";
		$comments2 ="Requests";
		$totalLabel3 = "(%) Attritions current year";
		$query1 = "SELECT COUNT(*) FROM `tblemployee`  WHERE EMPLOYID<>'".$_SESSION['EMPLOYID']."' AND (". $_SESSION['MATRIX_FULL-FILTER'].")AND strdate>='".$firstdayYear."'";
		$query2 = "SELECT COUNT(*) FROM tblleave WHERE LEMPID IN(SELECT EMPLOYID FROM `tblemployee` WHERE (". $_SESSION['MATRIX_FULL-FILTER'].") AND EMPLOYID<>'".$_SESSION['EMPLOYID']."') AND LEAVESTATUS='Pending'";
		//$query3 = "SELECT COUNT(*) AS Attrited FROM tblemployee WHERE (". $_SESSION['MATRIX_FULL-FILTER'].") AND EMPLOYID IN(SELECT ATTREMPCODE FROM tblattrition WHERE attrdate>='".$firstdayYear."')";
		$query3 = "SELECT (SELECT COUNT(*) FROM tblemployee WHERE (". $_SESSION['MATRIX_FULL-FILTER'].") and strdate>='".$firstdayYear."') AS active, (SELECT COUNT(*) FROM tblemployee WHERE strdate>='".$firstdayYear."' AND empstatus = 'Attrited') AS attrited FROM tblemployee LIMIT 1";
		$RequestsTitle ="LEAVE REQUESTS";

	}elseif($_SESSION['EMPPMXLEV']==10){//Administrator
		$totalLabel1 = "Total employees";
		$comments1 ="Hired this year";
		$totalLabel2 = "Pending Leaves";
		$comments2 ="Requests";
		$totalLabel3 = "(%) Attritions current year";
		$query1 = "SELECT COUNT(*) FROM `tblemployee`  WHERE strdate>='".$firstdayYear."'";
		$query2 = "SELECT COUNT(*) FROM tblleave WHERE leavestatus='pending'";
		//$query3 = "SELECT COUNT(*) AS Attrited FROM tblemployee WHERE EMPLOYID IN(SELECT ATTREMPCODE FROM tblattrition WHERE attrdate>='".$firstdayYear."')";
		$query3 = "SELECT (SELECT COUNT(*) FROM tblemployee WHERE strdate>='".$firstdayYear."') AS active, (SELECT COUNT(*) FROM tblemployee WHERE strdate>='".$firstdayYear."' AND empstatus = 'Attrited') AS attrited FROM tblemployee LIMIT 1";
		$RequestsTitle ="LEAVE REQUESTS";
	}
	
?>
<!--column-->
<?php
	//Card1
	$mydb1->setQuery($query1);
	$countemployees = $mydb1->loadSingleResult();
    $graphia = new myChart("chart1", "Employee Status");
    echo '<div class="col-md-6 col-xl-4">';
		$graphia->draw_DashboardBox('33%', 80, 'bg-midnight-bloom', ''.$totalLabel1.'', ''.$comments1.'', $countemployees);
	echo '</div>';

	//Card 2
	$mydb1->setQuery($query2);
	$countpending = $mydb1->loadSingleResult();
    $graphi1 = new myChart("chart1", "Employee Status");
    echo '<div class="col-md-6 col-xl-4">';
		$graphi1->draw_DashboardBox('33%', 80, 'bg-arielle-smile', ''.$totalLabel2.'', ''.$comments2.'', $countpending);
	echo '</div>';
 
	$countattrited = 0;
    $graphi = new myChart("chart1", "Employee Status");
	echo '<div class="col-md-6 col-xl-4">';
		if($_SESSION['EMPPMXLEV']>3){
			$mydb1->setQuery($query3);
			$result1 = $mydb1->executeQuery();
		  	if ($result1->num_rows > 0) {
			while($row1 = $result1->fetch_array()) {
				if($row1[1]==0){
					$percentage = 0;
				}else{
					$percentage = ($row1[1]/$row1[0])*100;
				}
			}
			}else{
				$percentage = 0;
			}
			$percentage=bcdiv($percentage, '1', 2);	
		}else{
			//$percentage = ($countattrited/$countemployees)*100;
			$percentage = round(($AvailableDays/17)*100);
		}
		$graphi->draw_PercentageBox('33%', 80, 'blue', ''.$totalLabel3.'', $percentage);
	echo '</div>';
	echo '</div>';
	echo '<div style="background-color: #FFF;">';
	if($Ulevel==1){
		showCard($AvailableDays);
	}
	if($_SESSION['EMPPMXLEV']>3){
		showCharts(true, true, $mydb1);
	}

	/*
	SELECT 
	 	CASE WHEN substr(attrdate,1,2)='20' THEN substr(attrdate, 6, 2) ELSE attrdate END AS mMonth 
      	,COUNT(*) AS RC
    	FROM tblattrition
    	WHERE attrdate >='2020-01-01'
	GROUP BY CASE WHEN substr(attrdate,1,2)='20' THEN substr(attrdate, 6, 2) ELSE attrdate END ORDER BY mMonth asc 
	*/
echo '</div>';
showlastLeaves($RequestsTitle, $Ulevel, $mydb1, $toRoot);

function showlastLeaves($title, $option, $mydb1, $toRoot){
	if($option<=3){
		$divHeight = "75px";
	}else{
		$divHeight = "235px";
	}

echo '<!-- table leave request -->

<div class="row" style="margin-left: 0%;">
	<div class="mb-3 card" style="width: 98%;display: inline-block;vertical-align: middle;text-align: center;">
		<div class="card-header-tab card-header-tab-animation card-header">
			<div class="card-header-title">
				<i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>'.$title.'
			</div>
			<ul class="nav">
					<li class="nav-item"><a href="javascript:void(0);" class="active nav-link">Last</a></li>
			</ul>
	</div>
	<div class="card-body">
		<div class="tab-content">
			<div class="tab-pane fade show active" id="tabs-eg-77">
					<!-- <h6 class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal">My Last request</h6> -->
					<div class="scroll-area-sm" style="height: '.$divHeight.';">
							<div class="scrollbar-container ps ps--active-y">
								<ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
									<!--items -->';
										if($option <= 3){
											$mydb1->setQuery("SELECT lempid, lempname, lcurdate, typeofleave, datestart, dateend FROM tblleave WHERE LEMPID='".$_SESSION['EMPLOYID']."' order by LCURDATE DESC");
										}else if($option > 3 && $option <=9){
											$mydb1->setQuery("SELECT lempid, lempname, lcurdate, typeofleave, datestart, dateend FROM tblleave WHERE LEMPID!='".$_SESSION['EMPLOYID']."' AND leavestatus = 'pending' and LCURDATE>='".$GLOBALS['firstdayYear']."' AND LEMPID IN (SELECT EMPLOYID FROM `tblemployee` WHERE (". $_SESSION['MATRIX_FULL-FILTER']."));");
										}else if($option==10){
												$mydb1->setQuery("SELECT lempid, lempname, lcurdate, typeofleave, datestart, dateend FROM tblleave WHERE leavestatus = 'pending' and LCURDATE>='".$GLOBALS['firstdayYear']."'");
										}
										  $result = $mydb1->executeQuery();
										  $URLBase ="";
		  								if ($result->num_rows > 0) {
											while($row = $result->fetch_array()) {
												$AvatarPath=$URLBase."assets/images/avatars/";
    											$file_pointer = $AvatarPath.$row[0].".jpg";
												if (file_exists($file_pointer)) {
													$mPicture = $row[0].".jpg";
												}else {
													$mPicture = "default.jpg";
												}
				 								$templateA ='<li class="list-group-item">
			 													<div class="widget-content p-0">
																	<div class="widget-content-wrapper">
					 													<div class="widget-content-left mr-3">
						 													<img width="42" class="rounded-circle" src="assets/images/avatars/'.$mPicture.'" alt="">
					 													</div>
					 													<div class="widget-content-left">
						 													<div style="font-weight: bold;">'.$row[1].' - Request date '.$row[2].' - '.$row[3].'</div>
						 													<div >From: '.$row[4].' To: '.$row[5].'</div>
					 													</div>
					 													<div class="widget-content-right">
						 													<div class="font-size-xlg text-muted">
							 													<span>Pending</span><small class="text-danger pl-2"><i class="pe-7s-look"> </i></small>
						 													</div>
					 													</div>
				 													</div>
			 													</div>
		 													</li>';
		 										echo $templateA;
			  									//echo "id: " . $row[0]. " - Name: " . $row[1]. "<br>";
											}
		  								}else{
											echo '<span style="float:left;">No results found</span>';
		  								}
									echo '<!--items finish -->                             
								</ul>
							</div>
					</div>
			</div>
		</div>
	</div>
</div>
<!-- table leave request finish-->';
}
?>