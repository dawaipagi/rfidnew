<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Data Excel
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Registrasi</li>
				<li class="active">Data Excel</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<?php echo form_open('registration/excel'); ?>
						<div class="input-group input-group">
							<input type="text" class="form-control" name="searchbox" style="padding:6px 12px;" placeholder="Cari Nama ...">
							<span class="input-group-btn">
								<button class="btn btn-info btn-flat" type="submit" name="searchBtn" value="nama">Go!</button>
							</span>
						</div>
					<?php echo form_close();?>
					<br>
					<div class="box box-primary">
						<div align="right" style="margin-top:10px; margin-right:10px;">
							<button type="button" class="btn btn-success btn-sm" onclick="location.href='<?php echo base_url().'registration/import';?>'"><?php echo jarvis_call_configuration('back_button');?></button>
							<button type="submit" class="btn btn-primary btn-sm" onclick="moveExcelData('<?php echo base_url().'action_mix/proses_excel_data';?>')">Selesai</button>
							<button type="submit" class="btn btn-danger btn-sm" onclick="deleteDataForm('<?php echo base_url().'action_mix/delete_all';?>','wm_excel_data','id','<?php echo base_url().'registration/excel';?>')">Hapus</button>
						</div>
						<div class="box-body table-responsive">
							<table id="module-table" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th width="20" style="background:none; padding:4px; vertical-align:middle;"><input type="checkbox" class="checkAll"/></th>
										<th style="padding:4px; vertical-align:middle;">Nama</th>
										<th style="padding:4px; vertical-align:middle;">No Sertifikasi</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								if (is_array($dataExcel)) {
									foreach($dataExcel['data'] as $item){ 
										?>
										<tr>
											<td style="padding:4px; vertical-align:middle; text-align:center;"><input type="checkbox" class="checkValue" value="<?php echo jarvis_encode($item['id']);?>" name="excelCheck[]"/></td>
											<td style="padding:4px; vertical-align:middle;"><?php echo $item['nama'];?></td>
											<td style="padding:4px; vertical-align:middle;"><?php echo $item['ser_no'];?></td>
										</tr>
										<?php
									} 
								}
								?>
								</tbody>
								<tfoot>
									<tr>
										<th style="padding:4px;"></th>
										<th style="padding:4px; vertical-align:middle;">Nama</th>
										<th style="padding:4px; vertical-align:middle;">No Sertifikasi</th>
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
