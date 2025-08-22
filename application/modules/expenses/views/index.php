<style>
.select_box{
width: 45%;
    float: left;
}
.select_box1{
width: 30%;
    float: right;
}
.select_box form.navbar-form.text-center {
    text-align: right;
}

</style>
<div id="headerbar">
	<div class="pull-left">
		<h1 class="headerbar-title"><?php _trans('expenses'); ?></h1>
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
			<a class="btn btn-sm btn-primary" href="<?php echo site_url('expenses/form'); ?>">
				<i class="fa fa-plus"></i> <?php _trans('new'); ?>
			</a>
		</div>

		<div class="headerbar-item pull-right">
			<?php echo pager(site_url('expenses/index'), 'mdl_expenses'); ?>
		</div>
	</div>
</div>

<div id="content" class="table-content">

    <?php $this->layout->load_view('layout/alerts'); ?>

    <div id="filter_results">
        <?php $this->layout->load_view('expenses/partial_expenses_table'); ?>
    </div>

</div>
