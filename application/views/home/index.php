<style>
  #printSection{
   color: #000;
   margin: 0 auto;
}

#ticket .modal-dialog
{
  width: 100%;
}


#modal-body{
    max-height: calc(100vh - 200px);
    overflow-y: auto;
}
  @media print {
   .modal-dialog{
      width: 100% !important;;
   }
   .modal {
    visibility: visible;
    /**Remove scrollbar for printing.**/
    overflow: visible !important;
  }
  .modal-dialog {
    visibility: visible !important;
    /**Remove scrollbar for printing.**/
    overflow: visible !important;
    height: auto !important;
    width: auto !important;
  }

  body * {
    visibility:hidden;
  }
  .container-fluid {
     display: none;
 }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSectionInvoice, #printSectionInvoice * {
    visibility:visible;
  }
  #printSection {
     text-transform:uppercase;
     font-size: 9px;
     left: 0;
     top: 0;
     padding: 0;
     margin:0;
  }
  #printSection h4{
     font-size: 12px;
  }
  #printSection{
     font-size: 12px;
  }
  #printSection tr td {
     margin: 0;
     padding: 0;
 }
 #printSection .bg-success, #printSection .bg-danger{
    visibility:hidden;
}
  @page {
  margin: 0;
  }
  .hiddenpr {
      display: none !important;
  }
  html, body {
 zoom: 100%;
 overflow:hidden !important;
 }
 
}
.candaraFont13 {
    font-family:"Droid Arabic Kufi, sans-serif";
    font-size: 13px;
}
.icon-cards-row {
    margin-top: 0px;
}
/*@media screen and (max-width:767px) {*/
/*    .icon-cards-row .glide__track {*/
/*        margin-top:-20px;*/
/*    }*/
/*}*/
</style>

<?php

$data_sale= json_encode($datasale);
?>

<div class="container-fluid">
<div class="row">
               
               <div class="col-lg-12 col-xl-8">
                   <div class="icon-cards-row">
                       <div class="glide dashboard-numbers">
                           <div class="glide__track" data-glide-el="track">
                              <?php
                                $paymentMethods = array('0' => 'Cash', '2' => 'Cheque', '3' => 'Card', '4' => 'UPI');
                                $paymentMethodsicon = array('0' => 'fa fa-money-bill-wave', '2' => 'fa fa-money-check-alt', '3' => 'fas fa-credit-card', '4' => 'fas fa-mobile-alt');
                                ?>
                               <ul class="glide__slides1" style="display:grid;grid-template-columns: repeat(3, 1fr);width:auto;gap: 20px;padding:0px;">
                                  <!-- 
                                   <li class="glide__slide">
                                       <a href="<?=base_url('clients')?>" class="card">
                                           <div class="card-body text-center">
                                               <i class="glyph-icon iconsminds-male-female"></i>
                                               <p class="card-text mb-0"><?=display('customers');?></p>
                                               <p class="lead text-center"><?=$count_client;?></p>
                                           </div>
                                       </a>
                                   </li>
                                   <li class="glide__slide">
                                       <a href="<?=base_url('products')?>" class="card">
                                           <div class="card-body text-center">
                                               <i class="glyph-icon simple-icon-tag"></i>
                                               <p class="card-text mb-0"><?=display('categories');?> </p>
                                               <p class="lead text-center"><?=$count_product;?></p>
                                           </div>
                                       </a>
                                   </li>
                                   -->
                                 <?php foreach($paymentMethods as $key => $val): 
                                                 $salesMethod =  $this->db
                                            ->select('SUM(total) as total')
                                            ->from('sales')
                                            ->where(['created_at' => date('Y-m-d'), 'paidmethod' => $key])
                                            ->get()
                                            ->row();
                                    ?>
                                        <li class="glide__slide">
                                            <a href="#" class="card">
                                                <div class="card-body text-center">
                                                    <i class="<?= $paymentMethodsicon[$key]; ?>"></i>
                                                    <p class="card-text mb-0"><?= $val; ?></p>
                                                    <p class="lead text-center"><?= is_numeric($salesMethod->total) ? $salesMethod->total : 0; ?> <?= settings()->currency ?></p>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                   
                                   <li class="glide__slide">
                                       <a href="<?=base_url('pos')?>" class="card">
                                           <div class="card-body text-center">
                                               <!--<i class="glyph-icon iconsminds-money-bag"></i>-->
                                               
                                               <i class="fas fa-tags"></i>
                                               
                                               <p class="card-text mb-0"> <?=display('TodaySale');?></p>
                                               <p class="lead text-center"><?=number_format((float)($sum_sale_day), settings()->decimals, '.', ''). ' ' . settings()->currency;?></p>

                                        
                                           </div>
                                       </a>
                                   </li>
                               </ul>
                           </div>
                       </div>
                   </div>

                   <div class="row d-sm-block d-none">
                       <div class="col-md-12 mb-4">
                           <div class="card">
                               

                               <div class="card-body" style="overflow:hidden;height:385px">
                                   <div class="dashboard-line-chart chart candaraFont13">
                                   <canvas id="saleChart" width="400" height="150"></canvas>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="col-xl-4 col-lg-12 mb-4">
                   <div class="card">
                      

                       <div class="card-body">
                           <h5 class="card-title"> <?=display('RequestsToday');?> (<?=$count_sale;?>)</h5>
                           <div class="scroll dashboard-list-with-thumbs">
                            <?PHP
                            foreach($sales_day as $sale):
                            ?>
                               <div class="d-flex flex-row mb-3">
                                   <div class="pl-3 pt-2 pr-2 pb-2">
                                       <a class="" href="javascript:void(0)" onclick="showTicket('<?=$sale->id?>')">
                                           <p style="margin-bottom:5px;" class="list-item-heading"><?=display('num')?> : <?=sprintf("%05d", $sale->id)?> : <?=$sale->date_time;?></p>
                                           <div class="pr-4">
                                               <p class="text-muted mb-1 text-small" style="line-height:18px!important;"><?=display('Client');?> : <?=$sale->clientname;?> - <?=display('number_of_services');?>: <?=$sale->totalitems;?> - <?=display('total');?>: <?=number_format((float)($sale->total), settings()->decimals, '.', ''). ' ' . settings()->currency;?> </p>
                                           </div>
                                           <div class="text-primary text-small font-weight-medium">
                                          
                                           <?PHP 
                                           if($sale->total == $sale->paid)
                                           {
                                             $satus = display('paid');
                                             $classeStyle ='badge badge-success';
                                           }
                                           elseif($sale->paid == 0)
                                           {
                                             $satus =  display('unpaid');
                                             $classeStyle ='badge badge-danger';
                                           }
                                           else
                                           {
                                             $satus = display('partial_payment');
                                             $classeStyle ='badge badge-warning';
                                           }
                                           ?>
                                            <span class="<?=$classeStyle;?>"><?=$satus;?><span>

                                               </div>
                                       </a>
                                   </div>
                               </div>
                               <hr>
                            <?PHP 
                            endforeach;
                            ?>
                            
                               
                           </div>
                       </div>
                   </div>
               </div>
           </div>
