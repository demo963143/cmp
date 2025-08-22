<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>-->

    <!---------------JQUERY---------------- -->
   <!--<script src="<?=base_url();?>assets/js/jquery-3.6.3.js"></script>-->
<!--   <script-->
<!-- src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"-->
<!-- integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c="-->
<!-- crossorigin="anonymous"></script>-->
  <!-----------------------JQUERY----------------- -->
<!--</head>-->


<style>
    .navbar.fixed-top{
        padding-left:0;
        padding-right:0;
    }
    
    .navbar.fixed-top .btn{
        border-radius:50px;
        font-size:.75rem;
        margin-left: 8px !important;
        padding: 7px 10px;
    }
    
    
    
</style>



<body>
 
  <!-- Modal ticket -->
    <div class="modal fade" id="ticket1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document" id="ticketModal1">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="ticket1"> Order Status Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>

                </div>
                <div class="modal-body" id="modal-body">
                    <div id="printSection1">
                        <!-- Ticket goes here -->
                        <center>
                            <h1 style="color:#34495E"><?=display('empty')?></h1>
                        </center>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger hiddenpr"
                        data-dismiss="modal"><?=display('close')?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- /.Modal -->
    
    
      <!--Model box barcode-->
    
   <div class="modal fade" id="ticket2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false"
       data-backdrop="static">
       <div class="modal-dialog modal-lg" role="document" id="ticketModal1">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="ticket2">BarCode Scanner</h5>
                    <br>
                    
                   <button type="button" class="close closetikat2" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
                 <div><h5 class="modal-title" style="margin-left:10px;">Total Qty<span id="qqqww" class="qqqww"><span></h5></div>
               <div class="modal-body" id="modal-body">
                   <div id="print">
                       <!-- Ticket goes here -->
                       <center>

                           <input class="product-scan-id form-control" name="product-scan-id" hidden>
                           <input class="status_id form-control" name="status_id" hidden>
                           
                           <input class="totaqut form-control" name="totaqut" hidden>
                           
                            <input class="qtydatas enterqty form-control" type="number" name="qty" placeholder="Enter Quantity" style='width:60%;' disabled>
                           
                           <div class="row mt-3">
                               <div class="form-group col-4">
                                   <a href="javascript:void(0)" onclick="order_list(0)">
                                       <button type="button" 
                                           class="btn btn-light  btn-lg mb-1 w-100 text-center default orderbutton"
                                           style="border-top:4px solid #138496;" id="" fdprocessedid="3jrc5">
                                           Order Placed</button>
                                    </a>
                               </div>

                               <div class="form-group col-4">
                                   <a href="javascript:void(0)" onclick="order_list(1)">
                                       <button type="button" data-id="1"
                                           class="btn btn-light  btn-lg mb-1 w-100 text-center default orderbutton"
                                           style="border-top:4px solid #138496;" id="" fdprocessedid="3jrc5">
                                           Picked up by Delivery Van</button>
                                    </a>
                               </div>
                              
                              <div class="form-group col-4">
                                   <a href="javascript:void(0)"  onclick="order_list(2)"><button type="button" data-id="2"
                                           class="btn btn-light  btn-lg mb-1 w-100 text-center default orderbutton"
                                           style="border-top:4px solid #138496;" id="" fdprocessedid="3jrc5">
                                           Delivered at Plant</button></a>
                               </div>
                            
                             <div class="form-group col-4">
                                   <a href="javascript:void(0)" onclick="order_list(3)"><button type="button" data-id="3"
                                           class="btn btn-light  btn-lg mb-1 w-100 text-center default orderbutton"
                                           style="border-top:4px solid #138496;" id="" fdprocessedid="3jrc5">
                                           Recieved at Plant</button></a>
                               </div>
                               
                                <div class="form-group col-4">
                                   <a href="javascript:void(0)" onclick="order_list(4)"><button type="button" data-id="4"
                                           class="btn btn-light  btn-lg mb-1 w-100 text-center default orderbutton"
                                           style="border-top:4px solid #138496;" id="" fdprocessedid="3jrc5">
                                           Sorting and Processing</button></a>
                               </div>
                               
                                <div class="form-group col-4">
                                   <a href="javascript:void(0)" onclick="order_list(5)"><button type="button" data-id="5"
                                           class="btn btn-light  btn-lg mb-1 w-100 text-center default orderbutton"
                                           style="border-top:4px solid #138496;" id="" fdprocessedid="3jrc5">
                                           Packing and Sticker Print</button></a>
                               </div>
                               
                                <div class="form-group col-4">
                                   <a href="javascript:void(0)" onclick="order_list(6)"><button type="button" data-id="6"
                                           class="btn btn-light  btn-lg mb-1 w-100 text-center default orderbutton"
                                           style="border-top:4px solid #138496;" id="" fdprocessedid="3jrc5">
                                           Ready to Dispatch</button></a>
                               </div>
                               
                               <div class="form-group col-4">
                                   <a href="javascript:void(0)" onclick="order_list(10)"><button type="button" data-id="10"
                                           class="btn btn-light  btn-lg mb-1 w-100 text-center default orderbutton"
                                           style="border-top:4px solid #138496;" id="" fdprocessedid="3jrc5">
                                          Pick-up by Delivery Van</button></a>
                               </div>
                               
                                <div class="form-group col-4">
                                   <a href="javascript:void(0)" onclick="order_list(7)"><button type="button" data-id="7"
                                           class="btn btn-light  btn-lg mb-1 w-100 text-center default orderbutton"
                                           style="border-top:4px solid #138496;" id="" fdprocessedid="3jrc5">
                                          Delivered at Franchise</button></a>
                               </div>
                               
                                 <div class="form-group col-4">
                                   <a href="javascript:void(0)" onclick="order_list(8)"><button type="button" data-id="8"
                                           class="btn btn-light  btn-lg mb-1 w-100 text-center default orderbutton"
                                           style="border-top:4px solid #138496;" id="" fdprocessedid="3jrc5">
                                          Franchise Received</button></a>
                               </div>
                               
                                <div class="form-group col-4">
                                   <a href="javascript:void(0)" onclick="order_list(9)"><button type="button" data-id="9"
                                           class="btn btn-light  btn-lg mb-1 w-100 text-center default orderbutton"
                                           style="border-top:4px solid #138496;" id="" fdprocessedid="3jrc5">
                                          Delivered to Customer</button></a>
                               </div>
                             
                           </div>
                       </center>
                   </div>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-primary savebutton" data-dismiss="modal" onclick="order_status_change()">Save</button>
                   <button type="button" class="btn btn-secondary closetikat2" data-dismiss="modal">Close</button>
               </div>
           </div>
       </div>
   </div>
   <!--Model box barcode-->
   
   
   <!-- start Print Sticker model start-->
   
    <div class="modal fade" id="ticket4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md" role="document" id="ticketModal4">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticket4">Print stricker</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <div id="">
                        <center>
                            <input type="text" class="form-control barcodeor_order_id" placeholder="Enter order no or barcode">
                        </center>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="print_sticker()">print</button>
                    <button type="button" class="btn btn-sm btn-danger hiddenpr"
                        data-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>
 
   <!-- end Print Sticker model start-->
 
 
    <div class="container-fluid mt-4 text-center shadow" style="border-radius: 4px;padding-left: none !important;padding-right: none !important;">
        <div class="form-group mb-3 col-12 pt-2">
            
            <div class="form-group form-inline">                            
        <label for="exampleInputEmail1"><strong>User : &nbsp;</strong></label>
