<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<?php 
		$dataForm=array(
		'matrix'=>array(
			'title'=>'Add Matrix',
			'url'=>'maintenance/manageMenu/matrix/'.jarvis_encode(jarvis_echo($dataMS,'id')),
			'set_value'=>array(
				'action_label_id'=>'',
				'url'=>'',
				'confirm_box'=>''
				),
			'form_active'=>array(
				'action_label_id'=>true,
				'url'=>true,
				'confirm_box'=>true
				)
			));
		?>
		<section class="content-header">
			<h1>
				Matrix <?php echo jarvis_echo($dataMS,'menu');?>
			</h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-dashboard"></i> Beranda</li>
				<li>Pemeliharaan</li>
				<li>Menu</li>
				<li class="active">Matrix</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<?php if(get_data_user('ref_group_user')=='J1' or get_data_user('ref_group_user')=='J4') { ?>
					<div class="box box-primary">
						<div class="box-body table-responsive">
							<?php echo form_open($dataForm[$key_action]['url']); ?>
								<div class="box-body">
								<input type="hidden" readonly="readonly" value="<?php echo jarvis_echo($dataMS,'id');?>" class="form-control" name="menu_id">
								<?php if($dataForm[$key_action]['form_active']['action_label_id']==true) { ?>
									<div class="form-group">
										<label for="Description">Label</label>
										<select class="form-control" name="action_label_id" style="height:29px;">
											<?php foreach($actionLabel['data'] as $actionLabel) {?>
												<option value="<?php echo $actionLabel['id'];?>" <?php if($actionLabel['id']==$dataForm[$key_action]['set_value']['action_label_id']) { $selected=true; } else { $selected=false; } echo set_select('action_label_id', $actionLabel['id'],$selected); ?>><?php echo $actionLabel['parameter'];?></option>
											<?php } ?>
										</select>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['url']==true) { ?>
									<div class="form-group">
										<label for="Module">URL</label>
										<input type="text" value="<?php echo set_value('url',$dataForm[$key_action]['set_value']['url']); ?>" class="form-control" name="url" placeholder="Enter URL" style="height:29px;">
										<?php echo form_error('url','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
									</div>
								<?php } ?>
								<?php if($dataForm[$key_action]['form_active']['confirm_box']==true) { ?>
									<div class="form-group">
										<label for="Module">With Popup Confirm?</label>
										<input type='radio' name='confirm_box' value="true"/> Yes | <input type='radio' name='confirm_box' value="false"/> No
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
					<?php } ?>
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Matrix List</h3>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive">
							<table id="module-table" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th style="padding:4px; vertical-align:middle;">Label</th>
										<th style="padding:4px; vertical-align:middle;">Url</th>
										<th style="padding:4px; vertical-align:middle;">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								if (is_array($dataMenuMatrix)){
									foreach($dataMenuMatrix['data'] as $item){ 
										?>
										<tr>
											<td style="padding:4px; vertical-align:middle;"><?php echo $item['label'];?></td>
											<td style="padding:4px; vertical-align:middle;"><?php echo $item['url'];?></td>
											<td style="padding:4px; vertical-align:middle;">
												<div class="btn-group">
													<button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown">
														<span class="caret"></span>
														<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li><a href="<?php echo base_url().'maintenance/manageMenu/matrix/'.jarvis_encode(jarvis_echo($dataMS,'id')).'/'.jarvis_encode(json_encode(array('type'=>'permission','params'=>$item['id'])));?>">Permission</a></li>
														<?php if(get_data_user('ref_group_user')=='J1' or get_data_user('ref_group_user')=='J4') { ?><li><a style="cursor:pointer" onclick="deleteData('<?php echo base_url().'maintenance/manageMenu/matrix/'.jarvis_encode(jarvis_echo($dataMS,'id')).'/'.jarvis_encode(json_encode(array('type'=>'delete','params'=>$item['id'])));?>')">Delete</a></li><?php } ?>
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
										<th style="padding:4px; vertical-align:middle;">Label</th>
										<th style="padding:4px; vertical-align:middle;">Url</th>
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
