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
          $("#name").prop('disabled', false);
          $("#identification").prop('disabled', false);
          $("#emprole").prop('disabled', false);
          $("#sex").prop('disabled', false);
          $("#birthday").prop('disabled', false);
          $("#strdate").prop('disabled', false);
          $("#username").prop('disabled', false);
          $("#empphone").prop('disabled', false);
          $("#empaddress").prop('disabled', false);
          $("#mgname").prop('disabled', false);
          $("#company").prop('disabled', false);
          $("#empshift").prop('disabled', false);
          $("#empmgr").prop('disabled', false);
          $("#country").prop('disabled', false);
          $("#city").prop('disabled', false);
          $("#emplob").prop('disabled', false);
          $("#department").prop('disabled', false);
          $("#pass").prop('disabled', false);
          $("#type").prop('disabled', false);
        }else{
          $("#name").prop('disabled', true);
          $("#name").val("");
          $("#identification").prop('disabled', true);
          $("#identification").val("");
          $("#emprole").prop('disabled', true);
          $("#emprole option:selected").prop("selected", false);
          $("#emplob").prop('disabled', true);
          $("#emplob option:selected").prop("selected", false);
          $("#sex").prop('disabled', true);
          $("#sex option:selected").prop("selected", false);
          $("#birthday").prop('disabled', true);
          $("#birthday").val("");
          $("#strdate").prop('disabled', true);
          $("#strdate").val("");
          $("#username").prop('disabled', true);
          $("#username").val("");
          $("#empphone").prop('disabled', true);
          $("#empphone").val("");
          $("#empaddress").prop('disabled', true);
          $("#empaddress").val("");
          $("#mgname").prop('disabled', true);
          $("#mgname").val("");
          $("#company").prop('disabled', true);
          $("#company option:selected").prop("selected", false);
          $("#country").prop('disabled', true);
          $("#country option:selected").prop("selected", false);
          $("#city").prop('disabled', true);
          $("#city option:selected").prop("selected", false);
          $("#empshift").prop('disabled', true);
          $("#empshift option:selected").prop("selected", false);
          $("#empmgr").prop('disabled', true);
          $("#empmgr option:selected").prop("selected", false);
          $("#department").prop('disabled', true);
          $("#department option:selected").prop("selected", false);
          $("#pass").prop('disabled', true);
          $("#pass").val("");
          $("#type").prop('disabled', true);
          $("#type option:selected").prop("selected", false);
          $("#save").prop('disabled', true);
          alert('This EMPLOYEE already exists!!!');
        }
		})
		.fail(function() {
			//$(b).text("");
		})
		.always(function() {
		});
  }
 }

 function SearchCity(a, b){
  var svalue = a+'[*]'+$("#company").val();
  if(a!=""){
  var jqxhr = $.ajax('ajx_c.php?a1='+a+'&b1=<?php echo $tokenPost; ?>&c1='+svalue+'&d1='+b)
		.done(function(resultado) {
      //alert(resultado);
      if(b==1){
        $("#country").html(resultado);
      }else if(b==2){
        $("#city").html(resultado);
      }else if(b==3){
        $("#department").html(resultado);
      }else if(b==4){
        $("#emplob").html(resultado);
      }else if(b==5){
        $("#empmgr").html(resultado);
      }    
		})
		.fail(function() {
			//$(b).text("");
		})
		.always(function() {
		});
  }
 }

 function q(){
  var d1 = $("#employid").val();
  var d2 = $("#name").val();
  var d3 = $("#identification").val();

  if(d1!="" && d2!="" && d3!=""){
    $("#save").prop('disabled', false);
  }else{
    $("#save").prop('disabled', true);
  }
 }
 </script>
