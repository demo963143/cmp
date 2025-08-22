<div class="table-responsive">
    <table class="table table-striped">

        <thead>
        <tr>
            <th><?php _trans('payment_date'); ?></th>
            <th><?php _trans('amount'); ?></th>
            <th><?php _trans('payment_method'); ?></th>
            <th><?php _trans('note'); ?></th>
            <th><?php _trans('options'); ?></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($expenses as $exp) { ?>
            <tr>
                <td><?php echo date_from_mysql($exp->exp_date); ?></td>
                <td><?php echo format_currency($exp->exp_amount); ?></td>
                <td><?php _htmlsc($exp->payment_method_name); ?></td>
                <td><?php _htmlsc($exp->exp_note); ?></td>
                <td>
                    <div class="options btn-group">
                        <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <?php _trans('options'); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo site_url('expenses/form/' . $exp->exp_id); ?>">
                                    <i class="fa fa-edit fa-margin"></i>
                                    <?php _trans('edit'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('expenses/delete/' . $exp->exp_id); ?>"
                                   onclick="return confirm('<?php _trans('delete_record_warning'); ?>');">
                                    <i class="fa fa-trash-o fa-margin"></i>
                                    <?php _trans('delete'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>

    </table>
</div>
