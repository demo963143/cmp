<!DOCTYPE html>
<html lang="<?php _trans('cldr'); ?>">
<head>
    <meta charset="utf-8">
    <title><?php _trans('invoice'); ?></title>
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>assets/<?php echo get_setting('system_theme', 'invoiceplane'); ?>/css/templates.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/core/css/custom-pdf.css">
</head>
<body>
<header class="clearfix border">

    <div id="logo">
        <?php echo invoice_logo_pdf(); ?>
    </div>
	<div id="company">
        <?php if ($invoice->user_web) {
            echo '<div>' . $invoice->user_web . '</div>';
        }
        if ($invoice->user_email) {
            echo '<div>' . $invoice->user_email . '</div>';
        }
        if ($invoice->user_mobile) {
            echo '<div>' . htmlsc($invoice->user_mobile) . '</div>';
        }
        ?>
    </div>
</header>
<hr>
<h2 class="invoice-title" align="center" style="margin:0; padding:0"><?php echo trans('receipt_no') . ' ' . $invoice->invoice_number; ?></h2>

<div id="client">
        <div>
            <b><?php _htmlsc(format_client($invoice)); ?></b>
        </div>
        <?php
        if ($invoice->client_mobile) {
            echo '<div>' . htmlsc($invoice->client_mobile) . '</div>';
        }
        if ($invoice->client_email) {
            echo '<div>' . $invoice->client_email . '</div>';
        } ?>

    </div>
	
	<div class="company_add">
        <div><b><?php _htmlsc($invoice->user_name); ?></b></div>
        <?php if ($invoice->user_vat_id) {
            echo '<div style="font-size:12px">' . trans('vat_id_short') . ': ' . $invoice->user_vat_id . '</div>';
        }
        if ($invoice->user_tax_code) {
            echo '<div style="font-size:12px">' . trans('tax_code_short') . ': ' . $invoice->user_tax_code . '</div>';
        }
        if ($invoice->user_address_1) {
            echo '<div style="font-size:12px">' . htmlsc($invoice->user_address_1) . '</div>';
        }
        if ($invoice->user_address_2) {
            echo '<div style="font-size:12px">' . htmlsc($invoice->user_address_2) . '</div>';
        }
        if ($invoice->user_city || $invoice->user_state || $invoice->user_zip) {
            echo '<div style="font-size:12px">';
            if ($invoice->user_city) {
                echo htmlsc($invoice->user_city) . ' ';
            }
            if ($invoice->user_state) {
                echo htmlsc($invoice->user_state) . ' ';
            }
            if ($invoice->user_zip) {
                echo htmlsc($invoice->user_zip);
            }
            echo '</div>';
        }
        if ($invoice->user_country) {
            echo '<div style="font-size:12px">' . get_country_name(trans('cldr'), $invoice->user_country) . '</div>';
        }

        echo '<br/>';

        if ($invoice->user_phone) {
            echo '<div style="font-size:12px">' . trans('phone_abbr') . ': ' . htmlsc($invoice->user_phone) . '</div>';
        }
        if ($invoice->user_fax) {
            echo '<div style="font-size:12px">' . trans('fax_abbr') . ': ' . htmlsc($invoice->user_fax) . '</div>';
        }
        ?>
    </div>	
	
	<br><br><br><br><br><br><br>
	
