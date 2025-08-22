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
</style>

<?php
$data_sale= json_encode($datasale);
?>
<div class="container-fluid">
<div class="row">
                <div class="col-12">
                    <h6><?=display('reports')?> </h6>
                    <div class="separator mb-1"></div>
                </div>
            </div>
<div class="row">
               
               <div class="col-lg-12 col-xl-12">
               <div class="row icon-cards-row mb-2  mt-2 sortable">
                        
                        <div class="col-md-3 col-lg-3 col-sm-4 col-6 mb-2">
                            <a href="<?=base_url('repports/sales')?>" class="card">
                                <div class="card-body text-center">
                                    <i class="iconsminds-basket-coins"></i>
                                    <p class="card-text mb-0"><?=display('sales')?></p>
                                    <p class="lead text-center"><?=$count_sale?></p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-4 col-6 mb-2" draggable="false" style="">
                            <a href="<?=base_url('repports/expences')?>" class="card" draggable="false">
                                <div class="card-body text-center">
                                    <i class="glyph-icon iconsminds-file"></i>
                                    <p class="card-text font-weight-semibold mb-0"><?=display('expenses')?></p>
                                    <p class="lead text-center"><?=$count_expence?></p>
                                </div>
                            </a>
                        </div><div class="col-md-3 col-lg-3 col-sm-4 col-6 mb-2" draggable="false" style="">
                            <a href="<?=base_url('repports/clients')?>" class="card" draggable="false">
                                <div class="card-body text-center">
                                    <i class="glyph-icon iconsminds-male-female"></i>
                                    <p class="card-text mb-0"><?=display('customers')?></p>
                                    <p class="lead text-center"><?=$count_client?></p>
                                </div>
                            </a>
                        </div>
                       
                        <!--<div class="col-md-3 col-lg-3 col-sm-4 col-6 mb-2">-->
                        <!--    <a href="<?=base_url('repports/registers')?>" class="card">-->
                        <!--        <div class="card-body text-center">-->
                        <!--            <i class="glyph-icon iconsminds-cash-register-2"></i>-->
                        <!--            <p class="card-text mb-0"> <?=display('pos')?></p>-->
                        <!--            <p class="lead text-center"><?=$count_register?></p>-->
                        <!--        </div>-->
                        <!--    </a>-->
                        <!--</div>-->
                        
                    </div>

                   <div class="row">
                       <div class="col-md-6 mb-4">
                           <div class="card">
                               

                               <div class="card-body" style="">
                                   <div class="width:50%">
                                   <canvas id="saleChart" width="400" height="230px"></canvas>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6 mb-4">
                           <div class="card">
                               
                           <?PHP
                                 
                                 $dataprod = [];
                                foreach($querytop as $queryto)
                                {
                                    $dataprod['label'][] = $queryto->name;
                                    $dataprod['data1'][] = $queryto->totalquantity;
                                }
                                $data_prod= json_encode($dataprod);
                                ?>
                               <div class="card-body" style="">
                                  <div class="width:50%">
                                   <canvas id="prodChart" width="400" height="230px"></canvas>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6 mb-4">
                       
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
                                            <h5 class="modal-title"> <?=display('receipt')?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
        <div class="modal-body" id="modal-body">
           <div id="printSection">
              <!-- Ticket goes here -->
              <center><h1 style="color:#34495E"><?=display('empty')?></h1></center>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-danger hiddenpr" data-dismiss="modal"><?=display('close')?></button>
          <button type="button" class="btn btn-sm btn-success hiddenpr" onclick="PrintTicket()"><?=display('print')?></button>
        </div>
      </div>
   </div>
  </div>
  <script src="<?=base_url('assets/js/')?>Chart.min.js"></script>
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
window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};
var saleData = JSON.parse(`<?php echo $data_sale;?>`);
var salechart = document.getElementById('saleChart');

var myChart = new Chart(salechart, {
    type: 'line',
    data: {
        labels: saleData.label,
        datasets: [{
            label: '<?=display('sales')?> <?=settings()->currency;?>',
            data: saleData.data1,
            fill: false,
            borderColor: '#17a2b8',
            borderWidth: 1
        },
        {
            label: '<?=display('expenses')?> <?=settings()->currency;?>',
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
          text: "<?=display('statementofexpensesandsalesfortheyear')?>  :  <?=$year?>",
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

var prodData = JSON.parse(`<?php echo $data_prod;?>`);
var prodchart = document.getElementById('prodChart');

var myChart = new Chart(prodchart, {
    type: 'pie',
    data: {
        labels: prodData.label,
        datasets: [{
            label: '<?=display('sales')?> <?=settings()->currency;?>',
            data: prodData.data1,
            backgroundColor: [
                window.chartColors.red,
				window.chartColors.orange,
				window.chartColors.yellow,
				window.chartColors.green,
				window.chartColors.blue,
            ],

            
            borderWidth: 1
        }
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
          text: "<?=display('list_of_the_most_requested_services')?>",
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

