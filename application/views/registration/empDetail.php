<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Employee Detail
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Home</li>
				<li>Employee</li>
				<li class="active">Detail</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<?php 
				if (is_array($dataEmpDetail)) {
					foreach($dataEmpDetail['data'] as $item){ 
						?>
						<div class="col-md-4">
							<div class="box box-danger">
								<div class="box-body" align="center">
									<img src="<?php echo file_exists(jarvis_call_configuration('savedPhoto').$item['p_image']) == '1' ? base_url().jarvis_call_configuration('pathPhoto').$item['p_image'] : base_url().jarvis_call_configuration('pathAvatar').jarvis_call_configuration('defaultAva'); ?>" width="175" class="img-circle">
								</div><!-- /.box-body -->
							</div><!-- /.box -->
						</div>
						<div class="col-md-8">
							<div class="box box-success">
								<div class="box-header">
									<h3 class="box-title">Personal Info</h3>
								</div>
								<div class="box-body">
									<dl>
                                        <dt>Nama</dt>
                                        <dd><?php echo $item['p_name'];?></dd>
                                        <dd>&nbsp;</dd>
                                        <dt>Tempat Lahir</dt>
                                        <dd><?php echo $item['p_plzbirth'];?></dd>
                                        <dd>&nbsp;</dd>
                                        <dt>Tanggal Lahir</dt>
                                        <dd><?php echo $item['p_birthdate'];?></dd>
                                        <dd>&nbsp;</dd>
                                        <dt>Tingkat</dt>
                                        <dd><?php echo $item['jjo_name'];?></dd>
                                    </dl>
								</div><!-- /.box-body -->
							</div><!-- /.box -->
						</div>
						<?php
						} 
					}
				?>
			</div>
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
