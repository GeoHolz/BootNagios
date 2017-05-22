<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vue global
        <small>des problémes</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Charts</a></li>
        <li class="active">Flot</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="row">
    
        <div class="col-md-2">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="glyphicon glyphicon-th-list"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Global</span>
              <span class="info-box-number"><?php echo $TblHost[0]+$TblHost[1]+$TblHost[2]+$TblHost[3]; ?> hôtes</span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo Pourcentage($TblHost[0],$TblHost[0]+$TblHost[1]+$TblHost[2]+$TblHost[3]) ?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo Pourcentage($TblHost[0],$TblHost[0]+$TblHost[1]+$TblHost[2]+$TblHost[3]) ?> % sont UPs
                  </span>
            </div>
            <!-- /.info-box-content -->
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Hôtes UP <span class="pull-right badge bg-green"><?php echo $TblHost[0]; ?></span></a></li>
                <li><a href="#">Hôtes Down <span class="pull-right badge bg-red"><?php echo $TblHost[1]; ?></span></a></li>
				<li><a href="#">Services Ok <span class="pull-right badge bg-green"><?php echo $TblService[0]; ?></span></a></li>
                <li><a href="#">Services Warning <span class="pull-right badge bg-orange"><?php echo $TblService[1]; ?></span></a></li>
                <li><a href="#">Services Critical <span class="pull-right badge bg-red"><?php echo $TblService[2]-$TblService[4]; ?></span></a></li>
                <li><a href="#">Services Unknow <span class="pull-right badge bg-white"><?php echo $TblService[3]; ?></span></a></li>
				<li><a href="#">Services Acknowledge <span class="pull-right badge bg-white"><?php echo $TblService[4]; ?></span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.info-box -->
        </div>
		<div class="col-md-6">
          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Liens internet</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		  </div>
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>	

	</div>
	<div class="row">

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
<!-- ChartJS 1.0.1 -->
<script src="plugins/chartjs/Chart.min.js"></script>
<?php 
		//==================
		// Status Services
		//==================
		$hostname="FO";
		$service="Trafic";
		$tmp_HostSrv = shell_exec('echo "GET services\nColumns: perf_data\nFilter: host_name = '.$hostname.'\nFilter: display_name = '.$service.'\nSeparators: 124 124\n" | unixcat '.$livestatus);
		//echo $tempoo."\n\n"; //DEBUG
		$TblHostSrv = explode("|", $tmp_HostSrv);
		$Nbr_HostSrv=count($TblHostSrv);
		$Nbr_HostSrv--;
		$PerfData = $TblHostSrv[0];
	
		$regex="#'[^0]*'=#mi";
		$PerfData = preg_replace_callback($regex,"fEspace",$PerfData);
		$Tbl_PerfData = explode(" ",$PerfData);
		
		$tmp_Down = explode(";",$Tbl_PerfData[0]);
		$tmp2_Down = explode("=",$tmp_Down[0]);
		$var_Down=str_replace("%","",$tmp2_Down[1]);
		
		$tmp_Up = explode(";",$Tbl_PerfData[1]);
		$tmp2_Up = explode("=",$tmp_Up[0]);
		$var_Up=str_replace("%","",$tmp2_Up[1]);
		
?>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
	 var areaChartData = {
      labels: ["FO Marseillaise", "February", "March", "April", "May", "June", "July"],
      datasets: [
        {
          label: "Download",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [<?php echo $var_Down; ?>, 59, 80, 81, 56, 55, 40]
        },
        {
          label: "Upload",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [<?php echo $var_Up; ?>, 48, 40, 19, 86, 27, 90]
        }
      ]
    };

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[1].fillColor = "#00a65a";
    barChartData.datasets[1].strokeColor = "#00a65a";
    barChartData.datasets[1].pointColor = "#00a65a";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
</script>
</body>
</html>
