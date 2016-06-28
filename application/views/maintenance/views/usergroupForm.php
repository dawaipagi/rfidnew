<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<?php 
		$dataForm=array(
			'add'=>array(
				'title'=>'Tambah',
				'url'=>'maintenance/manageUG/add',
				'set_value'=>array(
					'id'=>'',
					'group'=>'',
					'avatar'=>'',
					'show'=>''
					),
				'form_active'=>array(
					'id'=>true,
					'group'=>true,
					'avatar'=>true,
					'show'=>(get_data_user('ref_group_user')=='J1' or get_data_user('ref_group_user')=='J4' ? true : false)
					)
				),
			'edit'=>array(
				'title'=>'Sunting',
				'url'=>'maintenance/manageUG/edit/'.uri_segment(4),
				'set_value'=>array(
					'id'=>isset($dataGroupEdit) ? jarvis_echo($dataGroupEdit,'id') : '',
					'group'=>isset($dataGroupEdit) ? jarvis_echo($dataGroupEdit,'group') : '',
					'avatar'=>isset($dataGroupEdit) ? jarvis_echo($dataGroupEdit,'avatar') : '',
					'show'=>isset($dataGroupEdit) ? jarvis_echo($dataGroupEdit,'show') : ''
					),
				'form_active'=>array(
					'id'=>false,
					'group'=>true,
					'avatar'=>true,
					'show'=>(get_data_user('ref_group_user')=='J1' or get_data_user('ref_group_user')=='J4' ? true : false)
					)
				));
		?>
		<section class="content-header">
			<h1>
				User Group
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Pemeliharaan</li>
				<li>User Group</li>
				<li class="active"><?php echo $dataForm[$key_action]['title']; ?></li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-body table-responsive">
							<?php echo form_open_multipart($dataForm[$key_action]['url']); ?>
								<div class="box-body">
									<?php if($dataForm[$key_action]['form_active']['id']==true) { ?>
										<div class="form-group">
											<label for="Username">ID (*)</label>
											<input type="text" value="<?php echo set_value('id',$dataForm[$key_action]['set_value']['id']); ?>" class="form-control" name="id" placeholder="Enter ID" style="height: 29px;">
											<?php echo form_error('id','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
										</div>
									<?php } ?>
									<?php if($dataForm[$key_action]['form_active']['group']==true) { ?>
										<div class="form-group">
											<label for="Username">Nama Group (*)</label>
											<input type="text" value="<?php echo set_value('group',$dataForm[$key_action]['set_value']['group']); ?>" class="form-control" name="group" placeholder="Enter Group" style="height: 29px;">
											<?php echo form_error('group','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
										</div>
									<?php } ?>
									<?php if($dataForm[$key_action]['form_active']['avatar']==true) { ?>
										<div class="form-group">
											<label for="Username">Avatar (*)</label>
											<?php
											foreach($avatarParameter['data'] as $avatar) {
												echo "<dd><label><input type='radio' name='avatar' ".($avatar['parameter']==$dataForm[$key_action]['set_value']['avatar'] ? 'checked=checked' : '' )." value='".$avatar['parameter']."'/><img src='".base_url().jarvis_call_configuration('pathAvatar').$avatar['parameter']."' width='50'/></label></dd>";
											}
											?>
											<?php echo form_error('avatar','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
										</div>
									<?php } ?>
									<?php if($dataForm[$key_action]['form_active']['show']==true) { ?>
										<div class="form-group">
											<label for="Description">Tampilkan</label>
											<select class="form-control" name="show" style="height: 29px;">
												<?php foreach($statusParameter['data'] as $status) {?>
													<option value="<?php echo $status['parameter'];?>" <?php if($status['parameter']==$dataForm[$key_action]['set_value']['show']) { $selected=true; } else { $selected=false; } echo set_select('show', $status['parameter'],$selected); ?>><?php echo $status['parameter'];?></option>
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
