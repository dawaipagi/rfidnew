<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<?php 
		$dataForm=array(
			'add'=>array(
				'title'=>'Tambah',
				'url'=>'admin/manageLoco/add',
				'set_value'=>array(
					'jp_name'=>''
					),
				'form_active'=>array(
					'jp_name'=>true
					)
				),
			'edit'=>array(
				'title'=>'Sunting',
				'url'=>'admin/manageLoco/edit/'.uri_segment(4),
				'set_value'=>array(
					'jp_name'=>isset($dataLocoEdit) ? jarvis_echo($dataLocoEdit,'jp_name') : ''
					),
				'form_active'=>array(
					'jp_name'=>true
					)
				));
		?>
		<section class="content-header">
			<h1>
				Lokomotif
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Komponen Data</li>
				<li>Lokomotif</li>
				<li class="active"><?php echo $dataForm[$key_action]['title']; ?></li>
			</ol>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-body table-responsive">
							<?php echo form_open($dataForm[$key_action]['url']); ?>
								<div class="box-body">
								<?php if($dataForm[$key_action]['form_active']['jp_name']==true) { ?>
									<div class="form-group">
										<label for="Module">Lokomotif (*)</label>
										<input type="text" value="<?php echo set_value('jp_name',$dataForm[$key_action]['set_value']['jp_name']); ?>" class="form-control" name="jp_name" placeholder="Enter Locomotive" style="height: 29px;">
										<?php echo form_error('jp_name','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
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
