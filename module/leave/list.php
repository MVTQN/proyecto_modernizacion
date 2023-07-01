<?php
	/* Open Required Header in all scripts */
		$pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
		$toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
		if(!isset($security_included)){require($toRoot."include/security.php");}
		Secure::session_verify($toRoot);
	/* Close Required Header in all scripts */
	
	$act = (isset($_GET['w']) && $_GET['w'] != '') ? $_GET['w'] : '';
	if($act !=''){
		if(!is_numeric($act)){
			Header("Location: index.php");
			exit();
		}	
	}
	$filter1 = (isset($_GET['vw']) && $_GET['vw'] != '') ? $_GET['vw'] : '';
	if($filter1 !=''){
		if(!is_numeric($filter1)){
			Header("Location: index.php");
			exit();
		}	
	}
	 if($permission == 0){
		echo "Forbidden";
		exit();
	}
?>
<script>
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<style>
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 5px;
  font-size: 14px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>

<div class="card mb-3">

<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Leaves filter</button> &nbsp;&nbsp;&nbsp;
  <div id="myDropdown" class="dropdown-content" style="">
  	<a href="<?php echo WEB_ROOT; ?>module/leave/index.php?vw=7">Pending</a>
    <a href="<?php echo WEB_ROOT; ?>module/leave/index.php?vw=0">Approved</a>
    <a href="<?php echo WEB_ROOT; ?>module/leave/index.php?vw=5">Rejected</a>
    <a href="<?php echo WEB_ROOT; ?>module/leave/index.php">ALL</a>
  </div>
</div>
  <div title="Sec ID: [<?php echo $secid; ?>]" class="card-header">
          <i class="fa fa-table"></i>&nbsp;&nbsp;&nbsp;List of Leave Application&nbsp;&nbsp;&nbsp;    
		  <?php
		  	if($permission == 2){
		  ?>
          		<a href="index.php?vw=1" class="btn btn-primary  "><i class="fa fa-plus-circle fw-fa"></i> New </a>
 		<?php
      	  }
      	?>
 	</div>	 
    <div class="card-body">
          <div class="table-responsive">
	 		    <form action="controller.php?ax=3" Method="POST">  		    		
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				  <thead>
				  	<tr>
				  		<th>Employee ID</th>
						<th>Employee Name</th>
				  		<th>Date From</th>
				  		<th>Date To</th>
				  		<th>Leave Type</th>
				  		<th>Reason</th>
				  	</tr>	
				  </thead>
				  <tbody>
				  	<?php
					  if($filter1==0){
							$sql_f1 = "LEAVESTATUS='APPROVED'";
							
					  }else if($filter1==5){
							$sql_f1 = "LEAVESTATUS='REJECTED'";
							
					  }else if($filter1==7){
							$sql_f1 = "LEAVESTATUS='PENDING'";
							
					  }
					  if(strlen($filter1)==0){
						$sql_f1 = "LEAVESTATUS='PENDING' or LEAVESTATUS='REJECTED' OR LEAVESTATUS='APPROVED'";
					  }
				  	if ($_SESSION['EMPPMXLEV'] <= 3) {
						$ficon = "fas fa-eye";	  
						$query = "select * from tblleave where LEMPID=". $_SESSION['EMPLOYID']." ORDER BY LCURDATE ASC";
					}elseif ($_SESSION['EMPPMXLEV'] > 3 && $_SESSION['EMPPMXLEV'] <= 9) {
						$ficon = "fas fa-check-square";
						$query = $query = "SELECT * FROM tblleave WHERE LEMPID IN(
							SELECT EMPLOYID FROM `tblemployee` WHERE (". $_SESSION['MATRIX_FULL-FILTER'].") AND EMPPOSITION IN".$_SESSION['MATRIX_LEVELNAME']." OR EMPLOYID='".$_SESSION['EMPLOYID']."' order by strdate ASC) AND (".$sql_f1.") ";
					}elseif($_SESSION['EMPPMXLEV']==10){//Administrator
						$ficon = "fas fa-edit";
						//$query = $query = "SELECT * FROM tblleave WHERE LEMPID IN(
							//SELECT EMPLOYID FROM `tblemployee` WHERE (". $_SESSION['MATRIX_FULL-FILTER'].") order by strdate ASC) AND (".$sql_f1.")"; 
						$query = $query = "SELECT * FROM tblleave WHERE (".$sql_f1.")"; 
					}
			  		$mydb->setQuery($query);
					$cur = $mydb->loadResultList();
				  		foreach ($cur as $Defaults) {
							if($Defaults->LEAVESTATUS == "PENDING"){
								$lColor ="#000";
								$mimage = "pending1.png";
							}elseif($Defaults->LEAVESTATUS == "REJECTED"){
								$lColor ="#000";//"#f74848";
								$mimage = "rejected1.png";
							}elseif($Defaults->LEAVESTATUS == "APPROVED"){
								$lColor = "#000";//"#3f852d";
								$mimage = "approved1.png";
							}
					  		echo '<tr style="color: '.$lColor.';">';
						  		echo '<td><img src="'.$toRoot."/assets/icons/".$mimage.'"> ' . $Defaults->LEMPID.'</a></td>';
								echo '<td>' . $Defaults->LEMPNAME.'</a></td>';
						  		echo '<td>'. $Defaults->DATESTART.'</td>';
						  		echo '<td>'. $Defaults->DATEEND.'</td>';
						  		echo '<td>'. $Defaults->TYPEOFLEAVE.'</td>';
								echo '<td>'. $Defaults->REASON.'</td>';
					  		echo '</tr>';
				  		} 
				  	?>
				  </tbody>
				</table>
				</form>
       </div>
        </div>
      </div>