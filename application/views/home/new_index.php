<style>
#printSection {
    color: #000;
    margin: 0 auto;
}

#ticket .modal-dialog {
    width: 100%;
}


#modal-body {
    max-height: calc(100vh - 200px);
    overflow-y: auto;
}

@media print {
    .modal-dialog {
        width: 100% !important;
        ;
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
        visibility: hidden;
    }

    .container-fluid {
        display: none;
    }

    #printSection,
    #printSection * {
        visibility: visible;
    }

    #printSectionInvoice,
    #printSectionInvoice * {
        visibility: visible;
    }

    #printSection {
        text-transform: uppercase;
        font-size: 9px;
        left: 0;
        top: 0;
        padding: 0;
        margin: 0;
    }

    #printSection h4 {
        font-size: 12px;
    }

    #printSection {
        font-size: 12px;
    }

    #printSection tr td {
        margin: 0;
        padding: 0;
    }

    #printSection .bg-success,
    #printSection .bg-danger {
        visibility: hidden;
    }

    @page {
        margin: 0;
    }

    .hiddenpr {
        display: none !important;
    }

    html,
    body {
        zoom: 100%;
        overflow: hidden !important;
    }

}

.candaraFont13 {
    font-family: "Droid Arabic Kufi, sans-serif";
    font-size: 13px;
}


.top-bars {
    background-color: #d1e8ff;
    color: #0056a3;
    padding: 10px;
    text-align: center;
    font-weight: bold;
    font-size: 14px;
    border-bottom: 1px solid #ccc;
}

.navbars {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    background-color: #e5f1ff;
    padding: 10px;
    border-bottom: 2px solid #ccc;
}

.navbars select {
    padding: 5px 10px;
    border-radius: 4px;
    border: 1px solid #aaa;
    font-size: 14px;
}

.navbars label {
    font-size: 14px;
    font-weight: bold;
}


.dashboards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 15px;
    }

    .cards {
      background: #fff;
      border-left: 5px solid #007bff;
      padding: 15px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      border-radius: 10px;
    }

    .card-title {
      font-size: 14px;
      color: #555;
    }

    .card-value {
      font-size: 24px;
      font-weight: bold;
      margin: 5px 0;
    }

    .card-sub {
      font-size: 13px;
      color: #888;
    }

    .card-change {
      margin-top: 5px;
      font-size: 13px;
    }

    .up {
      color: green;
    }

    .down {
      color: red;
    }

    .icon-placeholder {
      float: right;
      opacity: 0.2;
      font-size: 24px;
    }


</style>

<?php
$data_sale= json_encode($datasale);
?>

<div class="container-fluid">
    <div class="top-bars">
        You have 1030 pending pick up requests.
    </div>
    
    <div class="navbars">
        <label for="dashboard">Show Dashboard for</label>
        <select id="dashboard">
            <option>Per Weight and Per Pieces</option>
        </select>
    
        <label for="comparison">Comparison</label>
        <select id="comparison" class="comparison">
            <option>This month vs. Last month</option>
        </select>
    </div>
</div>


<div class="dashboards mt-4">

    <div class="cards">
      <div class="card-title">Customers</div>
      <div class="card-value"><?=$count_client;?></div>
      <div class="card-sub">2,168 Active, 137 New</div>
      <div class="card-change up">+12.2%</div>
    </div>
    
    
     
    
    

    <div class="cards">
      <div class="card-title">Revenue</div>
      <div class="card-value">INR <?= number_format((float)($sum_sale_day), settings()->decimals, '.', '') ?></div>
      <div class="card-sub">(393,167)</div>
      <div class="card-change down">-3.6%</div>
    </div>

    <div class="cards">
      <div class="card-title">Orders</div>
      <div class="card-value"><?= $count_sale ?></div>
      <div class="card-sub">(649)</div>
      <div class="card-change down">-14.9%</div>
    </div>

    <div class="cards">
      <div class="card-title">Dry Cleaning</div>
      <div class="card-value">309,365</div>
      <div class="card-sub">(318,679)</div>
      <div class="card-change down">-2.9%</div>
    </div>

    <div class="cards">
      <div class="card-title">Laundry</div>
      <div class="card-value">69,539</div>
      <div class="card-sub">(74,488)</div>
      <div class="card-change down">-6%</div>
    </div>

    <div class="cards">
      <div class="card-title">Dry Cleaning (Orders)</div>
      <div class="card-value">389</div>
      <div class="card-sub">(450)</div>
      <div class="card-change down">-13.6%</div>
    </div>

    <div class="cards">
      <div class="card-title">Laundry (Orders)</div>
      <div class="card-value">163</div>
      <div class="card-sub">(199)</div>
      <div class="card-change down">-18.1%</div>
    </div>

  </div>


