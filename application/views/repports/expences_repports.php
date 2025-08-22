<div class="container-fluid">
<div class="row">
                <div class="col-12">
                <?php $this->load->view('repports/nave');?>
                </div>
            </div>
<div class="row">

<div class="col-xl-2 col-lg-12 mb-4">
  <?=form_open('repports/expences');?>

    <label class="yearrtl"><?=display('year')?> :</label>
                                        <select id="idYear" class="form-control mb-2" onchange="this.form.submit()" name="year">
                                            <?php 
                                                for($i = 2020 ; $i <= date('Y'); $i++){
                                                    ?>
                                                    <option <?php echo ($i ==  $year) ? ' selected="selected"' : '';?> value="<?=$i;?>"><?=$i;?></option>
                                                    <?php
                                                }
                                                ?>
                                        </select>
  
                    <div class="card">
                    <div class="card-body text-center">
                                     <h6><span class="badge badge-primary"><?=$year;?></span></h6>
                                    <i class="glyph-icon iconsminds-file" style="font-size: 20px;"></i>
                                    <p class="card-text mb-0"><?=display('expenses')?></p>
                                    <p class="lead text-center"><?=number_format((float)$amount, settings()->decimals, '.', '').' '. settings()->currency;?></p>
                                    <input type="hidden" value="" class="xdirection" id="xdirection" name="xdirection">
                                    <button type="submit" class="btn btn-sm btn-info" value="pdfgen" name="pdfgen"> <?=display('download')?> <i class="glyph-icon simple-icon-printer"></i></button>

                                </div>

                    </div>

                    <?=form_close();?>
                </div>
                <div class="col-xl-10 col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body p-2">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"> <?=display('list_of_expenses')?> <?=$year;?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"> <?=display('graph')?>  <?=$year;?></a>
  </li>

</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  <table id="table" class="table">
                                <thead>
                                <tr>
                                    <th><?=display('date')?></th>
                                    <th><?=display('num')?></th>
                                    <th><?=display('address')?></th>
                                    <th><?=display('category')?>  </th>
                                    <th> <?=display('price')?> <?=settings()->currency;?></th>
                                    <th> <?=display('file')?>  </th>
                                </tr>
                                </thead>
                                <tbody>
                              
                                </tbody>
                            </table>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <?php
    $data_chart= json_encode($chartdata);
    ?>
    <canvas id="expencesChart" width="400" height="230px"></canvas>

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
        
      table = $('#table').DataTable({
        "language": {
          "url": "<?php echo ($this->language == 'arabic') ? base_url('files/ar_datatable.json') : ''; ?>",
            "searchPlaceholder": " <?=display('num')?> ",
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('expences/ajax_expence/')?>"+year,
            "type": "POST",
            "data": {
            },
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        {
          "targets": [ -1 ], //last column
          "orderable": true, //set not orderable
        },
        ],
         "bInfo": true,
         // "fnRowCallback": function(nRow, aData, iDisplayIndex) {
         //     nRow.setAttribute('data-order',aData[4]);
         // }
      });
    });

var expencesData = JSON.parse(`<?php echo $data_chart;?>`);
var expencesChart = document.getElementById('expencesChart');

var myChart = new Chart(expencesChart, {
    type: 'line',
    data: {
        labels: expencesData.label,
        datasets: [{
            label: '<?=display('expenses')?> <?=settings()->currency;?>',
            data: expencesData.data1,
            borderColor: '#17a2b8',
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
          text: "<?=display('expenses')?> :  <?=$year?>",
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