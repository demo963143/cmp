<script>
    $(function () {
        // Creates the activity
        $('#add_activity').click(function () {
            var service_name=$("#service_name").val();
            var amount =$("#amount").val();
            var reminder=$("#reminder").val();
            var remarks=$("#remarks").val();
           	$.ajax({	
						url:'<?php echo site_url('clients/add_activity'); ?>',
						data: {'service_name':service_name,
						       'amount':amount,
						       'reminder':reminder,
						       'remarks':remarks,
						       'id':<?php echo $client->client_id; ?>
						    
						},
						type:'POST',
						success: function(result)
						{
						   // alert(result);
						    location.reload();
								
						}						
					});
        });
     
    })
</script>
<div id="headerbar">
    <h1 class="headerbar-title"><?php _htmlsc(format_client($client)); ?></h1>

</div>
 <?php
 $total_activities=0;
 foreach ($activities as $act) : 
 $total_activities += $act->amount;
 endforeach; ?>
<div id="content" class="tabbable tabs-below no-padding">
    
    <div class="tab-content no-padding">
<div class="container">
        <div id="clientDetails" class="tab-pane tab-rich-content active">

            <?php $this->layout->load_view('layout/alerts'); ?>

            <div class="row">
                 <div class="col-xs-12 col-sm-12 col-md-12 " style="text-align: right;">
                     <button type="button" class="btn btn-success" data-toggle="modal" data-target="#activityModal">
                                  Add Activity
                    </button>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-6">
                    
                    <h3 class="name-add"><?php _htmlsc(format_client($client)); ?></h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>
                                <?php _trans('member_since'); ?>
                            </th>
                            <td class="td-amount">
                                <?php echo ucfirst($client->client_date_created); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?php _trans('total_billed'); ?>
                            </th>
                            <td class="td-amount">
                                <?php echo format_currency($client->client_invoice_total+$total_activities); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?php _trans('total_paid'); ?>
                            </th>
                            <th class="td-amount">
                                <?php echo format_currency($client->client_invoice_paid+$total_activities); ?>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php _trans('total_balance'); ?>
                            </th>
                            <td class="td-amount">
                                <?php echo format_currency($client->client_invoice_balance); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?php _trans('usual_services'); ?>
                            </th>
                            <td class="usual_services">
                            <?php 
                                                       $services = "";
                                                       if($usual_invoice_services){
                                                       foreach ($usual_invoice_services as $us) {
                                                           $services .= $us->product.",<br>";
                                                       }  
                                                       }
                                                       if($usual_activity_services){
                                                       foreach ($usual_activity_services as $uas) {
                                                           $services .= $uas->service_name.",<br>";
                                                       }  
                                                       }
                                                           echo $services;
                            ?>
                            </td>
                        </tr>
                    </table>

                </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                   <div id="clientDetails" class="tab-pane tab-rich-content active">

            <?php $this->layout->load_view('layout/alerts'); ?>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    
                    <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#activity"><?php  _trans('activity_history'); ?></a></li>
                      <li><a data-toggle="tab" href="#invoice">Invoice History</a></li>
                    </ul>
                    <!--h3 class="name-add"><?php  _trans('activity_history'); ?></h3-->
                    <div class="tab-content1">
                          <div id="activity" class="tab-pane fade in active">
                                <?php $this->layout->load_view('clients/partial_activity_table'); ?>
                          </div>
                          <div id="invoice" class="tab-pane fade">
                                <?php $this->layout->load_view('clients/partial_invoice_table'); ?>
                          </div>
                    </div>
  
                </div>
            </div>
        </div>
                </div>

        </div>

     
    </div>
</div>
</div>
<!-- Modal -->


<div id="activityModal" class="modal modal-lg"
     role="dialog" aria-labelledby="modal_create_invoice" aria-hidden="true">
    <form class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
            <h4 class="panel-title"><?php _trans('add_activity'); ?></h4>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <label for="service_name" class="control-label"><?php _trans('service_name'); ?></label>
                <input type="text" name="service_name" id="service_name" class="form-control" placeholder="<?php _trans('service_name'); ?>"
                       value="">
            </div>
            <div class="form-group">
                <label for="amount" class="control-label"><?php _trans('amount'); ?></label>
                <input type="text" name="amount" id="amount" class="form-control" placeholder="<?php _trans('amount'); ?>"
                       value="">
            </div>
            <!--div class="form-group">
                <label for="employee" class="control-label"><?php _trans('emp_name'); ?></label>
                <select class="form-control" id="employee" name="employee">
                     <option selected>Select Employee</option>
                     <option value="1">One</option>
                     <option value="2">Two</option>
                     <option value="3">Three</option>
                </select>
            </div-->
            <div class="form-group">
                <label for="reminder" class="control-label"><?php _trans('service_reminder'); ?></label>
                <select class="form-control" id="reminder" name="reminder">
                     <option selected>Select Reminder</option>
                     <option value="Fortnightly">Fortnightly</option>
                     <option value="Monthly">Monthly</option>
                     <option value="Quarterly">Quarterly</option>
                     <option value="Yearly">Yearly</option>
                </select>
            </div>
            <div class="form-group">
                <label for="remarks" class="control-label"><?php _trans('remarks'); ?></label>
                <input type="text" name="remarks" id="remarks" class="form-control" placeholder="<?php _trans('remarks'); ?>"
                       value="">
            </div>

        </div>

        <div class="modal-footer">
            <div class="btn-group">
                <button class="btn btn-success ajax-loader" id="add_activity" type="button">
                    <i class="fa fa-check"></i> <?php _trans('submit'); ?>
                </button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <i class="fa fa-times"></i> <?php _trans('cancel'); ?>
                </button>
            </div>
        </div>

    </form>

</div>

