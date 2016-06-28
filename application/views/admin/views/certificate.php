<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Sertifikat
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Komponen Data</li>
				<li class="active">Sertifikat</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<?php echo form_open('admin/manageCT'); ?>
						<div class="input-group input-group">
							<input type="text" class="form-control" style="padding:6px 12px;" name="searchbox" placeholder="Cari Sertifikat ...">
							<span class="input-group-btn">
								<button class="btn btn-info btn-flat" type="submit" name="searchBtn" value="js_name">Go!</button>
							</span>
						</div>
					<?php echo form_close();?>
					<br>
					<div class="box box-primary">
						<div align="right" style="margin-top:10px; margin-right:10px;">
							<?php echo jarvis_permission('add',$permission);?>
							<?php echo jarvis_permission_v2($permission,array('tabel'=>'wm_jsertifikat','pk'=>'js_code','redirect'=>base_url().'admin/manageCT'));?>
						</div>
						<div class="box-body table-responsive" style="margin-top:-5px;">
							<table id="module-table" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th width="20" style="background:none; padding:4px; vertical-align:middle;"><input type="checkbox" class="checkAll"/></th>
										<th width="35" style="padding:4px; vertical-align:middle;">ID</th>
										<th style="padding:4px; vertical-align:middle;">Sertifikat</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								if (is_array($dataCT)) {
									foreach($dataCT['data'] as $item){ 
										?>
										<tr>
											<td style="padding:4px; vertical-align:middle; text-align:center;"><input type="checkbox" class="checkValue" value="<?php echo jarvis_encode($item['js_code']);?>" name="ctCheck[]"/></td>
											<td style="padding:4px; vertical-align:middle;"><?php echo $item['js_code'];?></td>
											<td style="padding:4px; vertical-align:middle;"><?php echo $item['js_name'];?></td>
										</tr>
										<?php
									} 
								}
								?>
								</tbody>
								<tfoot>
									<tr>
										<th style="padding:4px;"></th>
										<th style="padding:4px; vertical-align:middle;">ID</th>
										<th style="padding:4px; vertical-align:middle;">Sertifikat</th>
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
