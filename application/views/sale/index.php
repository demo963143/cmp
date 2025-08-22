<style>
  #printSection{
   color: #000;
   margin: 0 auto;
}


#printSection center img{
width:15.5rem;
}


#order_status{
    padding-top:0.3rem;
    padding-bottom:0.3rem;
}

.modal .modal-header{
    margin:0!important;
    padding:0px 10px!important;
    display:none;
}

#ticket .modal-dialog
{
  width: 100%;
}

.table.dataTable td:nth-child(2) {
    display: inline-block;
    width: 68px;
    height: 44px;
}

.default-transition h3, .default-transition h6{
    font-size:22px;
    /*margin-bottom:0;*/
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

.dropdown-item i {
    display: none;
}

select option {
    background-color: #fff;
    color: #000;
}

</style>
<div class="container-fluid">
<!-- Modal delet -->
<?php $this->load->view('tpl/delete_modal');?>
            <div class="row">
                <div class="col-12">
                    <h3><?=display('sales')?> </h3>
                    <!--<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">-->
                    <!--</nav>-->
                    
                </div>
                
            </div>

            <div class="row mb-4">
            
                <div class="col-12 mb-4">
                   <?php echo form_open('sales/index'); ?>
                  <div class="row">
                <div class="form-group mb-3 col-6 col-sm-3">
                                        <label> <?=display('from')?></label>
                                        <input name="startdate" class="form-control datepicker" placeholder="<?=display('from')?>" data-date-format="yyyy-mm-dd" autocomplete="off">
                               </div>
                <div class="form-group mb-3 col-6 col-sm-3">
                                        <label> <?=display('to')?></label>
                                        <input name="enddate" class="form-control datepicker" placeholder="<?=display('to')?>" data-date-format="yyyy-mm-dd" autocomplete="off">
                               </div>
                               
                               
                               
                               <div class="form-group mt-sm-4 mt-0  col-6 col-sm-3">
                    <button type="submit" name="pdfgen" value="pdfgen" class="btn btn-primary  mb-1"><?=display('print')?> <i class="glyph-icon simple-icon-printer"></i></button>
                               </div>
                  </div>
                  <?php echo form_close(); ?>
                    <div class="card">
                        <div class="card-body">
                            
                            <table id="table" class="table">
                                <thead>
                                <tr>
                                <th><?=display('num')?></th>
                                <th><?=display('date')?></th>
                                <th>Client Name</th>
                                <th>User Name</th>
                                <th><?=display('tax')?></th>
                                <th><?=display('discounts')?></th>
                                <th><?=display('total')?></th>
                                <th><?=display('by')?></th>
                                <th> <?=display('number_of_services')?></th>
                                <th><?=display('status')?></th>
                                <th><?=display('delivery')?></th>
                                 <th>Payment method</th>
                                <th><?=display('action')?></th>
                                <th>Order Status</th>  
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
        "language": {
             "url": "<?php echo ($this->language=='arabic') ? base_url('files/ar_datatable.json') : ''; ?>>",
            "searchPlaceholder": " <?=display('num')?>",
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('sales/ajax_list/')?>",
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
      //Confirm deletion  modal 
      $('#confirm-delete').on('show.bs.modal', function (e) {
        var sale_id = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'POST',
            url : '<?php echo site_url();?>/sales/delete/', 
            data :  'sale_id='+ sale_id,
            success : function(data){
            $('.fetchedeletebtm').html(data);
            $('#deletbtm_result').html('');
           
            }
        });
     });
     
    });
    var items = [];
   // delete customer
   function deletebtm(idClt){
    $.ajax({
            url : "<?php echo base_url('sales/delete/')?>"+idClt,
            type: "POST",
            dataType : "JSON",
            data: {},
            success: function(data)
            {
               $('#deletbtm_result').html(data.msg);
               if(data.delete == 'delete')
               {
                 table.ajax.reload();
                 $('.sound1').get(0).play();
               }
               else
               {
                $('.sounderr').get(0).play();
               }  
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
               alert("error");
            }
        });
   }
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
    
    
     function showImage(id){
      $.ajax({
          url : "<?php echo site_url('sales/showimage')?>/"+id,
          type: "POST",
          success: function(data)
          { 
              $('#printimage').html(data);
              $('#imagesection').modal('show');
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
    
   
    
   function Printbarcode() {
        var id = $(".printid").val();
        if (id) {
            var printUrl = "https://laundroklean.meshink.xyz/software/pos/print_all_barcodes/" + id;
            window.open(printUrl, '_blank'); 
        } else {
            console.error("Could not retrieve ID. Check if the element with class 'printid' exists and has a value.");
        }
    }
    
    
    
    
    
   
   
    
    function updatebarcode(id){
      $.ajax({
           url : "<?php echo site_url('pos/updatedata_barcodes')?>",
          type: "Post",
          data:
          { 
              "id": id
          },
          success: function(data)
          {
           alert('Barcode Generate successfull.');
          window.location.reload();
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert("error");
          }
       });
    }
    
    function Printtag() {
       $('.modal-body').removeAttr('id');
       window.print();
       $('.modal-body').attr('id', 'modal-body');
    }
    
    function change_order_status(id,type){
        var status = $(type).children("option:selected").val();  
        data = 'id='+id+'&status='+status;
      $.ajax({
          url : "<?php echo site_url('sales/change_order_status')?>",
          type: "GET",
          data:data,
          success: function(data)
          {
            result = JSON.parse(data);
            if(result.status == 1){
                refreshpage();
                alert(result.message);
            }else{
                alert(result.message);
            }
            

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert("error");
          }
      });
      }
      
      
      $(document).on('change', '.user_filter', function() {
        var data = $(this).val();
        $("#table_filter input").val(data).trigger("input");;
        //$("#table_filter input").trigger('change');
      });
      
      


    function sendnotification() {
        var id = $(".printid").val();
        $.ajax({
            url: "<?php echo site_url('sales/send_notification')?>",
            type: "POST",
            data: { id: id },
            success: function(data) {
                try {
                    var result = JSON.parse(data);
                    if (result.status == 1) {
    
                        // Build the line items
                        let itemDetails = "Item Details:\n\n";
                        if (Array.isArray(result.items) && result.items.length > 0) {
                            result.items.forEach(function(item, index) {
                                itemDetails += `${index + 1}: ${item.name}`;
                                // If you want service_name or type, etc.
                                if (item.service_name) {
                                    itemDetails += ` (${item.service_name})`;
                                }
                                itemDetails += ` = ${item.qt.toFixed(2)} X ${item.price.toFixed(2)} = ${item.subtotal.toFixed(2)}\n`;
                            });
                        } else {
                            itemDetails += "No item data found.\n";
                        }
    
                        // Build final message
                        let message = `Dear ${result.clientname},
    
                        Thank you for placing the order.
                        Your Invoice Number: ${result.sales_id} is ready with amount of ${result.total_amount}.
                        
                        ${itemDetails}
                        Total Amount: ${result.subtotal_amount}
                        Discount Amount: ${result.discountamount}
                        Tax: ${result.tax}
                        Bill: ${result.total_amount}
                        
                        Thanks`;
    
                        // Construct WhatsApp URL
                        let action_url = "https://wa.me/91" + result.phone + "?text=" + encodeURIComponent(message);
                        window.open(action_url, '_blank');
                    } else {
                        alert(result.message);
                    }
                } catch (e) {
                    alert("Invalid JSON response: " + data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error: " + textStatus + " - " + errorThrown);
            }
        });
    }


    

   function edititeam(id) {
    var sale_id = id;
    $.ajax({
        type: 'GET',
        data: { sale_id: sale_id }, 
        success: function (data) {
            console.log("Success:", data); 
             window.location.href = '<?php echo site_url();?>pos/update_pos/' + id;
        },
        error: function (xhr, status, error) { 
            console.error("Error:", error); 
        }
    });
   }



   
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
          
          <a href="" onclick="Printbarcode()" class="btn btn-warning print_all_barcodes">Tag</a>
          
          <button type="button" onclick="sendnotification()" class="btn btn-success"><i style="font-size:17px;" class="fab fa-whatsapp"></i></button>
          
        </div>
      </div>
   </div>
  </div>
  


  <!-- /.Modal -->
  
  
  
    <!-- Modal Image -->
  <div class="modal fade" id="imagesection" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
   <div class="modal-dialog" role="document" id="ticketModal">
      <div class="modal-content">
       
        <div class="modal-header">
       <h5 class="modal-title" id="ticket">Image View </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
        <div class="modal-body" id="modal-body">
           <div id="printimage">
              <!-- Ticket goes here -->
              <center><h1 style="color:#34495E"><?=display('empty')?></h1></center>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-danger hiddenpr" data-dismiss="modal"><?=display('close')?></button>
        </div>
      </div>
   </div>
  </div>
  <!-- /.Modal -->
  
  
  
  
  
  
  