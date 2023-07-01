<?php  
  /* Open Required Header in all scripts */
    $pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
    $toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
    if(!isset($security_included)){require($toRoot."include/security.php");}
	  Secure::session_verify($toRoot);$tokenPost = Secure::sToken(true);
    $_SESSION['tokenPostSess'] = $tokenPost;
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

    $user = New User();
    
    $singleuser = $user->single_user($atID);

?> 
<Script>
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
 </Script>

<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Update Employee Account</div>
      <div class="card-body"> 
        <form  action="controller.php?ax=2" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="employid">Employee ID:</label>
                <input name="empid" type="hidden" value="<?php echo $singleuser->EMPID; ?>">
                <input class="form-control input-sm" id="employid" name="employid" placeholder="Employee ID" type="text" value="<?php echo $singleuser->EMPLOYID; ?>" required readonly>
              </div>
            </div>
          </div>     
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Full Name:</label>
                  <input class="form-control input-sm" id="name" name="name" placeholder="Name" type="text" value="<?php echo $singleuser->EMPNAME; ?>" required>
              </div>
            </div>
          </div>    
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="Identification">Identification:</label>
                <input class="form-control input-sm" id="identification" name="identification" placeholder="Identification" type='text' value="<?php echo $singleuser->IDENTIFICATION; ?>"  required>
              </div>
            </div>
          </div>  

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="empstatus">Status:</label>
                <select class="form-control input-sm" name="empstatus" id="empstatus">
                  <option value="<?php echo $singleuser->EMPSTATUS; ?>"><?php echo $singleuser->EMPSTATUS; ?></option>
                        <option value="Active">Active</option>
                        <option value="Onboarding">On-boarding</option>
                        <option value="Attrited">Attrited</option>
                </select>                          
              </div>
            </div>
          </div>     

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="empsex">Gender:</label>
                  <select class="form-control input-sm" name="sex" id="sex">
                    <?php 
                      if ($singleuser->EMPSEX == 'Male') {
                          echo '<option value="Male" selected>Male</option>
                                <option value="Female">Female</option>';
                          }else{
                          echo '<option value="Female">Female</option>
                              <option value="Male" selected>Male</option>';
                          }
                   ?>            
                  </select> 
                </div>
              </div>
            </div>   
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="birthday">Birthday:</label>
                    <input class="form-control input-sm" id="birthday" name="birthday" placeholder="Birthday" type='date' value="<?php echo $singleuser->BIRTHDAY; ?>" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="date">Start date:</label>
                        <input class="form-control input-sm" id="strdate" name="strdate" placeholder="yyyy/mm/dd" type='date' value="<?php echo $singleuser->STRDATE; ?>" required>
                </div>
              </div>
            </div>               
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="username">Email/Username:</label>
                    <input class="form-control input-sm" id="username" name="username" placeholder="Email Address" type="text" value="<?php echo $singleuser->USERNAME; ?>"  required>
                </div>
              </div>
            </div>     
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="empphone">Phone #:</label>
                      <input class="form-control input-sm" id="empphone" name="empphone" placeholder="Phone #" type="text" value="<?php echo $singleuser->EMPPHONE; ?>" required>
                </div>
              </div>
            </div>      
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="empaddress">Address:</label>
                  <input class="form-control input-sm" id="empaddress" name="empaddress" placeholder="Emp Address" type="text" value="<?php echo $singleuser->EMPADDRESS; ?>" required>
                </div>
              </div>
            </div>     
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="mgname">Manager Name:</label>
                      <input class="form-control input-sm" id="mgname" name="mgname" placeholder="Manager Name" type="text" value="<?php echo $singleuser->MGNAME; ?>" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="company">Company:</label>
                    <select OnChange="SearchCity(this.value, 1);" class="form-control input-sm" name="company" id="company">
                        <?php 
                        $output = "";
                          $mydb->setQuery("SELECT COMPANY FROM `tblcompany`");
                          $cur = $mydb->loadResultList();
                          $output .= '<option value="">Select Company</option>';
                          foreach ($cur as $prov) {
                            if($singleuser->COMPANY==$prov->COMPANY){
                              $output .= '<option value="'.$prov->COMPANY.'" selected>'.$prov->COMPANY.'</option>';
                            }else{
                              $output .= '<option value="'.$prov->COMPANY.'">'.$prov->COMPANY.'</option>';
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
                    <label for="department">Country:</label>
                    <select OnChange="SearchCity(this.value, 2);" class="form-control input-sm" name="country" id="country" required>        
                      <?php 
                        $mydb->setQuery("SELECT COUNTRY FROM tblcompany WHERE COMPANY='".$singleuser->COMPANY."' GROUP BY COUNTRY;");
                        $d = $mydb->loadResultList();
                        $ct .= '<option value="">Select Country</option>';
                        foreach ($d as $cnt) {
                          if($singleuser->COUNTRY==$cnt->COUNTRY){
                            $ct .= '<option value="'.$cnt->COUNTRY.'" selected>'.$cnt->COUNTRY.'</option>';
                          }else{
                            $ct .= '<option value="'.$cnt->COUNTRY.'">'.$cnt->COUNTRY.'</option>';
                          }
                        }
                        echo $ct;
                      ?>
                    </select> 
                  </div>
                </div>
             </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="department">City:</label>
                  <select OnChange="SearchCity(this.value, 3);" class="form-control input-sm" name="city" id="city" required>        
                      <?php 
                        $mydb->setQuery("SELECT CITY FROM tblcompany WHERE COUNTRY='".$singleuser->COUNTRY."' AND COMPANY='".$singleuser->COMPANY."' GROUP BY CITY;");
                        $d1 = $mydb->loadResultList();
                        $ct1 .= '<option value="">Select Country</option>';
                        foreach ($d1 as $cnt1) {
                          if($singleuser->CITY==$cnt1->CITY){
                            $ct1 .= '<option value="'.$cnt1->CITY.'" selected>'.$cnt1->CITY.'</option>';
                          }else{
                            $ct1 .= '<option value="'.$cnt1->CITY.'">'.$cnt1->CITY.'</option>';
                          }
                        }
                        echo $ct1;
                      ?>
                    </select> 
                  </select> 
                </div>
              </div>
          </div>

          <div class="form-group">
                <div class="form-row">
                  <div class="col-md">
                    <label for="department">Department:</label>
                      <select OnChange="SearchCity(this.value, 4);" class="form-control input-sm" name="department" id="department">
                          <?php 
                            $mydb->setQuery("SELECT LDEPTNAME FROM tbllob WHERE COMPLOB='".$singleuser->COMPANY."' GROUP BY LDEPTNAME;");
                            $cur2 = $mydb->loadResultList();
                            foreach ($cur2 as $prov2) {
                              if($singleuser->DEPARTMENT==$prov2->LDEPTNAME){
                                $outputs2 .= '<option value="'.$prov2->LDEPTNAME.'" selected>'.$prov2->LDEPTNAME.'</option>';
                              }else{
                                $outputs2 .= '<option value="'.$prov2->LDEPTNAME.'">'.$prov2->LDEPTNAME.'</option>';
                              }
                            }
                            echo $outputs2;
                          ?>
                      </select> 
                  </div>
                </div>
          </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="emprole">LOB:</label>
                  <select OnChange="SearchCity(this.value, 5);" class="form-control input-sm" name="emplob" id="emplob" required>
                        <?php 
                          $output1 = "";
                          $mydb->setQuery("SELECT LOBNAME FROM tbllob WHERE LDEPTNAME='".$singleuser->DEPARTMENT."' AND COMPLOB='".$singleuser->COMPANY."' GROUP BY LOBNAME;");
                          $cur3 = $mydb->loadResultList();
                          $output3 .= '<option value="">Select LOB</option>';
                          foreach ($cur3 as $prov3) {
                            if($singleuser->LOB==$prov3->LOBNAME){
                              $output3 .= '<option value="'.$prov3->LOBNAME.'" selected>'.$prov3->LOBNAME.'</option>';
                            }else{
                              $output3 .= '<option value="'.$prov3->LOBNAME.'">'.$prov3->LOBNAME.'</option>';
                            }
                          }
                          echo $output3;
                        ?>
                  </select> 
                </div>
              </div>
            </div>  

            <div class="form-group">
                <div class="form-row">
                  <div class="col-md">
                    <label for="empmgr">Campaign Manager:</label>
                      <select class="form-control input-sm" name="empmgr" id="empmgr">
                          <?php
                            $mydb->setQuery("SELECT a.MGRNAME AS MGRNAME1 FROM tblmanager a, tblcompany b WHERE b.COMCODE=a.MGRCOMPANY AND b.COMPANY='".$singleuser->COMPANY."' GROUP BY a.MGRNAME;");
                            $mgr = $mydb->loadResultList();
                            $rmgr .= '<option value="">Select Mgr</option>';
                            foreach ($mgr as $mgrs) {
                              if($mgrs->MGRNAME1==$singleuser->EMPMGR){
                                $rmgr .= '<option value="'.$mgrs->MGRNAME1.'" selected>'.$mgrs->MGRNAME1.'</option>';
                              }else{
                                $rmgr .= '<option value="'.$mgrs->MGRNAME1.'">'.$mgrs->MGRNAME1.'</option>';
                              }
                                
                            }
                            echo $rmgr;
                         ?>
                      </select> 
                  </div>
                </div>
              </div>   

              <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="emprole">Role:</label>
                  <select class="form-control input-sm" name="emprole" id="emprole" required>
                    <?php 
                        $r_output = "";
                        $mydb->setQuery("SELECT ROLENAME FROM `tblrole` order by ROLENAME");
                        $rol = $mydb->loadResultList();
                        $r_output .= '<option value="">Select Role</option>';
                        foreach ($rol as $rolemp) {
                          if($singleuser->EMPROLE==$rolemp->ROLENAME){
                            $r_output .= '<option value="'.$rolemp->ROLENAME.'" selected>'.$rolemp->ROLENAME.'</option>';
                          }else{
                            $r_output .= '<option value="'.$rolemp->ROLENAME.'">'.$rolemp->ROLENAME.'</option>';
                          }
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
                    <label for="shift">Shifts:</label>
                      <select class="form-control input-sm" name="empshift" id="empshift">
                          <?php 
                            global $mydb;
                            $mydb->setQuery("SELECT SHIFTCODE, SHIFTIMEIN, SHIFTIMEOUT FROM `tblshift`");
                            $s = $mydb->loadResultList();
                            $sh .= '<option value="">Select Shift</option>';
                            foreach ($s as $ss) {
                              if($singleuser->EMPSHIFT==$ss->SHIFTCODE){
                                $sh .= '<option value="'.$ss->SHIFTCODE.'" selected>'.$ss->SHIFTIMEIN." - ".$ss->SHIFTIMEOUT.'</option>';
                              }else{
                                $sh .= '<option value="'.$ss->SHIFTCODE.'">'.$ss->SHIFTIMEIN." - ".$ss->SHIFTIMEOUT.'</option>';
                              }
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
                    <label for="empposition">User Type:</label>    
                      <select class="form-control input-sm" name="type" id="type">
                        <?php 
                          global $mydb;
                          $mydb->setQuery("SELECT MTXUSRNAME FROM tblusermatrix");
                          $prf = $mydb->loadResultList();
                          foreach ($prf as $dprf) {
                            if($dprf->MTXUSRNAME==$singleuser->EMPPOSITION){
                              $sprf .= '<option value="'.$dprf->MTXUSRNAME.'" selected>'.$dprf->MTXUSRNAME.'</option>';
                            }else{
                              $sprf .= '<option value="'.$dprf->MTXUSRNAME.'">'.$dprf->MTXUSRNAME.'</option>';
                            }
                          }
                          echo $sprf;
                        ?>
                      </select> 
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary btn-block" id="save" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save User</button>
        </form>
      </div>
    </div>
  </div>
</div>