<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/css/pdfpage.css" />
</head>

<body style="font-family:Arial, Helvetica, sans-serif" style="direction: <?= $xdirection ?>;">
  <style type="text/css">
    .trd {
      padding: 5px;
    }

    .trdd {
      padding: 2px;
    }
  </style>
  <header class="clearfix">
    <div align="center">

      <H4 style="float:left; width:150px;"> <img src="<?php echo base_url() ?>/files/img/<?= settings()->logo; ?>" width="100" height="70">
      </H4>
      <H4 style="float:right;width:200px; text-align:center;">
        <?= settings()->receiptheader; ?>
      </H4>
    </div>
    <div style="margin:0px; height:2px; background-color:#0087C3"></div>
  </header>


  <div id="invoice" style="text-align:center; margin-bottom: 50px" align="center">
    <h5 style="font-size:25px;direction: <?= $xdirection ?>;"> <?= display('sales_report') ?> </h5>

    <br>
    <div style="padding: 10px;">

      <div class="row">
        <?PHP
        if ($EndDate != null && $StartDate != null) {
        ?>
          <h2> <?= $EndDate . ' - ' . $StartDate; ?></h2>
        <?php
        }
        ?>
        <br>
        <table style="width: 100%;direction: <?= $xdirection ?>; float: right;" class="" border="1">

          <tr style="background-color: #f5f5f5">
            <td style="background-color: #f5f5f5" class="trd"><?= display('num') ?></td>
            <td style="background-color: #f5f5f5" class="trd"><?= display('date') ?></td>
            <td style="background-color: #f5f5f5" class="trd"><?= display('client') ?></td>
            <td style="background-color: #f5f5f5" class="trd"><?= display('tax') ?> <?= settings()->currency; ?></td>
            <td style="background-color: #f5f5f5" class="trd"><?= display('discounts') ?> </td>
            <td style="background-color: #f5f5f5" class="trd"><?= display('total') ?> </td>
            <td style="background-color: #f5f5f5" class="trd"><?= display('by') ?> </td>
            <td style="background-color: #f5f5f5" class="trd"> <?= display('number_of_services') ?> </td>
            <td style="background-color: #f5f5f5" class="trd"><?= display('paid') ?> </td>
            <td style="background-color: #f5f5f5" class="trd"><?= display('rest') ?> </td>
            <td style="background-color: #f5f5f5" class="trd"><?= display('status') ?> </td>
            <td style="background-color: #f5f5f5" class="trd"><?= display('delivery') ?></td>
          </tr>
          <?PHP
          if ($sales) {
            $total = 0;
            $paid = 0;
            $rest = 0;
            foreach ($sales as $invoice) {
              $total =  $total + $invoice->total;
              $paid =  $paid + $invoice->paid;

              if ($invoice->status) {
                $statusdelev = display('delivery');
                $classe2 = "badge badge-success";
              } else {
                $statusdelev = display('did_not_deliver');
                $classe2 = "";
              }
              if ($invoice->total == $invoice->paid) {
                $satus = display('paid');
                $classeStyle = '';
              } elseif ($invoice->paid == 0) {
                $satus = display('unpaid');
                $classeStyle = '';
              } else {
                $satus = display('partial_payment');
                $classeStyle = '';
              }
          ?>
              <tr>
                <td class="trdd"><?= sprintf("%05d", $invoice->id) ?></td>
                <td class="trdd"><?= $invoice->created_at ?></td>
                <td class="trdd"><?= $invoice->clientname ?></td>
                <td class="trdd"><?= $invoice->tax ?></td>
                <td class="trdd"><?= $invoice->discount ?></td>
                <td class="trdd"><?= number_format((float)$invoice->total, settings()->decimals, '.', '') ?></td>
                <td class="trdd"><?= $invoice->created_by ?></td>
                <td class="trdd"><?= $invoice->totalitems ?></td>
                <td class="trdd"><?= number_format((float)$invoice->paid, settings()->decimals, '.', '') ?></td>
                <td class="trdd">
                  <?php
                  $rest =  $rest + ($invoice->total - $invoice->paid);
                  echo number_format((float)$invoice->total - $invoice->paid, settings()->decimals, '.', '') ?>
                </td>
                <td class="trdd"><?= '<span class="' . $classeStyle . '">' . $satus . '<span>'; ?></td>
                <td class="trdd"><?= '<span class="' . $classe2 . '">' . $statusdelev . '<span>'; ?></td>
              </tr>
          <?PHP
            }
          }
          ?>

          <tr>
            <td colspan="5">المجموع :</td>
            <td colspan="3"><?= number_format((float)$total, settings()->decimals, '.', '') ?></td>
            <td><?= number_format((float)$paid, settings()->decimals, '.', '') ?></td>
            <td><?= number_format((float)$rest, settings()->decimals, '.', '') ?></td>
            <td colspan="2"></td>
          </tr>

        </table>
        <br>

      </div>
    </div>
  </div>

  </div>

  <br>



  <footer style="float:left; width:95%; color:#000; direction: <?= $xdirection ?>;">

    <p><?= date('Y-m-d H:s') ?></p>
  </footer>
</body>

</html>