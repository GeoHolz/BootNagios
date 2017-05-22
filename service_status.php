<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<?php $hostname = $_GET['host'];
	  $service = $_GET['service'];?>
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $service; ?>
        <small><?php echo $hostname; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Charts</a></li>
        <li class="active">Flot</li>
      </ol>
    </section>
<?php
		//==================
		// Status Services
		//==================
		$tmp_HostSrv = shell_exec('echo "GET services\nColumns: description state plugin_output last_check last_state_change check_period perf_data\nFilter: host_name = '.$hostname.'\nFilter: display_name = '.$service.'\nSeparators: 124 124\n" | unixcat '.$livestatus);
		//echo $tempoo."\n\n"; //DEBUG
		$TblHostSrv = explode("|", $tmp_HostSrv);
		$Nbr_HostSrv=count($TblHostSrv);
		$Nbr_HostSrv--;
		$PerfData = $TblHostSrv[6];
		if($PerfData == "")
		{
			$Nbr_PerfData=0;
			$Tbl_PerfData = $PerfData;
		}
		else{
		
		$regex="#'[^0]*'=#mi";
		$PerfData = preg_replace_callback($regex,"fEspace",$PerfData);
		$Tbl_PerfData = explode(" ",$PerfData);
		$Nbr_PerfData = count($Tbl_PerfData);}

		//==================
		// Host Info
		//==================
		$tmp_HostInfo = shell_exec('echo "GET hosts\nColumns: state plugin_output last_check last_state_change address contacts groups check_period\nFilter: host_name = '.$hostname.'\nSeparators: 59 59\n" | unixcat '.$livestatus);
		//echo $tempoo."\n\n"; //DEBUG
		$TblHostInfo = explode(";", $tmp_HostInfo);
		
		$URL_PNP=$Fichier_XML->PNP->url;
?>
    <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="col-md-6">
          <div class="box box-solid box-success">
            <div class="box-header">
              <h3 class="box-title">Résumé</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
					<tr>
						<td>Status</td>
						<td>				<?php switch($TblHostSrv[1]): case 0 : ?>
											<span class="label label-success">OK</span>
											<?php break; case 1 : ?>
											<span class="label label-warning">Warning</span>
											<?php break; case 2 : ?>
											<span class="label label-danger">Critical</span>
											<?php break; case 3 : ?>
											<span class="label label-danger">Critical</span>
											<?php break; endswitch; ?>

						depuis <?php echo humanTiming($TblHostSrv[4]); ?> </td>
					</tr>
					<tr>
						<td>Host name</td>
						<td><a href="host_status.php?host=<?php echo $hostname; ?>"><?php echo $hostname; ?></a></td>
					</tr>
					<tr>
						<td>Host address</td>
						<td><?php echo $TblHostInfo[4]; ?></td>
					</tr>
					<tr>
						<td>Service name</td>
						<td><?php echo $service; ?></td>
					</tr>
					<tr>
						<td>Check Output</td>
						<td><?php echo $TblHostSrv[2]; ?></td>
					</tr>	
					<tr>
						<td>Check period</td>
						<td><?php echo $TblHostSrv[5]; ?></td>
					</tr>					
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
          <div class="box box-solid box-success">
            <div class="box-header">
              <h3 class="box-title">Perf Data : <?php echo $TblHostSrv[6]; ?> </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
					<tr>
					  <th>label</th>				
					  <th>value</th>
					  <th>warn</th>
					  <th>crit</th>
					  <th>min</th>
					  <th>max</th>
					</tr>
					<!-- Debut tableau dynamique -->
					<?php			for($i=0;$i<$Nbr_PerfData;$i++)
									{ 									
										$tmp_PerfData = explode(";",$Tbl_PerfData[$i]);
										$tmp2_PerfData = explode("=",$tmp_PerfData[0]);
								?>
										<tr>
											<td><?php echo $tmp2_PerfData[0]; ?></td>
											<td><?php echo $tmp2_PerfData[1]; ?></td>
											<td><?php if (isset($tmp_PerfData[1])){echo $tmp_PerfData[1];} ?></td>
											<td><?php if (isset($tmp_PerfData[2])){echo $tmp_PerfData[2];} ?></td>
											<td><?php if (isset($tmp_PerfData[3])){echo $tmp_PerfData[3];} ?></td>
											<td><?php if (isset($tmp_PerfData[4])){echo $tmp_PerfData[4];}?></td>
										</tr>
					<?php			}  ?>					
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
	</div>	
	<div class="row">
	<!-- Debut tableau dynamique -->
	<?php	for($i=0;$i<$Nbr_PerfData;$i++)
		{  ?>										
        <div class="col-md-6">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">PNP4Nagios PerfData[<?php echo $i; ?>]</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<img src="<?php echo $URL_PNP; ?>/image?host=<?php echo $hostname; ?>&srv=<?php echo $service; ?>&view=0&source=<?php echo $i; ?>" >
			</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

	<?php			}  ?>	
	</div>
    </section>
    <!-- /.content -->
</div>


  <!-- /.content-wrapper -->
<?php include 'footer.php' ?>

