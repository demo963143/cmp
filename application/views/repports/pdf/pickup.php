<!DOCTYPE html>
<html>
  <head>
<meta charset="utf-8">
    <title></title>
     <link rel="stylesheet" href="<?php echo base_url('assets/')?>/css/pdfpage.css" /> 

  </head>
<body style="font-family:Arial, Helvetica, sans-serif" style="direction: <?=$xdirection?>;">
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
  <h5 style="font-size:25px;direction: <?=$xdirection?>;"> Pickup List</h5>

<br>
        <div style="padding: 10px;">
            	
    <div class="row">
        
<br>
    <table style="width: 100%;direction: <?=$xdirection?>; float: left;" class="" border="1">
    
        <tr style="background-color: #f5f5f5">
       	<td style="background-color: #f5f5f5" class="trd">Order ID</td>
       	<td style="background-color: #f5f5f5" class="trd">Client Name</td>
       	<td style="background-color: #f5f5f5" class="trd">Client Phone</td>
        <td style="background-color: #f5f5f5" class="trd">Client Address</td>
        <td style="background-color: #f5f5f5" class="trd">Pickup Date</td>
        <!--<td style="background-color: #f5f5f5" class="trd">Delivery Date</td>-->
        <td style="background-color: #f5f5f5" class="trd">Product Qt</td>

       </tr>
        <?PHP
        if($expences_repport)
        {
          $total = 0;
         foreach($expences_repport as $expence)
         {
          $total =  $total +$expence->amount;
        ?>
        	<tr>
			    <td class="trdd"><?=$expence->invoice_id;?></td>
			    <td class="trdd"><?= $expence->clientname;?></td>
			    <td class="trdd"><?= $expence->phone;?></td>
			    <td class="trdd"><?= $expence->adress;?></td>
			    <td class="trdd"><?= $expence->pickup_date;?></td>
			    <!--<td class="trdd"><?=$expence->delivery_date?></td>-->
                <td class="trdd"><?=$expence->qt?></td>
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


 
<footer style="float:left; width:95%; color:#000; direction: <?=$xdirection?>;">

<p><?=date('Y-m-d H:s')?></p>
</footer>
</body>
</html>