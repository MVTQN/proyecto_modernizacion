<?php
/* Open Required Header in all scripts */
	$pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
	$toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
	if(!isset($security_included)){require($toRoot."include/security.php");}
	Secure::session_verify($toRoot);
/* Close Required Header in all scripts */

	 $act = (isset($_GET['vw']) && $_GET['vw'] != '') ? $_GET['vw'] : '';

	 if($act !=''){
		 if(!is_numeric($act)){
			 Header("Location: index.php");
			 exit();
		 }	
	 }

	 if($permission == 0){
		 echo "Forbidden";
		 exit();
	 }
?>
<div class="card mb-3">

        <div title="Sec <?php echo $secid; ?>" class="card-header">
          <i class="fa fa-university"></i> &nbsp;&nbsp;&nbsp;Attendance&nbsp;&nbsp;   
		  <?php
		  	if($permission == 2){
		  ?>
		  <a href="index.php?vw=1" class="btn btn-primary  ">  <i class="fa fa-plus-circle fw-fa"></i> New</a>
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
						<th>Attendance Date</th>
						<th>Time In</th>
						<th>Time Out</th>
						<?php if($permission == 2){ ?>
						<th width="15%" >Action</th>
						<?php } ?>
				  	</tr>	
				  </thead> 
				  <tbody>
				  
					  <?php 
					  	if($_SESSION['EMPPMXLEV']=="10"){
							$query = "SELECT * FROM tblattendance WHERE ATEMPID IN(
								SELECT EMPLOYID FROM `tblemployee` WHERE (". $_SESSION['MATRIX_FULL-FILTER'].") order by strdate ASC)"; 
						}else{
							$query = "SELECT * FROM tblattendance WHERE ATEMPID IN(
										SELECT EMPLOYID FROM `tblemployee` WHERE EMPLOYID<>'".$_SESSION['EMPLOYID']."'
								 		AND (". $_SESSION['MATRIX_FULL-FILTER'].") AND EMPPOSITION IN".$_SESSION['MATRIX_LEVELNAME']." order by strdate ASC)";
						}
				  		$mydb->setQuery($query);
				  		$cur = $mydb->loadResultList();
						foreach ($cur as $result) {
							echo '<tr>';
							echo '<td>' . $result->ATEMPID.'</a></td>';
							echo '<td>' . $result->ATEMPNAME.'</a></td>';
							echo '<td>' . $result->ATDATE.'</a></td>';
							echo '<td>' . $result->ATTIMEIN.'</a></td>';
							echo '<td>' . $result->ATTIMEOUT.'</a></td>';
							if($permission == 2){	
							$hash1 = ((2*$result->ATID)+($result->ATID+2)+date("md"))*date("md")*$result->ATID;
							$hash2 = ((3*$result->ATID)+($result->ATID+3)+date("md"))*date("md")*$result->ATID;				
							echo '<td align="center" >
									<a title="Edit" href="index.php?vw=2&d='.$result->ATID.'&h='.$hash1.'"  class="btn btn-primary btn-sm  ">  <span class="fa fa-edit fw-fa"></span>Edit</a>
									<a id="save" name="save" title="Delete" href="controller.php?ax=3&d='.$result->ATID.'&h='.$hash2.'" class="btn btn-danger btn-sm  delete" ><span class="fa fa-trash-o fw-fa"></span>Delete</a>	
									</td>';
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