<?php include 'aside.php' ?>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- FLOT CHARTS -->
<script src="plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="plugins/flot/jquery.flot.pie.min.js"></script>
<script src="plugins/knob/jquery.knob.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="plugins/flot/jquery.flot.categories.min.js"></script>
<!-- Page script -->
<script>
  $(function () {
    /* jQueryKnob */

    $(".knob").knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a = this.angle(this.cv)  // Angle
              , sa = this.startAngle          // Previous start angle
              , sat = this.startAngle         // Start angle
              , ea                            // Previous end angle
              , eat = sat + a                 // End angle
              , r = true;

          this.g.lineWidth = this.lineWidth;

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3);

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value);
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3);
            this.g.beginPath();
            this.g.strokeStyle = this.previousColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
            this.g.stroke();
          }

          this.g.beginPath();
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
          this.g.stroke();

          this.g.lineWidth = 2;
          this.g.beginPath();
          this.g.strokeStyle = this.o.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
          this.g.stroke();

          return false;
        }
      }
    });
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
    $(".sparkline").each(function () {
      var $this = $(this);
      $this.sparkline('html', $this.data());
    });

    /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
    drawDocSparklines();
    drawMouseSpeedDemo();

  });
  function drawDocSparklines() {

    // Bar + line composite charts
    $('#compositebar').sparkline('html', {type: 'bar', barColor: '#aaf'});
    $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        {composite: true, fillColor: false, lineColor: 'red'});


    // Line charts taking their values from the tag
    $('.sparkline-1').sparkline();

    // Larger line charts for the docs
    $('.largeline').sparkline('html',
        {type: 'line', height: '2.5em', width: '4em'});

    // Customized line chart
    $('#linecustom').sparkline('html',
        {
          height: '1.5em', width: '8em', lineColor: '#f00', fillColor: '#ffa',
          minSpotColor: false, maxSpotColor: false, spotColor: '#77f', spotRadius: 3
        });

    // Bar charts using inline values
    $('.sparkbar').sparkline('html', {type: 'bar'});

    $('.barformat').sparkline([1, 3, 5, 3, 8], {
      type: 'bar',
      tooltipFormat: '{{value:levels}} - {{value}}',
      tooltipValueLookups: {
        levels: $.range_map({':2': 'Low', '3:6': 'Medium', '7:': 'High'})
      }
    });

    // Tri-state charts using inline values
    $('.sparktristate').sparkline('html', {type: 'tristate'});
    $('.sparktristatecols').sparkline('html',
        {type: 'tristate', colorMap: {'-2': '#fa7', '2': '#44f'}});

    // Composite line charts, the second using values supplied via javascript
    $('#compositeline').sparkline('html', {fillColor: false, changeRangeMin: 0, chartRangeMax: 10});
    $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        {composite: true, fillColor: false, lineColor: 'red', changeRangeMin: 0, chartRangeMax: 10});

    // Line charts with normal range marker
    $('#normalline').sparkline('html',
        {fillColor: false, normalRangeMin: -1, normalRangeMax: 8});
    $('#normalExample').sparkline('html',
        {fillColor: false, normalRangeMin: 80, normalRangeMax: 95, normalRangeColor: '#4f4'});

    // Discrete charts
    $('.discrete1').sparkline('html',
        {type: 'discrete', lineColor: 'blue', xwidth: 18});
    $('#discrete2').sparkline('html',
        {type: 'discrete', lineColor: 'blue', thresholdColor: 'red', thresholdValue: 4});

    // Bullet charts
    $('.sparkbullet').sparkline('html', {type: 'bullet'});

    // Pie charts
    $('.sparkpie').sparkline('html', {type: 'pie', height: '1.0em'});

    // Box plots
    $('.sparkboxplot').sparkline('html', {type: 'box'});
    $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
        {type: 'box', raw: true, showOutliers: true, target: 6});

    // Box plot with specific field order
    $('.boxfieldorder').sparkline('html', {
      type: 'box',
      tooltipFormatFieldlist: ['med', 'lq', 'uq'],
      tooltipFormatFieldlistKey: 'field'
    });

    // click event demo sparkline
    $('.clickdemo').sparkline();
    $('.clickdemo').bind('sparklineClick', function (ev) {
      var sparkline = ev.sparklines[0],
          region = sparkline.getCurrentRegionFields();
      value = region.y;
      alert("Clicked on x=" + region.x + " y=" + region.y);
    });

    // mouseover event demo sparkline
    $('.mouseoverdemo').sparkline();
    $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
      var sparkline = ev.sparklines[0],
          region = sparkline.getCurrentRegionFields();
      value = region.y;
      $('.mouseoverregion').text("x=" + region.x + " y=" + region.y);
    }).bind('mouseleave', function () {
      $('.mouseoverregion').text('');
    });
  }

  /**
   ** Draw the little mouse speed animated graph
   ** This just attaches a handler to the mousemove event to see
   ** (roughly) how far the mouse has moved
   ** and then updates the display a couple of times a second via
   ** setTimeout()
   **/
  function drawMouseSpeedDemo() {
    var mrefreshinterval = 500; // update display every 500ms
    var lastmousex = -1;
    var lastmousey = -1;
    var lastmousetime;
    var mousetravel = 0;
    var mpoints = [];
    var mpoints_max = 30;
    $('html').mousemove(function (e) {
      var mousex = e.pageX;
      var mousey = e.pageY;
      if (lastmousex > -1) {
        mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
      }
      lastmousex = mousex;
      lastmousey = mousey;
    });
    var mdraw = function () {
      var md = new Date();
      var timenow = md.getTime();
      if (lastmousetime && lastmousetime != timenow) {
        var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
        mpoints.push(pps);
        if (mpoints.length > mpoints_max)
          mpoints.splice(0, 1);
        mousetravel = 0;
        $('#mousespeed').sparkline(mpoints, {width: mpoints.length * 2, tooltipSuffix: ' pixels per second'});
      }
      lastmousetime = timenow;
      setTimeout(mdraw, mrefreshinterval);
    };
    // We could use setInterval instead, but I prefer to do it this way
    setTimeout(mdraw, mrefreshinterval);
  }
</script>
</body>
</html>