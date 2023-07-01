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

   $Shift = New  Shift();
   $l = $Shift->single_Shift($atID);

?> 
<script>
function validateHour(a){
  var d1 = $("#shiftcode").val();
  var d2 = $("#shiftname").val();
  var d3 = $("#atempname").val();
  var d4 = $("#shiftimein").val();
  var d5 = $("#shiftimeout").val();

  if(d1=="" || d2=="" || d3=="" || d4=="" || d5==""){
    $("#save").prop('disabled', true);
  }else{
    if(d4>=d5){
    $("#save").prop('disabled', true);
    $(a).focus();
    alert('You should choose a later hour');
   }else{
      $("#save").prop('disabled', false);
   }
  }
 }
 </script>
<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Update shift</div>
      <div class="card-body"> 
        <form  action="controller.php?ax=2" method="POST">         
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Shift Code:</label>
                  <input name="SHIFTID" type="hidden" value="<?php echo $l->SHIFTID; ?>">
                    <input  OnBlur="validateHour('#shiftcode');" class="form-control input-sm" id="shiftcode" name="shiftcode" placeholder="Shift Code" type="text" value="<?php echo $l->SHIFTCODE; ?>" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Shift Name:</label>
                  <input OnBlur="validateHour('#shiftname');" class="form-control input-sm" id="shiftname" name="shiftname" placeholder="Shift Name" type="text" value="<?php echo $l->SHIFTNAME; ?>" required>
              </div>
            </div>
          </div> 
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="shiftimein">Shift In:</label>
                  <input OnBlur="validateHour('#shiftimein');" class="form-control input-sm" id="shiftimein" name="shiftimein" placeholder="Shift In" type="time" value="<?php echo $l->SHIFTIMEIN; ?>" required>
              </div>
            </div>
          </div>      
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="shiftimeout">Shift Out:</label>
                  <input OnBlur="validateHour('#shiftimeout');" class="form-control input-sm" id="shiftimeout" name="shiftimeout" placeholder="Shift Out" type="time" value="<?php echo $l->SHIFTIMEOUT; ?>" required>
              </div>
            </div>
          </div>        
          <button class="btn btn-primary btn-block" id="save" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save Shift</button> 
        </form>
      </div>
    </div>
  </div>
</div>