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
 function SearchItem(a, b){
  if(a!=""){
  var jqxhr = $.ajax('ajx_q.php?a1='+a+'&b1=<?php echo $tokenPost; ?>')
		.done(function(resultado) {
      if(resultado == ""){
        $("#shiftname").prop('disabled', false);
        $("#shiftimein").prop('disabled', false);
        $("#shiftimeout").prop('disabled', false);
      }else{
        $("#save").prop('disabled', true);
        $("#shiftname").prop('disabled', true);
        $("#shiftname").val("");
        $("#shiftimein").prop('disabled', true);
        $("#shiftimein").val("");
        $("#shiftimeout").prop('disabled', true);
        $("#shiftimeout").val("");
        alert('This code exists!!!');
      }
		})
		.fail(function() {
			$(b).text("");
		})
		.always(function() {
		});
  }
 }

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
    $(a).val("");
    alert('You should choose a later hour');
   }else{
      $("#save").prop('disabled', false);
   }
  }
 }
 </script>
<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Add new shift</div>
      <div class="card-body">   
        <form action="controller.php?ax=1" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Shift Code:</label>
                  <input OnBlur="SearchItem(this.value, '#shiftname');" class="form-control input-sm" id="shiftcode" name="shiftcode" placeholder="Shift Code" type="number" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Shift Name:</label>
                  <input OnBlur="validateHour('#shiftname');" class="form-control input-sm" id="shiftname" name="shiftname" placeholder="Shift Name" type="text" required disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Shift In:</label>
                  <input OnBlur="validateHour('#shiftimein');" class="form-control input-sm" id="shiftimein" name="shiftimein" placeholder="Shift In" type="time" required disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Shift Out:</label>
                  <input OnBlur="validateHour('#shiftimeout');" class="form-control input-sm" id="shiftimeout" name="shiftimeout" placeholder="Shift Out" type="time" required disabled>
              </div>
            </div>
          </div>
          <button class="btn btn-primary btn-block" id="save" name="save" type="submit" disabled><span class="glyphicon glyphicon-floppy-save"></span> Save</button> 
        </form>        
      </div>
    </div>
  </div>
</div>