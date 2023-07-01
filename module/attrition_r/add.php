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
      $("#save").prop('disabled', true);
        if(resultado==""){
          $("#attrdesc").prop('disabled', false);
        }else{
          $("#attrdesc").val("");
          $("#attrdesc").prop('disabled', true);
          alert('This Attrition type already exists!!!');
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
  var d1 = $("#attrname_r").val();
  var d2 = $("#attrdesc").val();
  if(d1!="" || d2!=""){
    $("#save").prop('disabled', false);
  }else{
    $("#save").prop('disabled', true);
  }
 }
 </script>
  <div class="container">
    <div class="card card-register mx-auto mt-2">
      <div class="card-header">Add new reason</div>
        <div class="card-body">   
          <form action="controller.php?ax=1" method="POST">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="name">Reason Name:</label>
                  <input OnBlur="SearchName(this.value);q();" class="form-control input-sm" id="attrname_r" name="attrname_r" placeholder="Reason Name" type="text" required>
                </div>
              </div>
            </div>  
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="name">Description:</label>
                  <input onBlur="q();" class="form-control input-sm" id="attrdesc" name="attrdesc" placeholder="Description" type="text" required disabled>
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn-block" id="save" name="save" type="submit" disabled><span class="glyphicon glyphicon-floppy-save"></span> Save Reason</button>
        </form>                   
      </div>
    </div>
  </div>
 