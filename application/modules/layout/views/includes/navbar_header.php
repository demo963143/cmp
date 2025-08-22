<nav class="navbar navbar-inverse" role="navigation" id="header">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#ip-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <?php echo trans('menu') ?> &nbsp; <i class="fa fa-bars"></i>
            </button>
        </div>
        <div class="logo">
		<img alt="logo" src="<?php echo base_url(); ?>assets/core/img/logo.png"/>
		</div>
        <div class="collapse navbar-collapse" id="ip-navbar-collapse">
		
            <ul class="nav navbar-nav">
                <li class=""><?php echo anchor('editor', 'Editor', 'class="hidden-md"') ?>
                    <?php echo anchor('dashboard', '<i class="fa fa-dashboard"></i>', 'class="visible-md-inline-block"') ?>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md"><?php _trans('clients'); ?></span>
                        <i class="visible-md-inline fa fa-users"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><?php echo anchor('clienteditor/form', trans('add_client')); ?></li>
                        <li><?php echo anchor('clienteditor/index', trans('view_clients')); ?></li>
                    </ul>
                </li>

              
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md"><?php _trans('invoices'); ?></span>
                        <i class="visible-md-inline fa fa-file-text"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="create-invoice"><?php _trans('create_invoice'); ?></a></li>
                        <li><?php echo anchor('invoices_editor/index', trans('view_invoices')); ?></li>
                      
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i> &nbsp;
                        <span class="hidden-md"><?php _trans('payments'); ?></span>
                        <i class="visible-md-inline fa fa-credit-card"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><?php echo anchor('payments_editor/form', trans('enter_payment')); ?></li>
                        <li><?php echo anchor('payments_editor/index', trans('view_payments')); ?></li>
                    </ul>
                </li>

               

              
            </ul>

            <?php if (isset($filter_display) and $filter_display == true) { ?>
                <?php $this->layout->load_view('filter/jquery_filter'); ?>
                <form class="navbar-form navbar-left" role="search" onsubmit="return false;">
                    <div class="form-group">
                        <input id="filter" type="text" class="search-query form-control input-sm"
                               placeholder="<?php echo $filter_placeholder; ?>">
                    </div>
                </form>
            <?php } ?>

            <ul class="nav navbar-nav navbar-right">
                <!--<li>
                    <a href="http://docs.invoiceplane.com/" target="_blank"
                       class="tip icon" title="//<?php _trans('documentation'); ?>"
                       data-placement="bottom">
                        <i class="fa fa-question-circle"></i>
                        <span class="visible-xs">&nbsp;//<?php _trans('documentation'); ?></span>
                    </a>
                </li>-->

              <!--    <li>
                    <a href="<?php echo site_url('users/form/' .
                        $this->session->userdata('user_id')); ?>"
                       class="tip icon" data-placement="bottom"
                       title="<?php
                       _htmlsc($this->session->userdata('user_name'));
                       if ($this->session->userdata('user_company')) {
                           print(" (" . htmlsc($this->session->userdata('user_company')) . ")");
                       }
                       ?>">
                        <i class="fa fa-user"></i>
                        <span class="visible-xs">&nbsp;<?php
                            _htmlsc($this->session->userdata('user_name'));
                            if ($this->session->userdata('user_company')) {
                                print(" (" . htmlsc($this->session->userdata('user_company')) . ")");
                            }
                            ?></span>
                    </a>
                </li>-->
                <li>
                    <a href="<?php echo site_url('sessions/logout'); ?>"
                       class="tip icon logout" data-placement="bottom"
                       title="<?php _trans('logout'); ?>">
                        <i class="fa fa-power-off"></i>
                        <span class="visible-xs">&nbsp;<?php _trans('logout'); ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
			jQuery(document).ready(function() {
			$(window).scroll(function() {
				var sticky = $('#header'),
					scroll = $(window).scrollTop();
				if (scroll > 20) sticky.addClass('fixed');
				else sticky.removeClass('fixed');
			});
		});
   </script>
