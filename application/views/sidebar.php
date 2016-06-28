<div class="wrapper row-offcanvas row-offcanvas-left">
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="left-side sidebar-offcanvas">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo base_url().jarvis_call_configuration('pathAvatar').get_data_user('avatar');?>" class="img-circle" alt="User Image" />
				</div>
				<div class="pull-left info">
					<p>Hello, <?php echo get_data_user('username')?></p>

					<a href="#"><i class="fa fa-circle text-success"></i> <?php echo $userData['is_online']?></a>
				</div>
			</div>
			<!-- search form -->
			<!--
			<form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Search..."/>
					<span class="input-group-btn">
						<button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</form>
			-->
			<!-- /.search form -->
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu">
				<li class="<?php if(uri_segment(1)=="dashboard"){ echo"active"; } ?>">
					<a href="<?php echo base_url().'dashboard';?>">
						<i class="fa fa-dashboard"></i> <span>Dashboard</span>
					</a>
				</li>
				<?php echo add_sidebar($sidebar); ?>
			</ul>
		</section>
		<!-- /.sidebar -->
	</aside>
