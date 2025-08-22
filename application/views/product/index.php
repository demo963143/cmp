<style>
.svgicon
{
    width:45px;
}
.btn-danger {
    margin-bottom: 5px;
}

label{
    margin-bottom:5px;
}



</style>
<div class="container-fluid">
<!-- Modal HTML -->
<div id="confirm-delete" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body" id="">
                <p><?=display('msg_delet')?></p>
                <div id="deletbtm_result"></div>
			</div>
			<div class="modal-footer justify-content-center fetchedeletebtm">
			</div>
		</div>
	</div>
</div>


<div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalRight" aria-hidden="true">
                                <div class="modal-dialog" role="document" style="max-width: 600px;">
                                    <div class="modal-content">
                                        <div class="modal-header p-3" style="flex:0 0 3px">
                                            <h5 class="modal-title"><?=display('add_product')?> </h5>
                                            <div id="savebtm_result" class="form-group text-success w-50"></div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="needs-validation">
                                        <div class="modal-body">
                                                <div class="row">
                                                <div class="form-group position-relative error-l-50 col-md-2 col-12">
                                                    <label><?=display('num')?> </label>
                                                    <?PHP
                                                    $invID = str_pad($lastid + 1, 3, '0', STR_PAD_LEFT);
                                                    $numclt = 'PR'.$invID;
                                                    ?>
                                                    <input type="text" class="form-control" placeholder="" name="num" id="num" autocomplete="off" value="<?=$numclt?>" readonly="readonly">
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>  <?=display('name')?> <span class="text-danger ">*</span></label>
                                                    <input type="text" class="form-control reqred" placeholder="" name="nameprod" id="nameprod" autocomplete="off">
                                                </div>
                                                <div class="form-group col-md-4 col-12">
                                                    <label>   <?=display('categories');?>  <span class="text-danger ">*</span></label>
                                                    <select name="categoryid" class="form-control reqred" id="categoryid">
                                                        <?PHP
                                                        foreach ($categories as $category) {
                                                           ?>
                                                             <option value="<?=$category->id;?>"><?=$category->name;?></option>
                                                           <?PHP
                                                        }
                                                        ?>
                                                       
                                                    </select>
                                                </div>
                                                </div>
                                        
                                                
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <label> Ironing Normal (<?=settings()->currency?>) <span class="text-danger ">*</span></label>
                                                        <input type="text" class="form-control reqred" placeholder="" name="lroningnormal" id="lroningnormal" autocomplete="off">
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <label> Ironing Express <span class="text-danger ">*</span></label>
                                                        <input type="text" class="form-control reqred" placeholder="" name="lroningfast" id="lroningfast" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>  <?=display('laundry');?> <?=display('normal');?> (<?=settings()->currency?>) <span class="text-danger ">*</span></label>
                                                        <input type="text" class="form-control reqred" placeholder="" name="laundrynormal" id="laundrynormal" autocomplete="off">
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <label> Laundry Express (<?=settings()->currency?>) <span class="text-danger ">*</span></label>
                                                        <input type="text" class="form-control reqred" placeholder="" name="laundryfast" id="laundryfast" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>  <?=display('laundrylroning')?> <?=display('normal');?> (<?=settings()->currency?>) <span class="text-danger ">*</span></label>
                                                        <input type="text" class="form-control reqred" placeholder="" name="laundrylroningnormal" id="laundrylroningnormal" autocomplete="off">
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <label> Laundry Ironing Express (<?=settings()->currency?>) <span class="text-danger ">*</span></label>
                                                        <input type="text" class="form-control reqred" placeholder="" name="laundrylroningfast" id="laundrylroningfast" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <label> <?=display('dry_wash')?> <?=display('normal');?> (<?=settings()->currency?>) <span class="text-danger ">*</span></label>
                                                        <input type="text" class="form-control reqred" placeholder="" name="drynormal" id="drynormal" autocomplete="off">
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <label> Dry Wash Express (<?=settings()->currency?>) <span class="text-danger ">*</span></label>
                                                        <input type="text" class="form-control reqred" placeholder="" name="dryfast" id="dryfast" autocomplete="off">
                                                    </div>
                                                    <div class="form-group col-12">
                                                        
                                                 <!--<button type="button" class="btn btn-sm btn-outline-primary ml-3 d-none d-md-inline-block" data-toggle="modal" data-backdrop="static" data-target="#iconshow"> <?=display('add_an_icon');?>  <i class="glyph-icon simple-icon-plus"></i> </button>-->
                                                <span id="icon_select" style="font-size: 40px;"></span>
                                                <input type="hidden" id="icons">
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="row">
                                                <?PHP 
                                                foreach($services as $service)
                                                {
                                                    ?>
                                                    <div class="form-group col-md-4 col-12">
                                                        <label> <?=$service->name;?> (<?=settings()->currency?>) <span class="text-danger ">*</span></label>
                                                        <input type="text" class="form-control item_name" placeholder="" name="item_name" id="" autocomplete="off" value="0">
                                                        <input type="hidden" class="servid" placeholder="" name="servid" id="" autocomplete="off" value="<?=$service->id;?>">
                                                    </div>
                                                    <?PHP
                                                }
                                                ?>
                                                 </div>
                                              
                                        
                                                
                                          <div class="error_validateclt text-danger"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal"><?=display('close');?></button>
                                            <button type="button" id="savebtn"  onclick="savebtm()" class="btn btn-primary"><?=display('save');?></button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                              </div>
                              <div class="modal fade modal-right" id="updateclt" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalRight" aria-hidden="true">
                                <div class="modal-dialog" role="document" style="max-width: 600px;">
                                    <div class="modal-content">
                                        <div class="modal-header p-3" style="flex:0 0 3px">
                                            <h5 class="modal-title">  <?=display('update');?> Data Development</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <span id="updatebtm_result" class="form-group text-success"></span>

                                        </div>
                                        <form class="needs-validation">
                                        <div class="modal-body">
                                            <div class="fetcheupdate">

                                            </div>
                                                <div id="savebtm_result" class="form-group"></div>
                                                
                                                
                                          
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal"><?=display('close');?></button>
                                            <button type="button" id="savebtn"  onclick="updatebtm()" class="btn btn-primary"><?=display('save');?></button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="iconshow" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalRight" aria-hidden="true">
                                <div class="modal-dialog" role="document" style="max-width: 600px;">
                                    <div class="modal-content" style="border: solid 1px #ed7117;">
                                        
                                        <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <br> 
                                            <hr>
                                            <div class="simple-line-icons">
                                             <?PHP 
                                             foreach($icons as $icon)
                                             {
                                                 ?>
                                                    <a href="#" onclick="add_icon('<?=$icon->link;?>','<?=$icon->type;?>')"><div class="glyph border border-success mr-1 mb-1">
                                                        <?PHP
                                                        if($icon->type == 'iconsminds')
                                                        {
                                                        ?>
                                                         <i class="<?=$icon->link;?>" style="font-size: 60px;"></i>
                                                        <?PHP 
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                          <img style="width: 65px;" class="mt-3" src="<?=base_url('files/svg/').$icon->link;?>">
                                                        <?PHP
                                                        }
                                                        ?>
                                                    </div></a>
                                                 <?php
                                             }
                                             ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>              
    
            <div class="row">
                <div class="col-12 d-md-flex">
                    <h1><?=display('products_list');?></h1>
                    <nav class="breadcrumb-container mb-sm-0 mb-2" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <?php if(permission_link()):?>
                            <li class="breadcrumb-item">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight"><i class="fa fa-plus"></i> Product</button>
                            </li>
                            
                            <li class="breadcrumb-item">
                             <a href="<?=base_url('categories')?>"><button type="button" class="btn btn-primary"><?=display('categories');?> </button></a>
                            </li>
                            <li class="breadcrumb-item">
                            <a href="<?=base_url('services')?>"><button type="button" class="btn btn-primary"><?=display('additional_services');?>  </button></a>
                            </li>
                            <?php endif;?>

                           
                        </ol>
                    </nav>
                    
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            
                            <table id="table" class="table">
                                <thead>
                                <tr>
                                    <th> <?=display('num');?></th>
                                    <th>  <?=display('product_name');?></th>
                                    <th> Ironing Normal</th>
                                    <th> Ironing Express</th>
                                    <th>  <?=display('laundry');?> <?=display('normal');?></th>
                                    <th> Laundry Express</th>
                                    <th> <?=display('laundrylroning')?> <?=display('normal');?></th>
                                    <th> Laundry Ironing Express</th>
                                    <th>Dry Normal</th>
                                    <th>Dry Express</th>
                                    <th><?=display('action');?></th>
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
            "url": "<?php echo ($this->language=='arabic') ? base_url('files/ar_datatable.json') : ''; ?>",
            "searchPlaceholder": " <?=display('search').' : '.display('num').' , '.display('name')?>",
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('products/ajax_product/')?>",
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
        var product_id = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'POST',
            url : '<?php echo site_url();?>/products/delete/', 
            data :  'product_id='+ product_id,
            success : function(data){
            $('.fetchedeletebtm').html(data);
            $('#deletbtm_result').html('');
           
            }
        });
     });
     $('#updateclt').on('show.bs.modal', function (e) {
        var product_id = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'POST',
            url : '<?php echo site_url();?>/products/update/',
            data :  'product_id='+ product_id,
            success : function(data){
            $('.fetcheupdate').html(data);
            }
        });
     });
     
    });
    var items = [];
   // delete customer
   function deletebtm(idClt){
    $.ajax({
            url : "<?php echo base_url('products/delete/')?>"+idClt,
            type: "POST",
            dataType : "JSON",
            data: {},
            success: function(data)
            {
               $('#deletbtm_result').html(data.msg);
              //$('#confirm-delete').modal(toggle);
               //$('.fetchedeletebtm').html('');
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
   // Add a customer
  function savebtm() {
   var num = $('#num').val();
   var icon = $('#icons').val();
   var nameprod = $('#nameprod').val();
   var categoryid = $('#categoryid').val();
   var lroningnormal = $('#lroningnormal').val();
   var lroningfast = $('#lroningfast').val();
   var laundrynormal = $('#laundrynormal').val();
   var laundryfast = $('#laundryfast').val();
   var laundrylroningnormal = $('#laundrylroningnormal').val();
   var laundrylroningfast = $('#laundrylroningfast').val();
   var drynormal = $('#drynormal').val();
   var dryfast = $('#dryfast').val();
   var item_name = [];
   $('.item_name').each(function(){
   item_name.push($(this).val());
   });
   var servid = [];
   $('.servid').each(function(){
    servid.push($(this).val());
   });
  
     if(nameprod != '' || lroningnormal != '' || lroningfast != '' || laundrynormal != '' || laundryfast != '' || laundrylroningnormal != '' || laundrylroningfast != '' || drynormal != '' || dryfast != '')
     {
        $.ajax({
            url : "<?php echo base_url('products/add')?>",
            type: "POST",
            dataType : "JSON",
            data: {nameprod: nameprod,num:num ,icon:icon, categoryid:categoryid ,lroningnormal:lroningnormal ,lroningfast:lroningfast ,laundrynormal:laundrynormal ,laundryfast:laundryfast ,laundrylroningnormal:laundrylroningnormal, laundrylroningfast:laundrylroningfast,drynormal:drynormal,dryfast,dryfast,item_name:item_name,servid:servid},
            success: function(data)
            {
               $('#savebtm_result').html(data.msg);
               window.location.reload();
               if(data.add == 'add')
               {
                 $('#nameprod').val('');
                 $('#categoryid').val('');
                 $('#lroningnormal').val('');
                 $('#lroningfast').val('');
                 $('#laundrynormal').val('');
                 $('#laundryfast').val('');
                 $('#laundrylroningnormal').val('');
                 $('#laundrylroningfast').val('');
                 $('#drynormal').val('');
                 $('#dryfast').val('');
                 $('.item_name').val('');
                 $('#icon_select').html('');
                 $('#num').val(data.lastid);
                 table.ajax.reload();
                 $('.sound2').get(0).play();
               }
               else
               {
                $('.sounderr').get(0).play();
               }  
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
               alert("errorsss");
            }
        });
       }
       else
       {
          $('.error_validateclt').html(' *  <?=display('this_fieldis_required')?>');
       }
}
 // update
 function updatebtm() {
   var id = $('#idprodup').val();
   var num = $('#numup').val();
   var icon = $('#iconsup').val();

   var nameprod = $('#nameprodup').val();
   var categoryid = $('#categoryidup').val();
   var lroningnormal = $('#lroningnormalup').val();
   var lroningfast = $('#lroningfastup').val();
   var laundrynormal = $('#laundrynormalup').val();
   var laundryfast = $('#laundryfastup').val();
   var laundrylroningnormal = $('#laundrylroningnormalup').val();
   var laundrylroningfast = $('#laundrylroningfastup').val();
   var drynormal = $('#drynormalup').val();
   var dryfast = $('#dryfastup').val();
   var item_name = [];
   $('.item_nameup').each(function(){
   item_name.push($(this).val());
   });
   var servid = [];
   $('.servidup').each(function(){
    servid.push($(this).val());
   });
     if(nameprod != '' || lroningnormal != '' || lroningfast != '' || laundrynormal != '' || laundryfast != '' || laundrylroningnormal != '' || laundrylroningfast != '')
     {
        $.ajax({
            url : "<?php echo base_url('products/update_ajax')?>",
            type: "POST",
            dataType : "JSON",
            data: {id: id,nameprod: nameprod,num:num ,icon:icon, categoryid:categoryid ,lroningnormal:lroningnormal ,lroningfast:lroningfast ,laundrynormal:laundrynormal ,laundryfast:laundryfast ,laundrylroningnormal:laundrylroningnormal, laundrylroningfast:laundrylroningfast ,dryfast:dryfast ,drynormal:drynormal,item_name:item_name,servid:servid},
            success: function(data)
            {
               $('#updatebtm_result').html(data.msg);
               if(data.update == 'update')
               {
                 table.ajax.reload();
                 $('.sound2').get(0).play();
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
       else
       {
          $('.error_validateup').html(' *  <?=display('this_fieldis_required')?>');
       }
}
//add icon
function add_icon(name,type){
    if(type == 'iconsminds')
    {
        var iconi = '<i class="'+name+'"></i>';
    }
    else
    {
        var iconi = '<img class="svgicon" src="<?=base_url('files/svg/')?>'+name+'">';
    }
    
    $('#icon_select').html(iconi);
    $('#icon_selectup').html(iconi);
    $('#icons').val(name);
    $('#iconsup').val(name);
   }

  </script>