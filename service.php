<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Liste des services
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
        <div class="col-md-12">
          <div class="box box-solid box-info" >
            <div class="box-header bg-green">
              <h3 class="box-title ">Services</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
				<tr>
                  <th>Last Check</th>				
                  <th>Host</th>
				  <th>State</th>
				  <th>Service</th>
				  <th>Output</th>
				  <th>Duration</th>
                </tr>
					<!-- Debut tableau dynamique -->
					<?php			
							//==================
							// Liste Hôtes
							//==================
							$lsthosttmp = shell_exec('echo "GET hosts\nColumns: host_name\nSeparators: 59 59\n" | unixcat '.$livestatus);
							//echo $tempoo."\n\n"; //DEBUG
							$lsthost = explode(";", $lsthosttmp);
							$nbrhost=count($lsthost);
							$nbrhost--;
									for($i=0;$i<$nbrhost;$i=$i+1)
									{ 
														$tmp_TblSvcHost = shell_exec('echo "GET services\nColumns: description state plugin_output last_check last_time_ok\nFilter: host_name = '.$lsthost[$i].'\nSeparators: 59 59\n" | unixcat '.$livestatus);
														$Tbl_SvcHost = explode(";", $tmp_TblSvcHost);
														$Nbr_TblSvcHost=count($Tbl_SvcHost);
														$Nbr_TblSvcHost--;
														
														for($j=0;$j<$Nbr_TblSvcHost;$j=$j+5)
														{ 	?>
															<tr>
																<?php $LastCheck_SvcHost=humanTiming($Tbl_SvcHost[$j+3]); ?>
																<?php $LastTimeOk_SvcHost=humanTiming($Tbl_SvcHost[$j+4]); ?>
																<td><?php echo $LastCheck_SvcHost; ?></td>
																<td><a href="host_status.php?host=<?php echo $lsthost[$i]; ?>"><?php echo $lsthost[$i]; ?></a></td>
																<td>
																<?php switch($Tbl_SvcHost[$j+1]): case 0 : ?>
																<span class="label label-success">OK</span>
																<?php break; case 1 : ?>
																<span class="label label-warning">Warning</span>
																<?php break; case 2 : ?>
																<span class="label label-danger">Critical</span>
																<?php break; case 3 : ?>
																<span class="label label-danger">Critical</span>
																<?php break; endswitch; ?></td>
																<td><a href="service_status.php?host=<?php echo $lsthost[$i]; ?>&service=<?php echo $Tbl_SvcHost[$j]; ?>"><?php echo $Tbl_SvcHost[$j]; ?></a></td>
																<td><?php echo $Tbl_SvcHost[$j+2]; ?></td>
																<td><?php echo $LastTimeOk_SvcHost; ?></td>
															</tr>
													<?php			}  ?>
															
														
														
														
														
														
					<?php			}  ?>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>	

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
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="plugins/flot/jquery.flot.categories.min.js"></script>
<!-- Page script -->

</body>
</html>
