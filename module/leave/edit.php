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

$Leave = new Leave();
$SL = $Leave->single_leave($atID);

$mydbApprover = new DatabaseN();
$mydbApprover->setQuery("SELECT appr_level FROM tblapproversmatrix WHERE appr_user_id='".$_SESSION['EMPLOYID']."'");
$LeaveApproverLevel = $mydbApprover->loadSingleResult();
$_SESSION['EMPPMXLEV'] = $permissionMenu[0];
$mydbMenu->close_connection();

$mydbVD = new DatabaseN();
$mydbVD->setQuery("SELECT APPROVERS_COUNT FROM `tblleavetype` WHERE LEAVETYPE='".$SL->TYPEOFLEAVE."'");
$approversCount = $mydbVD->loadSingleResult();
$mydbVD->close_connection();
$strtr = "tmmsrprcsdmvdDpdrs2020";
$appv[0][0] = "";

for($x=1;$x<=$approversCount;$x++){
  if($x==1){
      $appv[1]=explode("[*]", Secure::decrypt($SL->APPR_1, $strtr));
  }else if($x==2){
      $appv[2]=explode("[*]", Secure::decrypt($SL->APPR_2, $strtr));
  }else if($x==3){
      $appv[3]=explode("[*]", Secure::decrypt($SL->APPR_3, $strtr));
  }else if($x==4){
      $appv[4]=explode("[*]", Secure::decrypt($SL->APPR_4, $strtr));
  }else if($x==5){
      $appv[5]=explode("[*]", Secure::decrypt($SL->APPR_5, $strtr));
  }
}

$astatus = "PENDING";
$rejcount = 0;
$appcount = 0;
$pendcount = 0;
for($i=1;$i<=$approversCount;$i++){
    if($appv[$i][0]=="REJECTED"){
      $rejcount += 1;
    }else if($appv[$i][0]=="PENDING"){
      $pendcount += 1;
    }else if($appv[$i][0]=="APPROVED"){
      $appcount += 1;
    }else if($appv[$i][0]==""){
      $pendcount += 1;
    }
}
if($rejcount>0){
    $astatus = "REJECTED";
}else{
    if($pendcount>0){
      $astatus = "PENDING";
    }else{
      if($appcount==$approversCount){
        $astatus = "APPROVED";
      }
    }
}

?> 
<script>
function setAPPR(a, b){
    regApp(a, b);
    document.getElementById("img<?php echo $LeaveApproverLevel; ?>").src = '<?php echo $toRoot; ?>assets/icons/'+a+'.png';
    document.getElementById("img<?php echo $LeaveApproverLevel; ?>").title = a;
    document.getElementById("img<?php echo $LeaveApproverLevel; ?>").alt = a;
}

function SetQR(){
  var parms = 'qr-s1.php?a1=<?php echo $SL->LEAVEID; ?>&a2=<?php echo $LeaveApproverLevel; ?>&b1=<?php echo $tokenPost; ?>&a3=<?php echo $_SESSION['EMPLOYID']; ?>&a4=<?php echo $approversCount; ?>';
  window.myFrame.location= parms;
}
function DownQR(png){
  var parms = 'down_qr.php?a1='+png+'&b1=<?php echo $tokenPost; ?>';
  window.myFrame.location= parms;
}
function regApp(a, b){
  var status = Base64.encode(a);
  var comment = Base64.encode(b);
  parms = 'ajx_r.php?a1=<?php echo $SL->LEAVEID; ?>&a2=<?php echo $LeaveApproverLevel; ?>&b1=<?php echo $tokenPost; ?>&a3='+status+'&a4='+comment+'&a5=<?php echo $_SESSION['EMPLOYID']; ?>&a7=<?php echo $approversCount; ?>';
  var jqxhr = $.ajax(parms)
		.done(function(result) { 
      if(result=="PENDING"){
          $("#lvstatus").css('color', '#777d7a');
      }else if(result=="REJECTED"){
          $("#lvstatus").css('color', '#a80a0a');
      }else if(result=="APPROVED"){
          $("#lvstatus").css('color', '#1e8f58');
      }
      $("#lvstatus").text(result); 
		})
		.fail(function() {
        alert('fail');
			//$(a).text("");
		})
		.always(function() {
		}); 
 }
