<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Dinas Sosial | Karanganyar</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?=base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?=base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?=base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url();?>assets/dist/css/adminlte.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?=base_url();?>assets/dist/css/skins/_all-skins.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

	<!-- Google Font -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="<?=base_url();?>assets/index2.html" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>D</b>S</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Dinas</b>Sosial</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
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
								<img src="<?=base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
								<span class="hidden-xs"><?=$this->session->userdata('name');?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="<?=base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

									<p>
										<?=$this->session->userdata('name');?>
										<small><?=$this->session->userdata('alamat');?></small>
									</p>
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="#" class="btn btn-default btn-flat">Settings</a>
									</div>
									<div class="pull-right">
										<a href="<?=site_url('auth/logout')?>" class="btn btn-danger btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<!-- =============================================== -->

		<!-- Left side column. contains the sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?=base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p><?=$this->session->userdata('name');?></p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>

				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>

                    <li <?=$this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"' : ''?>>
                        <a href="<?=site_url('dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
					</li>

                    <!-- <li <?=$this->uri->segment(1) == 'manage' || $this->uri->segment(1) == '' ? 'class="active"' : ''?>>
                        <a href="<?=site_url('manage');?>"><i class="fa fa-pencil"></i> <span>Manage</span></a>
					</li>

                    <li class="header">LAPORAN</li>

                    <li class="treeview <?=$this->uri->segment(1) == 'laporan' ? 'active' : ''?>">
						<a href="#">
							<i class="fa fa-book"></i>
							<span>Laporan PBI-KIS</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li <?=$this->input->get('jenis') == 'sangat_miskin' || $this->input->get('jenis') == '' ? 'class="active"' : ''?>>
								<a href="<?=site_url('laporan');?>?jenis=sangat_miskin"><i class="fa fa-book"></i> Laporan Sangat Miskin</a>
							</li>
							<li <?=$this->input->get('jenis') == 'miskin' || $this->input->get('jenis') == '' ? 'class="active"' : ''?>>
								<a href="<?=site_url('laporan');?>?jenis=miskin"><i class="fa fa-book"></i> Laporan Miskin</a>
							</li>
							<li <?=$this->input->get('jenis') == 'hampir_miskin' || $this->input->get('jenis') == '' ? 'class="active"' : ''?>>
								<a href="<?=site_url('laporan');?>?jenis=hampir_miskin"><i class="fa fa-book"></i> Laporan Hampir Miskin</a>
							</li>
							<li <?=$this->input->get('jenis') == 'mampu' || $this->input->get('jenis') == '' ? 'class="active"' : ''?>>
								<a href="<?=site_url('laporan');?>?jenis=mampu"><i class="fa fa-book"></i> Laporan Mampu</a>
							</li>
						</ul>
					</li> -->

					<?php if($this->session->userdata('level') == 1){ ?>
                    <li class="header">SETTINGS</li>

                    <li <?=$this->uri->segment(1) == 'user' || $this->uri->segment(1) == '' ? 'class="active"' : ''?>>
                        <a href="<?=site_url('user');?>"><i class="fa fa-users"></i> <span>Users</span></a>
					</li>
					<!-- <li <?=$this->uri->segment(1) == 'cloud_storrage' || $this->uri->segment(1) == '' ? 'class="active"' : ''?>>
                        <a href="<?=site_url('cloud_storrage');?>"><i class="fa fa-users"></i> <span>Minio</span></a>
					</li> -->
					<?php } ?>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- =============================================== -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<?=$title?>
					<small><?=$description?></small>
				</h1>
			</section>

			<!-- Main content -->
			<section class="content">
            
            <!-- jQuery 3 -->
            <script src="<?=base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
			<script src="<?=base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
			<script src="<?=base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>	
            <?= $this->load->view($content);?>

			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 2.4.0
			</div>
			<strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
			reserved.
		</footer>

		<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- Bootstrap 3.3.7 -->
	<script src="<?=base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- SlimScroll -->
	<script src="<?=base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?=base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?=base_url();?>assets/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?=base_url();?>assets/dist/js/demo.js"></script>
	<script>
		$(document).ready(function () {
			$('.sidebar-menu').tree()
		})

	</script>
</body>

</html>
