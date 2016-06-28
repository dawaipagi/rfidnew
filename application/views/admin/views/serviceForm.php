<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<?php 
		$dataForm=array(
			'add'=>array(
				'title'=>'Tambah',
				'url'=>'admin/manageServ/add',
				'set_value'=>array(
					'jpel_name'=>''
					),
				'form_active'=>array(
					'jpel_name'=>true
					)
				),
			'edit'=>array(
				'title'=>'Sunting',
				'url'=>'admin/manageServ/edit/'.uri_segment(4),
				'set_value'=>array(
					'jpel_name'=>isset($dataServEdit) ? jarvis_echo($dataServEdit,'jpel_name') : ''
					),
				'form_active'=>array(
					'jpel_name'=>true
					)
				));
		?>
		<section class="content-header">
			<h1>
				Pelayanan
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Komponen Data</li>
				<li>Pelayanan</li>
				<li class="active"><?php echo $dataForm[$key_action]['title']; ?></li>
			</ol>
		</section>
		
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-body table-responsive">
							<?php echo form_open($dataForm[$key_action]['url']); ?>
								<div class="box-body">
								<?php if($dataForm[$key_action]['form_active']['jpel_name']==true) { ?>
									<div class="form-group">
										<label for="Module">Pelayanan (*)</label>
										<input type="text" value="<?php echo set_value('jpel_name',$dataForm[$key_action]['set_value']['jpel_name']); ?>" class="form-control" name="jpel_name" placeholder="Enter Service Name" style="height: 29px;">
										<?php echo form_error('jpel_name','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<div class="form-group">
									<p class="help-block">(*) <?php echo jarvis_call_configuration('required_label');?></p>
								</div>
								</div><!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-primary btn-sm"><?php echo jarvis_call_configuration('save_button');?></button>
									<?php echo jarvis_back_button(2);?>
								</div>
							<?php echo form_close();?>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>

		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