</div>
 <!-- Modal ticket -->
 <div class="modal fade" id="ticket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
   <div class="modal-dialog" role="document" id="ticketModal">
      <div class="modal-content">
        <div class="modal-header">
                                            <h5 class="modal-title"> <?=display('receipt');?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
        <div class="modal-body" id="modal-body">
           <div id="printSection">
              <!-- Ticket goes here -->
              <center><h1 style="color:#34495E"><?=display('empty');?></h1></center>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-danger hiddenpr" data-dismiss="modal"><?=display('close');?></button>
          <button type="button" class="btn btn-sm btn-success hiddenpr" onclick="PrintTicket()"><?=display('print');?></button>
        </div>
      </div>
   </div>
  </div>
  <script src="<?=base_url();?>assets/js/Chart.min.js"></script>

  <script src="<?=base_url();?>assets/js/vendor/jquery-3.3.1.min.js"></script>
  <!-- /.Modal -->
<script> 

function showTicket(id){
      $.ajax({
          url : "<?php echo site_url('sales/ShowTicket')?>/"+id,
          type: "POST",
          success: function(data)
          {
              $('#printSection').html(data);
              $('#ticket').modal('show');
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert("error");
          }
      });
      }
   function PrintTicket() {
       $('.modal-body').removeAttr('id');
       window.print();
       $('.modal-body').attr('id', 'modal-body');
    }

</script>
<script>
var saleData = JSON.parse(`<?php echo $data_sale;?>`);
var salechart = document.getElementById('saleChart');

var myChart = new Chart(salechart, {
    type: 'line',
    data: {
        labels: saleData.label,
        datasets: [{
            label: '<?=display('sales').' '.settings()->currency;?>',
            data: saleData.data1,
            fill: false,
            borderColor: '#17a2b8',
            borderWidth: 1
        },
        {
            label: '<?=display('expenses').' '.settings()->currency;?>',
            data: saleData.data2,
            fill: false,
            borderColor: '#ed7117',
            borderWidth: 1
        },
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        title: {
          display: true,
          position: "top",
          text: "<?=display('statementofexpensesandsalesfortheyear').' : '. date('Y')?>",
          fontSize: 18,
          family: "'Droid Arabic Kufi'",
          fontColor: "#111"
        },
        label: {
            font: {
                family: "'Droid Arabic Kufi'"
            }
       }
    }
});
</script>

