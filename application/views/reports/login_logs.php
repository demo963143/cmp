<!DOCTYPE html>
<html lang="<?php echo trans('cldr'); ?>">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo trans('login_logs'); ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/<?php echo get_setting('system_theme', 'invoiceplane'); ?>/css/reports.css" type="text/css">
</head>
<body>

<h3 class="report_title">
    <?php echo trans('login_logs'); ?><br/>
    <small><?php echo $from_date . ' - ' . $to_date ?></small>
</h3>

<table>
    <tr>
        <th>Login Date & time</th>
        <th>Logout Date & time</th>
        <th>Browser name</th>
        <th>Location</th>
        <th>Ip/Mac address</th>
    </tr>
    <?php
    $sum = 0;

    foreach ($results as $result) {
        ?>
        <tr>
            <td><?php echo $result->log_in_time; ?></td>
            <td><?php echo $result->log_out_time; ?></td>
            <td><?php echo $result->browser_name; ?></td>
            <td><?php echo $result->location; ?></td>
            <td><?php echo $result->ip_address; ?></td>
        </tr>
        <?php
    }

        ?>
       
</table>

</body>
</html>