function rsize(a){
  if(a==true){
    document.getElementById("myFrame").style.height = "290px";
  }else{
    document.getElementById("myFrame").style.height = "150px";
  }
  
}
</script>
<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">&nbsp;&nbsp;&nbsp;Leave Application status</div>
      <div class="card-body">
        <form action="controller.php?ax=2" method="POST">

        <div class="form-group">
            <div class="form-row">
              <div class="col-md">
              <table style="width: 100%;"><tr>
              <td> <label for="lstatus" style="font-weight: bold;">Leave request Status:</label></td>
              <?php
                        if($LeaveApproverLevel!=""){
                            echo '<td>&nbsp;</td>';
                        }else{
                          echo '';
                        }
              ?>
              </tr><tr>
              <?php
                        if($LeaveApproverLevel!=""){
                            echo '<td style="width: 95%;">';
                        }else{
                            echo '<td style="width: 100%;">';
                        }
              ?>
              <input id="LEAVESTATUS" name="LEAVESTATUS" type="hidden" value="<?php echo $astatus; ?>">
              <?php
              if(strtoupper($astatus)=="APPROVED"){
                  $fcolor ="#1e8f58";
              }else if(strtoupper($astatus)=="PENDING"){
                $fcolor ="#777d7a";
              }else if(strtoupper($astatus)=="REJECTED"){
                $fcolor ="#a80a0a";
              }
              ?>
                <div id="lvstatus" name="lvstatus" style="width: 100%;height: 35px;border: 1px solid #ccc;text-align: center;padding: 8px 0;font-weight: bold;color:<?php echo $fcolor; ?>"><?php echo $astatus; ?></div>
                  </td>
                  <?php
                        if($LeaveApproverLevel!="" && $_SESSION['EMPLOYID']!=$SL->LEMPID){
                  ?>
                <td style="width: 5%;text-align: right;vertical-align: middle;">
                 
                  <button OnClick="window.myFrame.location='approve.php';rsize(false);" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal1">...</button>
                  
                </td>
                <?php
                    }
                  ?>
              </tr></table><br>
                <?php 
                    echo '<table style="width: 100%;border: 1px solid #ccc"><tr>';
                    $micon = "pending";
                    $altI = "";
    
                    for($x=0;$x<=$approversCount-1;$x++){
                      if($appv[$x+1][0]==""){
                        $micon = "pending";
                        $altI = "Approval pending";
                      }else{
                        $micon = strtolower($appv[$x+1][0]);
                        $altI = $appv[$x+1][0]." - ".$appv[$x+1][1];
                      }
                        echo '<td style="text-align:center;border: 1px solid #CCC"><img id="img'.($x+1).'" src="'.$toRoot.'assets/icons/'.$micon.'.png" title="'.$altI.'" alt="'.$altI.'" width="50" height="50"></td>';
                    }
                    echo '<td style="text-align: center;width: 7%"><button OnClick="SetQR();rsize(true);" type="button" style="border: 1px solid #333;color: #333;cursor: hand; cursor: pointer;" class="fa fa-qrcode fa-3x" data-toggle="modal" data-target="#exampleModal1"></button></td>';
                    
                    echo '</tr></table>';
                  ?>                 
                </div>
                
              </div>
              
            </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="lempid" style="font-weight: bold;">Employee ID:</label>
                  <input id="LEAVEID" name="LEAVEID" type="hidden" value="<?php echo $SL->LEAVEID; ?>">
                  <input id="LEMPNAME" name="LEMPNAME" type="hidden" value="<?php echo $singleuser->EMPNAME; ?>">
                  <input class="form-control input-sm" id="LEMPID" name="LEMPID" placeholder="Employee ID" type="text" value="<?php echo $SL->LEMPID; ?>" readonly>
              </div>
            </div>
          </div>
          <?PHP  
            $user = New User();
            $singleuser = $user->single_emp($SL->LEMPID);
          ?>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name" style="font-weight: bold;">Full Name:</label>
                <input class="form-control input-sm" id="LEMPNAME" name="LEMPNAME" placeholder="Full Name" type="text" value="<?php echo $singleuser->EMPNAME; ?>" readonly>
              </div>
            </div>
          </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md">
                  <label for="lstrdate" style="font-weight: bold;">Start Date:</label>
                  <input class="form-control input-sm" id="lstrdate" name="LSTRDATE" placeholder="Start Date" type="text" value="<?php echo $singleuser->STRDATE; ?>" readonly>  
                </div>  
                <div class="col-md">
                  <label for="LCURDATE" style="font-weight: bold;">Company Tenure:</label>
                  <input id="LCURDATE" name="LCURDATE" type="hidden" value="<?php echo $SL->LEAVEID; ?>">
                  <input class="form-control input-sm" id="ltenure" name="LTENURE"  type="test" value="<?php echo $SL->LTENURE; ?>" readonly>
                </div>
              </div>
            </div> 
            <div class="form-group">
              <div class="form-row">    
                <div class="col-md">
                  <label for="Leave" style="font-weight: bold;">Type of Leave:</label>
                  <select class="form-control input-sm" name="TYPEOFLEAVE" id="Leave" disabled>
                  <option value="<?php echo $SL->TYPEOFLEAVE; ?>"><?php echo $SL->TYPEOFLEAVE; ?></option>
                  <?php 
                    global $mydb;
                    $mydb->setQuery("SELECT LEAVETYPE FROM `tblleavetype`");
                    $cur = $mydb->loadResultList();
                    $output .= '<option value="">Select Leave</option>';
                    foreach ($cur as $prov) {
                          $output .= '<option value="'. $prov->LEAVETYPE.'">'.$prov->LEAVETYPE.'</option>';
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
                  <label for="df" style="font-weight: bold;">Date From:</label>
                  <input class="form-control input-sm" id="DATESTART" name="DATESTART"  type="date" value="<?php echo $SL->DATESTART; ?>" required readonly>       
                </div>
              <div class="col-md">
                <label for="dt" style="font-weight: bold;">Date To:</label>
                  <input class="form-control input-sm" id="DATEEND" name="DATEEND" type="date" value="<?php echo $SL->DATEEND; ?>" required readonly>       
              </div>
            </div>
          </div>  

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="ltenure">Accumulated days:</label>
                <input class="form-control input-sm" id="LNODAYS" name="LNODAYS"  type="text" value="<?php echo $SL->LNODAYS; ?>" readonly>              
              </div>
              <div class="col-md">
                      <label for="lnotaken">Days taken:</label>
                          <input class="form-control input-sm" id="LNOTAKEN" name="LNOTAKEN" type="test" value="<?php echo $SL->LNOTAKEN; ?>" required readonly>          
              </div>
                    </div>
                   </div>        
                    <div class="form-group">
                    <div class="form-row">
                      <div class="col-md">
                        <label for="reason">Reason :</label>
                          <textarea class="form-control input-sm" name="REASON" id="REASON" required readonly><?php echo $SL->REASON; ?></textarea>  
                       </div>
                    </div>
                  </div>
        </form>
      </div>
    </div>
  </div>
</div>