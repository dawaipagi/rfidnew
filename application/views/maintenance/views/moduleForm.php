<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<?php 
		$dataForm=array(
			'add'=>array(
				'title'=>'Tambah',
				'url'=>'maintenance/manageModule/add',
				'set_value'=>array(
					'module'=>'',
					'desc'=>'',
					),
				'form_active'=>array(
					'id'=>true,
					'module'=>true,
					'desc'=>true,
					)
				),
			'edit'=>array(
				'title'=>'Sunting',
				'url'=>'maintenance/manageModule/edit/'.uri_segment(4),
				'set_value'=>array(
					'module'=>isset($dataModuleEdit) ? jarvis_echo($dataModuleEdit,'module') : '',
					'desc'=>isset($dataModuleEdit) ? jarvis_echo($dataModuleEdit,'desc') : '',
					),
				'form_active'=>array(
					'id'=>false,
					'module'=>true,
					'desc'=>true,
					)
				));
		?>
		<section class="content-header">
			<h1>
				Module
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Pemeliharaan</li>
				<li>Module</li>
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
								<?php if($dataForm[$key_action]['form_active']['id']==true) { ?>
									<div class="form-group">
										<label for="ID">ID (*)</label>
										<input type="text" value="<?php echo set_value('id'); ?>" class="form-control" name="id" placeholder="Enter ID" style="height: 29px;">
										<?php echo form_error('id','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['module']==true) { ?>
									<div class="form-group">
										<label for="Module">Modul (*)</label>
										<input type="text" value="<?php echo set_value('module',$dataForm[$key_action]['set_value']['module']); ?>" class="form-control" name="module" placeholder="Enter module" style="height: 29px;">
										<?php echo form_error('module','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['desc']==true) { ?>
									<div class="form-group">
										<label for="Description">Deskripsi</label>
										<textarea class="form-control" rows="3" name="desc" placeholder="Enter ..."><?php echo set_value('desc',$dataForm[$key_action]['set_value']['desc']); ?></textarea>
										<?php echo form_error('desc','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
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
