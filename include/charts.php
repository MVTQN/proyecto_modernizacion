<?php
class myChart {

    public function __construct($canvas, $title) {
        $this->canvas = $canvas;
        $this->title = $title;
    }

    public function draw_BarsChart($barLabels, $data, $stacked) {
        $template = '
        <script>
		var barChartData = {labels: '.$this->createLabelList($barLabels).', datasets: ['.$this->createOptionList($data, 1).']};
		
			var ctx = document.getElementById(\''.$this->canvas.'\').getContext(\'2d\');
			window.myBar = new Chart(ctx, {
				type: \'bar\',
                data: barChartData,
				options: {
					title: {
						display: true,
						text: \''.$this->title.'\'
					},
					tooltips: {
						mode: \'index\',
						intersect: false
					},
					responsive: true,
					scales: {xAxes: [{stacked: '.$stacked.', }], yAxes: [{stacked: '.$stacked.'}]
					}
				}
			});
	</script>';
    echo $template;
    }

    public function draw_LinesChart($barLabels, $data, $stacked) {
        $template = '
        <script>
		var barChartData = {labels: '.$this->createLabelList($barLabels).', datasets: ['.$this->createOptionList($data, 2).']};
		
			var ctx = document.getElementById(\''.$this->canvas.'\').getContext(\'2d\');
			window.myBar = new Chart(ctx, {
				type: \'line\',
                data: barChartData,
				options: {
					title: {
						display: true,
						text: \''.$this->title.'\'
					},
					tooltips: {
						mode: \'index\',
						intersect: false
                    },
                    hover: {
                        mode: \'nearest\',
                        intersect: true
                    },
                    responsive: true,
					scales: {xAxes: [{display: true, stacked: '.$stacked.', }], yAxes: [{stacked: '.$stacked.'}]
					}
				}
            });
            
	</script>';
    echo $template;
    }

    public function draw_PieChart($data) {
        $template = '
        <script>
		var config = {type: \'pie\',
			data: {datasets: [{
				data: '.$this->createPieList($data, 2).',
				backgroundColor: '.$this->createPieColors($data, 1).',
				label: \'Dataset 1\'
			}],
			labels: '.$this->createPieLabels($data, 0).'
			},
			options: {responsive: true}
        };
            var ctx = document.getElementById(\''.$this->canvas.'\').getContext(\'2d\');
			window.myPie = new Chart(ctx, config);
	    </script>';
        echo $template;
    }

    public function draw_DashboardBox($width, $height, $color, $title, $comment, $value){
        $template = '<div class="card mb-3 widget-content '.$color.'"  style="width: '.$width.'px;height: '.$height.'px;">
        <div class="widget-content-wrapper text-white">
          <div class="widget-content-left">
              <div class="widget-heading">'.$title.'</div>
              <div class="widget-subheading">'.$comment.'</div>
          </div>
          <div class="widget-content-right">
            <div class="widget-numbers text-white"><span>'.$value.'</span></div>
          </div>
            </div>
         </div>';
         echo $template;
    }

    public function draw_CleanBox($width, $height, $color, $title, $comment, $value){
        $template = '<div class="card mb-3 widget-content" style="width: '.$width.'px;height: '.$height.'px;">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading" style="color: #333333;">'.$title.'</div>
                                <div class="widget-subheading" style="color: #333333;">'.$comment.'</div>
                            </div>
                             <div class="widget-content-right">
                                <div class="widget-numbers" style="color: '.$color.'"><span>'.$value.'</span></div>
                             </div>
                            </div>
                    </div>';
         echo $template;
    }

    public function draw_PercentageBox($width, $height, $color, $title, $value){
        $template = '<div class="card-shadow-info mb-3 widget-chart widget-chart2 text-left card" style="width: '.$width.'px;height: '.$height.'px;">
        <div class="widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left pr-2 fsize-1">
                        <div class="widget-numbers mt-0 fsize-3 text-info">'.$value.'%</div>
                    </div>
                    <div class="widget-content-right w-100">
                        <div class="progress-bar-xs progress">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="'.$value.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$value.'%;"></div>
                        </div>
                    </div>
                </div>
                <div class="widget-content-left fsize-1">
                    '.$title.'
                </div>
            </div>
        </div>
    </div>';
         echo $template;
    }

    protected function createLabelList($barLabels){
        $labelsString ="[";
        for($x=0;$x<=count($barLabels)-1;$x++){
            $labelsString .= '\''.$barLabels[$x].'\', ';
        }
        $labelsString = substr($labelsString, 0, -2);
        $labelsString .="]";
        return $labelsString;
    }

    protected function createPieList($varLabels, $index){
        $labelsString ="[";
        for($x=0;$x<=count($varLabels)-1;$x++){
            $labelsString .= ''.$varLabels[$x][$index].', ';
        }
        $labelsString = substr($labelsString, 0, -2);
        $labelsString .="]";
        return $labelsString;
    }

    protected function createPieLabels($varLabels, $index){
        $labelsString ="[";
        for($x=0;$x<=count($varLabels)-1;$x++){
            $labelsString .= '\''.$varLabels[$x][$index].'\', ';
        }
        $labelsString = substr($labelsString, 0, -2);
        $labelsString .="]";
        return $labelsString;
    }

    protected function createPieColors($varLabels, $index){
        $labelsString ="[";
        for($x=0;$x<=count($varLabels)-1;$x++){
            $labelsString .= 'window.chartColors.'.$varLabels[$x][$index].', ';
        }
        $labelsString = substr($labelsString, 0, -2);
        $labelsString .="]";
        return $labelsString;
    }

    protected function createDataList($barLabels, $label, $type){
        $tags = explode("[*]", $label);
        $tail="";
        if($type==1){$tail="";}elseif($type==2){$tail="fill: false,";}
        $labelsString ="{ label: '".$tags[0]."', ".$tail." borderColor: window.chartColors.".$tags[1].", backgroundColor: window.chartColors.".$tags[1].", data: [";
        for($x=1;$x<=count($barLabels)-1;$x++){
            $labelsString .= $barLabels[$x].', ';
        }
        $labelsString = substr($labelsString, 0, -2);
        $labelsString .="]}, ";
        return $labelsString;
    }

    protected function createOptionList($barOptions, $type){
       $datalist = "";
        for($x=0;$x<=count($barOptions)-1;$x++){
            $datalist .= $this->createDataList($barOptions[$x], $barOptions[$x][0], $type);
        }
        $datalist = substr($datalist, 0, -2);
        return $datalist;
    }
}
?>