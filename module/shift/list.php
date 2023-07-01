
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
          <i class="pe-7s-timer"></i>&nbsp;&nbsp;&nbsp;Shifts&nbsp;&nbsp;&nbsp;
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
				  		<th>Shift Code</th>
						<th>Shift Name</th>  
						<th>Shift In</th>
						<th>Shift Out</th>
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
				  		$mydb->setQuery("SELECT * FROM  `tblshift`");
				  		$cur = $mydb->loadResultList();
						foreach ($cur as $result) {
							echo '<tr>';
							echo '<td>' . $result->SHIFTCODE.'</a></td>';
							echo '<td>' . $result->SHIFTNAME.'</a></td>';
							echo '<td>' . $result->SHIFTIMEIN.'</a></td>';
							echo '<td>' . $result->SHIFTIMEOUT.'</a></td>';
							if($permission == 2){
								$hash1 = ((2*$result->SHIFTID)+($result->SHIFTID+2)+date("md"))*date("md")*$result->SHIFTID;
								$hash2 = ((3*$result->SHIFTID)+($result->SHIFTID+3)+date("md"))*date("md")*$result->SHIFTID;
							echo '<td align="center" >
									<a title="Edit" href="index.php?vw=2&d='.$result->SHIFTID.'&h='.$hash1.'" class="btn btn-primary btn-sm  ">  <span class="fa fa-edit fw-fa"></span>Edit</a>
									<a title="Delete" href="controller.php?ax=3&d='.$result->SHIFTID.'&h='.$hash2.'" class="btn btn-danger btn-sm  delete" ><span class="fa fa-trash-o fw-fa"></span>Delete</a></td>';
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