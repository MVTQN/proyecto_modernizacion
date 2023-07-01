<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Vacation application.">
    <meta name="msapplication-tap-highlight" content="no">

    <title><?php echo $title; ?></title>
  <!--
    <link href="<?php echo WEB_ROOT; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="<?php echo WEB_ROOT; ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link href="<?php echo WEB_ROOT; ?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    
    <link href="<?php echo WEB_ROOT; ?>css/sb-admin.css" rel="stylesheet">
-->
    <link href="<?php echo WEB_ROOT; ?>vendor/skin/main.css" rel="stylesheet">
    <link href="<?php echo WEB_ROOT; ?>vendor/skin/style.css" rel="stylesheet"> 

</head>
<body>
    
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <!-- Header -->
        <?php include("nav.php"); ?>
        <!-- Body -->
        <div class="app-main">
            <!--Slide Bar -->
            <div class="app-sidebar sidebar-shadow">
                <div id="description" class="scrollbar-sidebar">
                    <?php  include("menu.php"); ?>
                </div>
            </div>
            <!--Main-->
            <div class="app-main__outer">
                <!--Content-->

                <?php   check_message();  ?>   
                <?php require_once $content; ?> 

                <!--Footer-->
                <div class="app-main__inner">
                    <?php include("footer.php");?>
                </div>
            </div>
        </div>
    </div>  

    <!-- Logout Modal-->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="<?php echo WEB_ROOT; ?>/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
  <!--  
    <script src="<?php echo WEB_ROOT; ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="<?php echo WEB_ROOT; ?>js/sb-admin.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo WEB_ROOT; ?>vendor/datatables/dataTables.bootstrap4.js"></script>
 
    <script src="<?php echo WEB_ROOT; ?>vendor/chart.js/Chart.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>js/sb-admin-datatables.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>js/sb-admin-charts.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>js/canvasjs.min.js"></script>
  -->
   <!-- <script type="text/javascript">
        $(document).on('click', '.delete', function(){
            var id = $(this).attr("id");
            if(confirm("Are you sure you want to delete this record?")){
            }else{
                return false; 
            }
        });

    </script>
-->
  <!--  <script src="<?php echo WEB_ROOT; ?>vendor/skin/scripts/script.js"></script>-->
    <script src="<?php echo WEB_ROOT; ?>vendor/skin/scripts/main.js"></script>

</body>
</html>
