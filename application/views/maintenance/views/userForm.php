<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<?php 
		$dataForm=array(
			'add'=>array(
				'title'=>'Tambah',
				'url'=>'maintenance/manageUser/add',
				'set_value'=>array(
					'username'=>'',
					'password'=>'',
					'name'=>'',
					'email'=>'',
					'ref_group_user'=>''
					),
				'form_active'=>array(
					'username'=>true,
					'password'=>true,
					'password_confirmation'=>true,
					'name'=>true,
					'email'=>true,
					'ref_group_user'=>true
					)
				),
			'edit'=>array(
				'title'=>'Sunting',
				'url'=>'maintenance/manageUser/edit/'.uri_segment(4),
				'set_value'=>array(
					'username'=>isset($dataUserEdit) ? jarvis_echo($dataUserEdit,'username') : '',
					'password'=>isset($dataUserEdit) ? jarvis_echo($dataUserEdit,'password') : '',
					'name'=>isset($dataUserEdit) ? jarvis_echo($dataUserEdit,'name') : '',
					'email'=>isset($dataUserEdit) ? jarvis_echo($dataUserEdit,'email') : '',
					'ref_group_user'=>isset($dataUserEdit) ? jarvis_echo($dataUserEdit,'ref_group_user') : '',
					),
				'form_active'=>array(
					'username'=>true,
					'password'=>false,
					'password_confirmation'=>false,
					'name'=>true,
					'email'=>true,
					'ref_group_user'=>true
					)
				),
			'changePassword'=>array(
				'title'=>'Ganti Password',
				'url'=>'maintenance/manageUser/changePassword/'.uri_segment(4),
				'set_value'=>array(
					'password'=> '',
					),
				'form_active'=>array(
					'username'=>false,
					'password'=>true,
					'password_confirmation'=>true,
					'name'=>false,
					'email'=>false,
					'ref_group_user'=>false
					)
				));
		?>
		<section class="content-header">
			<h1>
				User
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Home</li>
				<li>Maintenance</li>
				<li>User</li>
				<li class="active"><?php echo $dataForm[$key_action]['title'];?></li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<?php if($key_action=='changePassword') {?>
						<div class="box-header">
							<h3 class="box-title"><?php echo (isset($dataUserCP) ? jarvis_echo($dataUserCP,'name') : ''); ?></h3>
						</div><!-- /.box-header -->
						<?php } ?>
						<div class="box-body table-responsive">
							<?php echo form_open_multipart($dataForm[$key_action]['url']); ?>
								<div class="box-body">
									<?php if($dataForm[$key_action]['form_active']['ref_group_user']==true) { ?>
										<div class="form-group">
											<label>Group User (*)</label>
											<select class="form-control" name="ref_group_user" style="height: 29px;">
												<?php foreach($groupUser['data'] as $item) {?>
													<option value="<?php echo $item['id'];?>" <?php if($item['id']==$dataForm[$key_action]['set_value']['ref_group_user']) { $selected=true; } else { $selected=false; } echo set_select('ref_group_user', $item['id'],$selected); ?>><?php echo $item['group'];?></option>
												<?php } ?>
											</select>
										</div>
									<?php } ?>
									<?php if($dataForm[$key_action]['form_active']['username']==true) { ?>
										<div class="form-group">
											<label for="Username">Username (*)</label>
											<input type="text" value="<?php echo set_value('username',$dataForm[$key_action]['set_value']['username']); ?>" class="form-control" name="username" placeholder="Enter username" style="height: 29px;">
											<?php echo form_error('username','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
										</div>
									<?php } ?>
									<?php if($dataForm[$key_action]['form_active']['password']==true) { ?>
										<div class="form-group">
											<label for="Password">Password (*)</label>
											<input type="password" value="<?php echo set_value('password',$dataForm[$key_action]['set_value']['password']); ?>" class="form-control" name="password" placeholder="Enter password" style="height: 29px;">
											<?php echo form_error('password','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
										</div>
									<?php } ?>
									<?php if($dataForm[$key_action]['form_active']['password_confirmation']==true) { ?>
										<div class="form-group">
											<label for="PasswordConfirmation">Konfirmasi Password (*)</label>
											<input type="password" value="<?php echo set_value('passwordconf'); ?>" class="form-control" name="passwordconf" placeholder="Enter password confirmation" style="height: 29px;">
											<?php echo form_error('passwordconf','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
										</div>
									<?php } ?>
									<?php if($dataForm[$key_action]['form_active']['name']==true) { ?>
										<div class="form-group">
											<label for="Username">Nama (*)</label>
											<input type="text" value="<?php echo set_value('name',$dataForm[$key_action]['set_value']['name']); ?>" class="form-control" name="name" placeholder="Enter name" style="height: 29px;">
											<?php echo form_error('name','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
										</div>
									<?php } ?>
									<?php if($dataForm[$key_action]['form_active']['email']==true) { ?>
										<div class="form-group">
											<label for="Username">Email (*)</label>
											<input type="text" value="<?php echo set_value('email',$dataForm[$key_action]['set_value']['email']); ?>" class="form-control" name="email" placeholder="Enter email" style="height: 29px;">
											<?php echo form_error('email','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
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
