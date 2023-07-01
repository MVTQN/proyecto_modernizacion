<?php
	 if (!isset($_SESSION['EMPID'])){
      redirect(web_root."/index.php");
	 }
	 if($permission == 0){
		echo "Forbidden";
		exit();
	}

?>
<div class="card mb-3">
    <div title="Sec ID: [<?php echo $secid; ?>]" class="card-header">
          <i class="fa fa-table"></i>&nbsp;&nbsp;&nbsp;List of Approved Applications&nbsp;&nbsp;&nbsp;
		  <?php
		  	if($permission == 2){
		  ?>
          	<a href="index.php?view=add" class="btn btn-primary  "><i class="fa fa-plus-circle fw-fa"></i> New</a>
		  <?php
      	  	}
      	  ?>
	</div>

         
        <div class="card-body">
          <div class="table-responsive">
	 		    <form action="controller.php?action=delete" Method="POST">  
			    		
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<th>Employee ID</th>
						<th>Employee Name</th>
						<th>Leave Status</th>
						<th>Start Date</th>
						<th>Current Date</th>
				  		<th>Date From</th>
				  		<th>Date To</th>
				  		<th>Company Tenure</th>
				  		<th>Days Taken</th>
						<th>Accumulated Days</th>
				  		<th>Leave Type</th>
				  		<th>Reason</th>
				  		<?php 
				  		if($permission == 2){
							echo " <th>Action</th>";
				  		}
				  		?>
						
				  	</tr>	
				  </thead>
				  <tbody>
				  	<?php 
				  	//`LEAVEID`, `EMPLOYID`, `DATESTART`, `DATEEND`, `NODAYS`, `SHIFTTIME`, `TYPEOFLEAVE`, `REASON`, `LEAVESTATUS`, `ADMINREMARKS`, `DATEPOSTED`
					
					global $mydb;
						//"select  * from tblleave where LEMPID=". $_SESSION['LEMPID']." AND LEAVESTATUS='APPROVED'"
						//"select  * from tblleave where LEAVESTATUS='APPROVED' AND `LEMPID` IN ( SELECT `EMPLOYID` from tblemployee WHERE `COMPANY`='". $_SESSION['COMPANY']  ."' AND `DEPARTMENT`='". $_SESSION['DEPARTMENT']  ."')  "  supervisor manager
						//"select  * from tblleave where LEAVESTATUS='APPROVED' AND `LEMPID` IN ( SELECT `EMPLOYID` from tblemployee WHERE `COMPANY`='". $_SESSION['COMPANY']  ."' )  " 
			  		$mydb->setQuery("select  * from tblleave where LEAVESTATUS='APPROVED'");
					$cur = $mydb->loadResultList();
				  		foreach ($cur as $Defaults) {
					  			echo '<tr>';
						  		echo '<td>' . $Defaults->LEMPID.'</a></td>';
								echo '<td>' . $Defaults->LEMPNAME.'</a></td>';
								echo '<td>' . $Defaults->LSTRDATE.'</a></td>';
								echo '<td>' . $Defaults->LCURDATE.'</a></td>';
						  		echo '<td>'. $Defaults->DATESTART.'</td>';
						  		echo '<td>'. $Defaults->DATEEND.'</td>';
						  		echo '<td>'. $Defaults->LTENURE.'</td>';
								echo '<td>'. $Defaults->LNOTAKEN.'</td>';
						  		echo '<td>' . $Defaults->LNODAYS.'</a></td>';
						  		echo '<td>'. $Defaults->TYPEOFLEAVE.'</td>';
						  		echo '<td>'. $Defaults->REASON.'</td>';
						  		echo '<td>'. $Defaults->LEAVESTATUS.'</td>';
								if($permission == 2){
									echo '<td align="center" > <a title="Edit" href="index.php?vw=2&id='.$Defaults->LEAVEID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a></td>';
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