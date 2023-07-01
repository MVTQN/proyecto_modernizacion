<?php
header("X-XSS-Protection: 1; mode=block");//reflected Cross Site Scripting attack
//header("content-security-policy: default-src 'self'; img-src https://*; child-src 'none';");
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

    <link href="<?php echo WEB_ROOT; ?>vendor/skin/main.css" rel="stylesheet">
    <link href="<?php echo WEB_ROOT; ?>vendor/skin/style.css" rel="stylesheet"> 
    <script src="<?php echo WEB_ROOT; ?>charts/Chart.min.js"></script>
	<script src="<?php echo WEB_ROOT; ?>js/base64.js"></script>

    <script>
	function Item_Exists(q, r, s, t){
		var jqxhr = $.ajax('<?php echo WEB_ROOT; ?>include/process.php?a1='+q+'&a2='+r+'&a3='+s)
		.done(function(result) {
		if(result>0){
			$(t).focus();
			$("#save").prop('disabled', true);
			$("#mess").text("This item already exists!!!");
			$("#mess").show();
			return true;
		}else{
			$("#save").prop('disabled', false);
			$("#mess").text("");
			$("#mess").hide();
			return false;
		}
		})
		.fail(function() {
			$("#mess").text("We had problems processing this query...");
			$("#save").prop('disabled', false);
			$("#mess").show();
			return false;
		})
		.always(function() {
		//customize if you need
		});
  }

'use strict';

window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(106, 186, 137)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

(function(global) {
	var MONTHS = [
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December'
	];

	var COLORS = [
		'#4dc9f6',
		'#f67019',
		'#f53794',
		'#537bc4',
		'#acc236',
		'#166a8f',
		'#00a950',
		'#58595b',
		'#8549ba'
	];

	var Samples = global.Samples || (global.Samples = {});
	var Color = global.Color;

	Samples.utils = {
		srand: function(seed) {
			this._seed = seed;
		},

		rand: function(min, max) {
			var seed = this._seed;
			min = min === undefined ? 0 : min;
			max = max === undefined ? 1 : max;
			this._seed = (seed * 9301 + 49297) % 233280;
			return min + (this._seed / 233280) * (max - min);
		},

		numbers: function(config) {
			var cfg = config || {};
			var min = cfg.min || 0;
			var max = cfg.max || 1;
			var from = cfg.from || [];
			var count = cfg.count || 8;
			var decimals = cfg.decimals || 8;
			var continuity = cfg.continuity || 1;
			var dfactor = Math.pow(10, decimals) || 0;
			var data = [];
			var i, value;

			for (i = 0; i < count; ++i) {
				value = (from[i] || 0) + this.rand(min, max);
				if (this.rand() <= continuity) {
					data.push(Math.round(dfactor * value) / dfactor);
				} else {
					data.push(null);
				}
			}

			return data;
		},

		labels: function(config) {
			var cfg = config || {};
			var min = cfg.min || 0;
			var max = cfg.max || 100;
			var count = cfg.count || 8;
			var step = (max - min) / count;
			var decimals = cfg.decimals || 8;
			var dfactor = Math.pow(10, decimals) || 0;
			var prefix = cfg.prefix || '';
			var values = [];
			var i;

			for (i = min; i < max; i += step) {
				values.push(prefix + Math.round(dfactor * i) / dfactor);
			}

			return values;
		},

		months: function(config) {
			var cfg = config || {};
			var count = cfg.count || 12;
			var section = cfg.section;
			var values = [];
			var i, value;

			for (i = 0; i < count; ++i) {
				value = MONTHS[Math.ceil(i) % 12];
				values.push(value.substring(0, section));
			}

			return values;
		},

		color: function(index) {
			return COLORS[index % COLORS.length];
		},

		transparentize: function(color, opacity) {
			var alpha = opacity === undefined ? 0.5 : 1 - opacity;
			return Color(color).alpha(alpha).rgbString();
		}
	};

	// DEPRECATED
	window.randomScalingFactor = function() {
		return Math.round(Samples.utils.rand(-100, 100));
	};

	// INITIALIZATION
	Samples.utils.srand(Date.now());

}(this));
</script>

</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <!-- Añadiendo Header -->
        <?php include("nav.php"); ?>
        <!-- Body -->
        <div class="app-main">
            <!--Slide Bar -->
            <div class="app-sidebar sidebar-shadow">
                <div class="scrollbar-sidebar">
                    <?php  include("menu.php"); ?>               
                </div>
            </div>
            <!--Main-->
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        
                <!--Content-->
                        <?php  check_message();  ?>   
                        <?php require_once $content; ?> 
                        <div class="row">
                            <div class="scroll-area-sm">
                                <div class="scrollbar-container">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>       
    </div>
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
	
	<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">::</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
            <div class="modal-body">
			<iframe style="width: 100%;border: 0px solid white;" src="start.php" id="myFrame" name="myFrame"></iframe>
			</div>
                <div class="modal-footer">
                    <button id="close-modal" name="close-modal" class="btn btn-secondary" type="button" data-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>


    <script src="<?php echo WEB_ROOT; ?>vendor/jquery/jquery.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo WEB_ROOT; ?>js/sb-admin.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo WEB_ROOT; ?>vendor/datatables/dataTables.bootstrap4.js"></script>
    <!--<script src="<?php //echo WEB_ROOT; ?>vendor/chart.js/Chart.min.js"></script>-->
     <!-- Custom scripts for this page-->
    <script src="<?php echo WEB_ROOT; ?>js/sb-admin-datatables.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>js/sb-admin-charts.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>js/canvasjs.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>vendor/skin/scripts/main.js"></script>
</body>
</html>
