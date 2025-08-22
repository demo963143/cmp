<form method="post" class="form-horizontal">

    <input type="hidden" name="_ip_csrf" value="<?= $this->security->get_csrf_hash() ?>">

    <?php if ($exp_id) { ?>
        <input type="hidden" name="exp_id" value="<?php echo $exp_id; ?>">
    <?php } ?>

    <div id="headerbar">
        <h1 class="headerbar-title"><?php _trans('expenses_form'); ?></h1>
        <?php $this->layout->load_view('layout/header_buttons'); ?>
    </div>

    <div id="content">

        <?php $this->layout->load_view('layout/alerts'); ?>
         <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-offset-3">
            <div class="panel panel-default">
			<div class="panel-heading form-inline clearfix">
                        Expenses Form
                     </div>
        <div class="panel-body">
	
        <div class="form-group">
            <div class="col-xs-12 col-sm-2 text-right text-left-xs">
                <label for="exp_payment_method_id" class="control-label">
                    <?php _trans('payment_method'); ?>
                </label>
            </div>
            <div class="col-xs-12 col-sm-6 payment-method-wrapper">

                <?php
                // Add a hidden input field if a payment method was set to pass the disabled attribute
                if ($this->mdl_expenses->form_value('exp_payment_method_id')) { ?>
                    <input type="hidden" name="exp_payment_method_id" class="hidden"
                           value="<?php echo $this->mdl_expenses->form_value('exp_payment_method_id'); ?>">
                <?php } ?>

                <select id="exp_payment_method_id" name="exp_payment_method_id" class="form-control simple-select"
                    <?php echo($this->mdl_expenses->form_value('exp_payment_method_id') ? 'disabled="disabled"' : ''); ?>>

                    <?php foreach ($payment_methods as $payment_method) { ?>
                        <option value="<?php echo $payment_method->payment_method_id; ?>"
                                <?php if ($this->mdl_expenses->form_value('exp_payment_method_id') == $payment_method->payment_method_id) { ?>selected="selected"<?php } ?>>
                            <?php echo $payment_method->payment_method_name; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group has-feedback">
            <div class="col-xs-12 col-sm-2 text-right text-left-xs">
                <label for="exp_date" class="control-label"><?php _trans('date'); ?></label>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                    <input name="exp_date" id="exp_date"
                           class="form-control datepicker"
                           value="<?php echo date_from_mysql($this->mdl_expenses->form_value('exp_date')); ?>">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar fa-fw"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-2 text-right text-left-xs">
                <label for="exp_amount" class="control-label"><?php _trans('amount'); ?></label>
            </div>
            <div class="col-xs-12 col-sm-6">
                <input type="number" name="exp_amount" id="exp_amount" class="form-control"
                       value="<?php echo format_amount($this->mdl_expenses->form_value('exp_amount')); ?>">
            </div>
        </div>


        <div class="form-group">
            <div class="col-xs-12 col-sm-2 text-right text-left-xs">
                <label for="exp_note" class="control-label"><?php _trans('note'); ?></label>
            </div>
            <div class="col-xs-12 col-sm-6">
                <textarea name="exp_note"
                          class="form-control"><?php echo $this->mdl_expenses->form_value('exp_note', true); ?></textarea>
            </div>

        </div>
                </div>
                </div>
    </div>
    </div>
<!--
        <?php
        $cv = $this->controller->view_data["custom_values"];
        foreach ($custom_fields as $custom_field) {
            print_field($this->mdl_expenses, $custom_field, $cv, "col-xs-12 col-sm-2 text-right text-left-xs", "col-xs-12 col-sm-6");
        } ?>
-->
    </div>

</form>
