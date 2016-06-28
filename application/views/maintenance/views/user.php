<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				User
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Pemeliharaan</li>
				<li class="active">User</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<?php echo form_open('maintenance/manageUser'); ?>
						<div class="input-group input-group">
							<input type="text" class="form-control" name="searchbox" style="padding:6px 12px;" placeholder="Cari Nama ...">
							<span class="input-group-btn">
								<button class="btn btn-info btn-flat" type="submit" name="searchBtn" value="name">Go!</button>
							</span>
						</div>
					<?php echo form_close();?>
					<br>
					<div class="box box-primary">
						<div align="right" style="margin-top:10px; margin-right:10px;">
							<?php echo jarvis_permission('add',$permission);?>
							<?php echo jarvis_permission_v2($permission,array('tabel'=>'jarvis_user','pk'=>'id','redirect'=>base_url().'maintenance/manageUser'));?>
						</div>
						<div class="box-body table-responsive" style="margin-top:-5px;">
							<table id="module-table" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th width="20" style="background:none; padding:4px; vertical-align:middle;"><input type="checkbox" class="checkAll"/></th>
										<th width="35" style="padding:4px; vertical-align:middle;">ID</th>
										<th style="padding:4px; vertical-align:middle;">Username</th>
										<th style="padding:4px; vertical-align:middle;">Nama</th>
										<th style="padding:4px; vertical-align:middle;">Group</th>
										<th style="padding:4px; vertical-align:middle;">Banned</th>
										<th style="padding:4px; vertical-align:middle;">Aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								if (is_array($dataUser)){
									foreach($dataUser['data'] as $item){ 
										?>
										<tr>
											<td style="padding:4px; vertical-align:middle; text-align:center;"><input type="checkbox" class="checkValue" value="<?php echo jarvis_encode($item['id']);?>" name="userCheck[]"/></td>
											<td style="padding:4px; vertical-align:middle;"><?php echo $item['id'];?></td>
											<td style="padding:4px; vertical-align:middle;"><?php echo $item['username'];?></td>
											<td style="padding:4px; vertical-align:middle;"><?php echo $item['name'];?></td>
											<td style="padding:4px; vertical-align:middle;"><?php echo $item['group'];?></td>
											<td style="padding:4px; vertical-align:middle;"><?php if($item['banned']=='true') {echo'Yes';} else {echo'No';}?></td>
											<td style="padding:4px; vertical-align:middle;"><?php echo jarvis_permission('banned',$permission,array('id'=>jarvis_encode($item['id']),'banned'=>$item['banned']));?></td>
										</tr>
										<?php
									} 
								}
								?>
								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th style="padding:4px; vertical-align:middle;">ID</th>
										<th style="padding:4px; vertical-align:middle;">Username</th>
										<th style="padding:4px; vertical-align:middle;">Nama</th>
										<th style="padding:4px; vertical-align:middle;">Group</th>
										<th style="padding:4px; vertical-align:middle;">Banned</th>
										<th style="padding:4px; vertical-align:middle;">Aksi</th>
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
