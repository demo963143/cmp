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
  <h5 style="font-size:25px;direction: <?=$xdirection ?>;"> <?=display('list_of_clients')?></h5>
<br>
        <div style="padding: 10px;">
            	
    <div class="row">
        
<br>
    <table style="width: 100%;direction: <?=$xdirection ?>; float: right;" class="" border="1">
    
       <tr style="background-color: #f5f5f5">
            <td style="background-color: #f5f5f5" class="trd"><?=display('num')?></td>
            <td style="background-color: #f5f5f5" class="trd"><?=display('first_name')?></td>
            <td style="background-color: #f5f5f5" class="trd"><?=display('last_name')?></td>
            <td style="background-color: #f5f5f5" class="trd"><?=display('phone')?></td>
            <td style="background-color: #f5f5f5" class="trd"><?=display('adress')?></td>
            <td style="background-color: #f5f5f5" class="trd"><?=display('total_transactions')?> </td>
            <td style="background-color: #f5f5f5" class="trd"><?=display('paid')?> </td>
            <td style="background-color: #f5f5f5" class="trd"><?=display('rest')?> </td>
       </tr>
       <?php
       if($clients)
       {
           foreach($clients as $client)
           {
               $total = $this->sale->get_sum_total($client->id);
               $paid = $this->sale->get_sum_paid($client->id);
               $rest = $total-$paid;
               ?>
                <tr style="background-color: #f5f5f5">
                    <td style="" class="trd"><?=$client->num;?></td>
                    <td style="" class="trd"><?=$client->lastname;?></td>
                    <td style="" class="trd"><?=$client->firstname;?></td>
                    <td style="" class="trd"><?=$client->phone;?></td>
                    <td style="" class="trd"><?=$client->adress;?> </td>
                    <td style="" class="trd"><?=number_format((float)$total, settings()->decimals, '.', '')?></td>
                    <td style="" class="trd"><?=number_format((float)$paid, settings()->decimals, '.', '')?></td>
                    <td style="" class="trd"><?=number_format((float)$rest, settings()->decimals, '.', '')?></td>
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