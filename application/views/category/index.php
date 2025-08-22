
<div class="container-fluid">
<!-- Modal delet -->
<?php $this->load->view('tpl/delete_modal');?>


<div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalRight" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><?=display('add_a_new_category')?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="needs-validation">
                                        <div class="modal-body">
                                                <div id="savebtm_result" class="form-group text-success"></div>
                                                <input type="hidden" name="idctg"  id="idctg" value="">
                                            
                                                <div class="form-group position-relative error-l-50">
                                                    <label> <?=display('num')?></label>
                                                    <?PHP
                                                    $invID = str_pad($lastid + 1, 3, '0', STR_PAD_LEFT);
                                                    $numclt = 'CG'.$invID;
                                                    ?>
                                                    <input type="text" class="form-control" placeholder="" name="num" id="num" autocomplete="off" value="<?=$numclt?>" readonly="readonly">
                                                </div>
                                                <div class="form-group">
                                                    <label> <?=display('name')?> <span class="text-danger error_lastname">*</span></label>
                                                    <input type="text" class="form-control" placeholder="" name="namecategory" id="namecategory" autocomplete="off">
                                                </div>
                                                
                                          <div class="error_validateclt text-danger"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal"><?=display('close')?></button>
                                            <button type="button" id="savebtn"  onclick="savebtm()" class="btn btn-primary"><?=display('save')?></button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
     </div>
     <div class="modal fade modal-right" id="updateclt" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalRight" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"> <?=display('update')?> </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="needs-validation">
                                        <div class="modal-body">
                                            <div class="fetcheupdate">

                                            </div>
                                                <div id="savebtm_result" class="form-group"></div>
                                                
                                                
                                          
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal"><?=display('close')?></button>
                                            <button type="button" id="savebtn"  onclick="updatebtm()" class="btn btn-primary"><?=display('save')?></button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
    
            <div class="row">
                <div class="col-12">
                    <h1> <?=display('categories')?> </h1>
                    <nav class="breadcrumb-container d-lg-inline-block mb-sm-0 mb-2" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight"><i class="fa fa-plus"></i> Category</button>
                            </li>
                            <li class="breadcrumb-item">
                            <a href="<?=base_url('products')?>"><button type="button" class="btn btn-primary" > <?=display('products_list');?>  </button></a>
                            <a href="<?=base_url('services')?>"><button type="button" class="btn btn-primary" > <?=display('additional_services');?>  </button></a>

                        </li>
                           
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
                <th><?=display('num')?></th>
                <th><?=display('name')?></th>
                <th><?=display('action')?></th>
                
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
            "searchPlaceholder": "<?=display('search')?>",
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('categories/ajax_category/')?>",
            "type": "POST",
            "data":function(data) {
              //data.num_moniteur = $('#num_moniteur').val();
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
        var category_id = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'POST',
            url : '<?php echo site_url();?>/categories/delete/', 
            data :  'category_id='+ category_id,
            success : function(data){
            $('.fetchedeletebtm').html(data);
            $('#deletbtm_result').html('');
           
            }
        });
     });
     $('#updateclt').on('show.bs.modal', function (e) {
        var category_id = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'POST',
            url : '<?php echo site_url();?>/categories/update/',
            data :  'category_id='+ category_id,
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
            url : "<?php echo base_url('categories/delete/')?>"+idClt,
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
                //$('.sounderr').get(0).play();
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
   var namecategory = $('#namecategory').val();
     if(namecategory != '')
     {
        $.ajax({
            url : "<?php echo base_url('categories/add')?>",
            type: "POST",
            dataType : "JSON",
            data: {namecategory: namecategory,num:num},
            success: function(data)
            {
               $('#savebtm_result').html(data.msg);
               if(data.add == 'add')
               {
                 $('#namecategory').val('');
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
               alert("error");
            }
        });
       }
       else
       {
          $('.error_validateclt').html(' * <?=display('this_fieldis_required')?>');
       }
}
 // update
 function updatebtm() {
   var id = $('#idcategup').val();
   var num = $('#numup').val();
   var namecategoryup = $('#namecategoryup').val();
     if(namecategoryup != '')
     {
        $.ajax({
            url : "<?php echo base_url('categories/update_ajax')?>",
            type: "POST",
            dataType : "JSON",
            data: {id: id,num: num,namecategoryup: namecategoryup,},
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
          $('.error_validateup').html(' * <?=display('this_fieldis_required')?>');
       }
}
  </script>