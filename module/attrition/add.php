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
 function SearchItem(a, b){
  if(a!=""){
  var jqxhr = $.ajax('ajx_q.php?a1='+a+'&b1=<?php echo $tokenPost; ?>')
		.done(function(resultado) {
        $("#attrempname").val("");
        $("#attrempname1").val("");
        $("#attreason option:selected").prop("selected", false);
        $("#attrdate").val("");
      if(resultado == ""){   
        $("#attreason").prop('disabled', true);
        $("#attrdate").prop('disabled', true);
        $("#save").prop('disabled', true);
        $("#attrempname").val("");
        $("#attrempname1").val("");
        $("#attreason option:selected").prop("selected", false);
        $("#attrempcode option:selected").prop("selected", false);
        alert('This employee is already attrited!!!');
      }else{
        $("#save").prop('disabled', true);
        $("#attrempname").val(resultado);
        $("#attrempname1").val(resultado);
        $("#attreason").prop('disabled', false);
        $("#attrdate").prop('disabled', false);
      }
		})
		.fail(function() {
			$(b).text("");
		})
		.always(function() {
		});
  }else{
    $("#attrempname").val("");
    $("#attrempname1").val("");
    $("#attrdate").val("");
    $("#attreason option:selected").prop("selected", false);
    $("#attreason").prop('disabled', true);
    $("#attrdate").prop('disabled', true);
    $("#save").prop('disabled', true);
  }
 }

 function Validate(){
    var a = $("#attrempname1").val();
    var b = $("#attrdate").val();
    var c = $("#attreason option:selected").val();
    
    if(a=="" || b=="" || c==".."){
      $("#save").prop('disabled', true);
    }else{
      $("#save").prop('disabled', false);
    }
 }

 function t(a, b, c, d){
  $(c).val(a);
  $(d).val(b);
  $("#attrempname").val(b);
  Actfi();
  window.parent.$('#close-modal').click();
 }

 function Actfi(){
  $("#save").prop('disabled', true);
  $("#attreason").prop('disabled', false);
  $("#attrdate").prop('disabled', false);  
}
 </script>
<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Add new Attrition</div>
      <div class="card-body">   
        <form action="controller.php?ax=1" method="POST">  
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                      <table style="width: 100%;"><tr>
              <td><label for="atempid">Employee ID:</label></td><td>&nbsp;</td></tr><tr>
              <td style="width: 95%;">
                <input OnChange="Actfi();" class="form-control" name="attrempcode" id="attrempcode" placeholder="Name" type="text" value="" readonly>
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
                      <label for="name">Employee Name:</label>
                      <input name="attrempname" id="attrempname" type="hidden" value="">
                      <input OnChange="Actfi();" class="form-control input-sm" name="attrempname1" id="attrempname1" placeholder="Employee name" type="text" required readonly>
                      </div>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="name">Attr Date:</label>
                         <input OnBlur="Validate();" class="form-control input-sm" id="attrdate" name="attrdate" placeholder="Date" type="date" required disabled>
                      </div>
                    </div>
                  </div>
                 <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="name">Reason:</label>
                       <select OnBlur="Validate();" class="form-control input-sm" name="attreason" id="attreason" disabled>
                         <?php 
                      global $mydb;
                      $mydb->setQuery("SELECT ATTRNAME_R FROM `tblattrition_r`");
                      $cur = $mydb->loadResultList();
                      $output .= '<option value="..">Select Attrition Reason</option>';
                      foreach ($cur as $prov) {
                           $output .= '<option value="'. $prov->ATTRNAME_R.'">'.$prov->ATTRNAME_R.'</option>';
                        }
                        echo $output;
                      ?>
                     </select>          
                      </div>
                    </div>
                  </div>
            <button class="btn btn-primary btn-block" id="save" name="save" type="submit" disabled><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
        </form>          
      </div>
    </div>
  </div>
 