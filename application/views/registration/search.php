<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<?php 
		$dataForm=array(
			'search'=>array(
				'title'=>'Pencarian',
				'url'=>'registration/enter/search'
				//'url'=>'registration/search/do'
				));
		?>
		<section class="content-header">
			<h1>
				Pencarian Registrasi
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Registrasi</li>
				<li class="active">Pencarian Registrasi</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-success">
						<?php echo form_open_multipart($dataForm[$key_action]['url']); ?>
							<div class="box-body table-responsive">
								<div class="form-group">
									<label for="Description">Jabatan/Operator</label>
									<select class="form-control formReg" name="ser_op" id="ser_op" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
										<option value="">--Semua--</option>
										<?php foreach($positionData['data'] as $position) {?>
											<option value="<?php echo $position['jto_code'];?>"><?php echo $position['jto_name']." (".$position['jto_code'].")";?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label for="Description">Status</label>
									<select class="form-control formReg" name="status_data_id" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
										<option value="">--Semua--</option>
										<?php foreach($dataStatus['data'] as $data_status) {?>
											<option value="<?php echo $data_status['id'];?>"><?php echo $data_status['parameter'];?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label for="Description">Tanggal Akhir Berlaku</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" autocomplete="off" class="form-control jarvisdatepicker formReg" style="padding-bottom: 1px; padding-top: 1px; height: 29px;" value="" name="ser_tglakhir" data-provide='datepicker' data-date-format='dd/mm/yyyy'/>
									</div>
								</div>
								<!--<div class="form-group">
									<label for="Module">Nama</label>
									<input type="text" value="" class="form-control formReg" name="p_name" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
								</div>-->
								<div class="form-group">
									<label for="Module">Nilai Pencarian</label>
									<input type="text" value="" class="form-control formReg" name="nilai_pencarian" style="padding-bottom: 1px; padding-top: 1px; height: 29px;">
								</div>
								<?php
								/*if(isset($showSearch)){
									$decodeSS=json_decode($showSearch,true);
									echo "Dari hasil pencarian terdapat <b>".$decodeSS['result']."</b> data <br>";
									echo $decodeSS['query'];
								}*/
								?>
							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-sm btn-primary formReg"><?php echo jarvis_call_configuration('search_button');?></button>
							</div>
						<?php echo form_close();?>
					</div><!-- /.box -->
				</div>
			</div>
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
