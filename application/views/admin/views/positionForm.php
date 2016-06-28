<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<?php 
		$dataForm=array(
			'add'=>array(
				'title'=>'Tambah',
				'url'=>'admin/managePosition/add',
				'set_value'=>array(
					'jto_name'=>'',
					'jto_code'=>'',
					'jto_cetak'=>'',
					'jto_flag'=>''
					),
				'form_active'=>array(
					'jto_name'=>true,
					'jto_code'=>true,
					'jto_cetak'=>true,
					'jto_flag'=>false
					)
				),
			'edit'=>array(
				'title'=>'Sunting',
				'url'=>'admin/managePosition/edit/'.uri_segment(4),
				'set_value'=>array(
					'jto_name'=>isset($dataPositionEdit) ? jarvis_echo($dataPositionEdit,'jto_name') : '',
					'jto_code'=>isset($dataPositionEdit) ? jarvis_echo($dataPositionEdit,'jto_code') : '',
					'jto_cetak'=>isset($dataPositionEdit) ? jarvis_echo($dataPositionEdit,'jto_cetak') : '',
					'jto_flag'=>isset($dataPositionEdit) ? jarvis_echo($dataPositionEdit,'jto_flag') : ''
					),
				'form_active'=>array(
					'jto_name'=>true,
					'jto_code'=>true,
					'jto_cetak'=>true,
					'jto_flag'=>false
					)
				));
		?>
		<section class="content-header">
			<h1>
				Jabatan
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Home</li>
				<li>Admin</li>
				<li>Jabatan</li>
				<li class="active"><?php echo $dataForm[$key_action]['title']; ?></li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-body">
							<?php echo form_open($dataForm[$key_action]['url']); ?>
								<div class="box-body">
								<?php if($dataForm[$key_action]['form_active']['jto_name']==true) { ?>
									<div class="form-group">
										<label for="Module">Nama (*)</label>
										<input type="text" value="<?php echo set_value('jto_name',$dataForm[$key_action]['set_value']['jto_name']); ?>" class="form-control" name="jto_name" placeholder="Enter Name" style="height: 29px;">
										<?php echo form_error('jto_name','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['jto_cetak']==true) { ?>
									<div class="form-group">
										<label for="Module">Judul Kartu</label>
										<input type="text" value="<?php echo set_value('jto_cetak',$dataForm[$key_action]['set_value']['jto_cetak']); ?>" class="form-control" name="jto_cetak" placeholder="Enter Card Tittle" style="height: 29px;">
										<?php echo form_error('jto_cetak','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['jto_code']==true) { ?>
									<div class="form-group">
										<label for="Module">Kode (*)</label>
										<input type="text" value="<?php echo set_value('jto_code',$dataForm[$key_action]['set_value']['jto_code']); ?>" class="form-control" name="jto_code" placeholder="Enter Code" style="height: 29px;">
										<?php echo form_error('jto_code','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['jto_flag']==true) { ?>
									<div class="form-group">
										<label for="Description">Status</label>
										<select class="form-control" name="jto_flag" style="height: 29px;">
											<?php foreach($flag['data'] as $status) { $param=json_decode($status['parameter'],true);?>
												<option value="<?php echo $param['value'];?>" <?php if($param['value']==$dataForm[$key_action]['set_value']['jto_flag']) { $selected=true; } else { $selected=false; } echo set_select('jto_flag', $param['value'],$selected); ?>><?php echo $param['label'];?></option>
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
