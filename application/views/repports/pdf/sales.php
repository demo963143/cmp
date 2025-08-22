<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/css/pdfpage.css" />
</head>

<body style="font-family:Arial, Helvetica, sans-serif" style="direction: <?=$xdirection?>;">
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
    <h5 style="font-size:25px;direction: <?=$xdirection?>;"> <?= display('sales_report') ?> <?= $year ?></h5>
    <table style="width: 100%;direction: <?=$xdirection?>; float: right;" class="" border="1">
      <tr>
        <td><?= display('earnings') ?></td>
        <td><?= display('total_taxes') ?></td>
        <td><?= display('paid_up') ?></td>
        <td><?= display('rest') ?></td>
        <td>Cash</td>
        <td>Card</td>
        <td>UPI</td>
        <td>Cheque</td>
        <td><?= display('total_discounts') ?></td>
      </tr>
      <tr>
        <td><?= number_format((float)$amount, settings()->decimals, '.', ''); ?></td>
        <td><?= number_format((float)$taxamount, settings()->decimals, '.', ''); ?></td>
        <td><?= number_format((float)$paid, settings()->decimals, '.', ''); ?></td>
        <td><?= number_format((float)$amount - $paid, settings()->decimals, '.', ''); ?></td>
        <td><?= number_format((float)$cash, settings()->decimals, '.', ''); ?></td>
        <td><?= number_format((float)$card, settings()->decimals, '.', ''); ?></td> 
        <td><?= number_format((float)$upi, settings()->decimals, '.', ''); ?></td>
        <td><?= number_format((float)$cheque, settings()->decimals, '.', ''); ?></td>
        <td><?= number_format((float)$discountamount, settings()->decimals, '.', ''); ?></td>
      </tr>
    </table>
    <br>
    <div style="padding: 10px;">

      <div class="row">

        <br>
        <table style="width: 100%;direction: <?=$xdirection?>; float: right;" class="" border="1">

          <tr style="background-color: #f5f5f5">
            <td style="background-color: #f5f5f5"><?= display('num') ?></td>
            <td style="background-color: #f5f5f5"><?= display('date') ?></td>
            <td style="background-color: #f5f5f5"><?= display('client') ?></td>
            <td style="background-color: #f5f5f5"><?= display('tax') ?></td>
            <td style="background-color: #f5f5f5"><?= display('discounts') ?></td>
            <td style="background-color: #f5f5f5"><?= display('total') ?> <?= settings()->currency; ?></td>
            <td style="background-color: #f5f5f5"><?= display('by') ?></td>
            <td style="background-color: #f5f5f5"><?= display('number_of_services') ?></td>
            <td style="background-color: #f5f5f5"><?= display('status') ?></td>
            
            <td style="background-color: #f5f5f5" class="trd">Payment method </td>

            <td style="background-color: #f5f5f5"><?= display('rest') ?></td>
            <td style="background-color: #f5f5f5"><?= display('delivery') ?></td>

          </tr>
          <?PHP
          if ($sales_repport) {
            $total = 0;
            $tax = 0;
            $discount = 0;
            foreach ($sales_repport as $sale) {
              $total =  $total + $sale->total;
              $tax =  $tax + $sale->tax;
              $discount =  $discount + $sale->discount;

              if ($sale->status) {
                $statusdelev = display('delivery');
                $classe2 = "badge badge-success";
              } else {
                $statusdelev = display('did_not_deliver');
                $classe2 = "badge badge-danger";
              }
              
              
             if($sale->paidmethod == 0)
			  {
				$psatus = 'Cash';
				$pclasseStyle ='badge badge-success';
			  }
			  elseif($sale->paidmethod == 2)
			  {
				$psatus = 'Cheque';
				$pclasseStyle ='badge badge-danger';
			  }
			  elseif($sale->paidmethod == 3)
			  {
				$psatus = 'Card';
				$pclasseStyle ='badge badge-danger';
			  } 
			  elseif($sale->paidmethod == 4)
			  {
				$psatus = 'UPI';
			    $pclasseStyle ='badge badge-warning';
			  }
			  else
			  {
				$psatus = '';
				$pclasseStyle ='';
			  }
              
              
              if ($sale->total == $sale->paid) {
                $satus = display('paid');
                $classeStyle = 'badge badge-success';
              } elseif ($sale->paid == 0) {
                $satus = display('unpaid');
                $classeStyle = 'badge badge-danger';
              } else {
                $satus = display('partial_payment');
                $classeStyle = 'badge badge-warning';
              }
          ?>
              <tr>
                <td class="trdd"><?= sprintf("%05d", $sale->id); ?></td>
                <td class="trdd"><?= $sale->created_at; ?></td>
                <td class="trdd"><?= $sale->clientname; ?></td>
                <td class="trdd"><?= $sale->tax ?></td>
                <td class="trdd"><?= $sale->discount; ?></td>
                <td class="trdd"><?= number_format((float)$sale->total, settings()->decimals, '.', ''); ?></td>
                <td class="trdd"><?= $sale->created_by; ?></td>
                <td class="trdd"><?= $sale->totalitems; ?></td>
                <td class="trdd"><?= $satus; ?></td>
                
                <td class="trdd"><?= '<span class="' . $pclasseStyle . '">' . $psatus . '<span>'; ?></td>

                
                <td class="trdd"><?= number_format((float)$sale->total - $sale->paid, settings()->decimals, '.', ''); ?></td>
                <td class="trdd"><?= $statusdelev; ?></td>
              </tr>
          <?PHP
            }
          }
          ?>

          <tr>
            <td colspan="3" class="text-center" style="text-align: center;"><?= display('total') ?> :</td>
            <td><?= number_format((float)$tax, settings()->decimals, '.', '') ?></td>
            <td><?= number_format((float)$discount, settings()->decimals, '.', '') ?></td>
            <td><?= number_format((float)$total, settings()->decimals, '.', '') ?></td>
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