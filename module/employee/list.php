<?php
	 /* Open Required Header in all scripts */
		$pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
		$toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
		if(!isset($security_included)){require($toRoot."include/security.php");}
		Secure::session_verify($toRoot);
	/* Close Required Header in all scripts */
	 if($permission == 0){
		echo "Forbidden";
		exit();
	}
?>
<div class="card mb-3">
        <div title="Sec <?php echo $secid; ?>" class="card-header">
          <i class="fa fa-table"></i>&nbsp;&nbsp;&nbsp;Employees&nbsp;&nbsp;&nbsp;
		  <?php
		  	if($permission == 2){
		  ?>
		  <a href="index.php?vw=1" class="btn btn-primary  "><i class="fa fa-plus-circle fw-fa"></i> New</a>
		  <?php
			  }
		  ?>
		  </div>
	  <!-- <div class="card-header"> <i class="fa fa-plus-circle fw-fa"></i>&nbsp;&nbsp;&nbsp;<a href="export.php?export=true">Export File </a></div> -->
        <div class="card-body">
          <div class="table-responsive">
	 		<form action="controller.php?ax=3" Method="POST">     		
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				  <thead>
				  	<tr>
				  		<th>Employee ID</th>
						<th>Employee Name</th>
						<th>Identification</th>
						<th>Role</th>
						<th>Email/Username</th>
				  		<th>Company</th>
						<th>Status</th>
						<?php
		  					if($permission == 2){
		  				?>  	  		
				  		<th width="15%" >Actions</th>
						<?php
			  				}
		  				?>
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php
				  		//if($_SESSION['EMPPMXLEV']=="10"){
							$query = "SELECT * FROM  `tblemployee` order by strdate ASC"; 
						//}else{
						//	$query = "SELECT * FROM `tblemployee`  WHERE EMPLOYID<>'".$_SESSION['EMPLOYID']."' AND (". $_SESSION['MATRIX_FULL-FILTER'].") AND EMPPOSITION IN".$_SESSION['MATRIX_LEVELNAME']." order by strdate ASC";
						//}
						$mCurrentdate = date("Y-m-d");
				//echo $query;
				  		$mydb->setQuery($query);
				  		$cur = $mydb->loadResultList();
						foreach ($cur as $result) {
							if($result->EMPSTATUS=='Attrited'){
								$color ="#CCC";
							}else{
								$color ="#000";
							}
				  		echo '<tr style="color: '.$color.'">';
							echo '<td>' . $result->EMPLOYID.'</a></td>';
							echo '<td>' . $result->EMPNAME.'</a></td>';
							echo '<td>' . $result->IDENTIFICATION.'</a></td>';
							echo '<td>' . $result->EMPROLE.'</a></td>';
							echo '<td>'. $result->USERNAME.'</td>';
							echo '<td>'. $result->COMPANY.'</td>';
							$ONBOARDINGDATE = date('Y-m-d', strtotime($result->STRDATE.' + 90 days'));
							if($result->EMPSTATUS=='Attrited'){
								echo '<td>'.$result->EMPSTATUS.'</a></td>';
							}else{
									if($mCurrentdate<=$ONBOARDINGDATE){
										echo '<td style="color: #326ba8;">Onboarding</a></td>';
									}else{
										echo '<td style="color: #27691e;">Active</a></td>';
									}
							}
						if($permission == 2){
							$hash1 = ((2*$result->EMPID)+($result->EMPID+2)+date("md"))*date("md")*$result->EMPID;
							$hash2 = ((3*$result->EMPID)+($result->EMPID+3)+date("md"))*date("md")*$result->EMPID;
							//<a title="Change Password" href="index.php?vw=4&d='.$result->EMPID.'&from=emp" class="btn btn-info btn-sm">Pass</a>
				  			echo '<td align="center" > 
							<a title="Edit" href="index.php?vw=2&d='.$result->EMPID.'&h='.$hash1.'" class="btn btn-info btn-sm"><span class="fas fa-edit"></span></a>&nbsp;';
							if($result->EMPSTATUS=='Attrited'){
								echo '<a title="Permissions" href="#" onclick="return false;" class="btn btn-primary btn-sm disabled"><span class="fas fa-lock"></span></a>';
							}else{
								echo '<a title="Permissions" href="index.php?vw=5&d='.$result->EMPID.'&h='.$hash1.'" class="btn btn-primary btn-sm"><span class="fas fa-lock"></span></a>';
							}
							//echo '<a title="Delete" href="controller.php?ax=3&d='.$result->EMPID.'&h='.$hash2.'" class="btn btn-danger btn-sm"><span class="fas fa-trash-alt"></span></a></td>';
						}		  
				  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
				</table>
				</form>
       </div>
        </div>
      </div>