<main>

    <div class="invoice-details">
        <table>
            <tr>
                <td><?php echo '<b>' . trans('invoice_date') . ':</b> ' . date_from_mysql($invoice->invoice_date_created, true); ?></td>
                <td><?php echo '<b>' . trans('due_date') . ':</b> ' . date_from_mysql($invoice->invoice_date_due, true); ?></td>
                <td><?php echo '<b>' . trans('amount_due') . ':</b> ' . format_currency($invoice->invoice_balance); ?></td>
				<?php if ($payment_method): ?>
						<td><?php echo '<b>' . trans('payment_mode') . ':</b> ' . ($payment_method->payment_method_name); ?></td>
				<?php endif; ?>
        </table>
    </div>

    <br>

    <table class="item-table">
        <thead>
        <tr>
            <th class="item-name"><?php _trans('item'); ?></th>
            <th class="item-desc"><?php _trans('description'); ?></th>
            <th class="item-amount text-right"><?php _trans('qty'); ?></th>
            <th class="item-price text-right"><?php _trans('price'); ?></th>
            <?php if ($show_item_discounts) : ?>
                <th class="item-discount text-right"><?php _trans('discount'); ?></th>
            <?php endif; ?>
            <th class="item-total text-right"><?php _trans('total'); ?></th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($items as $item) { ?>
            <tr>
                <td><?php _htmlsc($item->item_name); ?></td>
                <td><?php echo nl2br(htmlsc($item->item_description)); ?></td>
                <td class="text-right">
                    <?php echo format_amount($item->item_quantity); ?>
                    <?php if ($item->item_product_unit) : ?>
                        <br>
                        <small><?php _htmlsc($item->item_product_unit); ?></small>
                    <?php endif; ?>
                </td>
                <td class="text-right">
                    <?php echo format_currency($item->item_price); ?>
                </td>
                <?php if ($show_item_discounts) : ?>
                    <td class="text-right">
                        <?php echo format_currency($item->item_discount); ?>
                    </td>
                <?php endif; ?>
                <td class="text-right">
                    <?php echo format_currency($item->item_total); ?>
                </td>
            </tr>
        <?php } ?>

        </tbody>
        <tbody class="invoice-sums">

        <tr>
            <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?> class="text-right">
                <?php _trans('subtotal'); ?>
            </td>
            <td class="text-right"><?php echo format_currency($invoice->invoice_item_subtotal); ?></td>
        </tr>

        <?php if ($invoice->invoice_item_tax_total > 0) { ?>
            <tr>
                <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?> class="text-right">
                    <?php _trans('item_tax'); ?>
                </td>
                <td class="text-right">
                    <?php echo format_currency($invoice->invoice_item_tax_total); ?>
                </td>
            </tr>
        <?php } ?>

        <?php foreach ($invoice_tax_rates as $invoice_tax_rate) : ?>
            <tr>
                <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?> class="text-right">
                    <?php echo htmlsc($invoice_tax_rate->invoice_tax_rate_name) . ' (' . format_amount($invoice_tax_rate->invoice_tax_rate_percent) . '%)'; ?>
                </td>
                <td class="text-right">
                    <?php echo format_currency($invoice_tax_rate->invoice_tax_rate_amount); ?>
                </td>
            </tr>
        <?php endforeach ?>

        <?php if ($invoice->invoice_discount_percent != '0.00') : ?>
            <tr>
                <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?> class="text-right">
                    <?php _trans('discount'); ?>
                </td>
                <td class="text-right">
                    <?php echo format_amount($invoice->invoice_discount_percent); ?>%
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($invoice->invoice_discount_amount != '0.00') : ?>
            <tr>
                <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?> class="text-right">
                    <?php _trans('discount'); ?>
                </td>
                <td class="text-right">
                    <?php echo format_currency($invoice->invoice_discount_amount); ?>
                </td>
            </tr>
        <?php endif; ?>

        <tr>
            <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?> class="text-right">
                <b><?php _trans('total'); ?></b>
            </td>
            <td class="text-right">
                <b><?php echo format_currency($invoice->invoice_total); ?></b>
            </td>
        </tr>
        <tr>
            <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?> class="text-right">
                <?php _trans('paid'); ?>
            </td>
            <td class="text-right">
                <?php echo format_currency($invoice->invoice_paid); ?>
            </td>
        </tr>
        <tr>
            <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?> class="text-right">
                <b><?php _trans('balance'); ?></b>
            </td>
            <td class="text-right">
                <b><?php echo format_currency($invoice->invoice_balance); ?></b>
            </td>
        </tr>
        </tbody>
    </table>

</main>

<footer>
    <?php if ($invoice->invoice_terms) : ?>
        <div class="notes">
            <b><?php _trans('terms'); ?></b><br/>
            <?php echo nl2br(htmlsc($invoice->invoice_terms)); ?>
        </div>
    <?php endif; ?>
</footer>

</body>
</html>
