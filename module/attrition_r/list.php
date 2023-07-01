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
          <i class="fa fa-university"></i>&nbsp;&nbsp;&nbsp;Reasons&nbsp;&nbsp;
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
						<th>Reason Name</th>
						<th>Description</th>
						<?php
		  					if($permission == 2){
		  				?>
			               <th width="15%" >Action</th>	
						<?php
							 }
						?>		 
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php 
				  		$mydb->setQuery("SELECT * FROM  `tblattrition_r`");
				  		$cur = $mydb->loadResultList();
						foreach ($cur as $result) {
							echo '<tr>';
							echo '<td>' . $result->ATTRNAME_R.'</a></td>';
							echo '<td>' . $result->ATTRDESC.'</a></td>';
						if($permission == 2){
							$hash1 = ((2*$result->ATTRID_R)+($result->ATTRID_R+2)+date("md"))*date("md")*$result->ATTRID_R;
							$hash2 = ((3*$result->ATTRID_R)+($result->ATTRID_R+3)+date("md"))*date("md")*$result->ATTRID_R;
							echo '<td align="center" >
				  					<a title="Edit" href="index.php?vw=2&d='.$result->ATTRID_R.'&h='.$hash1.'"  class="btn btn-primary btn-sm  ">  <span class="fa fa-edit fw-fa"></span>Edit</a>
								 	<a title="Delete" href="controller.php?ax=3&d='.$result->ATTRID_R.'&h='.$hash2.'" class="btn btn-danger btn-sm  delete" ><span class="fa fa-trash-o fw-fa"></span>Delete</a>		  			
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