<?php 
    /* Open Required Header in all scripts */
        $pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
        $toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
        if(!isset($security_included)){require($toRoot."include/security.php");}
        Secure::session_verify($toRoot);$tokenPost = Secure::sToken(true);
        $_SESSION['tokenPostSess'] = $tokenPost;
    /* Close Required Header in all scripts */
 ?> 
 <Script>
 function SearchName(a, b){
  var jqxhr = $.ajax('ajx_q.php?a1='+a+'&b1=<?php echo $tokenPost; ?>')
		.done(function(resultado) {
        $(b).val(resultado);
        $("#atdate").prop('disabled', false);
        $("#attimein").prop('disabled', false);
        $("#attimeout").prop('disabled', false);
        $("#save").prop('disabled', true);        
		})
		.fail(function() {
			$(b).text("");
		})
		.always(function() {
		});
 }

function Actfi(){
  $("#atdate").prop('disabled', false);
  $("#attimein").prop('disabled', false);
  $("#attimeout").prop('disabled', false);
  $("#save").prop('disabled', true);   
}

 function validateHour(a, b){
  var d1 = $(a).val();
  var d2 = $(b).val();

  if(d1>=d2){
      $("#save").prop('disabled', true);
      $(b).val("");
      alert('You should choose a later hour');
  }else{
      $("#save").prop('disabled', false);
  }
 }

 function q(){
  var d1 = $("#atempid").val();
  var d2 = $("#atempname").val();
  var d3 = $("#atdate").val();
  var d4 = $("#attimein").val();
  var d5 = $("#attimeout").val();

  if(d1=="" || d2=="" || d3=="" || d4=="" || d5==""){
    $("#save").prop('disabled', true);
  }else{
    $("#save").prop('disabled', false);
  }
 }

 function t(a, b, c, d){
  $(c).val(a);
  $(d).val(b);
  Actfi();
  window.parent.$('#close-modal').click();
 }
 </script>
<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Add new attendance</div>
      <div class="card-body">   
        <form action="controller.php?ax=1" method="POST">              
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
              <table style="width: 100%;"><tr>
              <td><label for="atempid">Employee ID:</label></td><td>&nbsp;</td></tr><tr>
              <td style="width: 95%;">
                      <input OnChange="Actfi();" class="form-control" name="atempid" id="atempid" placeholder="Name" type="text" value="" readonly>
                </td><td style="width: 5%;text-align: right;vertical-align: middle;">
                  <button OnClick="window.myFrame.location='search.php';" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal1">...</button>
                </td>
              </tr></table>
                     </div>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="atempn">Employee Name:</label>
                      <input OnChange="Actfi();" class="form-control input-sm" name="atempname" id="atempname" placeholder="Name" type="text" value="" readonly>
                     </div>
                    </div>
                  </div>      

                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="atdate">Attendance Date:</label>

                        <input name="atdate" type="hidden" value="">
                         <input onBlur="q();" class="form-control input-sm" id="atdate" name="atdate" placeholder="YYYY-MM-DD" type="date" required disabled>
                      </div>
                    </div>
                  </div>
                  
                  
                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="name">Time In:</label>
                        <input name="attimein" type="hidden" value="">
                         <input onBlur="q();" class="form-control input-sm" id="attimein" name="attimein" placeholder="Time In " type="time" required disabled>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                         <label for="name">Time Out:</label>
                         <input OnBlur="validateHour('#attimein', '#attimeout');q();" class="form-control input-sm" id="attimeout" name="attimeout" placeholder="Time Out" type="time" required disabled>
                      </div>
                    </div>
                  </div>           
            <button class="btn btn-primary btn-block" id="save" name="save" type="submit" disabled><span class="glyphicon glyphicon-floppy-save"></span> Save Att</button>        
        </form>          
      </div>
    </div>
  </div>
</div> 