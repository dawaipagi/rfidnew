<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Pemberitahuan
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-dashboard"></i> Beranda</li>
			<li class="active">Pemberitahuan</li>
		</ol>
	</section>
	
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			<div class="box-header">
				<h3 class="box-title"></h3>
			</div><!-- /.box-header -->
			<div class="box-body" style="padding-bottom:1px;">
				<div class="alert alert-success alert-dismissable">
					<i class="fa fa-check"></i>
					<a href="<?php echo base_url().$urlAlert?>" class="close">&times;</a>
					<b>Alert!</b> <?php echo $msgAlert?>.
				</div>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</section><!-- /.content -->
	
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
