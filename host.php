<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Liste des hôtes
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Charts</a></li>
        <li class="active">Flot</li>
      </ol>
    </section>
<?php			
							//==================
							// Liste Hôtes
							//==================
							$tmp_LstHost = shell_exec('echo "GET hosts\nColumns: host_name state last_check last_time_up address\nSeparators: 59 59\n" | unixcat '.$livestatus);
							//echo $tempoo."\n\n"; //DEBUG
							$Lst_Host = explode(";", $tmp_LstHost);
							$Nbr_LstHost=count($Lst_Host);
							$Nbr_LstHost--;
?>
    <!-- Main content -->
    <section class="content">
	<div class="row">
        <div class="col-md-12">
          <div class="box box-solid box-info" >
            <div class="box-header">
              <h3 class="box-title">Hôtes down</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
				<tr>
                  <th>Last Check</th>				
                  <th>Host</th>
				  <th>Address</th>
                  <th>State</th>
				  <th>Duration</th>
                </tr>
					<!-- Debut tableau dynamique -->					
					<?php
									for($i=0;$i<$Nbr_LstHost;$i=$i+5)
									{ ?>
										<tr>
											<?php $LastCheck_LstHost=humanTiming($Lst_Host[$i+2]); ?>
											<?php $LastTimeOk_LstHost=humanTiming($Lst_Host[$i+3]); ?>
											<td><?php echo $LastCheck_LstHost; ?></td>
											<td> <a href="host_status.php?host=<?php echo $Lst_Host[$i]; ?>"><?php echo $Lst_Host[$i]; ?></a></td>
											<td><?php echo $Lst_Host[$i+4]; ?></td>											
											<td><?php if ($Lst_Host[$i+1] == 0) : ?>
											<span class="label label-success">UP</span>
											<?php elseif($Lst_Host[$i+1] == 1) : ?>
											<span class="label label-danger">Down</span>
											<?php else : ?>
											<span class="label label-warning">Ack</span>
											<?php endif; ?></td>
											<td><?php echo $LastTimeOk_LstHost; ?></td>
										</tr>
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
