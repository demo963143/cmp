<!DOCTYPE html>
<html lang="<?php echo trans('cldr'); ?>">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo trans('activities'); ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/<?php echo get_setting('system_theme', 'invoiceplane'); ?>/css/reports.css" type="text/css">
</head>
<body>

<h3 class="report_title">
    <?php echo trans('activities'); ?><br/>
    <small><?php echo $from_date . ' - ' . $to_date ?></small>
</h3>

<table>
    <tr>
        <th>Customer Name</th>
        <th>Customer Mob No</th>
        <th>Activity Details</th>
        <th>Date & time</th>
        <th>Reminder duration</th>
        <th>Amount</th>
    </tr>
    <?php
    $sum = 0;

    foreach ($results as $result) {
        ?>
        <tr>
            <td><?php echo $result->client_name; ?></td>
            <td><?php echo $result->client_mobile; ?></td>
            <td><?php _htmlsc($result->service_name); ?></td>
            <td><?php echo $result->act_created_at; ?></td>
            <td><?php echo $result->reminder; 
                $sum = $sum + $result->amount;?></td>
            <td><?php echo format_currency($result->amount); ?></td>
        </tr>
        <?php
    }

    if (!empty($results)) {
        ?>
        <tr>
            <td colspan=5><?php echo trans('total'); ?></td>
            <td class="amount"><?php echo format_currency($sum); ?></td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
