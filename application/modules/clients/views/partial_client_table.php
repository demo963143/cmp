<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th><?php _trans('active'); ?></th>
            <th>Room Number</th>
            <th>Tenant Name</th>
            <th>Tenant Photo</th>
            <th><?php _trans('email_address'); ?></th>
            <th>Document</th>
            <th><?php _trans('phone_number'); ?></th>
            <th class="amount"><?php _trans('balance'); ?></th>
            <th><?php _trans('options'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($records as $client) : ?>
            <tr>
                <td><?php echo ($client->client_active) ? trans('yes') : trans('no'); ?></td>
                <td><?php _htmlsc($client->room_no); ?></td>
                <td><?php echo anchor('clients/view/' . $client->client_id, htmlsc(format_client($client))); ?></td>

                <td>
                    <?php 
                    if (!empty($client->tenant_file_name)) {
                        $path = $client->tenant_file_name;
                        $photo = str_replace(' ', '_', $path);
                        $imgSrc = base_url('assets/core/img/tenant-photo/' . $photo);
                    } else {
                        $imgSrc = base_url('assets/core/img/default-photo.jpg');
                    }
                    ?>
                    <img src="<?php echo $imgSrc; ?>" 
                        alt="Tenant Photo" 
                        style="max-width: 100px; margin-top: 0px;" />
                </td>


                <td><?php _htmlsc($client->client_email); ?></td>

                <td>
                    <?php if ($client->document_file_name): ?>                            
                        <?php
                        $documents = explode(',', $client->document_file_name);
                        foreach ($documents as $document):
                            $document = trim($document);
                            $document = str_replace(' ', '_', $document);
                            ?>
                            <a style="color:blue;"
                                href="<?php echo base_url('assets/core/img/document/' . $document); ?>"
                                download
                                target="_blank">
                                Download Document
                            </a><br>
                        <?php endforeach; ?>   
                    <?php endif; ?>
                </td>


                <td><?php _htmlsc($client->client_phone ? $client->client_phone : ($client->client_mobile ? $client->client_mobile : '')); ?></td>
                <td class="amount"><?php echo format_currency($client->client_invoice_balance); ?></td>
                <td>
                    <div class="options btn-group">
                        <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <?php _trans('options'); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo site_url('clients/view/' . $client->client_id); ?>">
                                    <i class="fa fa-eye fa-margin"></i> <?php _trans('view'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('clients/form/' . $client->client_id); ?>">
                                    <i class="fa fa-edit fa-margin"></i> <?php _trans('edit'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="client-create-quote"
                                   data-client-id="<?php echo $client->client_id; ?>">
                                    <i class="fa fa-file fa-margin"></i> <?php _trans('create_quote'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="client-create-invoice"
                                   data-client-id="<?php echo $client->client_id; ?>">
                                    <i class="fa fa-file-text fa-margin"></i> <?php _trans('create_invoice'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('clients/delete/' . $client->client_id); ?>"
                                   onclick="return confirm('<?php _trans('delete_client_warning'); ?>');">
                                    <i class="fa fa-trash-o fa-margin"></i> <?php _trans('delete'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('clients/client_history/' . $client->client_id); ?>">
                                    <i class="fa fa-history fa-margin"></i> <?php _trans('activity_history'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
