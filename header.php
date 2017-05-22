<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BootNagios</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <script type="text/JavaScript">
		var timer = function() {
		  window.location.reload(true);
		};
		var timeout = setTimeout(timer, 15000);
</script>

  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<?php
		//$delay=5; //Where 0 is an example of time Delay you can use 5 for 5 seconds for example !
		//header("Refresh: $delay;"); 
		include 'fonction.php';
		$Chemin_XML = 'config.xml';
		$Fichier_XML = simplexml_load_file($Chemin_XML);
		$livestatus=$Fichier_XML->livestatus->data;

		
		
		//==================
		// Status Host
		//==================
			$tmp_TblHostdown = shell_exec('echo "GET hosts\nColumns: host_name state last_check last_time_up address\nFilter: state = 1\nFilter: acknowledged = 0\nSeparators: 59 59\n" | unixcat '.$livestatus);
			$Tbl_HostDown = explode(";", $tmp_TblHostdown);
			$Nbr_TblHostDown=count($Tbl_HostDown);
			$Nbr_TblHostDown--;

		//	***///*** Nouveau compteur Service
		$CptService = shell_exec('echo "GET services\nStats: state = 0\nStats: state = 1\nStats: state = 2\nStats: state = 3\nStats: acknowledged = 1" | unixcat '.$livestatus);
		$TblService = explode(";",$CptService);
		//	***///*** Nouveau compteur Host
		$CptHost = shell_exec('echo "GET hosts\nStats: state = 0\nStats: state = 1\nStats: state = 2\nStats: state = 3\nStats: acknowledged = 1" | unixcat '.$livestatus);
		$TblHost = explode(";",$CptHost);
		//==================
		// Status Services
		//==================
		$tmp_TblSvcWarCri = shell_exec('echo "GET services\nColumns: host_name description state plugin_output last_check last_time_ok\nFilter: state > 0\nFilter: acknowledged = 0\nSeparators: 59 59\n" | unixcat '.$livestatus);
		$TblSvcWarCri = explode(";", $tmp_TblSvcWarCri);
		$Nbr_TblSvcWarCri=count($TblSvcWarCri);
		$Nbr_TblSvcWarCri--;
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>L</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Boot</b>Nagios</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/BootNagios.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Profil Utilisateur</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/BootNagios.png" class="img-circle" alt="User Image">

                <p>
                  Pas encore developpe
                  <small>Peut etre plus tard</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>

      </div>
    </nav>
  </header>