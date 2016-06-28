<body>
<!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
<div align="center" style="margin-top:60px;">
<img width="90" src="<?php echo base_url().jarvis_call_configuration('logoDishub');?>"/>
<h4 style="color:#FBC818; text-shadow: 2px 2px #1A1111;"><?php echo jarvis_call_configuration('footerLoginBox');?></h4>
</div>
<div class="form-box" id="login-box" style="margin-top:10px;">
<div class="header"><h3>Registrasi User</h3></div>
<form enctype="multipart/form-data" method="post" action="<?php echo base_url();?>login/add_daftar_baru">
<div class="body bg-gray">
<div class="error"><strong><?php if ($this->session->flashdata('message'))echo $this->session->flashdata('message');?></strong></div>
<div class="form-group">
<input type="radio" name="ref_group_user" value="PO" class="" checked> <label for="Module">Perorangan</label>
<input style="margin-left:70px;" type="radio" name="ref_group_user" value="BU" class=""> <label  for="Module">Bada Usaha</label>
</div>				
<div class="form-group">
<label for="Module">Nama Lengkap</label>
<input type="text" name="name" class="form-control" placeholder="Nama" required/>
<?php echo form_error('name','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
</div>	
<div class="form-group">
<label for="Module">Email</label>
<input type="text" name="email" class="form-control" placeholder="Email" required/>
<?php echo form_error('email','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
</div>
<div class="form-group">
<label for="Module">No Telepon</label>
<input type="text" name="phone_number" class="form-control" placeholder="No Telepon" required/>
<?php echo form_error('phone_number','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
</div>	
<div class="form-group">
<label for="Module">Alamat</label>
<input type="text" name="address" class="form-control" placeholder="Alamat" required/>
<?php echo form_error('address','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
</div>																	
<div class="form-group">
<label for="Module">Username</label>				
<input type="text" name="username" class="form-control" placeholder="User Name" required/>
<?php echo form_error('username','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
</div>
<div class="form-group">
<label for="Module">Password</label>				
<input type="password" name="password" class="form-control" placeholder="Password" required/>
<?php echo form_error('password','<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>'); ?>
</div>  

<div class="form-group">
<label for="avatar">Photo</label>
<input class="form-control" type="file" name="avatar">
</div>

<div class="form-group">
<p><?=$image;?></p>
<p><input type="text" class="form-control" name="secutity_code" required></p>
</div>
</div>
<div class="footer">                                     
<button type="submit" class="btn bg-jarvis btn-block">Register</button> 
</div>
<br>
</form>
</div>
