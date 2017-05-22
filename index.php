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
        <div class="col-md-10">
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
					<?php			for($i=0;$i<$Nbr_TblHostDown;$i=$i+5)
									{ ?>
										<tr>
											<?php $LastCheck_TblHostDown=humanTiming($Tbl_HostDown[$i+2]); ?>
											<?php $LastTimeOk_TblHostDown=humanTiming($Tbl_HostDown[$i+3]); ?>
											<td><?php echo $LastCheck_TblHostDown; ?></td>
											<td> <a href="host_status.php?host=<?php echo $Tbl_HostDown[$i]; ?>"><?php echo $Tbl_HostDown[$i]; ?></a></td>
											<td><?php echo $Tbl_HostDown[$i+4]; ?></td>											
											<td><?php if ($Tbl_HostDown[$i+1] == 2) : ?>
											<span class="label label-warning">Warning</span>
											<?php elseif($Tbl_HostDown[$i+1] == 1) : ?>
											<span class="label label-danger">Down</span>
											<?php else : ?>
											<span class="label label-warning">Ack</span>
											<?php endif; ?></td>
											<td><?php echo $LastTimeOk_TblHostDown; ?></td>
										</tr>
					<?php			}  ?>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-2">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="glyphicon glyphicon-th-list"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Hôtes</span>
              <span class="info-box-number"><?php echo $TblHost[0]+$TblHost[1]+$TblHost[2]+$TblHost[3]; ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo Pourcentage($TblHost[0],$TblHost[0]+$TblHost[1]+$TblHost[2]+$TblHost[3]) ?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo Pourcentage($TblHost[0],$TblHost[0]+$TblHost[1]+$TblHost[2]+$TblHost[3]) ?>% UPs
                  </span>
            </div>
            <!-- /.info-box-content -->
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">UP <span class="pull-right badge bg-green"><?php echo $TblHost[0]; ?></span></a></li>
                <li><a href="#">Down <span class="pull-right badge bg-red"><?php echo $TblHost[1]; ?></span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.info-box -->
        </div>
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>	

	</div>
	<div class="row">
        <div class="col-md-10">
          <div class="box box-solid box-success">
            <div class="box-header">
              <h3 class="box-title">Services en état Warning et Critical</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
				<tr>
                  <th>Last Check</th>				
                  <th>Host</th>
                  <th>Service</th>
                  <th>State</th>
                  <th>Output</th>
				  <th>Duration</th>
                </tr>
			
					<!-- Debut tableau dynamique -->
					<?php			for($i=0;$i<$Nbr_TblSvcWarCri;$i=$i+6)
									{ ?>
										<tr>
											<?php $LastCheck_TblSvcWarCri=humanTiming($TblSvcWarCri[$i+4]); ?>
											<?php $LastTimeOk_TblSvcWarCri=humanTiming($TblSvcWarCri[$i+5]); ?>
											<td><?php echo $LastCheck_TblSvcWarCri; ?></td>
											<td> <a href="host_status.php?host=<?php echo $TblSvcWarCri[$i]; ?>"><?php echo $TblSvcWarCri[$i]; ?></a></td>
											<td><a href="service_status.php?host=<?php echo $TblSvcWarCri[$i]; ?>&service=<?php echo $TblSvcWarCri[$i+1]; ?>"><?php echo $TblSvcWarCri[$i+1]; ?></a></td>
											<td><?php if ($TblSvcWarCri[$i+2] == 1) : ?>
											<span class="label label-warning">Warning</span>
											<?php elseif($TblSvcWarCri[$i+2] == 2) : ?>
											<span class="label label-danger">Critical</span>
											<?php else : ?>
											<span class="label label-warning">Ack</span>
											<?php endif; ?></td>
											<td><?php echo $TblSvcWarCri[$i+3]; ?></td>
											<td><?php echo $LastTimeOk_TblSvcWarCri; ?></td>
										</tr>
					<?php			}  ?>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-2">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="glyphicon glyphicon-cog"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Services</span>
              <span class="info-box-number"><?php echo $TblService[0]+$TblService[1]+$TblService[2]+$TblService[3]; ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo Pourcentage($TblService[0],$TblService[0]+$TblService[1]+$TblService[2]+$TblService[3]) ?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo Pourcentage($TblService[0],$TblService[0]+$TblService[1]+$TblService[2]+$TblService[3]) ?>% OKs
                  </span>
            </div>
            <!-- /.info-box-content -->
		            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Ok <span class="pull-right badge bg-green"><?php echo $TblService[0]; ?></span></a></li>
                <li><a href="#">Warning <span class="pull-right badge bg-orange"><?php echo $TblService[1]; ?></span></a></li>
                <li><a href="#">Critical <span class="pull-right badge bg-red"><?php echo $TblService[2]-$TblService[4]; ?></span></a></li>
                <li><a href="#">Unknow <span class="pull-right badge bg-white"><?php echo $TblService[3]; ?></span></a></li>
				<li><a href="#">Acknowledge <span class="pull-right badge bg-white"><?php echo $TblService[4]; ?></span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.info-box -->
        </div>
	</div>
	<div class="row">
		<?php 
		

		$tmp_NbrIndex=$Fichier_XML->livestatus->data; 
		
		
		?>
		<!-- Debut tableau dynamique -->
		<?php	
		
			foreach($Fichier_XML->index as $index)
			{  ?>										
			<div class="col-md-6">
			  <div class="box box-success box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title"><?php echo $index->name;?></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<img src="<?php echo $index->url; ?>" >
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
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="plugins/flot/jquery.flot.categories.min.js"></script>
<!-- Page script -->

</body>
</html>
