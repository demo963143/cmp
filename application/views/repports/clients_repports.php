<div class="container-fluid">
<div class="row">
                <div class="col-12">
                <?php $this->load->view('repports/nave');?>
                </div>
            </div>
<div class="row">

<div class="col-xl-2 col-lg-12 mb-4">
  <?=form_open('repports/clients');?>

                    <div class="card">
                    <div class="card-body text-center">
                                     <h6><span class="badge badge-primary"><?=$year;?></span></h6>
                                    <i class="glyph-icon iconsminds-male-female" style="font-size: 20px;"></i>
                                    <p class="card-text mb-0"><?=display('list_of_clients')?></p>
                                    <p class="lead text-center"><?=$count_client?></p>
                                    <input type="hidden" value="" class="xdirection" id="xdirection" name="xdirection">

                                    <button type="submit" class="btn btn-sm btn-info" value="pdfgen" name="pdfgen"><?=display('download')?><i class="glyph-icon simple-icon-printer"></i></button>

                                </div>

                    </div>

                    <?=form_close();?>
                </div>
                <div class="col-xl-10 col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body p-2">
     
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  <table id="table" class="table">
                                <thead>
                                <tr>
                                <th><?=display('num')?></th>
                                <th><?=display('first_name')?></th>
                                <th><?=display('last_name')?> </th>
                                <th><?=display('phone')?></th>
                                <th><?=display('adress')?></th>
                                <th><?=display('total_transactions')?> <?=settings()->currency;?></th>
                                <th><?=display('paid')?></th>
                                <th><?=display('rest')?></th>
                                </tr>
                                </thead>
                                <tbody>
                              
                                </tbody>
                            </table>
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
    $(document).ready(function() {

      var xdirection = localStorage.getItem("dore-direction");
      $('.xdirection').val(xdirection);
        
      table = $('#table').DataTable({
        "language": {
            "url": "<?php echo ($this->language=='arabic') ? base_url('files/ar_datatable.json') : ''; ?>",
            "searchPlaceholder": "<?=display('search').' : '.display('num').' , '.display('name')?>",
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('clients/ajax_client/')?>",
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
</script>