<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Profile
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-dashboard"></i> Home</li>
			<li class="active">Profile</li>
		</ol>
	</section>	
	<?php 
	$dataForm=array(
		'account'=>array(
			'title'=>'Account editor',
			'url'=>'profile/account',
			'set_value'=>array(
				'username'=>get_data_user('username'),
				'password'=>get_data_user('password'),
				'name'=>get_data_user('name'),
				'email'=>get_data_user('email'),
				'phone_number'=>get_data_user('phone_number'),
				'address'=>get_data_user('address')
				),
			'form_active'=>array(
				'username'=>true,
				'password'=>false,
				'password_confirmation'=>false,
				'name'=>true,
				'email'=>true,
				'phone_number'=>true,
				'address'=>true,
				'avatar'=>false
				)
			),
		'password'=>array(
			'title'=>'Password editor',
			'url'=>'profile/password',
			'set_value'=>array(
				'username'=>get_data_user('username'),
				'password'=>'',
				'name'=>get_data_user('name'),
				'email'=>get_data_user('email'),
				'phone_number'=>get_data_user('phone_number'),
				'address'=>get_data_user('address')
				),
			'form_active'=>array(
				'username'=>false,
				'password'=>true,
				'password_confirmation'=>true,
				'name'=>false,
				'email'=>false,
				'phone_number'=>false,
				'address'=>false,
				'avatar'=>false
				)
			),
		'avatar'=>array(
			'title'=>'Avatar editor',
			'url'=>'profile/avatar/upload',
			'set_value'=>array(),
			'form_active'=>array(
				'username'=>false,
				'password'=>false,
				'password_confirmation'=>false,
				'name'=>false,
				'email'=>false,
				'phone_number'=>false,
				'address'=>false,
				'avatar'=>true
				)
			));
	?>	
	<!-- Main content -->
	<section class="content">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li <?php if($activeTab=='account') { echo 'class="active"'; }?>><a href="<?php echo base_url().'profile/account/'?>">Account</a></li>
				<li <?php if($activeTab=='avatar') { echo 'class="active"'; }?>><a href="<?php echo base_url().'profile/avatar/'?>">Avatar</a></li>
				<li <?php if($activeTab=='password') { echo 'class="active"'; }?>><a href="<?php echo base_url().'profile/password'?>">Password</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active">
					<?php echo form_open_multipart($dataForm[$key_action]['url']); ?>
						<div class="box-body">
							<?php if($dataForm[$key_action]['form_active']['username']==true) { ?>
								<div class="form-group">
									<label for="Username">Username (*)</label>
									<input type="text" value="<?php echo set_value('username',$dataForm[$key_action]['set_value']['username']); ?>" class="form-control" name="username" placeholder="Enter username">
									<?php echo form_error('username','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
								</div>
							<?php } ?>
							<?php if($dataForm[$key_action]['form_active']['password']==true) { ?>
								<div class="form-group">
									<label for="Password">Password (*)</label>
									<input type="password" value="<?php echo set_value('password',$dataForm[$key_action]['set_value']['password']); ?>" class="form-control" name="password" placeholder="Enter password">
									<?php echo form_error('password','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
								</div>
							<?php } ?>
							<?php if($dataForm[$key_action]['form_active']['password_confirmation']==true) { ?>
								<div class="form-group">
									<label for="PasswordConfirmation">Password Confirm (*)</label>
									<input type="password" value="<?php echo set_value('passwordconf'); ?>" class="form-control" name="passwordconf" placeholder="Enter password confirmation">
									<?php echo form_error('passwordconf','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
								</div>
							<?php } ?>
							<?php if($dataForm[$key_action]['form_active']['name']==true) { ?>
								<div class="form-group">
									<label for="Username">Name (*)</label>
									<input type="text" value="<?php echo set_value('name',$dataForm[$key_action]['set_value']['name']); ?>" class="form-control" name="name" placeholder="Enter name">
									<?php echo form_error('name','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
								</div>
							<?php } ?>
							<?php if($dataForm[$key_action]['form_active']['email']==true) { ?>
								<div class="form-group">
									<label for="Username">Email (*)</label>
									<input type="text" value="<?php echo set_value('email',$dataForm[$key_action]['set_value']['email']); ?>" class="form-control" name="email" placeholder="Enter email">
									<?php echo form_error('email','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
								</div>
							<?php } ?>
							<?php if($dataForm[$key_action]['form_active']['phone_number']==true) { ?>
								<div class="form-group">
									<label for="PhoneNumber">Phone Number (*)</label>
									<input type="text" value="<?php echo set_value('phone_number',$dataForm[$key_action]['set_value']['phone_number']); ?>" class="form-control" name="phone_number" placeholder="Enter phone number">
									<?php echo form_error('phone_number','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
								</div>
							<?php } ?>
							<?php if($dataForm[$key_action]['form_active']['address']==true) { ?>
								<div class="form-group">
									<label for="Address">Address (*)</label>
									<textarea class="form-control" rows="3" placeholder="Enter ..." name="address"><?php echo set_value('address',$dataForm[$key_action]['set_value']['address']); ?></textarea>
									<?php echo form_error('address','<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i>','</div>'); ?>
								</div>
							<?php } ?>
							<?php if($dataForm[$key_action]['form_active']['avatar']==true) { ?>
							<div class="form-group">
								<label for="avatar">Avatar</label>
								<input type="file" name="avatar" class="filestyle" data-buttonName="btn btn-primary">
								<?php echo $errorAvatar; ?>
								<p class="help-block">Max size : 30KB, Size : 215 X 215px</p>
							</div>
							<?php } ?>							
							<div class="form-group">
								<p class="help-block">(*) Required field</p>
							</div>
						</div><!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					<?php echo form_close();?>
				</div><!-- /.tab-pane -->
			</div><!-- /.tab-content -->
		</div><!-- nav-tabs-custom -->
	</section><!-- /.content -->
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
