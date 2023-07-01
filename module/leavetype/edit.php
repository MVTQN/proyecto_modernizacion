<?php 
  /* Open Required Header in all scripts */
    $pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
    $toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
    if(!isset($security_included)){require($toRoot."include/security.php");}
	Secure::session_verify($toRoot);
  /* Close Required Header in all scripts */
 

    $atID = (isset($_GET['d']) && $_GET['d'] != '') ? $_GET['d'] : '';
    if(!is_numeric($atID)){
      Secure::scriptRedirect("index.php");
    }

    $atHash = (isset($_GET['h']) && $_GET['h'] != '') ? $_GET['h'] : '';
    if(!is_numeric($atHash)){
      Secure::scriptRedirect("index.php");
    }

    $hash2 = ((2*$atID)+($atID+2)+date("md"))*date("md")*$atID;
    if($hash2!=$atHash){
      Secure::scriptRedirect("index.php");
    }

    $leave = New  Leavetype();
    $c = $leave->single_dept($atID);
 ?> 
  <div class="container">
    <div class="card card-register mx-auto mt-2">
      <div class="card-header">Update Leave Type</div>
        <div class="card-body">   
          <form action="controller.php?ax=2" method="POST">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="name">Leave Code:</label>
                    <input name="LEAVTID" type="hidden" value="<?php echo $c->LEAVTID; ?>">
                      <input class="form-control input-sm" id="leavecode" name="leavecode" placeholder="Leave Code" type="text"  value="<?php echo $c->LEAVECODE; ?>" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="leavetype">Leave Name:</label>
                  <input class="form-control input-sm" id="leavetype" name="leavetype" placeholder="Leave Name" type="text"  value="<?php echo $c->LEAVETYPE; ?>" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="description">Leave Description:</label>                
                <input class="form-control input-sm" id="desc" name="desc" placeholder="Leave Description" type="text" value="<?php echo $c->DESCRIPTION; ?>" required>
              </div>
            </div>
          </div> 

          <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="name">Number of Approvers:</label>
                    <input class="form-control input-sm" id="leaveapprovers" name="leaveapprovers" placeholder="Approvers" type="number" value="<?php echo $c->APPROVERS_COUNT; ?>" required>
                </div>
              </div>
            </div>
          <button class="btn btn-primary btn-block" id="save" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save Leave Type</button>
        </form>
      </div>          
    </div>
  </div>
</div>
 