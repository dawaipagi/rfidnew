<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<?php 
		$dataForm=array(
		'upload_pdf'=>array(
			'title'=>'Upload PDF',
			'url'=>'registration/enter/upload_pdf/'.jarvis_encode(jarvis_echo($dataPdf,'Id')),
			'set_value'=>array(
				'file'=>''
				),
			'form_active'=>array(
				'file'=>true
				)
			));
		?>
		<section class="content-header">
			<h1>
				Data Pendukung <?php echo jarvis_echo($dataPdf,'p_name');?>
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Registrasi</li>
				<li class="active">Data Pendukung</li>
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
								<input type="hidden" readonly="readonly" value="<?php echo jarvis_echo($dataPdf,'Id');?>" class="form-control" name="peg_id">
								<?php if($dataForm[$key_action]['form_active']['file']==true) { ?>
									<div class="form-group">
										<label for="avatar">PDF</label>
										<input type="file" name="file" class="filestyle" data-buttonName="btn btn-primary">
										<?php echo $errorPdf; ?>
										<p class="help-block">
											Max size : 7MB <br>
											pastikan File Attacthment terdiri dari : <br>
											1- Surat Keterangan Sehat Dari Dokter Umum <br>
											2- Photo Copy Surat Tanda Tamat Belajar/ Ijazah yang di legalisir <br>
											3- Photocopy KTP yang masih berlaku <br>
											4- Tanda Bukti Lulus mengikuti pendidikan dan pelatihan sesuai dengan bidang yang dimohon. <br>
											5- Photocopy sertifikat yang dimiliki ( Untuk Pemohon Perpanjangan dan peningkatan kompetensi) <br>
											6- Surat Keterangan Kehilangan dari Kepolisian ( Untuk Penggantian sertifikat yang hilang) <br>
											7- Sertifikat yang rusak untuk penggantian yang rusak <br>
										</p>
									</div>
								<?php } ?>
								</div><!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-primary btn-sm"><?php echo jarvis_call_configuration('save_button');?></button>
									<?php echo jarvis_back_button(2);?>
								</div>
							<?php echo form_close();?>
						</div><!-- /.box-body -->
					</div>
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">File List</h3>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive">
							<table id="module-table" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th style="padding:4px; vertical-align:middle;">File</th>
										<th style="padding:4px; vertical-align:middle;">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								if (is_array($dataPdfSert)){
									foreach($dataPdfSert['data'] as $item){ 
										?>
										<tr>
											<td style="padding:4px; vertical-align:middle;"><a onclick="window.open('<?php echo base_url().jarvis_call_configuration('pathPdf').$item['file'];?>','','width=800, height=600')" ><?php echo $item['file'];?></a></td>
											<td style="padding:4px; vertical-align:middle;">
												<div class="btn-group">
													<button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown">
														<span class="caret"></span>
														<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li><a style="cursor:pointer" onclick="deleteData('<?php echo base_url().'registration/enter/upload_pdf/'.jarvis_encode(jarvis_echo($dataPdf,'Id')).'/'.jarvis_encode(json_encode(array('type'=>'delete','params'=>$item['id'])));?>')">Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
										<?php
									} 
								}
								?>
								</tbody>
								<tfoot>
									<tr>
										<th style="padding:4px; vertical-align:middle;">File</th>
										<th style="padding:4px; vertical-align:middle;">Action</th>
									</tr>
								</tfoot>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
