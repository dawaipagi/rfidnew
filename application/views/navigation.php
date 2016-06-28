<body class="<?php echo jarvis_echo($layout,'skin_page').' '.jarvis_echo($layout,'layout_page');?>">
<!-- header logo: style can be found in header.less -->
<header class="header">
	<a href="<?php echo base_url().'dashboard'?>" class="logo">
		<!-- Add the class icon to your logo image or logo icon to add the margining -->
		<?php echo jarvis_call_configuration('sitename');?>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		<div style="position:absolute; z-index:999999; width:100px; background-color:red; margin-right:auto; margin-left:auto;">
		
		</div>
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="glyphicon glyphicon-user"></i>
						<span><?php echo get_data_user('name'); ?> <i class="caret"></i></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li id="naviJarvis" class="user-header <?php echo (jarvis_echo($layout,'skin_page') == 'skin-black') ? 'bg-black' : 'bg-light-blue';?>">
							<img src="<?php echo base_url().jarvis_call_configuration('pathAvatar').get_data_user('avatar');?>" class="img-circle" alt="User Image" />
							<p>
								<?php echo get_data_user('name'); ?> - <?php echo get_data_user('group'); ?>
								<small>Member since <?php echo date('M. Y', strtotime(get_data_user('c_created'))); ?></small>
							</p>
						</li>
						<!-- Menu Body -->
						<!-- <li class="user-body">
							<div class="col-xs-4 text-center">
								<a href="#">Followers</a>
							</div>
							<div class="col-xs-4 text-center">
								<a href="#">Sales</a>
							</div>
							<div class="col-xs-4 text-center">
								<a href="#">Friends</a>
							</div>
						</li> -->
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="<?php echo base_url().'profile/account';?>" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
								<a href="<?php echo base_url().'logout';?>" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>

