<body>
<!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
<div align="center" style="margin-top:60px;">
<img width="90" src="<?php echo base_url().jarvis_call_configuration('logoDishub');?>"/>
<h4 style="color:#FBC818; text-shadow: 2px 2px #1A1111;"><?php echo jarvis_call_configuration('footerLoginBox');?></h4>
</div>
<div class="form-box" id="login-box" style="margin-top:10px;">
<div class="header"><h4>Verifikasi Email Berhasil..!</h4></div>
<form enctype="multipart/form-data" method="post" action="login/add_daftar_baru">
<div class="body bg-gray">

<div class="form-group">
<label for="Module"><center>Silahkan Login dengan Username dan Password anda. Terimkasih!</center></label>
</div>	

</div>
<div class="footer">                                     
<a href="<?php echo base_url();?>login" type="submit" class="btn bg-jarvis btn-block">Sign me in</a> 
</div>
<br>
</form>
</div>
