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
body {
    background: #f8f8f8;
}
.sales {
    background: #fff;
}


    .navbar {
     
        padding: 12px 0;
    }
    
     .navbar .btn{
         border-radius:50px;
     }

    .navbar .navbar-left .btn{
        padding:5px 8px!important;
    }


@media (max-width: 1439px) {
    #app-container.menu-hidden main, #app-container.menu-sub-hidden main, #app-container.sub-hidden main {
        margin-left: 145px;
    }
}
@media (max-width: 767px) {
    #app-container.menu-hidden main, #app-container.menu-sub-hidden main, #app-container.sub-hidden main {
        margin-left: 15px;
    }
}
</style>
<body>

    <div class="container-fluid mt-4 text-center shadow" style="border-radius: 4px;">
        <div class="row sales">
            <div class="col-sm-12 pt-2">
              <div class="row">
                <div class="col-md-2">
                    <label style="text-align:left;" for="email">Select Date : </label>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <input type="date" class="form-control datesearch" onchange="getPosList(this.value)"/>
                    </div>
                </div>
              </div>
            </div>  
            
            
            
          <div class="col-sm border mx-2 mb-2" style="border-radius: 0px 0px 0px 0px; cursor: pointer;">
           <H5 style="color: #17365d; margin-top: 0.55rem;text-align:left;"><b>Pickup</b></H5>
           
            <div class="column flex pickups">
                
            
            </div>
          </div>
          
          <div class="col-sm border mx-2 mb-2">
           <H5 style="color: #17365d; margin-top: 0.55rem; text-align:left;"><b>Delivery</b></H5>
            <div class="column flex delivery">
             
            </div>
          </div>



          
<script type="text/javascript">
function getPosList(val){
      if(val !== ''){
        $('.pickups').html('');
        $('.delivery').html('');
        let formData =  new FormData()
        formData.append('date',val)
          $.ajax({
            url : "<?php echo site_url('pos/pos_list')?>",
            type: "POST",
            data:formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(data)
            {
              var result = JSON.parse(data);
              console.log(result);
              if(result.status == 1){
                  
                    if(result.pickup.length > 0){
                    var pickup = result.pickup;
                    var html = "";
                    var exportpicup = '<button style="float:right; margin-top:-50px" class="btn btn-sm btn-primary mb-3 exportdata">Export Pickups List</button>';
                    $(pickup).each(function(index, value){
                      html += '<a href="javascript:void(0)" class="showTicket" data-id="'+value.id+'"><div class="col-sm-12 mt-4 mb-4 portlet">';
                      html += '<div class="card portlet header" style="border:1px solid #0089ff;">';
                      html += '<div class="card-body"><div class="row"><div class="col">';
                      html += '<h6 style="float: left;">Name : '+value.clientname+'</h6>';
                      html += '</div><div class="col"><h6 style="float: right;">Ord No. : '+value.invoice_id+' </h6>';
                      html += '</div></div><p class="card-text" style="float:left;">Pickup Date: '+value.pickup_date+'</p>';
                      html += '<div class="row">';
                      html += '<div class="col"><p style="display: flex; float:right;">Quantity: '+value.qt+'</p></div></div></div></div></div></a>';
                    });
                    
                  }
                  $('.pickups').append(exportpicup);
                  $('.pickups').append(html);
                  
                  if(result.delivery.length > 0){
                    var delivery = result.delivery;
                    var htmls = ""; 
                    var exportdelivery = '<button style="float:right; margin-top:-50px" class="btn btn-sm btn-primary mb-3 exportdatadiv">Export Delivery List</button>';
                    $(delivery).each(function(index, value){
                      htmls += '<a href="javascript:void(0)" class="showTicket" data-id="'+value.id+'"><div class="col-sm-12 mt-4 mb-4 portlet">';
                      htmls += '<div class="card portlet header" style="border:1px solid #0089ff;">';
                      htmls += '<div class="card-body"><div class="row"><div class="col">';
                      htmls += '<h6 style="float: left;">Name : '+value.clientname+'</h6>';
                      htmls += '</div><div class="col"><h6 style="float: right;">Ord No. : '+value.invoice_id+' </h6>';
                      htmls += '</div></div><p class="card-text" style="float:left;">Delivery Date: '+value.delivery_date+'</p>';
                      htmls += '<div class="row">';
                      htmls += '<div class="col"><p style="display: flex; float:right;">Quantity: '+value.qt+'</p></div></div></div></div></div></a>';
                    });
                  }
                  $('.delivery').append(exportdelivery);
                  $('.delivery').append(htmls);
              }else{
                alert('There was error while grtting record');
              }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
              alert("error");
            }
        });
      }
    }

    $('.sales').on('click','.showTicket',function(){
        var id = $(this).attr('data-id');
        console.log(id,'ssds');
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
    });
      

   function PrintTicket() {
       $('.modal-body').removeAttr('id');
       window.print();
       $('.modal-body').attr('id', 'modal-body');
    }
    
    
    $(document).on('click', '.exportdata', function (e) {
      var date = $('.datesearch').val();
      if(date) {
            var baseUrl = "<?php echo site_url('pos/pos_pickupExport'); ?>";
            window.location.href = baseUrl + '?date=' + encodeURIComponent(date);
        } else {
          alert('select date');
        }
    });
    
     
    $(document).on('click', '.exportdatadiv', function (e) {
      var date = $('.datesearch').val();
      if(date) {
            var baseUrl = "<?php echo site_url('pos/pos_deliveryExport'); ?>";
            window.location.href = baseUrl + '?date=' + encodeURIComponent(date);
        } else {
          alert('select date');
        }
    });
    
    

</script>

<!--    <script>-->
<!--    $(function() {-->
<!--   $( ".column" ).sortable({-->
<!--     connectWith: ".column",-->
<!--     handle: ".portlet-header",-->
<!--     cancel: ".portlet-toggle",-->
<!--     placeholder: "portlet-placeholder ui-corner-all"-->
<!--   });-->

<!--   $( ".portlet" )-->
<!--     .addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )-->
<!--     .find( ".portlet-header" )-->
<!--       .addClass( "ui-widget-header ui-corner-all" )-->
      

<!--   $( ".portlet-toggle" ).click(function() {-->
<!--     var icon = $( this );-->
<!--     icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );-->
<!--     icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();-->
<!--   });-->
<!-- });-->
 
      
<!--</script>-->
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
        </div>
      </div>
   </div>
  </div>

        </div>
        

      </div>
    
</body>


