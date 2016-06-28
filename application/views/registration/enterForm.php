<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<?php 
		$dataForm=array(
			'add'=>array(
				'title'=>'Tambah',
				'url'=>'registration/enter/add',
				'set_value'=>array(
					'p_name'=>'',
					'p_plzbirth'=>'',
					'p_birthdate'=>'',
					'pd_jabto'=>'',
					'p_nip'=>'',
					'ser_op'=>'',
					'ser_wo'=>'',
					'ser_lok'=>'',
					'ser_unit'=>'',
					'ser_code'=>'',
					'ser_no'=>'',
					'ser_tglberlaku'=>'',
					'ser_tglakhir'=>'',
					'ser_status'=>'',
					'p_image'=>'',
					'avatar'=>base_url().jarvis_call_configuration('pathAvatar').jarvis_call_configuration('defaultAva'),
					'status_data_id'=>''
					),
				'form_active'=>array(
					'p_name'=>true,
					'p_plzbirth'=>true,
					'p_birthdate'=>true,
					'pd_jabto'=>true,
					'p_nip'=>true,
					'ser_op'=>true,
					'ser_wo'=>true,
					'ser_lok'=>true,
					'ser_unit'=>true,
					'ser_code'=>false,
					'ser_no'=>false,
					'ser_tglberlaku'=>false,
					'ser_tglakhir'=>false,
					'ser_status'=>false,
					'p_image'=>true,
					'toggle_edit'=>false,
					'added_one'=>true,
					'save_button'=>true,
					'photo_box'=>true,
					'barcode'=>false,
					'status_data_id'=>false,
					'pdf_list'=>false
					),
				'form_disable'=>array(
					'p_name'=>false,
					'p_plzbirth'=>false,
					'p_birthdate'=>false,
					'pd_jabto'=>false,
					'p_nip'=>false,
					'ser_op'=>false,
					'ser_wo'=>false,
					'ser_lok'=>false,
					'ser_unit'=>false,
					'ser_code'=>true,
					'ser_no'=>true,
					'ser_tglberlaku'=>true,
					'ser_tglakhir'=>true,
					'ser_status'=>true,
					'p_image'=>false,
					'added_one'=>false,
					'save_button'=>false,
					'status_data_id'=>true
					)
				),
			'edit'=>array(
				'title'=>'Sunting',
				'url'=>'registration/enter/edit/'.uri_segment(4),
				'set_value'=>array(
					'p_name'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'p_name') : '',
					'p_plzbirth'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'p_plzbirth') : '',
					'p_birthdate'=>isset($dataRegEdit) ? (jarvis_echo($dataRegEdit,'p_birthdate') == '0000-00-00') ? '' : jarvis_convert_field(jarvis_echo($dataRegEdit,'p_birthdate'),'jarvisDate') : '',
					'pd_jabto'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'pd_jabto') : '',
					'p_nip'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'p_nip') : '',
					'ser_op'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'ser_op') : '',
					'ser_wo'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'ser_wo') : '',
					'ser_lok'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'ser_lok') : '',
					'ser_unit'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'ser_unit') : '',
					'ser_code'=>isset($dataRegEdit) ? $serCode : '',
					//'ser_no'=>isset($dataRegEdit) ? $serNo : '',
					'ser_no'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'ser_no') : '',
					'ser_tglberlaku'=>isset($dataRegEdit) ? (jarvis_echo($dataRegEdit,'ser_tglberlaku') == '0000-00-00') ? '' : jarvis_convert_field(jarvis_echo($dataRegEdit,'ser_tglberlaku'),'jarvisDate') : '',
					'ser_tglakhir'=>isset($dataRegEdit) ? (jarvis_echo($dataRegEdit,'ser_tglakhir') == '0000-00-00') ? '' : jarvis_convert_field(jarvis_echo($dataRegEdit,'ser_tglakhir'),'jarvisDate') : '',
					'ser_status'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'ser_status') : '',
					'avatar'=>(isset($dataRegEdit) and jarvis_echo($dataRegEdit,'p_image')!='') ? file_exists(jarvis_call_configuration('savedPhoto').jarvis_echo($dataRegEdit,'p_image')) == '1' ? base_url().jarvis_call_configuration('pathPhoto').jarvis_echo($dataRegEdit,'p_image') : base_url().jarvis_call_configuration('pathAvatar').jarvis_call_configuration('defaultAva') : base_url().jarvis_call_configuration('pathAvatar').jarvis_call_configuration('defaultAva'),
					'status_data_id'=>'' 
					),
				'form_active'=>array(
					'p_name'=>true,
					'p_plzbirth'=>true,
					'p_birthdate'=>true,
					'pd_jabto'=>true,
					'p_nip'=>true,
					'ser_op'=>true,
					'ser_wo'=>true,
					'ser_lok'=>true,
					'ser_unit'=>true,
					'ser_code'=>false,
					'ser_no'=>false,
					'ser_tglberlaku'=>false,
					'ser_tglakhir'=>false,
					'ser_status'=>false,
					'p_image'=>true,
					'toggle_edit'=>false,
					'added_one'=>true,
					'save_button'=>true,
					'photo_box'=>true,
					'barcode'=>false,
					'status_data_id'=>false,
					'pdf_list'=>false
					),
				'form_disable'=>array(
					'p_name'=>false,
					'p_plzbirth'=>false,
					'p_birthdate'=>false,
					'pd_jabto'=>false,
					'p_nip'=>false,
					'ser_op'=>false,
					'ser_wo'=>false,
					'ser_lok'=>false,
					'ser_unit'=>false,
					'ser_code'=>false,
					'ser_no'=>false,
					'ser_tglberlaku'=>false,
					'ser_tglakhir'=>false,
					'ser_status'=>false,
					'p_image'=>false,
					'added_one'=>false,
					'save_button'=>false,
					'status_data_id'=>false
					)
				),
			'detail'=>array(
				'title'=>'Detail',
				'url'=>'registration/enter/detail/'.uri_segment(4),
				'set_value'=>array(
					'p_name'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'p_name') : '',
					'p_plzbirth'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'p_plzbirth') : '',
					'p_birthdate'=>isset($dataRegEdit) ? (jarvis_echo($dataRegEdit,'p_birthdate') == '0000-00-00') ? '' : jarvis_convert_field(jarvis_echo($dataRegEdit,'p_birthdate'),'jarvisDate') : '',
					'pd_jabto'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'pd_jabto') : '',
					'p_nip'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'p_nip') : '',
					'ser_op'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'ser_op') : '',
					'ser_wo'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'ser_wo') : '',
					'ser_lok'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'ser_lok') : '',
					'ser_unit'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'ser_unit') : '',
					'ser_code'=>isset($dataRegEdit) ? $serCode : '',
					'ser_no'=>isset($dataRegEdit) ? $serNo : '',
					'ser_tglberlaku'=>isset($dataRegEdit) ? (jarvis_echo($dataRegEdit,'ser_tglberlaku') == '0000-00-00') ? '' : jarvis_convert_field(jarvis_echo($dataRegEdit,'ser_tglberlaku'),'jarvisDate') : '',
					'ser_tglakhir'=>isset($dataRegEdit) ? (jarvis_echo($dataRegEdit,'ser_tglakhir') == '0000-00-00') ? '' : jarvis_convert_field(jarvis_echo($dataRegEdit,'ser_tglakhir'),'jarvisDate') : '',
					'ser_status'=>isset($dataRegEdit) ? jarvis_echo($dataRegEdit,'ser_status') : '',
					'avatar'=>(isset($dataRegEdit) and jarvis_echo($dataRegEdit,'p_image')!='') ? file_exists(jarvis_call_configuration('savedPhoto').jarvis_echo($dataRegEdit,'p_image')) == '1' ? base_url().jarvis_call_configuration('pathPhoto').jarvis_echo($dataRegEdit,'p_image') : base_url().jarvis_call_configuration('pathAvatar').jarvis_call_configuration('defaultAva') : base_url().jarvis_call_configuration('pathAvatar').jarvis_call_configuration('defaultAva'),
					'status_data_id'=>'' 
					),
				'form_active'=>array(
					'p_name'=>true,
					'p_plzbirth'=>true,
					'p_birthdate'=>true,
					'pd_jabto'=>true,
					'p_nip'=>true,
					'ser_op'=>true,
					'ser_wo'=>true,
					'ser_lok'=>true,
					'ser_unit'=>true,
					'ser_code'=>false,
					'ser_no'=>false,
					'ser_tglberlaku'=>false,
					'ser_tglakhir'=>false,
					'ser_status'=>false,
					'p_image'=>false,
					'toggle_edit'=>false,
					'added_one'=>false,
					'save_button'=>false,
					'photo_box'=>true,
					'barcode'=>true,
					'status_data_id'=>false,
					'pdf_list'=>true
					),
				'form_disable'=>array(
					'p_name'=>true,
					'p_plzbirth'=>true,
					'p_birthdate'=>true,
					'pd_jabto'=>true,
					'p_nip'=>true,
					'ser_op'=>true,
					'ser_wo'=>true,
					'ser_lok'=>true,
					'ser_unit'=>true,
					'ser_code'=>true,
					'ser_no'=>true,
					'ser_tglberlaku'=>true,
					'ser_tglakhir'=>true,
					'ser_status'=>true,
					'p_image'=>true,
					'added_one'=>false,
					'save_button'=>true,
					'status_data_id'=>true
					)
				),
			'revisi'=>array(
				'title'=>'Revisi',
				'url'=>'registration/enter/revisi/'.uri_segment(4),
				'set_value'=>array(
					'p_name'=>'',
					'p_plzbirth'=>'',
					'p_birthdate'=>'',
					'pd_jabto'=>'',
					'p_nip'=>'',
					'ser_op'=>'',
					'ser_wo'=>'',
					'ser_lok'=>'',
					'ser_unit'=>'',
					'ser_code'=>'',
					'ser_no'=>'',
					'ser_tglberlaku'=>'',
					'ser_tglakhir'=>'',
					'ser_status'=>'',
					'avatar'=>'',
					'status_data_id'=>''
					),
				'form_active'=>array(
					'p_name'=>false,
					'p_plzbirth'=>false,
					'p_birthdate'=>false,
					'pd_jabto'=>false,
					'p_nip'=>false,
					'ser_op'=>false,
					'ser_wo'=>false,
					'ser_lok'=>false,
					'ser_unit'=>false,
					'ser_code'=>false,
					'ser_no'=>false,
					'ser_tglberlaku'=>false,
					'ser_tglakhir'=>false,
					'ser_status'=>false,
					'p_image'=>false,
					'toggle_edit'=>false,
					'added_one'=>false,
					'save_button'=>true,
					'photo_box'=>false,
					'barcode'=>false,
					'status_data_id'=>true,
					'pdf_list'=>false
					),
				'form_disable'=>array(
					'p_name'=>true,
					'p_plzbirth'=>true,
					'p_birthdate'=>true,
					'pd_jabto'=>true,
					'p_nip'=>true,
					'ser_op'=>true,
					'ser_wo'=>true,
					'ser_lok'=>true,
					'ser_unit'=>true,
					'ser_code'=>true,
					'ser_no'=>true,
					'ser_tglberlaku'=>true,
					'ser_tglakhir'=>true,
					'ser_status'=>true,
					'p_image'=>true,
					'added_one'=>true,
					'save_button'=>false,
					'status_data_id'=>false
					)
				));
		?>
		<section class="content-header">
			<h1>
				Registrasi Sertifikasi
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Registrasi</li>
				<li>Daftar Registrasi</li>
				<li class="active"><?php echo $dataForm[$key_action]['title']; ?></li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<?php echo form_open_multipart($dataForm[$key_action]['url']); ?>
							<div class="box-body table-responsive">		
								<div class="box-group" id="accordion">
									<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
									<?php if($dataForm[$key_action]['form_active']['photo_box']==true) { ?>
										<div class="panel box box-info">
											<div id="collapseOne" class="panel-collapse collapse in">
												<div class="box-body">
													<div class="row">
														<div class="col-md-3" align="center">
															<img src="<?php echo $dataForm[$key_action]['set_value']['avatar'];?>" width="110" class="img">
														</div>
														<?php if($dataForm[$key_action]['form_active']['p_image']==true) { ?>
															<div class="col-md-7">
																<div class="form-group">
																	<label for="avatar">Photo (*)</label>
																	<input class="formReg filestyle" data-buttonName="btn btn-primary" type="file" name="p_image" <?php echo ($dataForm[$key_action]['form_disable']['p_image']==true ? 'disabled=disabled' : '');?>>
																	<?php echo $errorAvatar; ?>
																	<p class="help-block">Max size : 160KB, Resolusi : 480 X 720px, Jenis File : .jpg</p>
																</div>
															</div>
														<?php } ?>
														<?php if($dataForm[$key_action]['form_active']['barcode']==true) { ?>
															<div class="col-md-9" align="center">
																<img style="margin-top:30px;" src="<?php echo base_url();?>barcode/draw/<?php echo $serCode.".".$serNo;?>?height=40&width=1">
															</div>
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
									<?php } ?>
									<?php if($dataForm[$key_action]['form_active']['p_name']==true or $dataForm[$key_action]['form_active']['p_plzbirth']==true or $dataForm[$key_action]['form_active']['p_birthdate']==true or $dataForm[$key_action]['form_active']['pd_jabto']==true) { ?>
										<div class="panel box box-primary">
											<div class="box-header">
												<h4 class="box-title">
													<a>Data Diri SDM</a>
												</h4>
											</div>
											<div id="collapseOne" class="panel-collapse collapse in">
												<div class="box-body">
													<?php if($dataForm[$key_action]['form_active']['p_name']==true) { ?>
														<div class="form-group">
															<label for="Module">Nama (*)</label>
															<input type="text" <?php echo ($dataForm[$key_action]['form_disable']['p_name']==true ? 'disabled=disabled' : '');?> value="<?php echo set_value('p_name',$dataForm[$key_action]['set_value']['p_name']); ?>" class="form-control formReg" name="p_name" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
															<?php echo form_error('p_name','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
														</div>
													<?php } ?>
													<?php if($dataForm[$key_action]['form_active']['p_plzbirth']==true) { ?>
														<div class="form-group">
															<label for="Module">Tempat Lahir</label>
															<input type="text" <?php echo ($dataForm[$key_action]['form_disable']['p_plzbirth']==true ? 'disabled=disabled' : '');?> value="<?php echo set_value('p_plzbirth',$dataForm[$key_action]['set_value']['p_plzbirth']); ?>" class="form-control formReg" name="p_plzbirth" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
															<?php echo form_error('p_plzbirth','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
														</div>
													<?php } ?>
													<?php if($dataForm[$key_action]['form_active']['p_birthdate']==true) { ?>
														<div class="form-group">
															<label for="review_brief">Tanggal Lahir (*)</label>
															<div class="input-group">
																<div class="input-group-addon">
																	<i class="fa fa-calendar"></i>
																</div>
																<input type="text" <?php echo ($dataForm[$key_action]['form_disable']['p_birthdate']==true ? 'disabled=disabled' : '');?> autocomplete="off" style="padding-bottom: 1px; padding-top: 1px; height: 29px;" class="form-control jarvisdatepicker formReg" value="<?php echo set_value('p_birthdate',$dataForm[$key_action]['set_value']['p_birthdate']); ?>" name="p_birthdate" data-provide='datepicker' data-date-format='dd/mm/yyyy'/>																
															</div>
															<?php echo form_error('p_birthdate','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
														</div>
													<?php } ?>
													<?php if($dataForm[$key_action]['form_active']['pd_jabto']==true) { ?>
														<div class="form-group">
															<label for="Description">Tingkat (*)</label>
															<select <?php echo ($dataForm[$key_action]['form_disable']['pd_jabto']==true ? 'disabled=disabled' : '');?> class="form-control formReg" name="pd_jabto" id="pd_jabto" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
																<option value="">--Pilih--</option>
																<?php foreach($dataRank['data'] as $rank) {?>
																	<option value="<?php echo $rank['jjo_code'];?>" <?php if($rank['jjo_code']==$dataForm[$key_action]['set_value']['pd_jabto']) { $selected=true; } else { $selected=false; } echo set_select('pd_jabto', $rank['jjo_code'],$selected); ?>><?php echo $rank['jjo_name'];?></option>
																<?php } ?>
															</select>
															<?php echo form_error('pd_jabto','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
														</div>
													<?php } ?>
													<?php if($dataForm[$key_action]['form_active']['p_nip']==true) { ?>
														<div class="form-group">
															<label for="Module">NIPP</label>
															<input type="text" <?php echo ($dataForm[$key_action]['form_disable']['p_nip']==true ? 'disabled=disabled' : '');?> value="<?php echo set_value('p_nip',$dataForm[$key_action]['set_value']['p_nip']); ?>" class="form-control formReg" name="p_nip" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
															<?php echo form_error('p_nip','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									<?php } ?>
									<?php if($dataForm[$key_action]['form_active']['ser_op']==true or $dataForm[$key_action]['form_active']['ser_wo']==true or $dataForm[$key_action]['form_active']['ser_lok']==true or $dataForm[$key_action]['form_active']['ser_unit']==true) { ?>
										<div class="panel box box-danger">
											<div class="box-header">
												<h4 class="box-title">
													<a>Data Pendukung</a>
												</h4>
											</div>
											<div id="collapseTwo" class="panel-collapse collapse in">
												<div class="box-body">
													<?php if($dataForm[$key_action]['form_active']['ser_op']==true) { ?>
														<div class="form-group">
															<label for="Description">Jabatan/Operator (*)</label>
															<select <?php echo ($dataForm[$key_action]['form_disable']['ser_op']==true ? 'disabled=disabled' : '');?> class="form-control formReg" name="ser_op" id="ser_op" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
																<option value="">--Pilih--</option>
																<?php foreach($positionData['data'] as $position) {?>
																	<option value="<?php echo $position['jto_code'];?>" <?php if($position['jto_code']==$dataForm[$key_action]['set_value']['ser_op']) { $selected=true; } else { $selected=false; } echo set_select('ser_op', $position['jto_code'],$selected); ?>><?php echo $position['jto_name']." (".$position['jto_code'].")";?></option>
																<?php } ?>
															</select>
															<?php echo form_error('ser_op','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
														</div>
													<?php } ?>
													<?php if($dataForm[$key_action]['form_active']['ser_wo']==true) { ?>
														<div class="form-group">
															<label for="Description">Wilayah Operasi</label>
															<select class="form-control formReg" <?php echo ($dataForm[$key_action]['form_disable']['ser_wo']==true ? 'disabled=disabled' : '');?> name="ser_wo" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
																<?php foreach($operationData['data'] as $operation) {?>
																	<option value="<?php echo $operation['kd_wilop'];?>" <?php if($operation['kd_wilop']==$dataForm[$key_action]['set_value']['ser_wo']) { $selected=true; } else { $selected=false; } echo set_select('ser_wo', $operation['kd_wilop'],$selected); ?>><?php echo $operation['nama_wilop'];?></option>
																<?php } ?>
															</select>
														</div>
													<?php } ?>
													<?php if($dataForm[$key_action]['form_active']['ser_lok']==true) { ?>
														<div class="form-group">
															<label for="Description">Lokasi</label>
															<select class="form-control formReg" <?php echo ($dataForm[$key_action]['form_disable']['ser_lok']==true ? 'disabled=disabled' : '');?> name="ser_lok" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
																<?php foreach($locationData['data'] as $location) {?>
																	<option value="<?php echo $location['loc_code'];?>" <?php if($location['loc_code']==$dataForm[$key_action]['set_value']['ser_lok']) { $selected=true; } else { $selected=false; } echo set_select('ser_lok', $location['loc_code'],$selected); ?>><?php echo $location['loc_name'];?></option>
																<?php } ?>
															</select>
														</div>
													<?php } ?>
													<?php if($dataForm[$key_action]['form_active']['ser_unit']==true) { ?>
														<div class="form-group">
															<label for="Description">Unit/Stasiun</label>
															<select class="form-control formReg" <?php echo ($dataForm[$key_action]['form_disable']['ser_unit']==true ? 'disabled=disabled' : '');?> name="ser_unit" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
																<?php foreach($stationData['data'] as $station) {?>
																	<option value="<?php echo $station['kd_unitstasiun'];?>" <?php if($station['kd_unitstasiun']==$dataForm[$key_action]['set_value']['ser_unit']) { $selected=true; } else { $selected=false; } echo set_select('ser_unit', $station['kd_unitstasiun'],$selected); ?>><?php echo $station['nama_unitstasiun'];?></option>
																<?php } ?>
															</select>
														</div>
													<?php } ?>
													<input type="hidden" value="<?php echo set_value('ser_code',$dataForm[$key_action]['set_value']['ser_code']); ?>" class="form-control formReg" readonly="readonly" name="ser_code" id="ser_code" placeholder="...." style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
													<input type="hidden" value="<?php echo set_value('ser_code',$dataForm[$key_action]['set_value']['ser_code']); ?>" class="form-control formReg" readonly="readonly" name="ser_code_old" placeholder="...." style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
													<input type="hidden" value="<?php echo set_value('ser_no',$dataForm[$key_action]['set_value']['ser_no']); ?>" class="form-control formReg" readonly="readonly" name="reg_no_old" placeholder="...." style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
												</div>
											</div>
										</div>
									<?php } ?>
									<?php if($dataForm[$key_action]['form_active']['ser_code']==true and $dataForm[$key_action]['form_active']['ser_no']==true or $dataForm[$key_action]['form_active']['ser_tglberlaku']==true and $dataForm[$key_action]['form_active']['ser_tglakhir']==true or $dataForm[$key_action]['form_active']['ser_status']==true or $dataForm[$key_action]['form_active']['status_data_id']==true) { ?>
										<div class="panel box box-success">
											<div class="box-header">
												<h4 class="box-title">
													<a><?php if($key_action=='revisi'){echo"Revisi";}else{echo"Masa Berlaku Kartu";}?></a>
												</h4>
											</div>
											<div id="collapseThree" class="panel-collapse collapse in">
												<div class="box-body">
													<?php if($dataForm[$key_action]['form_active']['ser_code']==true and $dataForm[$key_action]['form_active']['ser_no']==true) { ?>
														<label>Kode Sertifikasi (*)</label>
														<div class="row">
															<div class="col-md-3">
																<input type="text" <?php echo ($dataForm[$key_action]['form_disable']['ser_code']==true ? 'disabled=disabled' : '');?> value="<?php echo set_value('ser_code',$dataForm[$key_action]['set_value']['ser_code']); ?>" class="form-control formReg" readonly="readonly" name="ser_code" id="ser_code" placeholder="...." style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
																<?php echo form_error('ser_code','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
															</div>
															<div class="col-md-9">
																<input type="text" <?php echo ($dataForm[$key_action]['form_disable']['ser_no']==true ? 'disabled=disabled' : '');?> class="form-control formReg" value="<?php echo set_value('ser_no',$dataForm[$key_action]['set_value']['ser_no']); ?>" name="ser_no" placeholder="...." style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
																<?php echo form_error('ser_no','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
															</div>
														</div>
													<?php } ?>
													<?php if($dataForm[$key_action]['form_active']['ser_tglberlaku']==true and $dataForm[$key_action]['form_active']['ser_tglakhir']==true) { ?>
														<label>Tgl Berlaku (*)</label>
														<div class="row">
															<div class="col-md-5">
																<div class="input-group">
																	<div class="input-group-addon">
																		<i class="fa fa-calendar"></i>
																	</div>
																	<input type="text" <?php echo ($dataForm[$key_action]['form_disable']['ser_tglberlaku']==true ? 'disabled=disabled' : '');?> autocomplete="off" class="form-control jarvisdatepicker formReg" style="padding-bottom: 1px; padding-top: 1px; height: 29px;" value="<?php echo set_value('ser_tglberlaku',$dataForm[$key_action]['set_value']['ser_tglberlaku']); ?>" name="ser_tglberlaku" data-provide='datepicker' data-date-format='dd/mm/yyyy'/>
																</div>
																<?php echo form_error('ser_tglberlaku','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
															</div>
															<div class="col-md-2" align="center">
																<div class="input-group" style="padding-top:5px;">
																	s/d
																</div>
															</div>
															<div class="col-md-5">
																<div class="input-group">
																	<div class="input-group-addon">
																		<i class="fa fa-calendar"></i>
																	</div>
																	<input type="text" <?php echo ($dataForm[$key_action]['form_disable']['ser_tglakhir']==true ? 'disabled=disabled' : '');?> autocomplete="off" class="form-control jarvisdatepicker formReg" style="padding-bottom: 1px; padding-top: 1px; height: 29px;" value="<?php echo set_value('ser_tglakhir',$dataForm[$key_action]['set_value']['ser_tglakhir']); ?>" name="ser_tglakhir" data-provide='datepicker' data-date-format='dd/mm/yyyy'/>
																</div>
																<?php echo form_error('ser_tglakhir','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
															</div>
														</div>
													<?php } ?>
													<?php if($dataForm[$key_action]['form_active']['ser_status']==true) { ?>
														<div class="form-group">
															<label for="Status_Kartu">Status Kartu</label>
															<select class="form-control formReg" <?php echo ($dataForm[$key_action]['form_disable']['ser_status']==true ? 'disabled=disabled' : '');?> name="ser_status" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
																<?php foreach($cardStatus['data'] as $card_status) {?>
																	<option value="<?php echo $card_status['parameter'];?>" <?php if($card_status['parameter']==$dataForm[$key_action]['set_value']['ser_status']) { $selected=true; } else { $selected=false; } echo set_select('ser_status', $card_status['parameter'],$selected); ?>><?php echo $card_status['parameter'];?></option>
																<?php } ?>
															</select>
														</div>
													<?php } ?>
													<?php if($dataForm[$key_action]['form_active']['status_data_id']==true) { ?>
														<div class="form-group">
															<select class="form-control formReg" <?php echo ($dataForm[$key_action]['form_disable']['status_data_id']==true ? 'disabled=disabled' : '');?> name="status_data_id" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
																<?php foreach($dataStatus['data'] as $data_status) {?>
																	<option value="<?php echo $data_status['id'];?>"><?php echo $data_status['parameter'];?></option>
																<?php } ?>
															</select>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									<?php } ?>
									<?php if($dataForm[$key_action]['form_active']['pdf_list']==true) { ?>
									<div class="box box-primary">
										<div class="box-header">
											<h3 class="box-title">File List</h3>
										</div><!-- /.box-header -->
										<div class="box-body table-responsive">
											<table id="module-table" class="table table-bordered table-hover">
												<thead>
													<tr>
														<th style="padding:4px; vertical-align:middle;">File</th>
													</tr>
												</thead>
												<tbody>
												<?php 
												if (is_array($dataPdfSert)){
													foreach($dataPdfSert['data'] as $item){ 
														?>
														<tr>
															<td style="padding:4px; vertical-align:middle;"><a onclick="window.open('<?php echo base_url().jarvis_call_configuration('pathPdf').$item['file'];?>','','width=800, height=600')" ><?php echo $item['file'];?></a></td>
														</tr>
														<?php
													} 
												}
												?>
												</tbody>
												<tfoot>
													<tr>
														<th style="padding:4px; vertical-align:middle;">File</th>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
									<?php } ?>
									<div class="form-group">
										<p class="help-block">(*) <?php echo jarvis_call_configuration('required_label');?></p>
									</div>
									<div class="form-group">
										<?php if($dataForm[$key_action]['form_active']['toggle_edit']==true) { ?>
											<input type='checkbox' class="toggleEdit"/> Sunting berkas
										<?php } ?>
										<?php if($dataForm[$key_action]['form_active']['added_one']==true) { ?>
											<input type='checkbox' <?php echo ($dataForm[$key_action]['form_disable']['added_one']==true ? 'disabled=disabled' : '');?> name='addedOne' value="added_one"/> Buka form baru
										<?php } ?>
									</div>
								</div>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<?php if($dataForm[$key_action]['form_active']['save_button']==true) { ?>
									<button type="submit" <?php echo ($dataForm[$key_action]['form_disable']['save_button']==true ? 'disabled=disabled' : '');?> class="btn btn-sm btn-primary formReg"><?php echo jarvis_call_configuration('save_button');?></button>
								<?php } ?>
								<?php echo jarvis_back_button(2);?>
							</div>
						<?php echo form_close();?>
					</div><!-- /.box-body -->
				</div>
			</div>
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
