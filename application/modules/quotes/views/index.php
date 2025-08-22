
<style>
.select_box{
width: 40%;
    float: left;
}
.select_box1{
width: 50%;
    float: right;
}
.select_box form.navbar-form.text-center {
    text-align: right;
}

</style>
<div id="headerbar">
	<div class="pull-left">
		<h1 class="headerbar-title"><?php _trans('quotes'); ?></h1>
	</div>	
	<div class="select_box">
				<?php if (isset($filter_display) and $filter_display == true) { ?>
					<?php $this->layout->load_view('filter/jquery_filter'); ?>
					<form class="navbar-form text-center" role="search" onsubmit="return false;">
						<div class="form-group">
							<input id="filter" type="text" class="search-query form-control input-sm"
								   placeholder="<?php echo $filter_placeholder; ?>">
						</div>
					</form>
				<?php } ?>
	</div>
	<div class="select_box1">
		<div class="headerbar-item pull-right">
			<button type="button" class="btn btn-default btn-sm submenu-toggle hidden-lg"
					data-toggle="collapse" data-target="#ip-submenu-collapse">
				<i class="fa fa-bars"></i> <?php _trans('submenu'); ?>
			</button>
			<a class="create-quote btn btn-sm btn-primary" href="#">
				<i class="fa fa-plus"></i> <?php _trans('new'); ?>
			</a>
		</div>

		<div class="headerbar-item pull-right visible-lg">
			<?php echo pager(site_url('quotes/status/' . $this->uri->segment(3)), 'mdl_quotes'); ?>
		</div>

		<div class="headerbar-item pull-right visible-lg">
			<div class="btn-group btn-group-sm index-options">
				<a href="<?php echo site_url('quotes/status/all'); ?>"
				   class="btn <?php echo $status == 'all' ? 'btn-primary' : 'btn-default' ?>">
					<?php _trans('all'); ?>
				</a>
				<a href="<?php echo site_url('quotes/status/draft'); ?>"
				   class="btn <?php echo $status == 'draft' ? 'btn-primary' : 'btn-default' ?>">
					<?php _trans('draft'); ?>
				</a>
				<a href="<?php echo site_url('quotes/status/sent'); ?>"
				   class="btn <?php echo $status == 'sent' ? 'btn-primary' : 'btn-default' ?>">
					<?php _trans('sent'); ?>
				</a>
				<a href="<?php echo site_url('quotes/status/viewed'); ?>"
				   class="btn <?php echo $status == 'viewed' ? 'btn-primary' : 'btn-default' ?>">
					<?php _trans('viewed'); ?>
				</a>
				<a href="<?php echo site_url('quotes/status/approved'); ?>"
				   class="btn <?php echo $status == 'approved' ? 'btn-primary' : 'btn-default' ?>">
					<?php _trans('approved'); ?>
				</a>
				<a href="<?php echo site_url('quotes/status/rejected'); ?>"
				   class="btn <?php echo $status == 'rejected' ? 'btn-primary' : 'btn-default' ?>">
					<?php _trans('rejected'); ?>
				</a>
				<a href="<?php echo site_url('quotes/status/canceled'); ?>"
				   class="btn <?php echo $status == 'canceled' ? 'btn-primary' : 'btn-default' ?>">
					<?php _trans('canceled'); ?>
				</a>
			</div>
		</div>
	</div>

</div>

<div id="submenu">
    <div class="collapse clearfix" id="ip-submenu-collapse">

        <div class="submenu-row">
            <?php echo pager(site_url('quotes/status/' . $this->uri->segment(3)), 'mdl_quotes'); ?>
        </div>

        <div class="submenu-row">
            <div class="btn-group btn-group-sm index-options">
                <a href="<?php echo site_url('quotes/status/all'); ?>"
                   class="btn <?php echo $status == 'all' ? 'btn-primary' : 'btn-default' ?>">
                    <?php _trans('all'); ?>
                </a>
                <a href="<?php echo site_url('quotes/status/draft'); ?>"
                   class="btn <?php echo $status == 'draft' ? 'btn-primary' : 'btn-default' ?>">
                    <?php _trans('draft'); ?>
                </a>
                <a href="<?php echo site_url('quotes/status/sent'); ?>"
                   class="btn <?php echo $status == 'sent' ? 'btn-primary' : 'btn-default' ?>">
                    <?php _trans('sent'); ?>
                </a>
                <a href="<?php echo site_url('quotes/status/viewed'); ?>"
                   class="btn <?php echo $status == 'viewed' ? 'btn-primary' : 'btn-default' ?>">
                    <?php _trans('viewed'); ?>
                </a>
                <a href="<?php echo site_url('quotes/status/approved'); ?>"
                   class="btn <?php echo $status == 'approved' ? 'btn-primary' : 'btn-default' ?>">
                    <?php _trans('approved'); ?>
                </a>
                <a href="<?php echo site_url('quotes/status/rejected'); ?>"
                   class="btn <?php echo $status == 'rejected' ? 'btn-primary' : 'btn-default' ?>">
                    <?php _trans('rejected'); ?>
                </a>
                <a href="<?php echo site_url('quotes/status/canceled'); ?>"
                   class="btn <?php echo $status == 'canceled' ? 'btn-primary' : 'btn-default' ?>">
                    <?php _trans('canceled'); ?>
                </a>
            </div>
        </div>

    </div>
</div>

<div id="content" class="table-content">

    <div id="filter_results">
        <?php $this->layout->load_view('quotes/partial_quote_table', array('quotes' => $quotes)); ?>
    </div>

</div>
