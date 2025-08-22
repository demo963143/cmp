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
</style>
<div class="container-fluid">
<!-- Modal delet -->
<?php $this->load->view('tpl/delete_modal');?>
            <div class="row">
                <div class="col-12">
                    <h3>Online Sales</h3>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    </nav>
                    <div class="separator mb-1"></div>
                </div>
                
            </div>

            <div class="row mb-4">
            
                <div class="col-12 mb-4">
                   <?php echo form_open('sales/index'); ?>
                  <!--
                    <div class="row">
                               <div class="form-group mb-3 col-3">
                                        <label> <?=display('from')?></label>
                                        <input name="startdate" class="form-control datepicker" placeholder="<?=display('from')?>" data-date-format="yyyy-mm-dd" autocomplete="off">
                               </div>
                               <div class="form-group mb-3 col-3">
                                        <label> <?=display('to')?></label>
                                        <input name="enddate" class="form-control datepicker" placeholder="<?=display('to')?>" data-date-format="yyyy-mm-dd" autocomplete="off">
                               </div>
                               <div class="form-group mb-3 col-3">
                                        <label> User</label>
                                        <select class="form-control user_filter">
                                            <option value="">Select User</option>
                                            <?php for($m=0;$m<count($result);$m++){?>
                                                <option value="<?= $result[$m]->name ?>"><?= $result[$m]->name ?></option>
                                            <?php } ?>
                                        </select>
                               </div>
                               <div class="form-group mt-4  col-3">
                                  <button type="submit" name="pdfgen" value="pdfgen" class="btn btn-primary  mb-1"><?=display('print')?> <i class="glyph-icon simple-icon-printer"></i></button>
                               </div>
                  </div>
                  -->
                  <?php echo form_close(); ?>
                    <div class="card">
                        <div class="card-body">
                            
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Store ID</th>
        								<th>Sales Date</th>
                                        <th>Products</th>
                                        <th>Client Name</th>
                                        <th>Refer Code</th>
                                        <th>Delivery address</th>
                                        <th>Delivery date</th>
                                        <th>Delivery time</th>
                                        <th>Pickup address</th>
                                        <th>Pickup date</th>
                                        <th>Pickup time</th>
        								<th>Instructions</th>
        								<th>Payment</th>
        								<th>Shipping cost</th>
        								<th>Subtotal cost</th>
        								<th>Total cost</th>
        								<th>Status</th>
                                        
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
        
     

   <script type="text/javascript">
 
    var save_method; //for save method string
    var table;
  
    $(document).ready(function() {
     
      table = $('#table').DataTable({
        "scrollX": true,
        "language": {
             "url": "<?php echo ($this->language=='arabic') ? base_url('files/ar_datatable.json') : ''; ?>>",
            "searchPlaceholder": " <?=display('num')?>",
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('onlineSales/ajax_list/')?>",
            "type": "POST",
            "data":function(data) {
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
    var items = [];


    
    function PrintTicket() {
       $('.modal-body').removeAttr('id');
       window.print();
       $('.modal-body').attr('id', 'modal-body');
    }
    
   function Printbarcode() {
        var id = $(".printid").val();
    
        if (id) {
            var printUrl = "https://retail.minkchatter.com/swan/pos/print_all_barcodes/" + id;
            window.open(printUrl, '_blank'); 
        } else {
            console.error("Could not retrieve ID. Check if the element with class 'printid' exists and has a value.");
        }
    }
    
    function Printtag() {
       $('.modal-body').removeAttr('id');
       window.print();
       $('.modal-body').attr('id', 'modal-body');
    }
    
    
    $(document).on('change', '.user_filter', function() {
    var data = $(this).val();
    $("#table_filter input").val(data).trigger("input");;
    //$("#table_filter input").trigger('change');
   });
   
  </script>
  
  <!-- Modal ticket -->
  <div class="modal fade" id="ticket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
   <div class="modal-dialog" role="document" id="ticketModal">
      <div class="modal-content">
       
        <div class="modal-header">
       <h5 class="modal-title" id="ticket"> <?=display('receipt')?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        
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
          
          <a href="" onclick="Printbarcode()" class="btn btn-warning print_all_barcodes">Print Tag</a>
           
        </div>
      </div>
   </div>
  </div>
  


  <!-- /.Modal -->