<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Add new Employee</div>
      <div class="card-body">   
        <form action="controller.php?ax=1" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="employid">Employee ID:</label>
                <input OnBlur="SearchName(this.value);q();" class="form-control input-sm" id="employid" name="employid" placeholder="Employee ID" type="text" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Full Name:</label>
                <input OnBlur="q();" class="form-control input-sm" id="name" name="name" placeholder="Name" type="text" required disabled>
              </div>
            </div>
          </div>          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="Identification">Identification:</label>
                <input OnBlur="q();" class="form-control input-sm" id="identification" name="identification" placeholder="Identification" type='number' required disabled>
              </div>
            </div>
          </div>  
          <input type="hidden" name="empstatus" id="empstatus" value="Onboarding">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="sex">Gender:</label>
                <select class="form-control input-sm" name="sex" id="sex" required disabled>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>       
                </select>                            
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="birthday">Birthday:</label>
                <input class="form-control input-sm" id="birthday" name="birthday" placeholder="yyyy/mm/dd" type='date' required disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="date">Start date:</label>
                <input class="form-control input-sm" id="strdate" name="strdate" placeholder="yyyy/mm/dd" type='date' required disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="username">Email/Username:</label>
                <input class="form-control input-sm" id="username" name="username" placeholder="Email Address" type="text" required disabled>
              </div>
            </div>
          </div>        
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="empphone">Phone #:</label>
                <input class="form-control input-sm" id="empphone" name="empphone" placeholder="Phone #" type="number" required disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="empaddress">Address:</label>
                <input class="form-control input-sm" id="empaddress" name="empaddress" placeholder="Emp Address" type="text" required disabled>
              </div>
            </div>
          </div>  

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="mgname">Manager Name:</label>
                <input class="form-control input-sm" id="mgname" name="mgname" placeholder="Manager Name" type="text" required disabled>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="company">Company:</label>
                <select OnChange="SearchCity(this.value, 1);" class="form-control input-sm" name="company" id="company" required disabled>
                  <?php 
                      $mydb->setQuery("SELECT COMPANY FROM `tblcompany` GROUP BY COMPANY");
                      $cur = $mydb->loadResultList();
                      $output .= '<option value="">Select Company</option>';
                      foreach ($cur as $prov) {
                           $output .= '<option value="'. $prov->COMPANY.'">'.$prov->COMPANY.'</option>';
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
                <label for="department">Country:</label>
                <select OnChange="SearchCity(this.value, 2);" class="form-control input-sm" name="country" id="country" required disabled>        
                <option value="">Select Country</option>
                </select> 
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="department">City:</label>
                <select OnChange="SearchCity(this.value, 3);" class="form-control input-sm" name="city" id="city" required disabled>        
                 <option value="">Select City</option>
                </select> 
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="department">Department:</label>
                <select OnChange="SearchCity(this.value, 4);" class="form-control input-sm" name="department" id="department" required disabled>        
                      <option value="">Select Department</option>
                </select> 
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="emprole">LOB:</label>
                <select OnChange="SearchCity(this.value, 5);" class="form-control input-sm" name="emplob" id="emplob" required disabled>
                    <option value="">Select LOB</option>
                </select> 
              </div>
            </div>
          </div> 

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="empmgr">Campaign Manager:</label>
                <select class="form-control input-sm" name="empmgr" id="empmgr" required disabled>
                <option value="">Select Manager</option>
                </select> 
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="emprole">Role:</label>
                <select class="form-control input-sm" name="emprole" id="emprole" required disabled>
                  <?php 
                      $mydb->setQuery("SELECT ROLENAME FROM `tblrole`");
                      $rol = $mydb->loadResultList();
                      $r_output .= '<option value="">Select Role</option>';
                      foreach ($rol as $rolemp) {
                           $r_output .= '<option value="'. $rolemp->ROLENAME.'">'.$rolemp->ROLENAME.'</option>';
                      }
                      echo $r_output;
                  ?>
                </select> 
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="shift">Shift:</label>
                <select OnBlur="q();" class="form-control input-sm" name="empshift" id="empshift" required disabled>
                  <?php 
                      $mydb->setQuery("SELECT SHIFTCODE, SHIFTIMEIN, SHIFTIMEOUT FROM `tblshift`");
                      $s = $mydb->loadResultList();
                       $sh .= '<option value="">Select Shift</option>';
                      foreach ($s as $ss) {
                           $sh .= '<option value="'.$ss->SHIFTCODE.'">'.$ss->SHIFTIMEIN." - ".$ss->SHIFTIMEOUT.'</option>';
                      }
                      echo $sh;
                  ?>     
                </select> 
              </div>
            </div>
          </div> 

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label  for="pass">Password:</label>
                <input class="form-control input-sm" id="pass" name="pass" placeholder="Account Password" type="Password" required disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="type">Type:</label>
                <select class="form-control input-sm" name="type" id="type" required disabled>
                  <?php 
                      $mydb->setQuery("SELECT MTXUSRNAME FROM tblusermatrix");
                      $prf = $mydb->loadResultList();
                      $sprf .= '<option value="">Select Profile</option>';
                      foreach ($prf as $dprf) {
                        $sprf .= '<option value="'. $dprf->MTXUSRNAME.'">'.$dprf->MTXUSRNAME.'</option>';
                      }
                      echo $sprf;
                    ?>
                </select> 
              </div>
            </div>
          </div>
          <button class="btn btn-primary btn-block" id="save" name="save" type="submit" disabled><span class="glyphicon glyphicon-floppy-save"></span> Save User</button>
        </form>         
      </div>
    </div>
  </div>
</div>