<script>
    $(function () {
        $('#save_client_note').click(function () {
            $.post('<?php echo site_url('clients/ajax/save_client_note'); ?>',
                {
                    client_id: $('#client_id').val(),
                    client_note: $('#client_note').val()
                }, function (data) {
                    <?php echo (IP_DEBUG ? 'console.log(data);' : ''); ?>
                    var response = JSON.parse(data);
                    if (response.success === 1) {
                        // The validation was successful
                        $('.control-group').removeClass('error');
                        $('#client_note').val('');

                        // Reload all notes
                        $('#notes_list').load("<?php echo site_url('clients/ajax/load_client_notes'); ?>",
                            {
                                client_id: <?php echo $client->client_id; ?>
                            }, function (response) {
                                <?php echo (IP_DEBUG ? 'console.log(response);' : ''); ?>
                            });
                    } else {
                        // The validation was not successful
                        $('.control-group').removeClass('error');
                        for (var key in response.validation_errors) {
                            $('#' + key).parent().addClass('has-error');
                        }
                    }
                });
        });
    });
</script>

<?php
$locations = array();
foreach ($custom_fields as $custom_field) {
    if (array_key_exists($custom_field->custom_field_location, $locations)) {
        $locations[$custom_field->custom_field_location] += 1;
    } else {
        $locations[$custom_field->custom_field_location] = 1;
    }
}
?>

<div id="headerbar">
    <h1 class="headerbar-title"><?php _htmlsc(format_client($client)); ?></h1>

    <div class="headerbar-item pull-right">
        <div class="btn-group btn-group-sm">
            <a href="#" class="btn btn-default client-create-quote" data-client-id="<?php echo $client->client_id; ?>">
                <i class="fa fa-file"></i> <?php _trans('create_quote'); ?>
            </a>
            <a href="#" class="btn btn-default client-create-invoice"
                data-client-id="<?php echo $client->client_id; ?>">
                <i class="fa fa-file-text"></i> <?php _trans('create_invoice'); ?></a>
            <a href="<?php echo site_url('clients/form/' . $client->client_id); ?>" class="btn btn-default">
                <i class="fa fa-edit"></i> <?php _trans('edit'); ?>
            </a>
            <a class="btn btn-danger" href="<?php echo site_url('clients/delete/' . $client->client_id); ?>"
                onclick="return confirm('<?php _trans('delete_client_warning'); ?>');">
                <i class="fa fa-trash-o"></i> <?php _trans('delete'); ?>
            </a>
        </div>
    </div>

</div>

<ul id="submenu" class="nav nav-tabs nav-tabs-noborder">
    <li class="active"><a data-toggle="tab" href="#clientDetails"><?php _trans('details'); ?></a></li>
    <li><a data-toggle="tab" href="#clientQuotes"><?php _trans('quotes'); ?></a></li>
    <li><a data-toggle="tab" href="#clientInvoices"><?php _trans('invoices'); ?></a></li>
    <li><a data-toggle="tab" href="#clientPayments"><?php _trans('payments'); ?></a></li>
</ul>

