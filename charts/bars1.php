<?php
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'sysadmin');
    defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'include');
    require("charts.php");	
    require("../include/databaseN.php");
    $mydb1 = new DatabaseN();
?>

<!doctype html>
<html>
<head>
	<title>Stacked Bar Chart</title>
	<link href="http://localhost/sysadmin/vendor/skin/main.css" rel="stylesheet" type="text/css">
	<script src="Chart.min.js"></script>
	<script src="utils.js"></script>
	<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
</head>

<body>
	<div style="width: 50%">
		<canvas id="canvas"></canvas>
	</div>
	<div style="width: 50%">
		<canvas id="chart1"></canvas>
	</div>

	<?php
	$labels[] = "January";
	$labels[] = "February";
	$labels[] = "March";
	$labels[] = "April";
	$labels[] = "May";
	$labels[] = "June";
	$labels[] = "July";

	$data[0][0] = "Active[*]green";
	$data[0][1] = 30;
	$data[0][2] = 10;
	$data[0][3] = 20;
	$data[0][4] = 18;
	$data[0][5] = 20;
	$data[0][6] = 19;
	$data[0][7] = 32;
	$data[1][0] = "Onboarding[*]blue";
	$data[1][1] = 5;
	$data[1][2] = 7;
	$data[1][3] = 5;
	$data[1][4] = 6;
	$data[1][5] = 8;
	$data[1][6] = 4;
	$data[2][0] = "Attrited[*]red";
	$data[2][1] = 10;
	$data[2][2] = 11;
	$data[2][3] = 9;
	$data[2][4] = 8;
	$data[2][5] = 12;
	$data[2][6] = 13;

	$piedata[0][0] ="Data 1";
	$piedata[0][1] ="green";
	$piedata[0][2] ="100";
	$piedata[1][0] ="Data 2";
	$piedata[1][1] ="red";
	$piedata[1][2] ="150";
	$piedata[1][0] ="Data 3";
	$piedata[1][1] ="yellow";
	$piedata[1][2] ="250";
	
		$graphi = new myChart("chart1", "Employee Status");
	//	$graphi->draw_BarsChart($labels, $data, 'true');
		//$graphi->draw_LinesChart($labels, $data, 'true');
		//$graphi->draw_PieChart($piedata);

		//bg-arielle-smile --bg-premium-dark --bg-night-fade
		echo '<div class="row"><div class="col-md-6 col-xl-4">';
		$graphi->draw_CleanBox(220, 70, 'blue', 'Employees', 'Active employees', '17');
		echo '</div></div>';
		
		echo '<div class="row"><div class="col-md-6 col-xl-4">';
		$graphi->draw_PercentageBox(220, 80, 'blue', 'Employees', '87');
		echo '</div></div>';
?>

<div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tabs-eg-77">
                                                <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                                                    <div class="widget-chat-wrapper-outer">
                                                        <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                                            <canvas id="canvas" width="866" height="432" class="chartjs-render-monitor" style="display: block; width: 433px; height: 216px;"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6 class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal">Top Authors</h6>
                                                <div class="scroll-area-sm">
                                                    <div class="scrollbar-container ps ps--active-y">
                                                        <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                                                            <li class="list-group-item">
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-wrapper">
                                                                        <div class="widget-content-left mr-3">
                                                                            <img width="42" class="rounded-circle" src="assets/images/avatars/9.jpg" alt="">
                                                                        </div>
                                                                        <div class="widget-content-left">
                                                                            <div class="widget-heading">Ella-Rose Henry</div>
                                                                            <div class="widget-subheading">Web Developer</div>
                                                                        </div>
                                                                        <div class="widget-content-right">
                                                                            <div class="font-size-xlg text-muted">
                                                                                <small class="opacity-5 pr-1">$</small>
                                                                                <span>129</span>
                                                                                <small class="text-danger pl-2">
                                                                                    <i class="fa fa-angle-down"></i>
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-wrapper">
                                                                        <div class="widget-content-left mr-3">
                                                                            <img width="42" class="rounded-circle" src="assets/images/avatars/5.jpg" alt="">
                                                                        </div>
                                                                        <div class="widget-content-left">
                                                                            <div class="widget-heading">Ruben Tillman</div>
                                                                            <div class="widget-subheading">UI Designer</div>
                                                                        </div>
                                                                        <div class="widget-content-right">
                                                                            <div class="font-size-xlg text-muted">
                                                                                <small class="opacity-5 pr-1">$</small>
                                                                                <span>54</span>
                                                                                <small class="text-success pl-2">
                                                                                    <i class="fa fa-angle-up"></i>
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-wrapper">
                                                                        <div class="widget-content-left mr-3">
                                                                            <img width="42" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                                                                        </div>
                                                                        <div class="widget-content-left">
                                                                            <div class="widget-heading">Vinnie Wagstaff</div>
                                                                            <div class="widget-subheading">Java Programmer</div>
                                                                        </div>
                                                                        <div class="widget-content-right">
                                                                            <div class="font-size-xlg text-muted">
                                                                                <small class="opacity-5 pr-1">$</small>
                                                                                <span>429</span>
                                                                                <small class="text-warning pl-2">
                                                                                    <i class="fa fa-dot-circle"></i>
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-wrapper">
                                                                        <div class="widget-content-left mr-3">
                                                                            <img width="42" class="rounded-circle" src="assets/images/avatars/3.jpg" alt="">
                                                                        </div>
                                                                        <div class="widget-content-left">
                                                                            <div class="widget-heading">Ella-Rose Henry</div>
                                                                            <div class="widget-subheading">Web Developer</div>
                                                                        </div>
                                                                        <div class="widget-content-right">
                                                                            <div class="font-size-xlg text-muted">
                                                                                <small class="opacity-5 pr-1">$</small>
                                                                                <span>129</span>
                                                                                <small class="text-danger pl-2">
                                                                                    <i class="fa fa-angle-down"></i>
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-wrapper">
                                                                        <div class="widget-content-left mr-3">
                                                                            <img width="42" class="rounded-circle" src="assets/images/avatars/2.jpg" alt="">
                                                                        </div>
                                                                        <div class="widget-content-left">
                                                                            <div class="widget-heading">Ruben Tillman</div>
                                                                            <div class="widget-subheading">UI Designer</div>
                                                                        </div>
                                                                        <div class="widget-content-right">
                                                                            <div class="font-size-xlg text-muted">
                                                                                <small class="opacity-5 pr-1">$</small>
                                                                                <span>54</span>
                                                                                <small class="text-success pl-2">
                                                                                    <i class="fa fa-angle-up"></i>
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 139px;"></div></div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

</body>
</html>