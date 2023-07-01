<?php 
   /* Open Required Header in all scripts */
   $pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
   $toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
   if(!isset($security_included)){require($toRoot."include/security.php");}
   Secure::session_verify($toRoot);$tokenPost = Secure::sToken(true);
   $_SESSION['tokenPostSess'] = $tokenPost;
/* Close Required Header in all scripts */
    
    if(!isset($dates_included)){
      require("dates.php");
    } 
 
    $user = New User();
    $singleuser = $user->single_user($_SESSION['EMPID']);
    $Adays = Achieved_VacationDays($singleuser->STRDATE, $CurrentDate);
    $Cdays = ConsumedVacationDays($singleuser->EMPLOYID, $singleuser->STRDATE);
    $AvailableDays = ($Adays-$Cdays);
 ?> 
 <script>
  var AvDays =<?php echo $AvailableDays; ?>;
  function Launch(q){
    var sel = document.getElementById("TYPEOFLEAVE");
    var text= sel.options[sel.selectedIndex].value;
    var option = false;
    if(text==""){
        option = true;
    }else{
        option = false;
    }
    $("#DATESTART").prop('disabled', option);$("#DATESTART").val("");
    $("#DATEEND").prop('disabled', option);$("#DATEEND").val("");
    $("#LNODAYS").val(AvDays);
    $("#LNODAYS").prop('disabled', option);
    $("#REASON").prop('disabled', option);$("#REASON").val("");
    $("#save").prop('disabled', option);
    $("#LNOTAKEN").val("0");
    if(text.toLowerCase().indexOf("vacation") != -1){
      $("#LNOTAKEN").prop('disabled', false);
      $("#vacationData").show();
    }else{
      $("#LNOTAKEN").prop('disabled', true);
      $("#vacationData").hide();
    }
 }
 function validateDates(a, el, mDate){
   var x = mDate;
  //  if(a<x){
  //   $(el).val("");
  //   alert('You should choose a later date');
  //  }
 }

 function ResetDays(){
    $("#LNODAYS").val(AvDays);
    $("#LNOTAKEN").val("0");
    $("#DATEEND").val("");
 }

 function CheckPrevious(a, b){
   if($(a).val() ==""){
    $(b).val("");
    $(a).focus();
    alert('You should select the starting date first');
   }
 }

 function calculateTakenDays(a, b){
  var d1 = $(a).val();
  var d2 = $(b).val();
  var jqxhr = $.ajax('ajx_dates.php?a1='+d1+'&a2='+d2)
		.done(function(resultado) {
      if(AvDays<resultado){
        $("#save").prop('disabled', true);
        $("#LNOTAKEN").val("0");
        $("#DATEEND").val("");
        alert('You are applying for '+resultado+' days, but You only have '+AvDays+' days available');
      }else{
        $("#LNOTAKEN").val(resultado);
        $("#LNODAYS").val(AvDays-resultado);
      }
		})
		.fail(function() {
			$("#LNOTAKEN").text("0");
		})
		.always(function() {
		});
 }
 </script>
<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Add new Leave Application</div>
      <div class="card-body"> 
        <form action="controller.php?ax=1" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="employid">Employee ID:</label>
                  <input name="deptid" type="hidden" value="<?php echo $singleuser->EMPID; ?>">
                  <input class="form-control input-sm" id="LEMPID" name="LEMPID" placeholder="Employee ID" type="text" value="<?php echo $singleuser->EMPLOYID; ?>" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Name:</label>
                  <input class="form-control input-sm" id="LEMPNAME" name="LEMPNAME" placeholder="Full Name" type="text" value="<?php echo $singleuser->EMPNAME; ?>" readonly>
              </div>
            </div>
          </div>
          <input type="hidden" name="LEAVESTATUS" id="LEAVESTATUS" value="PENDING">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="LSTRDATE">Start Date:</label>
                    <input class="form-control input-sm" id="LSTRDATE" name="LSTRDATE" placeholder="Start Date" type="text" value="<?php echo $singleuser->STRDATE; ?>" readonly>  
                </div>
                <div class="col-md">
                  <label for="LTENURE">Company Tenure:</label>
                    <input class="form-control input-sm" id="LTENURE" name="LTENURE"  type="test" value="<?php echo round(Tenure($singleuser->STRDATE), 2);?>" readonly>
                </div>
                  <input type="hidden" name="LCURDATE" id="LCURDATE" value="<?php echo $CurrentDate; ?>">
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">    
                <div class="col-md">
                  <label for="Leave">Type of Leave:</label>
                    <select OnChange="Launch(this.text);" class="form-control input-sm" name="TYPEOFLEAVE" id="TYPEOFLEAVE">
                      <?php             
                        global $mydb;
                        $output ="";
                        $mydb->setQuery("SELECT LEAVETYPE FROM `tblleavetype`");
                        $cur = $mydb->loadResultList();
                        $output .= '<option value="">Select Leave</option>';
                        foreach ($cur as $prov) {
                          if(strtolower($prov->LEAVETYPE)=="vacation"){
                            if($AvailableDays>0){
                                $output .= '<option value="'.$prov->LEAVETYPE.'">'.$prov->LEAVETYPE.'</option>';
                            }
                          }else{
                              $output .= '<option value="'.$prov->LEAVETYPE.'">'.$prov->LEAVETYPE.'</option>';
                          }
                        }
                        echo $output;
                      ?>
                    </select> 
                </div>
              </div>
            </div>      
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="DATESTART">Date From:</label>
                    <input OnClick="ResetDays();" onchange="validateDates(this.value, '#DATESTART', '<?php echo $CurrentDate; ?>');" class="form-control input-sm" id="DATESTART" name="DATESTART"  type="date" disabled required>              
                </div>
                <div class="col-md">
                  <label for="DATEEND">Date To:</label>
                    <input onchange="CheckPrevious('#DATESTART', '#DATEEND');validateDates(this.value, '#DATEEND', '<?php echo $CurrentDate; ?>');calculateTakenDays('#DATESTART', '#DATEEND');" class="form-control input-sm" id="DATEEND" name="DATEEND" type="date" disabled required>     
                </div>
              </div>
            </div>
            <div id="vacationData" name="vacationData" class="form-group" style="display: none;">
              <div class="form-row">
                <div class="col-md">
                  <label for="LNODAYS">Vacation Accumulated days:</label>
                    <input class="form-control input-sm" id="LNODAYS" name="LNODAYS"  type="number" value="<?php echo $AvailableDays;  ?>" readonly>
                </div>
                <div class="col-md">
                  <label for="LNOTAKEN">Vacation Days taken:</label>
                    <input class="form-control input-sm" id="LNOTAKEN" name="LNOTAKEN" type="number" value="0" readonly required>     
                </div>
              </div>
            </div>  
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="REASON">Reason:</label>
                    <textarea class="form-control input-sm" name="REASON" id="REASON" disabled></textarea>  
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn-block" id="save" name="save" type="submit" disabled><span class="glyphicon glyphicon-floppy-save"></span> Save Leave</button>
        </form>
      </div>
    </div>
  </div>
</div>