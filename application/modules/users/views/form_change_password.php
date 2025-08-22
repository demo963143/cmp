<script src="<?php echo base_url(); ?>assets/core/js/zxcvbn.js"></script>

<form method="post">

    <input type="hidden" name="_ip_csrf" value="<?= $this->security->get_csrf_hash() ?>">

    <div id="headerbar">
        <h1 class="headerbar-title"><?php _trans('change_password'); ?></h1>
        <?php /* echo $this->layout->load_view('layout/header_buttons'); */ ?>
		<div class="headerbar-item pull-right">
    <div class="btn-group btn-group-sm">
        <?php if (!isset($hide_submit_button)) : ?>
            <button id="btn-submit" name="btn_submit" class="btn btn-success ajax-loader" value="1">
                <i class="fa fa-check"></i> <?php _trans('save'); ?>
            </button>
        <?php endif; ?>
        <?php if (!isset($hide_cancel_button)) : ?>
            <button id="btn-cancel" name="btn_cancel" class="btn btn-danger" value="1">
                <i class="fa fa-times"></i> <?php _trans('cancel'); ?>
            </button>
        <?php endif; ?>
    </div>
</div>

    </div>

    <div id="content">

        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">

                <?php $this->layout->load_view('layout/alerts'); ?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php _trans('change_password'); ?>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="user_password">
                                <?php _trans('password'); ?>
                            </label>
                            <input type="password" name="user_password" id="user_password"
                                   class="form-control passwordmeter-input">
                            <div class="progress" style="height:3px;">
                                <div class="progress-bar progress-bar-danger passmeter passmeter-1"
                                     style="width: 33%"></div>
                                <div class="progress-bar progress-bar-warning passmeter passmeter-2"
                                     style="display: none; width: 33%"></div>
                                <div class="progress-bar progress-bar-success passmeter passmeter-3"
                                     style="display: none; width: 34%"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="user_passwordv">
                                <?php _trans('verify_password'); ?>
                            </label>
                            <input type="password" name="user_passwordv" id="user_passwordv"
                                   class="form-control">
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
<?php $id=$_GET['id'];?>
</form>
<script>
$(document).ready(function(){
	$("#btn-submit").click(function(){
		var user_password = $("#user_password").val();
		var user_passwordv = $("#user_passwordv").val();
		if(user_password != "" )
		{
			if(user_password==user_passwordv){
					$.ajax({
							url:'https://<?php echo $_SERVER['SERVER_NAME']?>/login/change_user_password.php',
							data: {'userpass':user_password},
							type:'POST',
							success: function(result)
							{
								$.ajax({	
        								url:'<?php echo site_url('users/change_password/'.$id); ?>',
        								type: 'GET', 
        								success: function(data)
											{
											}						
										});
							}
					});
			}	
		}
	});
});
</script>