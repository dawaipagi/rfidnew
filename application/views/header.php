<!DOCTYPE html>
<html class="<?php echo $html_class;?>">
    <head>
        <meta charset="UTF-8">
        <title><?php echo jarvis_call_configuration('sitename');?> | <?php echo $page_title;?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php echo add_css($css); ?>
		<style type="text/css">
		.content{
			display:none;
		}
		</style>
		<link rel="shortcut icon" href="<?php echo base_url()."img/dishub.ico"; ?>" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
