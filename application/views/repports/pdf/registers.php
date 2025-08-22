<!DOCTYPE html>
<html>
  <head>
<meta charset="utf-8">
    <title></title>
     <link rel="stylesheet" href="<?php echo base_url('assets/')?>/css/pdfpage.css" /> 
  </head>
<body style="font-family:Arial, Helvetica, sans-serif" style="direction: <?=$xdirection ?>;">
 <style type="text/css">
 	.trd
 	{
 		padding: 5px;
 	}
 	.trdd
 	{
 		padding: 2px;
 	}
 </style>
<header class="clearfix">
  <div align="center">

  <H4 style="float:left; width:150px;"> <img src="<?php echo base_url()?>/files/img/<?=settings()->logo;?>" width="100" height="70">
 </H4>
<H4 style="float:right;width:200px; text-align:center;">
<?=settings()->receiptheader;?>
</H4>
</div>
    <div style="margin:0px; height:2px; background-color:#0087C3"></div>
</header>
         
              
           
<div id="invoice" style="text-align:center; margin-bottom: 50px" align="center">
  <h5 style="font-size:25px;direction:  <?=$xdirection ?>;"><?=display('point_sale_report')?> </h5>
  <h6>
  <?PHP 
  if($start_date)
  {
      echo $end_date.' - '.$start_date;
  }
  ?>
  </h6>

<br>
        <div style="padding: 10px;">
            	
    <div class="row">
        
<br>
    <table style="width: 100%;direction: <?=$xdirection ?>; float: right;" class="" border="1">
    
        <tr style="background-color: #f5f5f5">
       <td> <?=display('openingtime')?> </td>
       <td> <?=display('openedby')?></td>
                                <td> <?=display('closingtime')?></td>
                                <td> <?=display('closeby')?></td>
                                <td> <?=display('cash')?></td>
                                <td> <?=display('cheque')?></td>
   
       </tr>
        <?PHP
        if($registers_repport)
        {
          $total = 0;
         foreach($registers_repport as $reg)
         {
           ?>
        	<tr>
			    <td class="trdd"><?=$reg->date;?></td>
          <td class="trdd"><?=$this->user->get_by_id($reg->user_id)->name;?></td>
                <td class="trdd"><?=($reg->closed_at ? $reg->closed_at : display('open'));?></td>
                <td class="trdd"><?=$this->user->get_by_id($reg->closed_by)->name;?></td>
                <td class="trdd"><?=number_format((float)$reg->cash_total, settings()->decimals, '.', '') . ' ' . settings()->currency ;;?></td>
                <td class="trdd"><?=number_format((float)$reg->cheque_total, settings()->decimals, '.', '') . ' ' . settings()->currency ;;?></td>
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


 
<footer style="float:left; width:95%; color:#000; direction: <?=$xdirection ?>;">

<p><?=date('Y-m-d H:s')?></p>
</footer>
</body>
</html>