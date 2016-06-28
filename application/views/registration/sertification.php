<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Sertifikasi
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Registrasi</li>
				<li class="active">Sertfikasi</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<?php echo form_open('registration/sertification/search'); ?>
						<div class="input-group input-group">
							<input type="text" class="form-control" name="nilai_pencarian" style="padding:6px 12px;" placeholder="Nilai Pencarian (Minimal 3 Karakter)">
							<span class="input-group-btn">
								<button class="btn btn-info btn-flat" type="submit" name="searchBtn" value="p_name">Go!</button>
							</span>
						</div>
					<?php echo form_close();?>
					<br>
					<div class="box box-primary">
						<div align="right" style="margin-top:10px; margin-right:10px;">
							<?php echo jarvis_permission('add',$permission);?>
							<?php echo jarvis_permission_v2($permission,array('tabel'=>'','pk'=>'id','redirect'=>base_url().'registration/enter'));?>
						</div>
						<div class="box-body table-responsive">
							<table id="module-table" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th width="20" style="background:none; padding:4px; vertical-align:middle;"><input type="checkbox" class="checkAll"/></th>
										<th style="padding:4px; vertical-align:middle;">Nama</th>
										<th style="padding:4px; vertical-align:middle;">No Sertifikasi</th>
										<th style="padding:4px; vertical-align:middle;">Status</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									foreach($dataReg->result_array() as $item){
										?>
										<tr>
											<td style="padding:4px; vertical-align:middle; text-align:center;"><input type="checkbox" class="checkValue" value="<?php echo jarvis_encode($item['Id']);?>" name="regCheck[]"/></td>
											<td style="padding:4px; vertical-align:middle;"><?php echo $item['p_name'];?></td>
											<td style="padding:4px; vertical-align:middle;"><?php echo $item['ser_no'];?></td>
											<td style="padding:4px; vertical-align:middle;"><?php echo $item['status_data_name'];?></td>
										</tr>
										<?php
									} 
								?>
								</tbody>
								<tfoot>
									<tr>
										<th style="padding:4px;"></th>
										<th style="padding:4px; vertical-align:middle;">Nama</th>
										<th style="padding:4px; vertical-align:middle;">No Sertifikasi</th>
										<th style="padding:4px; vertical-align:middle;">Status</th>
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
