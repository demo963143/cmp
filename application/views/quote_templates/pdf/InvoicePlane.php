<!DOCTYPE html>
<html lang="<?php _trans('cldr'); ?>">
<head>
    <meta charset="utf-8">
    <title><?php _trans('quote'); ?></title>
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>assets/<?php echo get_setting('system_theme', 'invoiceplane'); ?>/css/templates.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/core/css/custom-pdf.css">
</head>
<body>
<header class="clearfix border">

    <div id="logo">
        <?php echo quote_logo_pdf(); ?>
    </div>
	<div id="company">
        <?php if ($quote->user_web) {
            echo '<div>' . $quote->user_web . '</div>';
        }
        if ($quote->user_email) {
            echo '<div>' . $quote->user_email . '</div>';
        }
        if ($quote->user_mobile) {
            echo '<div>' . htmlsc($quote->user_mobile) . '</div>';
        }
        ?>
    </div>
</header>
<hr>
<h2 class="invoice-title" align="center" style="margin:0; padding:0"><?php echo trans('quote_no') . ' ' . $quote->quote_number; ?></h2>

<div id="client">
        <div>
            <b><?php _htmlsc(format_client($quote)); ?></b>
        </div>
        <?php
        if ($quote->client_phone) {
            echo '<div>Mob No.: ' . htmlsc($quote->client_phone) . '</div>';
        }
        if ($quote->client_email) {
            echo '<div>Email: ' . $quote->client_email . '</div>';
        } ?>

    </div>
	
	<div class="company_add">
        <div><b><?php _htmlsc($quote->user_name); ?></b></div>
        <?php if ($quote->user_vat_id) {
            echo '<div>' . trans('vat_id_short') . ': ' . $quote->user_vat_id . '</div>';
        }
        if ($quote->user_tax_code) {
            echo '<div>' . trans('tax_code_short') . ': ' . $quote->user_tax_code . '</div>';
        }
        if ($quote->user_address_1) {
            echo '<div>' . htmlsc($quote->user_address_1) . '</div>';
        }
        if ($quote->user_address_2) {
            echo '<div>' . htmlsc($quote->user_address_2) . '</div>';
        }
        if ($quote->user_city || $quote->user_state || $quote->user_zip) {
            echo '<div>';
            if ($quote->user_city) {
                echo htmlsc($quote->user_city) . ' ';
            }
            if ($quote->user_state) {
                echo htmlsc($quote->user_state) . ' ';
            }
            if ($quote->user_zip) {
                echo htmlsc($quote->user_zip);
            }
            echo '</div>';
        }
        if ($quote->user_country) {
            echo '<div>' . get_country_name(trans('cldr'), $quote->user_country) . '</div>';
        }

        echo '<br/>';

        if ($quote->user_phone) {
            echo '<div>' . trans('phone_abbr') . ': ' . htmlsc($quote->user_phone) . '</div>';
        }
        if ($quote->user_fax) {
            echo '<div>' . trans('fax_abbr') . ': ' . htmlsc($quote->user_fax) . '</div>';
        }
        ?>
    </div>	
	
	<br><br><br><br><br><br><br>
	
<main>

    <div class="invoice-details">
        <table>
            <tr>
                <td><?php echo '<b>' . trans('quote_date') . ':</b> ' . date_from_mysql($quote->quote_date_created, true); ?></td>
                <td><?php echo '<b>' . trans('expires') . ':</b> ' . date_from_mysql($quote->quote_date_expires, true); ?></td>
                <td><?php echo '<b>' . trans('total') . ':</b> ' . format_currency($quote->quote_total); ?></td>
        </table>
    </div>

    

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
            <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?>
                    class="text-right"><?php _trans('subtotal'); ?></td>
            <td class="text-right"><?php echo format_currency($quote->quote_item_subtotal); ?></td>
        </tr>

        <?php if ($quote->quote_item_tax_total > 0) { ?>
            <tr>
                <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?> class="text-right">
                    <?php _trans('item_tax'); ?>
                </td>
                <td class="text-right">
                    <?php echo format_currency($quote->quote_item_tax_total); ?>
                </td>
            </tr>
        <?php } ?>

        <?php foreach ($quote_tax_rates as $quote_tax_rate) : ?>
            <tr>
                <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?> class="text-right">
                    <?php echo $quote_tax_rate->quote_tax_rate_name . ' (' . format_amount($quote_tax_rate->quote_tax_rate_percent) . '%)'; ?>
                </td>
                <td class="text-right">
                    <?php echo format_currency($quote_tax_rate->quote_tax_rate_amount); ?>
                </td>
            </tr>
        <?php endforeach ?>

        <?php if ($quote->quote_discount_percent != '0.00') : ?>
            <tr>
                <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?> class="text-right">
                    <?php _trans('discount'); ?>
                </td>
                <td class="text-right">
                    <?php echo format_amount($quote->quote_discount_percent); ?>%
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($quote->quote_discount_amount != '0.00') : ?>
            <tr>
                <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?> class="text-right">
                    <?php _trans('discount'); ?>
                </td>
                <td class="text-right">
                    <?php echo format_currency($quote->quote_discount_amount); ?>
                </td>
            </tr>
        <?php endif; ?>

        <tr>
            <td <?php echo($show_item_discounts ? 'colspan="5"' : 'colspan="4"'); ?> class="text-right">
                <b><?php _trans('total'); ?></b>
            </td>
            <td class="text-right">
                <b><?php echo format_currency($quote->quote_total); ?></b>
            </td>
        </tr>
        </tbody>
    </table>

</main>

</body>
</html>
