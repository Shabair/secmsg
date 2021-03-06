<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/register_v3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 11:03:50 GMT -->
<head>
	<meta charset="utf-8" />
	<title>Register Page | Secure Message</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/animate.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url();?>assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin register -->
        <div class="register register-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="<?php echo base_url();?>assets/img/login-bg/bg-8.jpg" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><i class="fa fa-edit text-success"></i> Get registered, and Enter to secure world..!!! </h4>
                    <p>
                     By getting registered you will get more enhancing features of secure site, after register get login to our site.   
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">

                <!-- begin register-header -->
                <h1 class="register-header">
                    Sign Up
                    <small>Enter to secure world.</small>
                </h1>
                <!-- end register-header -->
                <!-- begin register-content -->
                <div class="register-content">
                    <form action="<?php echo base_url();?>userpanel/register" method="POST" class="margin-bottom-0" enctype="multipart/form-data">
                        <label class="control-label">Name</label>
                        <div class="row row-space-10">
                            <div class="col-md-6 m-b-15">
                                <input type="text" class="form-control" name="firstname" value="<?php echo set_value('firstname')?>" placeholder="First name" />
                                <?php echo form_error('firstname'); ?>
                            </div>
                            <div class="col-md-6 m-b-15">
                                <input type="text" class="form-control" name="lastname" value="<?php echo set_value('lastname')?>" placeholder="Last name" />
                                <?php echo form_error('lastname'); ?>
                            </div>
                        </div>
                        <label class="control-label">Username</label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="username" value="<?php echo set_value('username')?>" placeholder="Username" />
                                <?php echo form_error('username'); ?>
                            </div>
                        </div>
                        <label class="control-label">Email</label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="email" value="<?php echo set_value('email')?>" placeholder="Email address" />
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <label class="control-label">Password</label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password" placeholder="Password" />
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                        <label class="control-label">Re-Password</label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="repassword" placeholder="Password" />
                                <?php echo form_error('repassword'); ?>
                            </div>
                        </div>
                        <label class="control-label">Profile Image</label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="file" name="profile_img" class="form-control" />
                                <?php echo (isset($file_error))?$file_error:''?>
                            </div>
                        </div>


                        <div class="register-buttons">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40">
                            Already a member? Click <a href="<?php echo base_url();?>userpanel/login">here</a> to login.
                        </div>
                        <hr />
                        <p class="text-center text-inverse">
                            &copy; Secure Message 2017
                        </p>
                    </form>
                </div>
                <!-- end register-content -->
            </div>
            <!-- end right-content -->
        </div>
        <!-- end register -->

        <!-- begin theme-panel -->
        <!-- <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <h5 class="m-t-0">Color Theme</h5>
                <ul class="theme-list clearfix">
                    <li class="active"><a href="javascript:;" class="bg-green" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-black" data-theme="black" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
                </ul>
                <div class="divider"></div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Header Styling</div>
                    <div class="col-md-7">
                        <select name="header-styling" class="form-control input-sm">
                            <option value="1">default</option>
                            <option value="2">inverse</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Header</div>
                    <div class="col-md-7">
                        <select name="header-fixed" class="form-control input-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Styling</div>
                    <div class="col-md-7">
                        <select name="sidebar-styling" class="form-control input-sm">
                            <option value="1">default</option>
                            <option value="2">grid</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Sidebar</div>
                    <div class="col-md-7">
                        <select name="sidebar-fixed" class="form-control input-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Gradient</div>
                    <div class="col-md-7">
                        <select name="content-gradient" class="form-control input-sm">
                            <option value="1">disabled</option>
                            <option value="2">enabled</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Content Styling</div>
                    <div class="col-md-7">
                        <select name="content-styling" class="form-control input-sm">
                            <option value="1">default</option>
                            <option value="2">black</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-12">
                        <a href="#" class="btn btn-inverse btn-block btn-sm" data-click="reset-local-storage"><i class="fa fa-refresh m-r-3"></i> Reset Local Storage</a>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- end theme-panel -->
	</div>
	<!-- end page container -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
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
	<script src="<?php echo base_url();?>assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
	<script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','../../../../www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-53034621-1', 'auto');
      ga('send', 'pageview');
    </script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/register_v3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 11:03:52 GMT -->
</html>
