<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<?php 
		$dataForm=array(
			'add'=>array(
				'title'=>'Tambah',
				'url'=>'maintenance/manageMenu/add',
				'set_value'=>array(
					'menu'=>'',
					'label'=>'',
					'order_hint'=>'',
					'icon'=>'',
					'ref_module'=>'',
					'pid'=>'',
					'desc'=>'',
					'bgDash'=>'',
					'iconDash'=>'',
					),
				'form_active'=>array(
					'menu'=>true,
					'label'=>true,
					'order_hint'=>true,
					'icon'=>true,
					'ref_module'=>true,
					'desc'=>true,
					'bgDash'=>true,
					'iconDash'=>true,
					'pid'=>true
					)
				),
			'edit'=>array(
				'title'=>'Sunting',
				'url'=>'maintenance/manageMenu/edit/'.uri_segment(4),
				'set_value'=>array(
					'menu'=>isset($dataMenuEdit) ? jarvis_echo($dataMenuEdit,'menu') : '',
					'label'=>isset($dataMenuEdit) ? jarvis_echo($dataMenuEdit,'label') : '',
					'order_hint'=>isset($dataMenuEdit) ? jarvis_echo($dataMenuEdit,'order_hint') : '',
					'icon'=>isset($dataMenuEdit) ? jarvis_echo($dataMenuEdit,'icon') : '',
					'ref_module'=>isset($dataMenuEdit) ? jarvis_echo($dataMenuEdit,'ref_module') : '',
					'pid'=>isset($dataMenuEdit) ? jarvis_echo($dataMenuEdit,'pid') : '',
					'desc'=>isset($dataMenuEdit) ? jarvis_echo($dataMenuEdit,'desc') : '',
					'bgDash'=>isset($dataMenuEdit) ? jarvis_decode_json(jarvis_decode(jarvis_echo($dataMenuEdit,'dashboard')),'bg') : '',
					'iconDash'=>isset($dataMenuEdit) ? jarvis_decode_json(jarvis_decode(jarvis_echo($dataMenuEdit,'dashboard')),'icon') : '',
					),
				'form_active'=>array(
					'menu'=>true,
					'label'=>true,
					'order_hint'=>true,
					'icon'=>true,
					'ref_module'=>true,
					'desc'=>true,
					'bgDash'=>true,
					'iconDash'=>true,
					'pid'=>true
					)
				));
		?>
		<section class="content-header">
			<h1>
				Menu
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Pemeliharaan</li>
				<li>Menu</li>
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
								<?php if($dataForm[$key_action]['form_active']['menu']==true) { ?>
									<div class="form-group">
										<label for="Module">Menu (*)</label>
										<input type="text" value="<?php echo set_value('menu',$dataForm[$key_action]['set_value']['menu']); ?>" class="form-control" name="menu" placeholder="Enter menu" style="height: 29px;">
										<?php echo form_error('menu','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['label']==true) { ?>
									<div class="form-group">
										<label for="Module">Label (*)</label>
										<input type="text" value="<?php echo set_value('label',$dataForm[$key_action]['set_value']['label']); ?>" class="form-control" name="label" placeholder="Enter Label" style="height: 29px;">
										<?php echo form_error('label','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['order_hint']==true) { ?>
									<div class="form-group">
										<label for="Module">Menu Order (*)</label>
										<input type="text" value="<?php echo set_value('order_hint',$dataForm[$key_action]['set_value']['order_hint']); ?>" class="form-control" name="order_hint" placeholder="Enter Menu Order" style="height: 29px;">
										<?php echo form_error('order_hint','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['icon']==true) { ?>
									<div class="form-group">
										<label for="Module">Menu Icon</label>
										<select class="form-control" name="icon" style="height: 29px;">
											<?php foreach($iconPack['data'] as $icon_pack) {?>
												<option value="<?php echo $icon_pack['parameter'];?>" <?php if($icon_pack['parameter']==$dataForm[$key_action]['set_value']['icon']) { $selected=true; } else { $selected=false; } echo set_select('icon', $icon_pack['parameter'],$selected); ?>><?php echo $icon_pack['parameter'];?></option>
											<?php } ?>
										</select>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['ref_module']==true) { ?>
									<div class="form-group">
										<label for="Module">Module</label>
										<select class="form-control" name="ref_module" style="height: 29px;">
											<?php foreach($dataModule['data'] as $module) {?>
												<option value="<?php echo $module['id'];?>" <?php if($module['id']==$dataForm[$key_action]['set_value']['ref_module']) { $selected=true; } else { $selected=false; } echo set_select('ref_module', $module['id'],$selected); ?>><?php echo $module['module'];?></option>
											<?php } ?>
										</select>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['desc']==true) { ?>
									<div class="form-group">
										<label for="Description">Description</label>
										<textarea class="form-control" rows="3" name="desc" placeholder="Enter ..."><?php echo set_value('desc',$dataForm[$key_action]['set_value']['desc']); ?></textarea>
										<?php echo form_error('desc','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['pid']==true) { ?>
									<div class="form-group">
										<label for="Module">PID</label>
										<select class="form-control" name="pid" style="height: 29px;">
											<option value="0">Choose</option>
											<?php foreach($dataPID['data'] as $pid) {?>
												<option value="<?php echo $pid['id'];?>" <?php if($pid['id']==$dataForm[$key_action]['set_value']['pid']) { $selected=true; } else { $selected=false; } echo set_select('pid', $pid['id'],$selected); ?>><?php echo $pid['menu'];?></option>
											<?php } ?>
										</select>
									</div>
								<?php } ?>
									<div class="form-group">
										<label for="Module">Panel Dashboard</label>
										<?php if($dataForm[$key_action]['form_active']['bgDash']==true) { ?>
											<select class="form-control" name="bgDash" style="height: 29px;">											
												<option value="" disabled selected>Background Color</option>
												<?php foreach($bgDash['data'] as $bgdash) {?>
													<option value="<?php echo $bgdash['parameter'];?>" <?php if($bgdash['parameter']==$dataForm[$key_action]['set_value']['bgDash']) { $selected=true; } else { $selected=false; } echo set_select('bgDash', $bgdash['parameter'],$selected); ?>><?php echo $bgdash['parameter'];?></option>
												<?php } ?>
											</select>
										<?php } ?>
										<br>
										<?php if($dataForm[$key_action]['form_active']['iconDash']==true) { ?>
											<select class="form-control" name="iconDash" style="height: 29px;">
												<option value="" disabled selected>Icon</option>
												<?php foreach($iconDash['data'] as $icondash) {?>
													<option value="<?php echo $icondash['parameter'];?>" <?php if($icondash['parameter']==$dataForm[$key_action]['set_value']['iconDash']) { $selected=true; } else { $selected=false; } echo set_select('iconDash', $icondash['parameter'],$selected); ?>><?php echo $icondash['parameter'];?></option>
												<?php } ?>
											</select>
										<?php } ?>
									</div>
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
