<?php
 /* Open Required Header in all scripts */
    $pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
    $toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
    if(!isset($security_included)){require($toRoot."include/security.php");}
    require($toRoot."include/config.php");
    Secure::session_verify($toRoot);
/* Close Required Header in all scripts */
?>
<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $title; ?></title>
    <meta name="description" content="Management System">

    <link href="<?php echo $toRoot; ?>vendor/skin/main.css" rel="stylesheet">
    <link href="<?php echo $toRoot; ?>vendor/skin/style.css" rel="stylesheet"> 
    <script src="<?php echo $toRoot; ?>charts/Chart.min.js"></script>
<title>Search</title>
<script type="text/javascript">
 function pAppr(){
     var radioValue = $("input[name='Lstatus']:checked").val();
     var txt = $("#comments").val(); 
     parent.setAPPR(radioValue, txt);
     window.parent.$('#close-modal').click();
 }

 // OnClick="parent.t('holii');"
</script>
</head>
<body>
<div class="form-group">

  
 <input type="radio" id="Lstatus" name="Lstatus" value="APPROVED" checked>&nbsp;
  <label for="male">Approved</label>&nbsp;&nbsp;&nbsp;
  <input type="radio" id="Lstatus" name="Lstatus" value="REJECTED">&nbsp;
  <label for="female">Rejected</label>&nbsp;&nbsp;&nbsp;
  <input type="radio" id="Lstatus" name="Lstatus" value="PENDING">&nbsp;
  <label for="female">Pending</label>&nbsp;&nbsp;&nbsp;
  <button OnClick="pAppr();" type="button" class="btn btn-primary" style="float: right;" data-dismiss="modal">Apply</button>
 <br><br>
 
    <textarea class="form-control input-sm" rows="2" style="width: 100%;" name="comments" id="comments"></textarea>
  <script src="<?php echo WEB_ROOT; ?>vendor/jquery/jquery.min.js"></script>
    <!-- Custom scripts for all pages-->
</div>  
<script type="text/javascript">
$('#aaa').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        execs();
    }
    event.stopPropagation();
 });

 function execs(){
        var op = $( "#select1 option:selected" ).val();
        SearchName('#results', op);  
 }
</script>
    <script src="<?php echo WEB_ROOT; ?>vendor/skin/scripts/main.js"></script>
</body>
</html>