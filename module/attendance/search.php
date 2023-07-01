<?php
 /* Open Required Header in all scripts */
    $pth1 = explode("/", str_replace("//","", $_SERVER['PHP_SELF']));
    $toRoot ="";for($iii=0;$iii<=count($pth1)-4;$iii++){$toRoot .= "../";}
    if(!isset($security_included)){require($toRoot."include/security.php");}
    require($toRoot."include/config.php");
    Secure::session_verify($toRoot);$tokenPost = Secure::sToken(true);
    $_SESSION['tokenPostSess'] = $tokenPost;
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

function SearchName(b, a){
    var name = $("#aaa").val();
    var jqxhr = $.ajax('ajx_r.php?a1='+name+'&a2='+a+'&b1=<?php echo $tokenPost; ?>')
		.done(function(resultado) {
        $(b).html(resultado);
		})
		.fail(function() {
			$(b).text("");
		})
		.always(function() {
		});
 }

 // OnClick="parent.t('holii');"
</script>
</head>
<body>
<div class="input-group">
<div class="input-group-prepend">
    <select id="select1" name="select1" class="form-control">
        <option value="2">Name</option>
        <option value="1">ID</option>
    </select>
</div><input id="aaa" name="aaa" type="text" class="form-control"><button OnClick="execs();" class="btn btn-secondary">Ok</button>
</div><br>
<div id="results" name="results">
</div>
<script src="<?php echo WEB_ROOT; ?>vendor/jquery/jquery.min.js"></script>
    <!-- Custom scripts for all pages-->
    
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