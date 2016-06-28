<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<?php 
		$dataForm=array(
			'add'=>array(
				'title'=>'Tambah',
				'url'=>'maintenance/manageParameter/add',
				'set_value'=>array(
					'category_parameter'=>'',
					'parameter'=>'',
					'status'=>'',
					),
				'form_active'=>array(
					'category_parameter'=>true,
					'parameter'=>true,
					'status'=>true,
					)
				),
			'edit'=>array(
				'title'=>'Sunting',
				'url'=>'maintenance/manageParameter/edit/'.uri_segment(4),
				'set_value'=>array(
					'category_parameter'=>isset($dataParameterEdit) ? jarvis_echo($dataParameterEdit,'category_parameter') : '',
					'parameter'=>isset($dataParameterEdit) ? jarvis_echo($dataParameterEdit,'parameter') : '',
					'status'=>isset($dataParameterEdit) ? jarvis_echo($dataParameterEdit,'status') : '',
					),
				'form_active'=>array(
					'category_parameter'=>true,
					'parameter'=>true,
					'status'=>true,
					)
				));
		?>
		<section class="content-header">
			<h1>
				Parameter
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Pemeliharaan</li>
				<li>Parameter</li>
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
								<?php if($dataForm[$key_action]['form_active']['category_parameter']==true) { ?>
									<div class="form-group">
										<label for="ID">Kategori (*)</label>
										<input type="text" value="<?php echo set_value('parameter',$dataForm[$key_action]['set_value']['category_parameter']); ?>" class="form-control" name="category_parameter" placeholder="Enter Category" style="height: 29px;">
										<?php echo form_error('category_parameter','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['parameter']==true) { ?>
									<div class="form-group">
										<label for="Module">Parameter (*)</label>
										<input type="text" value="<?php echo set_value('parameter',$dataForm[$key_action]['set_value']['parameter']); ?>" class="form-control" name="parameter" placeholder="Enter Parameter" style="height: 29px;">
										<?php echo form_error('parameter','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['status']==true) { ?>
									<div class="form-group">
										<label for="Description">Status Aktif (*)</label>
										<select class="form-control" name="status" style="height: 29px;">
											<?php foreach($statusParameter['data'] as $status) {?>
												<option value="<?php echo $status['parameter'];?>" <?php if($status['parameter']==$dataForm[$key_action]['set_value']['status']) { $selected=true; } else { $selected=false; } echo set_select('status', $status['parameter'],$selected); ?>><?php echo $status['parameter'];?></option>
											<?php } ?>
										</select>
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
