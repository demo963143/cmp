<style>
.counter {
    background-color:#f5f5f5;
    padding: 20px 0;
    border-radius: 5px;
}

.count-title {
    font-weight: normal;
    margin-bottom: 0;
    text-align: center;
}


.fa-2x {
    margin: 0 auto;
    float: none;
    display: table;
    color: #4ad1e5;
}

</style>

<div id="content1" class="deshboad_main_page">
   <div class="container">
    <?php echo $this->layout->load_view('layout/alerts'); ?>
    <div class="row">
        <div class="fisrt_row">
            <div class="window_btn">
        <div class="col-md-1 col-xs-4 col-sm-3">
                   <button class="btn btn-success" onClick="window.location.reload();" type="button">
                    Today
                </button>
        </div>
        <div class="col-md-2 col-xs-4  col-sm-3">
                   <button class="btn btn-success" onclick="filter('7');" type="button">
                    Next 7 Days
                </button>
        </div>
        <div class="col-md-2 col-xs-4  col-sm-3">
                   <button class="btn btn-success" onclick="filter('15');" type="button">
                    Next 15 Days
                </button>
        </div>
        <div class="col-md-1 col-xs-4  col-sm-3">
                   <button class="btn btn-success" onclick="filter('month');" type="button">
                   Month
                </button>
        </div>
        </div>
        <div class="col-md-6 col-xs-12 ">
	        <div class="col-md-5  col-xs-12  col-sm-6 window_btn">
            <div class="col-md-12  col-xs-12">
                <div class="input-group">
                    <input name="payment_date" id="start_date"
                           class="form-control datepicker"
                           placeholder="Start <?php _trans('date'); ?>">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar fa-fw"></i>
                    </span>
                </div>
            </div>    
            </div>  
	        <div class="col-md-5  col-xs-12 col-sm-6 window_btn">
            <div class="col-md-12">
                <div class="input-group">
                    <input name="payment_date" id="end_date"
                           class="form-control datepicker"
                          placeholder="End <?php _trans('date'); ?>">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar fa-fw"></i>
                    </span>
                </div>
            </div>    
            </div> 
            <div class="col-md-2">
                   <button class="btn btn-success" onclick="filter('')" type="button">
                    <i class="fa fa-check"></i> <?php _trans('submit'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
		<div class="row ">
	        <div class="col-md-3   col-sm-6">
	        <div class="counter">
	           <div class="col-md-4 col-sm-4 box_icon"> 
              <i class="fa fa-user fa-2x"></i>
              </div>
                <div class="col-md-8 col-sm-8 box_txt"> 
              <h2 class="timer count-title count-number" id="clients_count" data-to="<?php echo $clients_count->clients;?>" data-speed="1500"></h2>
               <p class="count-text ">Clients Count</p>
            </div>   
            </div>
	        </div>
              <div class="col-md-3   col-sm-6">
               <div class="counter">
                    <div class="col-md-4 col-sm-4 box_icon"> 
                  <i class="fa fa-check-circle-o fa-2x"></i>
                   </div>
                   <div class="col-md-8 col-sm-8 box_txt"> 
                  <h2 class="timer count-title count-number" id="quotes_count" data-to="<?php echo $quotes_count->quotes;?>" data-speed="1500"></h2>
                  <p class="count-text ">Quotations Count</p>
                   </div>
                </div>
              </div>
              <div class="col-md-3  col-sm-6">
                  <div class="counter">
                      <div class="col-md-4 col-sm-4 box_icon">
                      <i class="fa fa-bars fa-2x"></i>
                      </div>
                      <div class="col-md-8 col-sm-8 box_txt">
                      <h2 class="timer count-title count-number" id="inv_count" data-to="<?php echo $invoice_count->inv_count;?>" data-speed="1500"></h2>
                      <p class="count-text ">Invoices Count</p>
                      
                      </div>
                    </div>
                </div>
        
	        <div class="col-md-3  col-sm-6">
	        <div class="counter">
	                 <div class="col-md-4 col-sm-4 box_icon">
              <i class="fa fa-tasks fa-2x"></i>
              </div>
                   <div class="col-md-8 col-sm-8 box_txt">
              <h2 class="timer count-title count-number" id="task_count" data-to="<?php  echo $task_count->tasks;?>" data-speed="1500"></h2>
               <p class="count-text ">Tasks </p>
               
               </div>
            </div>
	        </div>
              <div class="col-md-3  col-sm-6">
               <div class="counter">
                       <div class="col-md-4 col-sm-4 box_icon">
                  <i class="fa fa-money fa-2x"></i>
                  </div>
                      <div class="col-md-8 col-sm-8 box_txt">
                  <h2 class="timer count-title count-number" id="expenses_sum" data-to="<?php  echo $expenses_sum->total;?>" data-speed="1500"></h2>
                  <p class="count-text ">Expenses Sum</p>
                  
                  </div>
                </div>
              </div>
			  
              <div class="col-md-3  col-sm-6">
			  <a  data-toggle="modal" data-target="#birthday_modal">
                  <div class="counter">
                       
                          <div class="col-md-4 col-sm-4 box_icon">
                      <i class="fa fa-birthday-cake fa-2x"></i>
                      </div>
                          <div class="col-md-8 col-sm-8 box_txt">
                      <h2 class="timer count-title count-number" id="birthday_count" data-to="<?php echo count($today_birthdays);?>" data-speed="1500"></h2>
                      <p class="count-text ">Birthday</p>
                      
                      </div>
                    </div>
                </div>
			 </a>
          <div class="col-md-3  col-sm-6">
			<a  data-toggle="modal" data-target="#anniversary_modal">
            
                  <div class="counter">
                      
                          <div class="col-md-4 col-sm-4 box_icon">
                      <i class="fa fa-gift fa-2x"></i>
                      </div>
                          <div class="col-md-8 col-sm-8 box_txt">
                      <h2 class="timer count-title count-number" id="ann_count" data-to="<?php echo count($today_ann);?>" data-speed="1500"></h2>
                      <p class="count-text ">Anniversary</p>
                      </div>
                      
                    </div>
                
			</a>
			</div>
		
              <div class="col-md-3  col-sm-6">
                  	<a  data-toggle="modal" data-target="#activity_modal">
                  <div class="counter">
                       <div class="col-md-4 col-sm-4 box_icon">
                      <i class="fa fa-gift fa-2x"></i>
                      </div>
                         <div class="col-md-8 col-sm-8 box_txt">
                      <h2 class="timer count-title count-number" id="act_count" data-to="<?php echo count($today_activities);?>" data-speed="1500"></h2>
                      <p class="count-text ">Activities</p>
                      </div>
                      
                    </div>
                    	</a>
                </div>
		
		 </div>
			<div class="modal fade" id="birthday_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Birthdays</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					 <table class="table table-striped table-condensed no-margin" id="birthday_tbl">
                        <thead>
                        <tr>
                            <th style="min-width: 15%;">Client Name</th>
                            <th style="min-width: 15%;">Phone</th>
                            <th style="min-width: 15%;">Email</th>
                            <th style="min-width: 15%;">Date</th>
                            <th style="min-width: 15%;">Send sms</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($today_birthdays as $birthday) {
                             ?>
                            <tr>
                               
                                <td>
                                        <?php echo $birthday->client_name; ?>
                                </td>
                                <td>
                                    <?php echo $birthday->client_mobile; ?>
                                </td>
                                <td>
                                    <?php echo $birthday->client_email; ?>
                                </td>
                                <td>
                                    <?php echo $birthday->client_birthdate; ?>
                                </td>
                                <?php
                                    if($birthday->bir_sms == 0){?>
                                    
                                    <td>
                                        <button class='btn btn-primary' onclick='sendBirSms("<?php echo $birthday->client_id; ?>","<?php echo $birthday->client_mobile; ?>")'>Send</button>
                                    </td>
                                    <?php }
                                    else{
                                    ?>
                                        <td>Already Sent</td>
                                    <?php }
                                ?>
                             
                            </tr>
                        <?php } ?>
                     
                        </tbody>
                    </table>
				  </div>
				</div>
			  </div>
			</div>
			<div class="modal fade" id="activity_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Activities</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
				            <table class="table table-striped table-condensed no-margin" id="activity_table">
                        <thead>
                        <tr>
                            <th style="min-width: 15%;">Client Name</th>
                            <th style="min-width: 15%;">Service</th>
                            <th style="min-width: 15%;">Reminder</th>
                            <th style="min-width: 15%;">Date</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($today_activities as $activity) {
                             ?>
                            <tr>
                               
                                <td>
                                        <?php echo $activity->client_name."(".$activity->client_mobile.")"; ?>
                                </td>
                                <td>
                                    <?php echo $activity->service_name; ?>
                                </td>
                                <td>
                                    <?php echo $activity->reminder; ?>
                                </td>
                                <td>
                                    <?php echo date('d-m-Y',strtotime($activity->act_created_at)); ?>
                                </td>
                                <td>
                                    <?php echo format_currency($activity->amount); ?>
                                </td>
                             
                            </tr>
                        <?php } ?>
                     
                        </tbody>
                    </table>
				  </div>
				</div>
			  </div>
			</div>
			<div class="modal fade" id="anniversary_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Anniversary</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					 <table class="table table-striped table-condensed no-margin" id="anniversary_tbl">
                        <thead>
                        <tr>
                            <th style="min-width: 15%;">Client Name</th>
                            <th style="min-width: 15%;">Phone</th>
                            <th style="min-width: 15%;">Email</th>
                            <th style="min-width: 15%;">Date</th>
                            <th style="min-width: 15%;">Send sms</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($today_ann as $today_ann) {
                             ?>
                            <tr>
                               
                                <td>
                                        <?php echo $today_ann->client_name; ?>
                                </td>
                                <td>
                                    <?php echo $today_ann->client_mobile; ?>
                                </td>
                                <td>
                                    <?php echo $today_ann->client_email; ?>
                                </td>
                                <td>
                                    <?php echo $today_ann->client_anniversary; ?>
                                </td>
                                <?php
                                    if($today_ann->ann_sms == 0){?>
                                    <td><button class='btn btn-primary' onclick='sendAnniSms("<?php echo $today_ann->client_id; ?>","<?php echo $today_ann->client_mobile; ?>")'>Send</button></td>
                                   <?php }
                                    else{
                                    ?>
                                        <td>Already Sent</td>
                                    <?php }
                                ?>
                                
                             
                            </tr>
                        <?php } ?>
                     
                        </tbody>
                    </table>
				  </div>
				</div>
			  </div>
			</div>
   
    <!--div class="row">
        <div class="col-xs-12 col-md-6">

            <div id="panel-quote-overview" class="panel panel-default overview">

                <div class="panel-heading">
                    <b><i class="fa fa-bar-chart fa-margin"></i><?php _trans('activity'); ?> Reminder</b>
                    <span class="pull-right text-muted danger">
                        
                
                <select id="act_filter" class="form-control">

                        <option value="">Today</option>
                        <option value="7">Next 7 days</option>
                        <option value="15">Next 15 days</option>
                        <option value="month">Current Month</option>
                </select>
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-condensed no-margin" id="act_table">
                        <thead>
                        <tr>
                            <th style="min-width: 15%;">Client Name</th>
                            <th style="min-width: 15%;">Service</th>
                            <th style="min-width: 15%;">Reminder</th>
                            <th style="min-width: 15%;">Date</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($today_activities as $activity) {
                             ?>
                            <tr>
                               
                                <td>
                                        <?php echo $activity->client_name."(".$activity->client_mobile.")"; ?>
                                </td>
                                <td>
                                    <?php echo $activity->service_name; ?>
                                </td>
                                <td>
                                    <?php echo $activity->reminder; ?>
                                </td>
                                <td>
                                    <?php echo date('d-m-Y',strtotime($activity->act_created_at)); ?>
                                </td>
                                <td>
                                    <?php echo format_currency($activity->amount); ?>
                                </td>
                             
                            </tr>
                        <?php } ?>
                     
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div-->
        <div class="row <?php if (get_setting('disable_quickactions') == 1) echo 'hidden'; ?>">
        <div class="col-xs-12">

            <div id="panel-quick-actions" class="panel panel-default quick-actions">

                <div class="panel-heading">
                    <b><?php _trans('quick_actions'); ?></b>
                </div>

                <div class="btn-group btn-group-justified no-margin">
                    <a href="<?php echo site_url('clients/form'); ?>" class="btn btn-default">
                        <i class="fa fa-user fa-margin"></i>
                        <span class="hidden-xs"><?php _trans('add_client'); ?></span>
                    </a>
                    <a href="javascript:void(0)" class="create-quote btn btn-default">
                        <i class="fa fa-file fa-margin"></i>
                        <span class="hidden-xs"><?php _trans('create_quote'); ?></span>
                    </a>
                    <a href="javascript:void(0)" class="create-invoice btn btn-default">
                        <i class="fa fa-file-text fa-margin"></i>
                        <span class="hidden-xs"><?php _trans('create_invoice'); ?></span>
                    </a>
                    <a href="<?php echo site_url('payments/form'); ?>" class="btn btn-default">
                        <i class="fa fa-credit-card fa-margin"></i>
                        <span class="hidden-xs"><?php _trans('enter_payment'); ?></span>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">

            <div id="panel-quote-overview" class="panel panel-default overview">

                <div class="panel-heading">
                    <b><i class="fa fa-bar-chart fa-margin"></i> <?php _trans('quote_overview'); ?></b>
                    <span class="pull-right text-muted"><?php echo lang($quote_status_period); ?></span>
                </div>

                <table class="table table-bordered table-condensed no-margin">
                    <?php foreach ($quote_status_totals as $total) { ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url($total['href']); ?>">
                                    <?php echo $total['label']; ?>
                                </a>
                            </td>
                            <td class="amount">
                        <span class="<?php echo $total['class']; ?>">
                            <?php echo format_currency($total['sum_total']); ?>
                        </span>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
        <div class="col-xs-12 col-md-6">

            <div id="panel-invoice-overview" class="panel panel-default overview">

                <div class="panel-heading">
                    <b><i class="fa fa-bar-chart fa-margin"></i> <?php _trans('invoice_overview'); ?></b>
                    <span class="pull-right text-muted"><?php echo lang($invoice_status_period); ?></span>
                </div>

                <table class="table table-bordered table-condensed no-margin">
                    <?php foreach ($invoice_status_totals as $total) { ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url($total['href']); ?>">
                                    <?php echo $total['label']; ?>
                                </a>
                            </td>
                            <td class="amount">
                        <span class="<?php echo $total['class']; ?>">
                            <?php echo format_currency($total['sum_total']); ?>
                        </span>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>


            <?php if (empty($overdue_invoices)) { ?>
                <div class="panel panel-default panel-heading">
                    <span class="text-muted"><?php _trans('no_overdue_invoices'); ?></span>
                </div>
            <?php } else {
                $overdue_invoices_total = 0;
                foreach ($overdue_invoices as $invoice) {
                    $overdue_invoices_total += $invoice->invoice_balance;
                }
                ?>
                <div class="panel panel-danger panel-heading">
                    <?php echo anchor('invoices/status/overdue', '<i class="fa fa-external-link"></i> ' . trans('overdue_invoices'), 'class="text-danger"'); ?>
                    <span class="pull-right text-danger">
                        <?php echo format_currency($overdue_invoices_total); ?>
                    </span>
                </div>
            <?php } ?>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">

            <div id="panel-recent-quotes" class="panel panel-default">

                <div class="panel-heading">
                    <b><i class="fa fa-history fa-margin"></i> <?php _trans('recent_quotes'); ?></b>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-condensed no-margin">
                        <thead>
                        <tr>
                            <th><?php _trans('status'); ?></th>
                            <th style="min-width: 15%;"><?php _trans('date'); ?></th>
                            <th style="min-width: 15%;"><?php _trans('quote'); ?></th>
                            <th style="min-width: 35%;"><?php _trans('client'); ?></th>
                            <th style="text-align: right;"><?php _trans('balance'); ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($quotes as $quote) { ?>
                            <tr>
                                <td>
                                <span class="label
                                <?php echo $quote_statuses[$quote->quote_status_id]['class']; ?>">
                                    <?php echo $quote_statuses[$quote->quote_status_id]['label']; ?>
                                </span>
                                </td>
                                <td>
                                    <?php echo date_from_mysql($quote->quote_date_created); ?>
                                </td>
                                <td>
                                    <?php echo anchor('quotes/view/' . $quote->quote_id, ($quote->quote_number ? $quote->quote_number : $quote->quote_id)); ?>
                                </td>
                                <td>
                                    <?php echo anchor('clients/view/' . $quote->client_id, htmlsc(format_client($quote))); ?>
                                </td>
                                <td class="amount">
                                    <?php echo format_currency($quote->quote_total); ?>
                                </td>
                                <td style="text-align: center;">
                                    <a href="<?php echo site_url('quotes/generate_pdf/' . $quote->quote_id); ?>"
                                       title="<?php _trans('download_pdf'); ?>" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="6" class="text-right small">
                                <?php echo anchor('quotes/status/all', trans('view_all')); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-xs-12 col-md-6">

            <div id="panel-recent-invoices" class="panel panel-default">

                <div class="panel-heading">
                    <b><i class="fa fa-history fa-margin"></i> <?php _trans('recent_invoices'); ?></b>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-condensed no-margin">
                        <thead>
                        <tr>
                            <th><?php _trans('status'); ?></th>
                            <th style="min-width: 15%;"><?php _trans('due_date'); ?></th>
                            <th style="min-width: 15%;"><?php _trans('invoice'); ?></th>
                            <th style="min-width: 35%;"><?php _trans('client'); ?></th>
                            <th style="text-align: right;"><?php _trans('balance'); ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($invoices as $invoice) {
                            if ($this->config->item('disable_read_only') == true) {
                                $invoice->is_read_only = 0;
                            } ?>
                            <tr>
                                <td>
                                    <span class="label <?php echo $invoice_statuses[$invoice->invoice_status_id]['class']; ?>">
                                        <?php echo $invoice_statuses[$invoice->invoice_status_id]['label'];
                                        if ($invoice->invoice_sign == '-1') { ?>
                                            &nbsp;<i class="fa fa-credit-invoice"
                                                     title="<?php _trans('credit_invoice') ?>"></i>
                                        <?php }
                                        if ($invoice->is_read_only == 1) { ?>
                                            &nbsp;<i class="fa fa-read-only"
                                                     title="<?php _trans('read_only') ?>"></i>
                                        <?php }; ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="<?php if ($invoice->is_overdue) { ?>font-overdue<?php } ?>">
                                        <?php echo date_from_mysql($invoice->invoice_date_due); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php echo anchor('invoices/view/' . $invoice->invoice_id, ($invoice->invoice_number ? $invoice->invoice_number : $invoice->invoice_id)); ?>
                                </td>
                                <td>
                                    <?php echo anchor('clients/view/' . $invoice->client_id, htmlsc(format_client($invoice))); ?>
                                </td>
                                <td class="amount">
                                    <?php echo format_currency($invoice->invoice_balance * $invoice->invoice_sign); ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php if ($invoice->sumex_id != null): ?>
                                        <a href="<?php echo site_url('invoices/generate_sumex_pdf/' . $invoice->invoice_id); ?>"
                                           title="<?php _trans('download_pdf'); ?>" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo site_url('invoices/generate_pdf/' . $invoice->invoice_id); ?>"
                                           title="<?php _trans('download_pdf'); ?>" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="6" class="text-right small">
                                <?php echo anchor('invoices/status/all', trans('view_all')); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <?php if (get_setting('projects_enabled') == 1) : ?>
        <div class="row">
            <div class="col-xs-12 col-md-6">

                <div id="panel-projects" class="panel panel-default">

                    <div class="panel-heading">
                        <b><i class="fa fa-list fa-margin"></i> <?php _trans('projects'); ?></b>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed no-margin">
                            <thead>
                            <tr>
                                <th><?php _trans('project_name'); ?></th>
                                <th><?php _trans('client_name'); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($projects as $project) { ?>
                                <tr>
                                    <td>
                                        <?php echo anchor('projects/view/' . $project->project_id, htmlsc($project->project_name)); ?>
                                    </td>
                                    <td>
                                        <?php echo anchor('clients/view/' . $project->client_id, htmlsc(format_client($project))); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-md-6">

                <div id="panel-recent-invoices" class="panel panel-default">

                    <div class="panel-heading">
                        <b><i class="fa fa-check-square-o fa-margin"></i> <?php _trans('tasks'); ?></b>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-condensed no-margin">

                            <thead>
                            <tr>
                                <th><?php _trans('status'); ?></th>
                                <th><?php _trans('task_name'); ?></th>
                                <th><?php _trans('task_finish_date'); ?></th>
                                <th><?php _trans('project'); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($tasks as $task) { ?>
                                <tr>
                                    <td>
                                    <span class="label <?php echo $task_statuses["$task->task_status"]['class']; ?>">
                                        <?php echo $task_statuses["$task->task_status"]['label']; ?>
                                    </span>
                                    </td>
                                    <td>
                                        <?php echo anchor('tasks/form/' . $task->task_id, htmlsc($task->task_name)) ?>
                                    </td>
                                    <td>
                                    <span class="<?php if ($task->is_overdue) { ?>text-danger<?php } ?>">
                                        <?php echo date_from_mysql($task->task_finish_date); ?>
                                    </span>
                                    </td>
                                    <td>
                                        <?php echo !empty($task->project_id) ? anchor('projects/view/' . $task->project_id, htmlsc($task->project_name)) : ''; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                    </div>

                </div>

            </div>
        </div>
    <?php endif; ?>
</div>
</div>
<script>

function sendAnniSms(id, phone){
    jQuery.ajax({
        url: "<?php echo site_url('dashboard/sendAnniversarySms') ?>",
        type: 'POST',
        "data": {'phone': phone, 'id':id},
      //  dataType: 'json',
        success: function (data) {
           console.log("data : "+data); 
            alert("Message sent successfully");
            location.reload();
        },
        error: function (data) {
            console.log("data : "+data); 
           alert("Message not sent");
           location.reload();
        }
    });
}


function sendBirSms(id, phone){
    jQuery.ajax({
        url: "<?php echo site_url('dashboard/sendBirthdaySms') ?>",
        type: 'POST',
        "data": {'phone': phone, 'id':id},
      //  dataType: 'json',
        success: function (data) {
           console.log("data : "+data); 
            alert("Message sent successfully");
            location.reload();
        },
        error: function (data) {
            console.log("data : "+data); 
           alert("Message not sent");
           location.reload();
        }
    });
}


function filter(val)
{
 //counter search
    var start_date=$("#start_date").val();
    var end_date=$("#end_date").val();
        	$.ajax({	
    						url:'<?php echo site_url('dashboard/search_filter'); ?>',
    						data: {
    						       'search':val,
    						       'start_date':start_date,
    						       'end_date':end_date,
    						},
    						type:'POST',
    						dataType: "json",
    						success: function(result)
    						{
    						    var expenses_sum=result['expenses_sum'];
    						    if(expenses_sum==null)
    						    {
    						        expenses_sum=0;
    						    }
    						    var task_count=result['task_count'];
    						    var clients_count=result['clients_count'];
    						    var quotes_count=result['quotes_count'];
    						    var invoice_count=result['invoice_count'];
    						    $('#task_count').data("to",task_count);
    						    $('#task_count').html(task_count);
    						    $('#expenses_sum').data('to',expenses_sum);
    						    $('#expenses_sum').html(expenses_sum);
    						    $('#clients_count').data("to",clients_count);
    						    $('#clients_count').html(clients_count);
    						    $('#quotes_count').data("to",quotes_count);
    						    $('#quotes_count').html(quotes_count);
    						    $('#inv_count').data("to",invoice_count);
    						    $('#inv_count').html(invoice_count);
    						 
    						}						
					});
if(val!=''){
//activity search
      	$.ajax({	
				url:'<?php echo site_url('dashboard/search_activities'); ?>',
				data: {
				    'search':val,
				    //'start_date':start_date,
    			//	'end_date':end_date,
				},
				type:'POST',
			//	dataType: "json",
				success: function(result)
				{
					var data=result;
				 var row=""; 
				 var count=0;
					$.each(JSON.parse(data), function(i, obj) {
					    count=count+1;
						var currentTime = new Date(obj.act_created_at);
						var month = currentTime.getMonth() + 1;
						var date = currentTime.getDate();
						var year = currentTime.getFullYear();
						var act_date=date + '-' + month + '-' + year;
						row += "<tr><td>"+obj.client_name+"</td><td>"+obj.service_name+"</td><td>"+obj.reminder+"</td><td>"+act_date+"</td><td>"+obj.amount+"</td></tr>";
				
					});
			     $('#act_count').data("to",count);
			     $('#act_count').html(count);
				 $("#activity_table").find('tbody').empty();
				 $("#activity_table").find('tbody').append(row);
				}						
			});
}
if(val!=''){
//birthday search		
		$.ajax({	
				url:'<?php echo site_url('dashboard/search_birthdays'); ?>',
				data: {
				    'search':val,
				   // 'start_date':start_date,
    			//	'end_date':end_date,
				},
				type:'POST',
			//	dataType: "json",
				success: function(result)
				{
				   // alert(result);
					var data=result;
				 var row=""; 
				 var count1=0;
					$.each(JSON.parse(data), function(i, obj) {
					    count1=count1+1;
						row += "<tr><td>"+obj.client_name+"</td><td>"+obj.client_mobile+"</td><td>"+obj.client_email+"</td><td>"+obj.client_birthdate+"</td></tr>";
					 // alert(obj.client_name);
					});
			     $('#birthday_count').data("to",count1);
			     $('#birthday_count').html(count1);
				 $("#birthday_tbl").find('tbody').empty();
				 $("#birthday_tbl").find('tbody').append(row);
				}						
			});
}
if(val!=''){
//anniversery search		
		$.ajax({	
				url:'<?php echo site_url('dashboard/search_anniversary'); ?>',
				data: {
				    'search':val,
				 //   'start_date':start_date,
    			//	'end_date':end_date,
				},
				type:'POST',
			//	dataType: "json",
				success: function(result)
				{
				   // alert(result);
					var data2=result;
				 //   alert(result);
				 var row=""; 
				 var count2=0;
					$.each(JSON.parse(data2), function(i, obj2) {
					    count2=count2+1;
						row += "<tr><td>"+obj2.client_name+"</td><td>"+obj2.client_mobile+"</td><td>"+obj2.client_email+"</td><td>"+obj2.client_anniversary+"</td></tr>";
					 // alert(obj.client_name);
					});
			     $('#ann_count').data("to",count2);
			     $('#ann_count').html(count2);
				 $("#anniversary_tbl").find('tbody').empty();
				 $("#anniversary_tbl").find('tbody').append(row);
				}						
			});
}
}


    //reminder ssearch
  /*  $(function () {
            $("#act_filter").change(function () {
            var act_filter = $('#act_filter').val();
             	$.ajax({	
    						url:'<?php echo site_url('dashboard/search_activities'); ?>',
    						data: {'search':act_filter},
    						type:'POST',
    					//	dataType: "json",
    						success: function(result)
    						{
								var data=result;
							 var row=""; 
								$.each(JSON.parse(data), function(i, obj) {
									var currentTime = new Date(obj.act_created_at);
									var month = currentTime.getMonth() + 1;
									var date = currentTime.getDate();
									var year = currentTime.getFullYear();
									var act_date=date + '-' + month + '-' + year;
									row += "<tr><td>"+obj.client_name+"</td><td>"+obj.service_name+"</td><td>"+obj.reminder+"</td><td>"+act_date+"</td><td>"+obj.amount+"</td></tr>";
							
								});
							 $("#act_table").find('tbody').empty();
							 $("#act_table").find('tbody').append(row);
    						}						
					});
        });
        
        // search counts
        $('#search_filter').click(function () {
            var start_date=$("#start_date").val();
            var end_date =$("#end_date").val();
            if(start_date!="" && end_date!="")
            {
               	$.ajax({	
    						url:'<?php echo site_url('dashboard/search_filter'); ?>',
    						data: {'start_date':start_date,
    						       'end_date':end_date,
    						},
    						type:'POST',
    						dataType: "json",
    						success: function(result)
    						{
    						    var expenses_sum=result['expenses_sum'];
    						    if(expenses_sum==null)
    						    {
    						        expenses_sum=0;
    						    }
    						    var task_count=result['task_count'];
    						    var clients_count=result['clients_count'];
    						    var quotes_count=result['quotes_count'];
    						    var invoice_count=result['invoice_count'];
    						    $('#task_count').data("to",task_count);
    						    $('#task_count').html(task_count);
    						    $('#expenses_sum').data('to',expenses_sum);
    						    $('#expenses_sum').html(expenses_sum);
    						    $('#clients_count').data("to",clients_count);
    						    $('#clients_count').html(clients_count);
    						    $('#quotes_count').data("to",quotes_count);
    						    $('#quotes_count').html(quotes_count);
    						    $('#inv_count').data("to",invoice_count);
    						    $('#inv_count').html(invoice_count);
    						 
    						}						
					});
            }else{
                alert("Please select date.");
                location.reload();
            }
        });
     
    })*/
</script>
<script>

(function ($) {

	$.fn.countTo = function (options) {
		options = options || {};
		
		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);
			
			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;
			
			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};
			
			$self.data('countTo', data);
			
			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);
			
			// initialize the element with the starting value
			render(value);
			
			function updateTimer() {
				value += increment;
				loopCount++;
				
				render(value);
				
				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}
				
				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;
					
					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}
			
			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};
	
	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};
	
	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
	formatter: function (value, options) {
	  return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
	}
  });
  
  // start all the timers
  $('.timer').each(count);  
  
  function count(options) {
	var $this = $(this);
	options = $.extend({}, options || {}, $this.data('countToOptions') || {});
	$this.countTo(options);
  }
});

</script>