<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Employee
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Home</li>
				<li>Admin</li>
				<li class="active">Employee</li>
			</ol>
		</section>
		<?php 
		$dataForm=array(
			'add'=>array(
				'title'=>'Add Employee',
				'url'=>'employee/add',
				'set_value'=>array(
					'p_name'=>'',
					'p_plzbirth'=>'',
					'p_birthdate'=>'',
					'pd_jabto'=>''
					),
				'form_active'=>array(
					'p_name'=>true,
					'p_plzbirth'=>true,
					'p_birthdate'=>true,
					'pd_jabto'=>true,
					'p_image'=>false
					)
				),
			'edit'=>array(
				'title'=>'Edit Employee',
				'url'=>'employee/edit/'.uri_segment(3),
				'set_value'=>array(
					'p_name'=>isset($dataEmpEdit) ? jarvis_echo($dataEmpEdit,'p_name') : '',
					'p_plzbirth'=>isset($dataEmpEdit) ? jarvis_echo($dataEmpEdit,'p_plzbirth') : '',
					'p_birthdate'=>isset($dataEmpEdit) ? (jarvis_echo($dataEmpEdit,'p_birthdate') == '0000-00-00') ? '' : jarvis_convert_field(jarvis_echo($dataEmpEdit,'p_birthdate'),'jarvisDate') : '',
					'pd_jabto'=>isset($dataEmpEdit) ? jarvis_echo($dataEmpEdit,'pd_jabto') : ''
					),
				'form_active'=>array(
					'p_name'=>true,
					'p_plzbirth'=>true,
					'p_birthdate'=>true,
					'pd_jabto'=>true,
					'p_image'=>false
					)
				),
			'profile_picture'=>array(
				'title'=>'Edit Profile Picture',
				'url'=>'employee/picture/'.uri_segment(3).'/upload',
				'set_value'=>array(),
				'form_active'=>array(
					'p_name'=>false,
					'p_plzbirth'=>false,
					'p_birthdate'=>false,
					'pd_jabto'=>false,
					'p_image'=>true
					)
				));
		?>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title"><?php echo $dataForm[$key_action]['title']; ?></h3>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive">
							<?php echo form_open_multipart($dataForm[$key_action]['url']); ?>
								<div class="box-body">
								<?php if($dataForm[$key_action]['form_active']['p_name']==true) { ?>
									<div class="form-group">
										<label for="Module">Name</label>
										<input type="text" value="<?php echo set_value('p_name',$dataForm[$key_action]['set_value']['p_name']); ?>" class="form-control" name="p_name" placeholder="Enter Name">
										<?php echo form_error('p_name','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['p_plzbirth']==true) { ?>
									<div class="form-group">
										<label for="Module">Birth Place</label>
										<input type="text" value="<?php echo set_value('p_plzbirth',$dataForm[$key_action]['set_value']['p_plzbirth']); ?>" class="form-control" name="p_plzbirth" placeholder="Enter Place">
										<?php echo form_error('p_plzbirth','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['p_birthdate']==true) { ?>
									<div class="form-group">
										<label for="review_brief">Birth Date</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control" value="<?php echo set_value('p_birthdate',$dataForm[$key_action]['set_value']['p_birthdate']); ?>" class="form-control" name="p_birthdate" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
										</div>
										<?php echo form_error('p_birthdate','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['pd_jabto']==true) { ?>
									<div class="form-group">
										<label for="Description">pd_jabto</label>
										<select class="form-control" name="pd_jabto">
											<?php foreach($dataRank['data'] as $rank) {?>
												<option value="<?php echo $rank['jjo_code'];?>" <?php if($rank['jjo_code']==$dataForm[$key_action]['set_value']['pd_jabto']) { $selected=true; } else { $selected=false; } echo set_select('pd_jabto', $rank['jjo_code'],$selected); ?>><?php echo $rank['jjo_name'];?></option>
											<?php } ?>
										</select>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['p_image']==true) { ?>
									<div class="form-group">
										<label for="avatar">Picture</label>
										<input type="file" name="p_image">
										<?php echo $errorAvatar; ?>
										<p class="help-block">Max size : 30KB, Size : 215 X 215px</p>
									</div>
								<?php } ?>	
								</div><!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-primary">Save</button>
								</div>
							<?php echo form_close();?>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>

		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
