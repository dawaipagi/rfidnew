<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Matrix <?php echo jarvis_echo($dataMenuMatrixGet,'menu');?>
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Pemeliharaan</li>
				<li>Menu</li>
				<li>Matrix</li>
				<li class="active">Permission</li>
			</ol>
		</section>
		<?php 
		$dataForm=array(
		'permission'=>array(
			'title'=>'Permission "'.jarvis_echo($dataMenuMatrixGet,'label').'"',
			'url'=>'maintenance/manageMenu/matrix/'.jarvis_encode(jarvis_echo($dataMenuMatrixGet,'menu_id')).'/'.jarvis_encode(json_encode(array('type'=>'permission','params'=>jarvis_echo($dataMenuMatrixGet,'id'))))
		));
		?>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title"><?php echo $dataForm[$key_action]['title']; ?></h3>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive">
							<?php echo form_open($dataForm[$key_action]['url']); ?>
								<div class="box-body">
									<input type="hidden" readonly="readonly" value="<?php echo jarvis_echo($dataMenuMatrixGet,'id');?>" class="form-control" name="matrix_id">
									<?php
									$dataChecked=array();
									foreach($groupUser['data'] as $group_user) {
										foreach($dataMenuMatrixPerm['data'] as $assTo) { 
											$dataChecked[$assTo['group_user_id']]='checked=checked';
										}
										echo "<dd><label><input type='checkbox' name='permissionTo[]' ".(isset($dataChecked[$group_user['id']]) ? $dataChecked[$group_user['id']] : '' )." value='".$group_user['id']."'/>".$group_user['group']."</label></dd>";
									}
									?>
								</div><!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-primary btn-sm"><?php echo jarvis_call_configuration('save_button');?></button>
									<?php echo jarvis_back_button(4);?>
								</div>
							<?php echo form_close();?>
						</div><!-- /.box-body -->
					</div>
				</div>
			</div>

		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
