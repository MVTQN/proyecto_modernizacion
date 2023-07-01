<?php
  if(!isset($ainit_included)){
    require("include/ainit.php");
  } 

  if(!isset($security_included)){
    require("include/security.php");
  }

  if(!isset($config_included)){
    require("include/config.php");
  }
  if(!isset($error_handlig_included)){
    require("include/error_handling.php");
  }
  if(!isset($session_included)){
    require("include/session.php");
  }
  if(!isset($member_included)){
    require("include/member.php");
  }

  if(logged_in()==true){
    redirect("index.php");
  }

if(isset($_POST['btnLogin'])){
    $email = trim($_POST['user_email']);
    $upass  = trim($_POST['user_pass']);
    $h_upass = sha1($upass);
  
   if ($email == '' OR $upass == '') {
      message("Invalid Username and/or Password!", "error");
      redirect("login.php");
    }else{
      $user = new User();
      $res = $user::AuthenticateUser($email, $h_upass);
      if ($res==true) {
        message("You logon as ".$_SESSION['EMPPOSITION'].".","success");
        //if ($_SESSION['EMPPOSITION']=='Administrator' || $_SESSION['EMPPOSITION']=='Normal user'){
          $_SESSION['EMPID']        = $_SESSION['EMPID'];
          $_SESSION['EMPNAME']       = $_SESSION['EMPNAME'] ;
          $_SESSION['USERNAME']     = $_SESSION['USERNAME'];
          $_SESSION['EMPPOSITION']  = $_SESSION['EMPPOSITION'];
          $_SESSION['EMPLOYID']     = $_SESSION['EMPLOYID'];
          $_SESSION['COMPANY']      = $_SESSION['COMPANY'];
          $_SESSION['DEPARTMENT']   = $_SESSION['DEPARTMENT']; 
          $_SESSION['STRDATE']      = $_SESSION['STRDATE'];
          $_SESSION['IDENTIFICATION'] = $_SESSION['IDENTIFICATION'];
          $_SESSION['EMPSTATUS']    = $_SESSION['EMPSTATUS'];   
          redirect(WEB_ROOT."index.php");
          exit();
        //}   
      }else{
        message("Invalid Username and/or Password!", "error");
        redirect("login.php");
        exit();
      }
    }
 }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo $AppTitle; ?></title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
          <?php check_message(); ?>
      <form action="login.php" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">User</label>
            <input class="form-control" id="exampleInputEmail1" name="user_email" type="text" aria-describedby="emailHelp" placeholder="Enter user" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" name="user_pass" type="password" placeholder="Password">
          </div>
          
        
           <input class="btn btn-primary btn-block" type="submit" name="btnLogin" value="Login" />
           <!--<a class="btn btn-warning btn-block" name="btnreset" href="reset.php">Reset Password</a> -->
        </form>
       
      </div>
    </div>
  </div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>
<?php
  
?>
  


