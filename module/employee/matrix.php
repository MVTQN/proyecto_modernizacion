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
function uchk(a){
  $("#"+a). prop("checked", false);
  //pfrchk1(a, a);
}
 function pfrchk1(a, b){
   var inptname ="";
   if(b==""){
    inptname = 'ip'+a.id;
   }else{
    inptname = 'ip'+a;
   }
   var iValue = $("#"+inptname).val();
  if(iValue==""){
    $("#"+a.id). prop("checked", false);
  }else{

  var parms = '';
  if(a.checked==true){
    parms = 'ajx_m.php?a1='+a.value+'&a2='+iValue+'&b1=<?php echo $tokenPost; ?>&b2=1';
  }else if(a.checked==false){
    parms = 'ajx_m.php?a1='+a.value+'&a2='+iValue+'&b1=<?php echo $tokenPost; ?>&b2=2';
  }
  
  var jqxhr = $.ajax(parms)
		.done(function(resultado) {      
       document.getElementById("mess").style.visibility = "visible"; 
      if(a.checked==true){  
        $("#mess").text("Approver role was assigned to the user with token: " + a.id);
        document.getElementById("mess").style.color = "#1261ff";
      }else{
        $("#mess").text("Approver role was revoked to the user with token: " + a.id);
        document.getElementById("mess").style.color = "#f51707";
      }
		})
		.fail(function() {
        alert('fail');
			//$(a).text("");
		})
		.always(function() {
		});

  }
 }

 function pfrchk(a){
   var parms = '';
  if(a.checked==true){
    parms = 'ajx_e.php?a1='+a.value+'&b1=<?php echo $tokenPost; ?>&b2=1';
  }else if(a.checked==false){
    parms = 'ajx_e.php?a1='+a.value+'&b1=<?php echo $tokenPost; ?>&b2=2';
  }
  
  var jqxhr = $.ajax(parms)
		.done(function(resultado) {      
       document.getElementById("mess").style.visibility = "visible"; 
      if(a.checked==true){  
        $("#mess").text("Permission was assigned to the user with token: " + a.id);
        document.getElementById("mess").style.color = "#1261ff";
      }else{
        $("#mess").text("Permission was revoked to the user with token: " + a.id);
        document.getElementById("mess").style.color = "#f51707";
      }
		})
		.fail(function() {
        alert('fail');
			//$(a).text("");
		})
		.always(function() {
		});
 }
</script>
<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Employee Account permission matrix</div>
      <div class="card-body"> 
        <form  action="controller.php?aX=2" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="employid" style="font-weight:bold">ID: <?php echo $singleuser->EMPID; ?> <br>Full Name: <?php echo $singleuser->EMPNAME; ?></label>
                <input id="employid" name="employid" type="hidden" value="<?php echo $singleuser->EMPID; ?>">
              </div>
            </div>
          </div>     
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="Identification" style="font-weight:bold;">PERMISSION MATRIX:</label>
                <?php 
                  $output = '<br>';
                  $mydb0 = new DatabaseN();
                  $mydb1 = new DatabaseN();
                  $mydb0->setQuery("SELECT a.country as Country, a.city as City, a.company as Company, b.ldeptname as Dept, b.lobname as Lob FROM tblcompany a, tbllob b WHERE b.complob=a.company ORDER BY a.company, a.country, a.CITY, b.LDEPTNAME, b.LOBNAME");
                  $cur = $mydb0->loadResultList();
                  $output .= '';
                  $a = 0;
                  foreach ($cur as $prov) {
                    $nameid = md5(base64_encode($singleuser->EMPLOYID.'[*]'.$prov->Country.'[*]'.$prov->City.'[*]'.$prov->Company.'[*]'.$prov->Dept.'[*]'.$prov->Lob));
                    $mydb1->setQuery("select priv_token from tbluprivmatrix where priv_token='".$nameid."'");
                    $token = $mydb1->loadSingleResult(); 
                    if($token == ""){$selected = "";}else{$selected = "checked";}
                    $output .= '<input type="checkbox" '.$selected.' onchange="pfrchk(this);" id="'.$nameid.'" name="'.$nameid.'" value="'.base64_encode($singleuser->EMPLOYID.'[*]'.$prov->Country.'[*]'.$prov->City.'[*]'.$prov->Company.'[*]'.$prov->Dept.'[*]'.$prov->Lob).'"> &nbsp;&nbsp;&nbsp;'.$prov->Country.'->'.$prov->City.'->'.$prov->Company.'->'.$prov->Dept.'->'.$prov->Lob.'<br>';
                    $a += 1;
                  }
                  $output .= '';
                  echo $output;
                  $mydb0->close_connection();
                  $mydb1->close_connection();
                ?>
              </div>
            </div>
          </div>        

          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="Identification" style="font-weight:bold;">APPROVER OPTIONS:</label>
                <?php 
                  $output = '<br>';
                  $mydb0 = new DatabaseN();
                  $mydb1 = new DatabaseN();
                  $mydb0->setQuery("SELECT leavetype, APPROVERS_COUNT FROM tblleavetype");
                  $cur = $mydb0->loadResultList();
                  $output .= '';
                  $a = 0;
                  $output = '<table>';
                  foreach ($cur as $appr) {
                    $nameid = md5(base64_encode($singleuser->EMPLOYID.'[*]'.$appr->leavetype));
                    $mydb1->setQuery("select appr_token, appr_level from tblapproversmatrix where appr_token='".$nameid."'");
                    $amatrix = $mydb1->loadResultList();
                    $token = "";
                    $ulevel = 1;
                    foreach ($amatrix as $sec_appr) {
                        $token = $sec_appr->appr_token;
                        $ulevel = $sec_appr->appr_level;
                    }
                    if($token == ""){$selected = "";}else{$selected = "checked";}
                    $output .= '<tr><td><input type="checkbox" '.$selected.' onchange="pfrchk1(this, \'\');" id="'.$nameid.'" name="'.$nameid.'" value="'.base64_encode($singleuser->EMPLOYID.'[*]'.$appr->leavetype).'"></td><td style="font-family: tahoma">'.$appr->leavetype.'</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Level:-> &nbsp;<input onchange="uchk(\''.$nameid.'\');" id="ip'.$nameid.'" name="ip'.$nameid.'" min="1" max="'.$appr->APPROVERS_COUNT.'" style="width: 50px;" type="number" value="'.$ulevel.'"></td></tr>';
                    $a += 1;
                  }
                  $output .= '</table>';
                  echo $output;
                  $mydb0->close_connection();
                  $mydb1->close_connection();
                ?>
              </div>
            </div>
          </div>        

        </form>
        <br>
            <div id="mess" name="mess" style="text-align: center;color: #f51707;">&nbsp;</div>  
      </div>
    </div>
  </div>
</div>