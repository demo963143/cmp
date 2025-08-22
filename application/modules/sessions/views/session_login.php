<!doctype html>

<!--[if lt IE 7]>
<html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>
        <?php
        if (get_setting('custom_title') != '') {
            echo get_setting('custom_title');
        } else {
            echo 'Mink Chatter CMP';
        } ?>
    </title>

    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <meta name="robots" content="NOINDEX,NOFOLLOW">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/core/img/favicon.png">

    <link href="<?php echo base_url(); ?>assets/<?php echo get_setting('system_theme', 'invoiceplane'); ?>/css/style.css"
          rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/core/css/custom.css" rel="stylesheet">
 <style>
   body {
    background: rgba(0, 0, 0, 0) url("<?php echo base_url() ?>assets/core/img/bg.jpg") no-repeat scroll 0 0 / 100% 100%;
    height: 100vh;
}
   </style>
</head>

<body class="bg-add">

<noscript>
    <div class="alert alert-danger no-margin"><?php _trans('please_enable_js'); ?></div>
</noscript>

<br>

<div class="container" hidden>

    <div id="login" class="col-sm-8 col-sm-offset-3 col-md-4 col-md-offset-4">

        <?php if ($login_logo) { ?>
            <img src="<?php echo base_url(); ?>uploads/<?php echo $login_logo; ?>" class="login-logo img-responsive">
        <?php } else { ?>
            <!--<h1><?php _trans('login'); ?></h1>-->
        <?php } ?>
		           <div class="logo-top text-center">
					 <img class="logo" src="<?php echo base_url() ?>assets/core/img/logo.png" alt="logo"/><br>
					 Mink Chatter CMP
				</div>

        <div class="row"><?php $this->layout->load_view('layout/alerts'); ?></div>

        <form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

            <input type="hidden" name="_ip_csrf" value="<?= $this->security->get_csrf_hash() ?>">

            <div class="form-group">
                <label for="email" class="control-label"><?php _trans('email'); ?></label>
                <input type="email" name="email" id="email" class="form-control"
                       placeholder="<?php _trans('email'); ?>" required autofocus  value="<?php echo $_COOKIE["dbmail"]?>">
            </div>

            <div class="form-group">
                <label for="password" class="control-label"><?php _trans('password'); ?></label>
                <input type="password" name="password" id="password" class="form-control"
                       placeholder="<?php _trans('password'); ?>" required value="<?php echo $_COOKIE["userpass"]?>">
            </div>

            <input type="hidden" name="btn_login" value="true">

            <button type="submit" class="btn btn-primary" id="log_btn">
                <i class="fa fa-unlock fa-margin"></i> <?php _trans('login'); ?>
            </button>
            <a href="<?php echo site_url('sessions/passwordreset'); ?>" class="btn btn-default">
                <?php _trans('forgot_your_password'); ?>
            </a>

        </form>

    </div>
</div>
			<div class="footer">
				<div class="container">
				<p class="text-center">
					<a style="font-size: 12px;" href="#" target="_blank">Mink Chatter CMP a venture of - Indian Mesh Pvt. Ltd</a>
					</p>
				</div>
			</div>

</body>
</html>
			<script>
			$(document).ready(function(){
				$('#log_btn').click();
			}); 
			</script>