<div id="content" class="tabbable tabs-below no-padding">
    <div class="tab-content no-padding">

        <div id="clientDetails" class="tab-pane tab-rich-content active">

            <?php $this->layout->load_view('layout/alerts'); ?>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">

                    <h3 class="name-add"><?php _htmlsc(format_client($client)); ?></h3>
                    <p class="">
                        <?php $this->layout->load_view('clients/partial_client_address'); ?>
                    </p>

                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">

                    <table class="table table-bordered">
                        <tr>
                            <th>
                                <?php _trans('language'); ?>
                            </th>
                            <td class="td-amount">
                                <?php echo ucfirst($client->client_language); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?php _trans('total_billed'); ?>
                            </th>
                            <td class="td-amount">
                                <?php echo format_currency($client->client_invoice_total); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?php _trans('total_paid'); ?>
                            </th>
                            <th class="td-amount">
                                <?php echo format_currency($client->client_invoice_paid); ?>
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
                    </table>

                </div>
            </div>


            <div class="row">

                <div class="col-xs-12 col-md-6 ">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php _trans('contact_information'); ?></div>
                        <div class="panel-body table-content">
                            <table class="table">
                                <?php if ($client->client_email): ?>
                                    <tr>
                                        <th><?php _trans('email'); ?></th>
                                        <td><?php echo auto_link($client->client_email, 'email'); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($client->client_mobile): ?>
                                    <tr>
                                        <th><?php _trans('mobile'); ?></th>
                                        <td><?php _htmlsc($client->client_mobile); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($client->room_no): ?>
                                    <tr>
                                        <th>Room Number</th>
                                        <td><?php _htmlsc($client->room_no); ?></td>
                                    </tr>
                                <?php endif; ?>
                              
                                <?php foreach ($custom_fields as $custom_field): ?>
                                    <?php if ($custom_field->custom_field_location != 2) {
                                        continue;
                                    } ?>
                                    <tr>
                                        <?php
                                        $column = $custom_field->custom_field_label;
                                        $value = $this->mdl_client_custom->form_value('cf_' . $custom_field->custom_field_id);
                                        ?>
                                        <th><?php _htmlsc($column); ?></th>
                                        <td><?php _htmlsc($value); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-xs-12 col-md-6 ">
                    <div class="panel panel-default">
                        <div class="panel-heading">Document Information</div>
                        <div class="panel-body table-content">
                            <table class="table">
                               

                                <?php if ($client->security_amount): ?>
                                    <tr>
                                        <th>Security Amount</th>
                                        <td>₹<?php _htmlsc($client->security_amount); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($client->client_gst_no): ?>
                                    <tr>
                                        <th><?php _trans('gst_no'); ?></th>
                                        <td><?php _htmlsc($client->client_gst_no); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($client->client_adhaar_no): ?>
                                    <tr>
                                        <th><?php _htmlsc($client->document_type); ?></th>
                                        <td><?php _htmlsc($client->client_adhaar_no); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($client->document_file_name): ?>
                                    <tr>
                                        <th>Document View</th>
                                        <td>
                                            <?php
                                            $documents = explode(',', $client->document_file_name);
                                            foreach ($documents as $document):
                                                $document = trim($document);
                                                $document = str_replace(' ', '_', $document);
                                                ?>
                                                <a style="color:blue;"
                                                    href="<?php echo base_url('assets/core/img/document/' . $document); ?>"
                                                    target="_blank">
                                                    View Document
                                                </a><br>
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($client->tenant_file_name): ?>
                                    <tr>
                                        <th> Tenant Photo</th>
                                        <td>
                                            <?php
                                            $documentss = explode(',', $client->tenant_file_name);
                                            foreach ($documentss as $document):
                                                $document = trim($document);
                                                $document = str_replace(' ', '_', $document);
                                                ?>                   
                                                <img src="<?php echo base_url('assets/core/img/tenant-photo/' . $document); ?>" alt="Tenant Photo" style="max-width: 200px; margin-top: 10px;" />
                                                <br>
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>


                                <?php if ($client->student_file_name): ?>
                                    <tr>
                                        <th>Student Document</th>
                                        <td>
                                            <?php
                                            $docuss = explode(',', $client->student_file_name);
                                            foreach ($docuss as $document):
                                                $document = trim($document);
                                                $document = str_replace(' ', '_', $document);
                                                ?>
                                                <a style="color:blue;"
                                                    href="<?php echo base_url('assets/core/img/Student-photo/' . $document); ?>"
                                                    target="_blank">
                                                    Student Document
                                                </a><br>
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($client->employee_file_name): ?>
                                    <tr>
                                        <th>Employee Document</th>
                                        <td>
                                            <?php
                                            $emp = explode(',', $client->employee_file_name);
                                            foreach ($emp as $document):
                                                $document = trim($document);
                                                $document = str_replace(' ', '_', $document);
                                                ?>
                                                <a style="color:blue;"
                                                    href="<?php echo base_url('assets/core/img/employee-photo/' . $document); ?>"
                                                    target="_blank">
                                                    Employee Document
                                                </a><br>
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>


                                <?php foreach ($custom_fields as $custom_field): ?>
                                    <?php if ($custom_field->custom_field_location != 4) {
                                        continue;
                                    } ?>
                                    <tr>
                                        <?php
                                        $column = $custom_field->custom_field_label;
                                        $value = $this->mdl_client_custom->form_value('cf_' . $custom_field->custom_field_id);
                                        ?>
                                        <th><?php _htmlsc($column); ?></th>
                                        <td><?php _htmlsc($value); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">



            </div>

            <?php if ($client->client_name != ""): //Client is not a company ?>


                <div class="row">
                    <div class="col-xs-12 col-md-6 ">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php _trans('personal_information'); ?>
                            </div>

                            <div class="panel-body table-content">
                                <table class="table">

                                   <?php if ($client->client_birthdate): ?>
                                        <tr>
                                            <th><?php _trans('birthdate'); ?></th>
                                            <td><?php echo format_date($client->client_birthdate); ?></td>
                                        </tr>
                                    <?php endif; ?>


                                    <tr>
                                        <th><?php _trans('gender'); ?></th>
                                        <td><?php echo format_gender($client->client_gender) ?></td>
                                    </tr>

                                    <tr>
                                        <th>Father Name</th>
                                        <td><?php _htmlsc($client->father_name); ?></td>
                                    </tr>

                                    <tr>
                                        <th>Father Contact Number</th>
                                        <td><?php _htmlsc($client->father_no); ?></td>
                                    </tr>

                                    <tr>
                                        <th>Mother Name</th>
                                        <td><?php _htmlsc($client->mother_name); ?></td>
                                    </tr>

                                    <tr>
                                        <th>Mother Contact Number</th>
                                        <td><?php _htmlsc($client->mother_no); ?></td>
                                    </tr>
                                   

                                    <?php foreach ($custom_fields as $custom_field): ?>
                                        <?php if ($custom_field->custom_field_location != 3) {
                                            continue;
                                        } ?>
                                        <tr>
                                            <?php
                                            $column = $custom_field->custom_field_label;
                                            $value = $this->mdl_client_custom->form_value('cf_' . $custom_field->custom_field_id);
                                            ?>
                                            <th><?php _htmlsc($column); ?></th>
                                            <td><?php _htmlsc($value); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif; ?>

            <?php
            if ($custom_fields): ?>


                <div class="row">
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <?php _trans('custom_fields'); ?>
                            </div>
                            <div class="panel-body table-content">
                                <table class="table">
                                    <?php foreach ($custom_fields as $custom_field): ?>
                                        <?php if ($custom_field->custom_field_location != 0) {
                                            continue;
                                        } ?>
                                        <tr>
                                            <?php
                                            $column = $custom_field->custom_field_label;
                                            $value = $this->mdl_client_custom->form_value('cf_' . $custom_field->custom_field_id);
                                            ?>
                                            <th><?php _htmlsc($column); ?></th>
                                            <td><?php _htmlsc($value); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endif; ?>



            <div class="row">
                <div class="col-xs-12 col-md-6 col-md-offset-3">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php _trans('notes'); ?>
                        </div>
                        <div class="panel-body">
                            <div id="notes_list">
                                <?php echo $partial_notes; ?>
                            </div>
                            <input type="hidden" name="client_id" id="client_id"
                                value="<?php echo $client->client_id; ?>">
                            <div class="input-group">
                                <textarea id="client_note" class="form-control" rows="2" style="resize:none"></textarea>
                                <span id="save_client_note" class="input-group-addon btn btn-default">
                                    <?php _trans('add_note'); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div id="clientQuotes" class="tab-pane table-content">
            <?php echo $quote_table; ?>
        </div>

        <div id="clientInvoices" class="tab-pane table-content">
            <?php echo $invoice_table; ?>
        </div>

        <div id="clientPayments" class="tab-pane table-content">
            <?php echo $payment_table; ?>
        </div>
    </div>

</div>