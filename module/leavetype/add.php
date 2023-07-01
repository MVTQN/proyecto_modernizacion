<?php 
/* Open Required Header in all scripts */
  $pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
  $toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
  if(!isset($security_included)){require($toRoot."include/security.php");}
  Secure::session_verify($toRoot);$tokenPost = Secure::sToken(true);
  $_SESSION['tokenPostSess'] = $tokenPost;
/* Close Required Header in all scripts */
 ?>
 <script>
 function SearchName(a){
  if(a!=""){
  var jqxhr = $.ajax('ajx_q.php?a1='+a+'&b1=<?php echo $tokenPost; ?>')
		.done(function(resultado) {
        if(resultado==""){
          $("#save").prop('disabled', true);
          $("#leavetype").prop('disabled', false);
          $("#desc").prop('disabled', false);
          $("#leaveapprovers").prop('disabled', false);
        }else{
          $("#leavetype").prop('disabled', true);
          $("#leavetype").val("");
          $("#desc").prop('disabled', true);
          $("#desc").val("");
          $("#leaveapprovers").prop('disabled', true);
          $("#leaveapprovers").val("");
          $("#save").prop('disabled', true);
          alert('This Leave Type already exists!!!');
        }
		})
		.fail(function() {
			$(b).text("");
		})
		.always(function() {
		});
    
  }
 }

 function q(){
  var d1 = $("#leavecode").val();
  var d2 = $("#leavetype").val();
  var d3 = $("#desc").val();
  if(d1!="" && d2!="" && d3!=""){
      $("#save").prop('disabled', false);
  }else{
      $("#save").prop('disabled', true);
  }
 }
 </script>
<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Add new Leave Type</div>
      <div class="card-body">   
        <!-- onsubmit="Validate('#deptcode');return false;" -->
          <form id="mForm" action="controller.php?ax=1" method="POST">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="name">Leave Code:</label>
                    <input OnBlur="SearchName(this.value);q();" class="form-control input-sm" id="leavecode" name="leavecode" placeholder="Leave Code" type="number" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="leavename">Leave Name:</label>
                  <input OnBlur="q();" class="form-control input-sm" id="leavetype" name="leavetype" placeholder="Leave Name" type="text" required disabled>
                </div>
              </div>
            </div>       
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="description">Description:</label>
                    <input OnBlur="q();" class="form-control input-sm" id="desc" name="desc" placeholder="Description" type="text" required disabled>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="name">Number of Approvers:</label>
                    <input OnBlur="q();" class="form-control input-sm" id="leaveapprovers" name="leaveapprovers" placeholder="Approvers" type="number" required disabled>
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn-block" id="save" name="save" type="submit" disabled><span class="glyphicon glyphicon-floppy-save"></span> Save Leave Type</button>
            <br>
            <div class="ErrorMsg" id="mess" name="mess" style="display: none;text-align: center;">&nbsp;</div>         
        </form>                   
      </div>
    </div>
  </div>
</div> 