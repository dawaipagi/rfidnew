<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Employee
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Home</li>
				<li>Employee</li>
				<li class="active">Certificate</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">List of Certificate</h3>
							<div align="right" style="margin-top:10px; margin-right:10px;">
								<button type="button" class="btn btn-success btn-sm" onclick="location.href='<?php echo base_url().'employee/certificate/'.jarvis_encode(jarvis_echo($dataEmp,'p_id')).'/'.jarvis_encode(json_encode(array('type'=>'add'))); ?>'">Add</button>
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive">
							<table id="module-table" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Cert Number</th>
										<th>Start - End</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								if (is_array($dataEmpCert)) {
									foreach($dataEmpCert['data'] as $item){ 
										?>
										<tr>
											<td><?php echo $item['Id'];?></td>
											<td><?php echo $item['ser_no'];?></td>
											<td><?php echo jarvis_convert_field($item['ser_tglberlaku'],'jarvisDate').' - '.jarvis_convert_field($item['ser_tglakhir'],'jarvisDate');?></td>
											<td>
												<div class="btn-group">
													<button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown">
														<span class="caret"></span>
														<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li><a href="<?php echo base_url().'employee/certificate/'.jarvis_encode($item['pid']).'/'.jarvis_encode(json_encode(array('type'=>'edit','params'=>$item['Id'])));?>">Edit</a></li>
														<li><a style="cursor:pointer" onclick="deleteData('<?php echo base_url().'employee/certificate/'.jarvis_encode($item['pid']).'/'.jarvis_encode(json_encode(array('type'=>'delete','params'=>$item['Id'])));?>')">Delete</a></li>
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
										<th>ID</th>
										<th>Cert Number</th>
										<th>Start - End</th>
										<th>Action</th>
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
