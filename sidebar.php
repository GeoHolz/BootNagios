  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/BootNagios.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Profil Utilisateur</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
	  <!-- /.search form -->
	     <ul class="sidebar-menu">
			<li class="header">AUTO REFRESH</li>
		</ul>
		<div class="btn-group" style="border-radius:3px;margin:10px 10px">
							  <button type="button" class="btn btn-default" onclick="javascript:var timeout = setTimeout(timer, 15000)"><i class="fa fa-play"></i></button>
							  <button type="button" class="btn btn-default" onclick="javascript:clearTimeout(timeout)"><i class="fa fa-stop"></i></button>

							  <div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								  <span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
								  <li><a href="javascript:var timeout = setTimeout(timer, 10000)">10 seconds</a></li>
								  <li><a href="javascript:var timeout = setTimeout(timer, 30000)">30 seconds</a></li>
								</ul>
							  </div>
		</div>  

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>	
        <li>
          <a href="host.php">
            <i class="glyphicon glyphicon-th-list"></i> <span>Hotes</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red"><?php echo $TblHost[1]; ?></small>
            </span>
          </a>
        </li>	
        <li>
          <a href="service.php">
            <i class="glyphicon glyphicon-cog"></i> <span>Services</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red"><?php echo $TblService[2]-$TblService[4]; ?></small>
              <small class="label pull-right bg-orange"><?php echo $TblService[1]; ?></small>
            </span>
          </a>
        </li>
        <li>
          <a href="nconf.php">
            <i class="glyphicon glyphicon-cog"></i> <span>nConf</span>
          </a>
        </li>
        <li>
          <a href="pnp.php">
            <i class="glyphicon glyphicon-cog"></i> <span>PNP</span>
          </a>
        </li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>