<?php  
  /* Open Required Header in all scripts */
    $pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
    $toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
    if(!isset($security_included)){require($toRoot."include/security.php");}
    Secure::session_verify($toRoot);
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

    $Attr = New  Attr();
    $l = $Attr->single_Attr($atID);
?> 
<div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Update Attrition</div>
      <div class="card-body"> 
        <form  action="controller.php?ax=2" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Employee Id:</label>
                <input name="ATTRID" type="hidden" value="<?php echo $l->ATTRID; ?>">
                <input class="form-control input-sm" id="attrempcode" name="attrempcode" placeholder="Employee ID" type="text" value="<?php echo $l->ATTREMPCODE; ?>" readonly>
              </div>
            </div>
          </div>          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Employee Name:</label>
                <input class="form-control input-sm" id="attrempname" name="attrempname" placeholder="Employee Name" type="text" value="<?php echo $l->ATTREMPNAME; ?>" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Attr Date:</label>
                <input class="form-control input-sm" id="attrdate" name="attrdate" placeholder="Date" type="date" value="<?php echo $l->ATTRDATE; ?>" required>
              </div>
            </div>
          </div>     
          <div class="form-group">
            <div class="form-row">
              <div class="col-md">
                <label for="name">Reasons:</label>
                  <select class="form-control input-sm" name="attreason" id="attreason">
                    <option value="<?php echo $l->ATTREASON; ?>"><?php echo $l->ATTREASON; ?></option>
                      <?php 
                          global $mydb;
                          $mydb->setQuery("SELECT ATTRNAME_R FROM `tblattrition_r`");
                          $cur = $mydb->loadResultList();
                          foreach ($cur as $prov) {
                          $output .= '<option value="'. $prov->ATTRNAME_R.'">'.$prov->ATTRNAME_R.'</option>';
                          }
                          echo $output;
                      ?>
                  </select>          
                </div>
              </div>
            </div>         
            <button class="btn btn-primary btn-block" id="save" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save </button>
        </form>
      </div>
    </div>
  </div>
</div>