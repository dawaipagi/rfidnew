<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<?php 
		$dataForm=array(
			'add'=>array(
				'title'=>'Tambah',
				'url'=>'admin/manageRank/add',
				'set_value'=>array(
					'jjo_name'=>''
					),
				'form_active'=>array(
					'jjo_name'=>true
					)
				),
			'edit'=>array(
				'title'=>'Sunting',
				'url'=>'admin/manageRank/edit/'.uri_segment(4),
				'set_value'=>array(
					'jjo_name'=>isset($dataRankEdit) ? jarvis_echo($dataRankEdit,'jjo_name') : ''
					),
				'form_active'=>array(
					'jjo_name'=>true
					)
				));
		?>
		<section class="content-header">
			<h1>
				Tingkat
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Komponen Data</li>
				<li>Tingkat</li>
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
								<?php if($dataForm[$key_action]['form_active']['jjo_name']==true) { ?>
									<div class="form-group">
										<label for="Module">Nama (*)</label>
										<input type="text" value="<?php echo set_value('jjo_name',$dataForm[$key_action]['set_value']['jjo_name']); ?>" class="form-control" name="jjo_name" placeholder="Masukan Nama" style="height: 29px;">
										<?php echo form_error('jjo_name','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
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