<select class="form-control user_filter mb-1">
                                            <option value="">Select User</option>
                                            <?php
                                            for($m=0;$m<count($result);$m++)
                                            {
                                                ?>
                                                <option value="<?= $result[$m]->id ?>"><?= $result[$m]->name ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                            <input class="form-control scan-bardode mng mb-1" style="width:50%; margin-left:10px;" placeholder="Please Scan The Barcode">

                                         <!--<button class="btn btn-primary ml-2 print-sticker">Print Sticker</button>-->
                                        
                                        </div>

                               </div>
                               
        <div class="row orderstatus">
         
<script type="text/javascript">

    $(document).on('change', '.user_filter', function() {
        var data_val = $(this).val();
        $('.orderstatus').html('');
        if(data_val != "")
        {
        $.ajax({
          url : "<?php echo site_url('orderstatus')?>",
          type: "GET",
          data: {"data_val":data_val},
          success: function(data)
          {
           $('.orderstatus').html(data);

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert("error");
          }
        });
        }
        else
        {
            refreshpage();
        }
    });
    
    
    $(document).on('click', '.print-sticker', function() {
        $('#ticket4').modal('show');
    });
    
    function print_sticker()
    {
      var id = $('.barcodeor_order_id').val(); 
        $.ajax({
          url : "<?php echo site_url('orderstatus/print_sticker')?>",
          type: "POST",
          data: 
          {
          "id":id,
          },
          success: function (response) { 
              console.log(response);
              var data = JSON.parse(response);
                if (data.status === 1) {
                    var newTab = window.open();
                    newTab.location.href = "https://laundroklean.meshink.xyz/software/pos/print_all_barcodes/" + data.order_id.sale_id;
                    newTab.target = "_blank"; 
                } else {
                    alert(data.message);
                }
            // alert(data.order_id.sale_id);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert("error");
          }
        });
    }
    
    $(document).ready(function(){
        refreshpage();
    });
    
    function order_list(id)
    {
        $('.status_id').val(id);
    }
    
    function order_status_change()
    {
       var scannerId = $('.product-scan-id').val(); 
       var statusId = $('.status_id').val();
       var qty = $('.qtydatas').val();
        $.ajax({
          url : "<?php echo site_url('orderstatus/update_status')?>",
          type: "POST",
          data: 
          {
          "scannerId":scannerId,
          "statusId":statusId,
          "qty":qty
          },
          success: function (response) { 
              console.log(response);
              var data = JSON.parse(response);
              $('.closetikat2').click();
              alert(data.message); 
              window.location.reload();
        },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert("error");
          }
        });
    }
    
    
     $('.scan-bardode').on("keypress", function (e) {
        if (e.keyCode == 13) {
            const scannerId = $(this).val();
            $.ajax({
                url: "<?php echo site_url('orderstatus/checkbarcode'); ?>",
                type: "POST",
                data: { scannerId: scannerId }, 
                dataType: 'json',
                success: function (data) {
                    if (data && data.barcode) { 
                        $('.product-scan-id').val(data.barcode);
                        $('#ticket2').modal('show');
                        $('.qqqww').html(data.qt);
                        $('.totaqut').val(data.qt);
                        $('.enterqty').val(data.qt);
                        
                           if (data.qt===0) {
                            $('.savebutton').hide();
                           }
    
                        console.log("Barcode data:", data); 
                         setTimeout(function() {
                             $('.closetikat2').click(); 
                         }, 50000);   
                    } else {
                        alert("Invalid Barcode");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown); 
                    alert("An error occurred. Please try again.");
                }
            });
            $(this).val(''); 
        }
   });
    
    
    //  function showTicket1(id) {
    //     $.ajax({
    //         url: "<?php echo site_url('sales/ShowTicket')?>/" + id,
    //         type: "POST",
    //         success: function(data) {
    //             $('#printSection1').html(data);
    //             $('#ticket1').modal('show');
    //         },
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             alert("error");
    //         }
    //     });
    // }
    
    
    function showTicket1(id,barcode,qt) {
        $.ajax({
            url: "<?php echo site_url('Orderstatus/ShowTicket')?>/" + id,
            type: "POST",
             data: 
              {
              "barcode":barcode,
              "qt":qt
              },
            success: function(data) {
                $('#printSection1').html(data);
                $('#ticket1').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });
    }
    
    
    
    
    
    

    

  function refreshpage(){
    $('.orderstatus').html('');
    $.ajax({
          url : "<?php echo site_url('orderstatus')?>",
          type: "GET",
          success: function(data)
          {
           $('.orderstatus').html(data);

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert("error");
          }
      });
  }

</script>

        </div>
        

      </div>
    
</body>