<style>
    .table.dataTable td:nth-child(2) {
        display: inline-block;
        width: 68px;
        height: 44px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <?php $this->load->view('repports/nave');?>
        </div>
    </div>
    <div class="row">

        <div class="col-xl-2 col-lg-2 mb-4">
            <?=form_open('repports/sales');?>

            <label class=""><?=display('year')?> :</label>
            <select id="idYear" class="form-control mb-2" onchange="this.form.submit()" name="year">
                <?php 
                                                for($i = 2020 ; $i <= date('Y'); $i++){
                                                    ?>
                <option <?php echo ($i ==  $year) ? ' selected="selected"' : '';?> value="<?=$i;?>"><?=$i;?></option>
                <?php
                                                }
                                                ?>
            </select>
            <div class="text-center mb-2">
                <input type="hidden" value="" class="xdirection" id="xdirection" name="xdirection">
                <button type="submit" class="btn btn-sm btn-info" value="pdfgen" name="pdfgen"> <?=display('download')?>
                    <i class="glyph-icon simple-icon-printer"></i></button>
            </div>

            <div class="card">
                <div class="card-body text-center">
                    <h6><span class="badge badge-primary"><?=$year;?></span></h6>
                    <p class="card-text mb-0 text-info"><?=display('earnings')?></p>
                    <p class="lead text-center">
                        <?=number_format((float)$amount, settings()->decimals, '.', '').' '. settings()->currency;?></p>
                </div>

            </div>
            <div class="card">
                <div class="card-body text-center">
                    <p class="card-text mb-0 text-info"> <?=display('total_taxes')?></p>
                    <p class="lead text-center">
                        <?=number_format((float)$taxamount, settings()->decimals, '.', '').' '. settings()->currency;?>
                    </p>
                </div>

            </div>
            <div class="card">
                <div class="card-body text-center">
                    <p class="card-text mb-0 text-success"> <?=display('paid_up')?></p>
                    <p class="lead text-center">
                        <?=number_format((float)$paid, settings()->decimals, '.', '').' '. settings()->currency;?></p>
                </div>

            </div>
            
             <div class="card">
                <div class="card-body text-center">
                    <p class="card-text mb-0 text-success">Cash</p>
                    <p class="lead text-center">
                        <?=number_format((float)$cash, settings()->decimals, '.', '').' '. settings()->currency;?></p>
                </div>
            </div>
            
            
            <div class="card">
                <div class="card-body text-center">
                    <p class="card-text mb-0 text-success">Card</p>
                    <p class="lead text-center">
                        <?=number_format((float)$card, settings()->decimals, '.', '').' '. settings()->currency;?></p>
                </div>
            </div>
            
            
              <div class="card">
                <div class="card-body text-center">
                    <p class="card-text mb-0 text-success">UPI</p>
                    <p class="lead text-center">
                        <?=number_format((float)$upi, settings()->decimals, '.', '').' '. settings()->currency;?></p>
                </div>
            </div>
            
            
             <div class="card">
                <div class="card-body text-center">
                    <p class="card-text mb-0 text-success">Cheque</p>
                    <p class="lead text-center">
                        <?=number_format((float)$cheque, settings()->decimals, '.', '').' '. settings()->currency;?></p>
                </div>
            </div>
            
            
            
            <div class="card">
                <div class="card-body text-center">
                    <p class="card-text mb-0 text-danger"> <?=display('rest')?></p>
                    <p class="lead text-center">
                        <?=number_format((float)$amount-$paid, settings()->decimals, '.', '').' '. settings()->currency;?>
                    </p>
                </div>

            </div>
            <div class="card">
                <div class="card-body text-center">
                    <p class="card-text mb-0 text-warning"> <?=display('total_discounts')?></p>
                    <p class="lead text-center">
                        <?=number_format((float)$discountamount, settings()->decimals, '.', '').' '. settings()->currency;?>
                    </p>
                </div>

            </div>

            <?=form_close();?>
        </div>
        <div class="col-lg-10 col-md-12 mb-4">
            <div class="card">
                <div class="card-body p-2">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true"> <?=display('sales')?>
                                <?=$year;?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false"> <?=display('graph')?>
                                <?=$year;?></a>
                        </li>
                        
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link" id="pills-advanced-tab" data-toggle="pill" href="#pills-advanced"-->
                        <!--        role="tab" aria-controls="pills-advanced" aria-selected="false">-->
                        <!--        <?=display('advanced_search')?></a>-->
                        <!--</li>-->
                        
                        
                       
                        
                        
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th><?=display('num')?></th>
                                        <th><?=display('date')?></th>
                                        <th><?=display('client')?></th>
                                        <th>User</th>
                                        <th><?=display('tax')?></th>
                                        <th><?=display('discounts')?></th>
                                        <th><?=display('total')?></th>
                                        <th><?=display('by')?></th>
                                        <th><?=display('number_of_services')?></th>
                                        <th><?=display('status')?></th>
                                        <th><?=display('delivery')?></th>
                                         <th>Payment method</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <?php
                                $data_chart= json_encode($chartdata);
                                ?>
                            <canvas id="saleChart" width="400" height="230px"></canvas>

                        </div>
                        <div class="tab-pane fade" id="pills-advanced" role="tabpanel"
                            aria-labelledby="pills-advanced-tab">
                            
                            <!--<h1> <?=display('advanced_search')?> </h1>-->
                            
                            <?php echo form_open('repports/sales'); ?>
                            <div class="row">



                                <div class="form-group mb-3 col-6">
                                    <script type="text/javascript">
                                    $(function() {
                                        $('.input-sm').datepicker({
                                            format: "yyyy-mm-dd"
                                        });
                                    });
                                    </script>
                                    <label><?=display('date')?> </label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="input-sm form-control" name="start"
                                            placeholder="<?=display('from')?>" data-date-format="yyyy-mm-dd"
                                            autocomplete="off">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="input-sm form-control" name="end"
                                            placeholder="<?=display('to')?>" data-date-format="yyyy-mm-dd"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group mt-4  col-3">
                                    <input type="hidden" value="" class="xdirectionadv" id="xdirection"
                                        name="xdirection">
                                    <button type="submit" name="advgen" value="advgen"
                                        class="btn btn-primary  mb-1"><?=display('print')?> <i
                                            class="glyph-icon simple-icon-printer"></i></button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url();?>assets/js/Chart.min.js"></script>
<script type="text/javascript">
var save_method; //for save method string
var table;
var year = '<?=$year?>';
$(document).ready(function() {
    var xdirection = localStorage.getItem("dore-direction");
    $('.xdirection').val(xdirection);
    $('.xdirectionadv').val(xdirection);
    table = $('#table').DataTable({
        "language": {
            "url": "<?php echo ($this->language == 'arabic') ? base_url('files/ar_datatable.json') : ''; ?>",
            "searchPlaceholder": " <?=display('search')?> ",
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('sales/ajax_list/')?>" + year,
            "type": "POST",
            "data": {},
        },

        //Set column definition initialisation properties.
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": true, //set not orderable
        }, ],
        "bInfo": true,
        // "fnRowCallback": function(nRow, aData, iDisplayIndex) {
        //     nRow.setAttribute('data-order',aData[4]);
        // }
    });
});

var salesData = JSON.parse(`<?php echo $data_chart;?>`);
var salesChart = document.getElementById('saleChart');

var myChart = new Chart(salesChart, {
    type: 'line',
    data: {
        labels: salesData.label,
        datasets: [{
            label: '<?=display('sales')?> <?=settings()->currency;?>',
            data: salesData.data1,
            borderColor: '#17a2b8',
            borderWidth: 1
        }, ]
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
            text: "<?=display('sales')?> <?=display('graph')?> :  <?=$year?>",
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
$(document).on('change', '.user_filter', function() {
    var data = $(this).val();
    $("#table_filter input").val(data).trigger("input");;
    //$("#table_filter input").trigger('change');
});
</script>