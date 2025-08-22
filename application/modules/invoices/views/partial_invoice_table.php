<style>
    .btnsms{
           display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: normal;
    line-height: 1.428571429;
    color: #333;
    white-space: nowrap;
    }
    .btnsms:hover {
    background-color: #029B8C;
    color: white;

}

</style>



<div class="table-responsive">
    <table class="table table-striped">

        <thead>
        <tr>
            <th><?php _trans('status'); ?></th> 
            <th><?php _trans('invoice'); ?></th>
            <th><?php _trans('created'); ?></th>
            <th><?php _trans('due_date'); ?></th>
            <th><?php _trans('client_name'); ?></th>
            <th style="text-align: right;"><?php _trans('amount'); ?></th>
            <th style="text-align: right;"><?php _trans('balance'); ?></th>
            <th><?php _trans('options'); ?></th>
        </tr>
        </thead>

        <tbody>
        <?php
        $invoice_idx = 1;
        $invoice_count = count($invoices);
        $invoice_list_split = $invoice_count > 3 ? $invoice_count / 2 : 9999;
        foreach ($invoices as $invoice) {
            // Disable read-only if not applicable
            if ($this->config->item('disable_read_only') == true) {
                $invoice->is_read_only = 0;
            }
            // Convert the dropdown menu to a dropup if invoice is after the invoice split
            $dropup = $invoice_idx > $invoice_list_split ? true : false;
            ?>
            <tr>
                <td>
                    <span class="label <?php echo $invoice_statuses[$invoice->invoice_status_id]['class']; ?>">
                        <?php echo $invoice_statuses[$invoice->invoice_status_id]['label'];
                        if ($invoice->invoice_sign == '-1') { ?>
                            &nbsp;<i class="fa fa-credit-invoice"
                                     title="<?php echo trans('credit_invoice') ?>"></i>
                        <?php }
                        if ($invoice->is_read_only == 1) { ?>
                            &nbsp;<i class="fa fa-read-only"
                                     title="<?php echo trans('read_only') ?>"></i>
                        <?php }; ?>
                    </span>
                </td>

                <td>
                    <a href="<?php echo site_url('invoices/view/' . $invoice->invoice_id); ?>"
                       title="<?php _trans('edit'); ?>">
                        <?php echo($invoice->invoice_number ? $invoice->invoice_number : $invoice->invoice_id); ?>
                    </a>
                </td>

                <td>
                    <?php echo date_from_mysql($invoice->invoice_date_created); ?>
                </td>

                <td>
                    <span class="<?php if ($invoice->is_overdue) { ?>font-overdue<?php } ?>">
                        <?php echo date_from_mysql($invoice->invoice_date_due); ?>
                    </span>
                </td>

                <td>
                    <a href="<?php echo site_url('clients/view/' . $invoice->client_id); ?>"
                       title="<?php _trans('view_client'); ?>">
                        <?php _htmlsc(format_client($invoice)); ?>
                    </a>
                </td>

                <td class="amount <?php if ($invoice->invoice_sign == '-1') {
                    echo 'text-danger';
                }; ?>">
                    <?php echo format_currency($invoice->invoice_total); ?>
                </td>

                <td class="amount">
                    <?php echo format_currency($invoice->invoice_balance); ?>
                </td>

                <td>
                    <div class="options btn-group<?php echo $dropup ? ' dropup' : ''; ?>">
                        <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <?php _trans('options'); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if ($invoice->is_read_only != 1) { ?>
                                <li>
                                    <a href="<?php echo site_url('invoices/view/' . $invoice->invoice_id); ?>">
                                        <i class="fa fa-edit fa-margin"></i> <?php _trans('edit'); ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <li>
                                <!--<a href="<?php echo site_url('invoices/generate_pdf/' . $invoice->invoice_id); ?>"
                                   target="_blank">
                                    <i class="fa fa-print fa-margin"></i> <?php _trans('download_pdf'); ?>
                                </a>-->
                                
                                <a href="<?php echo site_url('invoices/pdf?token='.uniqid().'&invoiceid='. $invoice->invoice_id); ?>"
                                   target="_blank">
                                    <i class="fa fa-print fa-margin"></i> <?php _trans('download_pdf'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('mailer/invoice/' . $invoice->invoice_id); ?>">
                                    <i class="fa fa-send fa-margin"></i> <?php _trans('send_email'); ?>
                                </a>
                            </li>
                            <li>
                               <!-- <a onclick='sendSms(<?php echo "\"$invoice->client_name\",$invoice->client_mobile,$invoice->invoice_total,$invoice->invoice_balance";?>)'>
                                    <i class="fa fa-envelope fa-margin"></i> Send SMS
                                </a>-->
                                
                                <!-- <a onclick='sendWASms(<?php echo "\"$invoice->client_name\",$invoice->client_mobile,$invoice->invoice_total,$invoice->invoice_number";?>)'>
                                    <i class="fa fa-envelope fa-margin"></i> Send SMS
                                </a>-->
                                <?php
                                //Bindia
                                 $validtoken = hash_hmac('ripemd160', 'q' . $invoice->invoice_id, $this->config->item('encryption_key'));
                                 $link = site_url('invoices/pdf?invoiceid=' . $invoice->invoice_id . '&token=' . $validtoken);
                    
                                 
                                ?>
                                <?php
                    
                                $val ="Dear ".$invoice->client_name."%0A%0AThank you for placing the order.%0AYour Order ID: ". $invoice->invoice_number." is created with amount of ".$invoice->invoice_total."%0A%0A";
                                     $val .= 'Item Details:%0A%0A';
                                  $resultval =$this->db->select('*')->from('ip_invoice_items')->where('invoice_id', $invoice->invoice_id)->get()->result_array();
                                  //$this->db->select('*')->from('ip_invoice_items')->where('invoice_id', $invoice->invoice_id)->get()->result_array();
                                  
                                  $i = 0;
                                  $totalamount = '';
                                  $discountamount = '';
                                  
                                   foreach($resultval as $value){  
                                       $i++;
                                       
                                       $sku =$this->db->select('*')->from('ip_products')->where('product_id', $value['item_product_id'])->get()->result_array();
                                       
                                       $amountsingle = $value['item_quantity']*$value['item_price'];
                                       $totalamount += $amountsingle; 
                                       $amountsinglediscount = $value['item_quantity']*$value['item_discount_amount'];
                                       $discountamount += $amountsinglediscount;
                                        $val .= ' '.$i.': '.$value['item_name'].($sku[0]['product_sku']).'='.$value['item_quantity'].'X'.$value['item_price'].'='.$amountsingle ."%0A%0A";
                                   }
                                   
                                $this->db->where('user_id', $this->session->userdata('user_id'));
                                $query12 = $this->db->get('ip_users');
                                $sms_sender = $query12->row();
            
                                   $val .= "Total Amount: ".$totalamount;
                                   $val .= "%0A Discount Amount: ".$discountamount;
                                   $val .= "%0A Bill: ".$invoice->invoice_total;
                                   $val .= "%0A%0AThanks"; 
                                   $val .= "%0A".$sms_sender->user_company;
                                     ?>
                                <a  href='https://api.whatsapp.com/send?phone=91<?= $invoice->client_mobile; ?>&text=<?= $val; ?>' target="_blank" >
                                    <i class="fa fa-envelope fa-margin"></i> Send SMS
                                    </a>
                                    <!--
                                      <a href='https://api.whatsapp.com/send?phone=91<?= $invoice->client_mobile; ?>&text=Thank%20You%20for%20placing%20the%20%20*order%20!*%0AYour%20order%20ID%20<?= $invoice->client_name ?>%0AInvoice%20Number:%20<?= $invoice->invoice_number ?>%0ABill%20Amount:%20Rs%20<?= $invoice->invoice_total ?>' target="_blank" >
                                    <i class="fa fa-envelope fa-margin"></i> Send SMS
                                    </a>-->
                            </li>
                            <?php
                    
                                $val ="Dear ".$invoice->client_name."%0A%0AThank you for placing the order.%0AYour Order ID: ". $invoice->invoice_number." is Ready with amount of ".$invoice->invoice_total."%0A%0A";
                                     $val .= 'Item Details:%0A%0A';
                                  $resultval =$this->db->select('*')->from('ip_invoice_items')->where('invoice_id', $invoice->invoice_id)->get()->result_array();
                                  //$this->db->select('*')->from('ip_invoice_items')->where('invoice_id', $invoice->invoice_id)->get()->result_array();
                                  
                                  $i = 0;
                                  $totalamount = '';
                                  $discountamount = '';
                                  
                                   foreach($resultval as $value){  
                                       $i++;
                                       
                                       $sku =$this->db->select('*')->from('ip_products')->where('product_id', $value['item_product_id'])->get()->result_array();
                                       
                                       $amountsingle = $value['item_quantity']*$value['item_price'];
                                       $totalamount += $amountsingle; 
                                       $amountsinglediscount = $value['item_quantity']*$value['item_discount_amount'];
                                       $discountamount += $amountsinglediscount;
                                        $val .= ' '.$i.': '.$value['item_name'].($sku[0]['product_sku']).'='.$value['item_quantity'].'X'.$value['item_price'].'='.$amountsingle ."%0A%0A";
                                   }
                                   
                                $this->db->where('user_id', $this->session->userdata('user_id'));
                                $query12 = $this->db->get('ip_users');
                                $sms_sender = $query12->row();
            
                                   $val .= "Total Amount: ".$totalamount;
                                   $val .= "%0A Discount Amount: ".$discountamount;
                                   $val .= "%0A Bill: ".$invoice->invoice_total;
                                   $val .= "%0A%0AThanks"; 
                                   $val .= "%0A".$sms_sender->user_company;
                                     ?>
                                <!-- <a class="btnsms" href='https://api.whatsapp.com/send?phone=91<?= $invoice->client_mobile; ?>&text=<?= $val; ?>' target="_blank" >
                                    <i class="fa fa-envelope fa-margin"></i> Send Ready SMS
                                    </a> -->
                                    <!--
                                      <a href='https://api.whatsapp.com/send?phone=91<?= $invoice->client_mobile; ?>&text=Thank%20You%20for%20placing%20the%20%20*order%20!*%0AYour%20order%20ID%20<?= $invoice->client_name ?>%0AInvoice%20Number:%20<?= $invoice->invoice_number ?>%0ABill%20Amount:%20Rs%20<?= $invoice->invoice_total ?>' target="_blank" >
                                    <i class="fa fa-envelope fa-margin"></i> Send SMS
                                    </a>-->
                            </li>
                            <li>
                                <a href="#" class="invoice-add-payment"
                                   data-invoice-id="<?php echo $invoice->invoice_id; ?>"
                                   data-invoice-balance="<?php echo $invoice->invoice_balance; ?>"
                                   data-invoice-payment-method="<?php echo $invoice->payment_method; ?>">
                                    <i class="fa fa-money fa-margin"></i>
                                    <?php _trans('enter_payment'); ?>
                                </a>
                            </li>
                            <?php if ($invoice->invoice_status_id == 1 || ($this->config->item('enable_invoice_deletion') === true && $invoice->is_read_only != 1)) { ?>
                                <li>
                                    <a href="<?php echo site_url('invoices/delete/' . $invoice->invoice_id); ?>"
                                       onclick="return confirm('<?php _trans('delete_invoice_warning'); ?>');">
                                        <i class="fa fa-trash-o fa-margin"></i> <?php _trans('delete'); ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php
            $invoice_idx++;
        } ?>
        </tbody>

    </table>
</div>

<script>

function sendSms(name, phone, total, blance){
    jQuery.ajax({
        url: "<?php echo site_url('invoices/sendinvoiceSms') ?>",
        type: 'POST',
        "data": {'name':name,'phone': phone, 'total':total,'blance':blance},
      //  dataType: 'json',
        success: function (data) {
           console.log("data : "+data); 
            alert("Message sent successfully");
            location.reload();
        },
        error: function (data) {
           alert("Message not sent");
           location.reload();
        }
    });
}

function sendWASms(name, phone, total, invoiceId){
    jQuery.ajax({
        url: "<?php echo site_url('invoices/sendinvoiceWASms') ?>",
        type: 'POST',
        "data": {'name':name,'phone': phone, 'total':total,'invoiceId':invoiceId},
      //  dataType: 'json',
        success: function (data) {
           console.log("data : "+data); 
            alert("Message sent successfully");
            location.reload();
        },
        error: function (data) {
           alert("Message not sent");
           location.reload();
        }
    });
}

</script>