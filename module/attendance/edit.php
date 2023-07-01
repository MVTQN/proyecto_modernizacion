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

    $At = New  At();
    $l = $At->single_At($atID);

?> 
<script>
 function validateHour(a, b){
  var d1 = $(a).val();
  var d2 = $(b).val();
  var d3 = $("#atempname").val();
  var d4 = $("#atdate").val();
  var d5 = $("#attimein").val();

  if(d3=="" || d4=="" || d5==""){
    $(b).val("");
    $("#save").prop('disabled', true);
  }else{
    if(d1>=d2){
    $("#save").prop('disabled', true);
    $(b).val("");
    $(b).focus();
    alert('You should choose a later hour');
   }else{
      $("#save").prop('disabled', false);
   }
  }
 }
 </script>
<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Update Attendance</div>
      <div class="card-body"> 
        <form  action="controller.php?ax=2" method="POST">             
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Employee ID:</label>
                <input name="ATID" type="hidden" value="<?php echo $l->ATID; ?>">
                <input class="form-control input-sm" id="atempid" name="atempid" placeholder="Employee ID" type="text" value="<?php echo $l->ATEMPID; ?>"readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Employee Name:</label>
                  <input class="form-control input-sm" id="atempname" name="atempname" placeholder="Employee Name" type="text" value="<?php echo $l->ATEMPNAME; ?>" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="atdate">Employee Date:</label>
                  <input class="form-control input-sm" id="atdate" name="atdate" placeholder="Date" type="date" value="<?php echo $l->ATDATE; ?>" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="attimein">Time In:</label>
                  <input class="form-control input-sm" id="attimein" name="attimein" placeholder="Time In" type="time" value="<?php echo $l->ATTIMEIN; ?>" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="attimeout">Time Out:</label>
                  <input onchange="validateHour('#attimein', '#attimeout');" class="form-control input-sm" id="attimeout" name="attimeout" placeholder="Time Out" type="time" value="<?php echo $l->ATTIMEOUT; ?>" required>
              </div>
            </div>
          </div>    
          <button class="btn btn-primary btn-block" id="save" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save Att</button>      
        </form>
      </div>
    </div>
  </div>
</div>