<div class="container-fluid mt-4">
    <div class="row">

        <div class="col-lg-12 col-xl-12">
          
            <div class="row">
                <div class="col-md-8 mb-4">
                    <div class="card">


                        <div class="card-body" style="overflow:hidden;height:385px">
                            <div class="dashboard-line-chart chart candaraFont13">
                                <canvas id="saleChart" width="400" height="150"></canvas>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-4 col-lg-4 mb-4">
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
                                            <p class="list-item-heading"><?=display('num')?> :
                                                <?=sprintf("%05d", $sale->id)?> : <?=$sale->date_time;?></p>
                                            <div class="pr-4 d-none d-sm-block">
                                                <p class="text-muted mb-1 text-small"><?=display('Client');?> :
                                                    <?=$sale->clientname;?> - <?=display('number_of_services');?>:
                                                    <?=$sale->totalitems;?> - <?=display('total');?>:
                                                    <?=number_format((float)($sale->total), settings()->decimals, '.', ''). ' ' . settings()->currency;?>
                                                </p>
                                            </div>
                                            <div class="text-primary text-small font-weight-medium d-none d-sm-block">

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


    </div>
</div>
<!-- Modal ticket -->
<div class="modal fade" id="ticket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false"
    data-backdrop="static">
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
                    <center>
                        <h1 style="color:#34495E"><?=display('empty');?></h1>
                    </center>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger hiddenpr"
                    data-dismiss="modal"><?=display('close');?></button>
                <button type="button" class="btn btn-sm btn-success hiddenpr"
                    onclick="PrintTicket()"><?=display('print');?></button>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url();?>assets/js/Chart.min.js"></script>

<script src="<?=base_url();?>assets/js/vendor/jquery-3.3.1.min.js"></script>
<!-- /.Modal -->
<script>
function showTicket(id) {
    $.ajax({
        url: "<?php echo site_url('sales/ShowTicket')?>/" + id,
        type: "POST",
        success: function(data) {
            $('#printSection').html(data);
            $('#ticket').modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
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


<script>
  const comparisonSelect = document.getElementById('comparison');

  const monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

  const today = new Date();

  function pad(n) {
    return n < 10 ? '0' + n : n;
  }

  for (let i = 0; i < 6; i++) {
    let current = new Date(today.getFullYear(), today.getMonth() - i, 1);
    let previous = new Date(today.getFullYear(), today.getMonth() - i - 1, 1);

    let currentText = `${monthNames[current.getMonth()]} ${current.getFullYear()}`;
    let previousText = `${monthNames[previous.getMonth()]} ${previous.getFullYear()}`;

    let currentValue = `01-${pad(current.getMonth() + 1)}-${current.getFullYear()}`;
    let previousValue = `01-${pad(previous.getMonth() + 1)}-${previous.getFullYear()}`;

    let option = document.createElement("option");
    option.value = `${currentValue}_${previousValue}`;
    option.text = `${currentText} vs ${previousText}`;
    comparisonSelect.appendChild(option);
  }
  
  $(document).on('change', '.comparison', function (e) {
    //alert('test data');
  
  });
  
  
  
  
</script>



