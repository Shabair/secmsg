<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:50:18 GMT -->
<?php $controller = $this->uri->segment(1); ?>
<?php $method = $this->uri->segment(2); ?>
<head>
	<meta charset="utf-8" />
	<title><?php echo $title;?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/animate.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="<?php echo base_url();?>assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
	<!-- <link href="<?php echo base_url();?>assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" /> -->
  <link href="<?php echo base_url();?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
  <!-- <link href="<?php echo base_url();?>assets/plugins/bootstrap-secdatetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" /> -->

	<!-- ==========================DashBoard Data================================ -->
	<link href="<?php echo base_url();?>assets/plugins/switch/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" />

	<!-- ==========================DashBoard Data End================================ -->
	<!-- composer page -->
	<link href="<?php echo base_url();?>assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet" />
	<!-- composer page -->


	<!-- ================== END PAGE LEVEL STYLE ================== -->
	<link href="<?php echo base_url();?>assets/plugins/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap3-editable/inputs-ext/address/address.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap3-editable/inputs-ext/typeaheadjs/lib/typeahead.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins//bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" />

	<?php //if($controller == 'timeline'){ ?>
		<link href="<?php echo base_url();?>assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
	<?php // } ?>
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>

	<?php
	$user_login = $this->session->userdata('user_login');

	?>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-inverse navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="<?php echo base_url();?>" class="navbar-brand"><span class="navbar-logo"></span> Secure Message</a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->

				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li>
            <a href="<?php echo base_url("timeline")?>">
                <!-- <img src="assets/img/user-13.jpg" alt="" />  -->
                <span class="hidden-xs">My TimeLine</span>
            </a>
	        </li>
					<!-- <li>
						<form class="navbar-form full-width">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Enter keyword" />
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li> -->
					<?php if($user_login['userType'] == 'local'):?>
					<li>
						<a href="<?php echo base_url();?>Userpanel/login">Login</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>Userpanel/register">Register</a>
					</li>
					<?php endif;?>
					<!-- <li class="dropdown">
						<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
							<i class="fa fa-bell-o"></i>
							<span class="label">5</span>
						</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown">
                            <li class="dropdown-header">Notifications (5)</li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><i class="fa fa-bug media-object bg-red"></i></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Server Error Reports</h6>
                                        <div class="text-muted f-s-11">3 minutes ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><img src="assets/img/user-1.jpg" class="media-object" alt="" /></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">John Smith</h6>
                                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                        <div class="text-muted f-s-11">25 minutes ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><img src="assets/img/user-2.jpg" class="media-object" alt="" /></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Olivia</h6>
                                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                        <div class="text-muted f-s-11">35 minutes ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><i class="fa fa-plus media-object bg-green"></i></div>
                                    <div class="media-body">
                                        <h6 class="media-heading"> New User Registered</h6>
                                        <div class="text-muted f-s-11">1 hour ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><i class="fa fa-envelope media-object bg-blue"></i></div>
                                    <div class="media-body">
                                        <h6 class="media-heading"> New Email From John</h6>
                                        <div class="text-muted f-s-11">2 hour ago</div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-footer text-center">
                                <a href="javascript:;">View more</a>
                            </li>
						</ul>
					</li> -->
					<?php if($user_login['userType'] != 'local'):?>
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?php echo base_url('uploads/users/').$user_login['profile_img'];?>" alt="" />
							<span class="hidden-xs"><?php echo $user_login['firstname']." ".$user_login['lastname']?></span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="<?php echo base_url('userpanel/profile')?>">Edit Profile</a></li>
							
							
							<?php if(getUser('type') != 'pro'):?>
								<li style="background-color: #FFD700"><a href="<?php echo base_url().'payment/'?>"><i class="glyphicon glyphicon-star-empty"></i> Get Pro</a></li>
							<?php endif; ?>
							<li class="divider"></li>
							<li><a href="<?php echo base_url();?>userpanel/logout">Log Out</a></li>
						</ul>
					</li>
					<?php endif;?>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->

		<!-- begin #sidebar -->
		<?php //include "includes/sidebar.php"; ?>
		<!-- end #sidebar -->

		<!-- main content -->


				<!-- begin #content -->
		<div id="content" class="content" style="margin-left: 20px;">
			<!-- begin breadcrumb -->
			<!-- <ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li class="active">Dashboard</li>
			</ol> -->
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<!-- <h1 class="page-header">Secure Message</h1> -->
			<!-- end page-header -->
			<!-- <?php if(!empty($this->session->flashdata('success'))):?>
			<div class="alert alert-dismissible alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Congrats</strong> <?php echo $this->session->flashdata('success')?>
			</div>
			<?php endif; ?> -->
			<!-- end row -->
			<!-- begin row -->
			<?php if(!empty($error)): ?>
				<div class="alert alert-dismissible alert-danger">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>Oh snap!</strong> <a href="#" class="alert-link"><?php echo $error?>
				</div>
			<?php endif; ?>
		<?php $this->load->view($view); ?>


				</div>
		<!-- end #content -->

		<!-- end of main content -->
        <!-- begin theme-panel -->
       
        <!-- end theme-panel -->

		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->

	<script src="<?php echo base_url();?>assets/plugins/pace/pace.min.js"></script>

	<!-- ================== BEGIN BASE JS ================== -->

	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="<?php echo base_url();?>assets/crossbrowserjs/html5shiv.js"></script>
		<script src="<?php echo base_url();?>assets/crossbrowserjs/respond.min.js"></script>
		<script src="<?php echo base_url();?>assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo base_url();?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<?php //if($files == 'dashboard'){ ?>
	<script src="<?php echo base_url();?>assets/js/ckeditor/ckeditor.js"></script>
	<script src="<?php echo base_url();?>assets/js/ckfinder/ckfinder.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/switch/js/bootstrap-switch.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/sparkline/jquery.sparkline.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<!-- <script src="<?php echo base_url();?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script> -->
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	 <script src="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/moment.js"></script>
	<!-- <script src="<?php echo base_url();?>assets/plugins/bootstrap-secdatetimepicker/js/bootstrap-datetimepicker.min.js"></script> -->
	 <script src="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo base_url();?>assets/js/dashboard.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/moment/moment.min.js"></script>
	<?php //} ?>

	<!-- compose  page-->
	<script src="<?php echo base_url();?>assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
	<script src="<?php echo base_url();?>assets/js/email-compose.demo.min.js"></script>
	<!-- compose page end -->
	<!-- ================== END PAGE LEVEL JS ================== -->
	<?php //if($method == 'profile'){ ?>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap3-editable/inputs-ext/typeaheadjs/lib/typeahead.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap3-editable/inputs-ext/typeaheadjs/typeaheadjs.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap3-editable/inputs-ext/wysihtml5/wysihtml5.js"></script>
	<?php //} ?>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script src="<?php echo base_url();?>assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<?php //if($controller == 'timeline'){ ?>
		<script src="<?php echo base_url();?>assets/js/inbox.demo.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/moment.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/bootstrap-secdatetimepicker/js/bootstrap-datetimepicker.min.js"></script>



	<?php //} ?>
	<script>
		$(document).ready(function() {
			App.init();
			<?php //if($files == 'dashboard'){ ?>
			Dashboard.init();
			<?php //} ?>
			<?php if($controller == 'timeline'){ ?>
			Inbox.init();
			<?php } ?>
			//composer page
			EmailCompose.init();

		});
	</script>

    <script type="text/javascript">
	    <?php if(!empty($this->session->flashdata('success'))):?>
			setTimeout(function () {
				$.gritter.add({
					title: "Congrats",
					text: '<?php echo $this->session->flashdata('success')?>',
					image: "<?php echo base_url('assets/img/markef6df.gif')?>",
					sticky: true,
					time: "",
					class_name: "my-sticky-class"
				});
			}, 1e3);
		<?php endif; ?>

    </script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-106513495-1', 'auto');
	  ga('send', 'pageview');

	</script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:53:52 GMT -->
</html>
