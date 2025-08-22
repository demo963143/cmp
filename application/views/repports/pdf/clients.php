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
    <h5 style="font-size:25px;direction: rtl;"><?= display('list_of_clients') ?> <br> (<?= $count_client; ?>)</h5>

    <br>
    <div style="padding: 10px;">

      <div class="row">

        <br>
        <table style="width: 100%;direction: <?= $xdirection ?>; float: right;" class="" border="1">

          <tr style="background-color: #f5f5f5">
            <td><?= display('num') ?></td>
            <td><?= display('first_name') ?></td>
            <td><?= display('last_name') ?></td>
            <td> <?= display('phone') ?></td>
            <td><?= display('adress') ?></td>
            <td><?= display('total_transactions') ?> <?= settings()->currency; ?></td>
            <td><?= display('paid') ?></td>
            <td><?= display('rest') ?></td>

          </tr>
          <?PHP
          if ($clients_repport) {
            $total = 0;
            foreach ($clients_repport as $client) {
              $sum_sale = $this->sale->sum_sale(array('client_id' => $client->id));
              $paid_sale = $this->sale->paid_sale(array('client_id' => $client->id));
          ?>
              <tr>
                <td class="trdd"><?= $client->num; ?></td>
                <td class="trdd"><?= $client->lastname; ?></td>
                <td class="trdd"><?= $client->firstname; ?></td>
                <td class="trdd"><?= $client->phone; ?></td>
                <td class="trdd"><?= $client->adress; ?></td>
                <td class="trdd"><?= number_format((float)($sum_sale), settings()->decimals, '.', ''); ?></td>
                <td class="trdd"><?= number_format((float)($paid_sale), settings()->decimals, '.', ''); ?></td>
                <td class="trdd"><?= number_format((float)($sum_sale - $paid_sale), settings()->decimals, '.', ''); ?></td>

              </tr>
          <?PHP
            }
          }
          ?>

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