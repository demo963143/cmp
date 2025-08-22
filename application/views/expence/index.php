<style>
.table.dataTable td:nth-child(1) {
    display: inline-block;
    width: 68px;
    height: 44px;
}
</style>


<div class="container-fluid">
<!-- Modal delet -->
<?php $this->load->view('tpl/delete_modal');?>
<!-- // -->
<div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalRight" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><?=display('add_an_expense')?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="needs-validation" id="upload_form_save" enctype="multipart/form-data">
                                        <div class="modal-body">
                                                <div id="savebtm_result" class="form-group text-success"></div>
                                                <input type="hidden" name="idctg"  id="idctg" value="">
                                            
                                                <div class="form-group position-relative error-l-50">
                                                    <label><?=display('num')?> </label>
                                                    <?PHP
                                                    $invID = str_pad($lastid + 1, 3, '0', STR_PAD_LEFT);
                                                    $numclt = 'EXP'.$invID;
                                                    ?>
                                                    <input type="text" class="form-control" placeholder="" name="num" id="num" autocomplete="off" value="<?=$numclt?>" readonly="readonly">
                                                </div>
                                                <div class="form-group">
                                                    <label>  <?=display('date')?>  <span class="text-danger error_lastname">*</span></label>
                                                    <input type="text" class="form-control datepicker" placeholder="" name="date" id="date" autocomplete="off"  data-date-format="yyyy-mm-dd">
                                                </div>
                                                <div class="form-group">
                                                    <label>  <?=display('title')?>  <span class="text-danger error_lastname">*</span></label>
                                                    <input type="text" class="form-control" placeholder="" name="note" id="note" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label>  <?=display('price')?>  <span class="text-danger error_lastname">*</span></label>
                                                    <input type="text" class="form-control" placeholder="" name="amount" id="amount" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label>  <?=display('category')?>  <span class="text-danger error_lastname">*</span></label>
                                                     <select class="form-control" name="category_id" id="category_id">
                                                         <?PHP 
                                                         foreach($categories as $category)
                                                         {
                                                         ?>
                                                         <option value="<?=$category->id;?>"><?=$category->name;?></option>
                                                         <?PHP
                                                         }
                                                         ?>
                                                     </select>
                                                </div>
                                                <div class="form-group">
                                                <label>  <?=display('file')?> : </label>
                                                      <input type="file" class="form-control" id="attachment" name="attachment">
                           
                                                </div>

                                                
                                          <div class="error_validateclt text-danger"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal"><?=display('close')?></button>
                                            <button type="submit" id="savebtn" class="btn btn-primary"><?=display('save')?></button>

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
                                            <h5 class="modal-title">  <?=display('update')?> </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="needs-validation" id="upload_form_update" enctype="multipart/form-data">

                                        <div class="modal-body">
                                            <div class="fetcheupdate">

                                            </div>
                                                <div id="savebtm_result" class="form-group"></div>
                                                
                                                
                                                <div class="error_validateup text-danger"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal"> <?=display('close')?> </button>
                                            <button type="submit" id="savebtn"  class="btn btn-primary"><?=display('save')?></button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
    
            <div class="row">
                <div class="col-12">
                    <h1><?=display('list_of_expenses')?></h1>
                    <nav class="breadcrumb-container d-lg-inline-block mb-sm-0 mb-2" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight"> <i class="fa fa-plus"></i> Expenses</button>
                            </li>
                            <li class="breadcrumb-item">
                            <a href="<?=base_url('categorie_expences')?>"><button type="button" class="btn btn-primary" ><?=display('Categories')?> <?=display('expenses')?></button></a>

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
                                    <th><?=display('date')?></th>
                                    <th><?=display('num')?></th>
                                    <th><?=display('title')?></th>
                                    <th><?=display('category')?></th>
                                    <th><?=display('price')?> <?=settings()->currency;?></th>
                                    <th><?=display('file')?></th>
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
            "searchPlaceholder": " <?=display('search').' : '.display('num')?> ",
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('expences/ajax_expence/')?>",
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

      $('#upload_form_save').on('submit', function(e){  
        var note = $('#note').val();
        var amount = $('#amount').val();
           e.preventDefault();  
           if(note != '' &&  amount != '')
             {
                $.ajax({  
                     url:"<?php echo base_url('expences/add')?>",   
                     method:"POST",
                     dataType : "JSON",
                     data:new FormData(this),  
                     contentType: false,  
                     cache: false,  
                     processData:false, 
                     success:function(data)  
                     {   
                        $('#savebtm_result').html(data.msg);
                        $('#amount').val('');
                        $('#date').val('');
                        $('#note').val('');
                        $('#num').val(data.lastid);
                        table.ajax.reload();
                        $('.error_validateclt').html('');
                        $('.sound2').get(0).play();
                        
                     }  
                });  
             }
             else
             {
                $('.error_validateclt').html(' * <?=display('this_fieldis_required')?>');
             }
            
      }); 
      $('#upload_form_update').on('submit', function(e){  
        var note = $('#noteup').val();
        var amount = $('#amountup').val();
           e.preventDefault();  
           if(note != '' &&  amount != '')
             {
                $.ajax({  
                     url:"<?php echo base_url('expences/update_ajax')?>",   
                     method:"POST",
                     dataType : "JSON",
                     data:new FormData(this),  
                     contentType: false,  
                     cache: false,  
                     processData:false, 
                     success:function(data)  
                     {   
                        $('#updatebtm_result').html(data.msg);
                        table.ajax.reload();
                        $('.error_validateup').html('');
                        $('.sound2').get(0).play();
                        
                     }  
                });  
             }
             else
             {
                $('.error_validateup').html(' * <?=display('this_fieldis_required')?>');
             }
            
      });
      //Confirm  
      $('#confirm-delete').on('show.bs.modal', function (e) {
        var category_id = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'POST',
            url : '<?php echo site_url();?>/expences/delete/', 
            data :  'expence_id='+ category_id,
            success : function(data){
            $('.fetchedeletebtm').html(data);
            $('#deletbtm_result').html('');
           
            }
        });
     });
     $('#updateclt').on('show.bs.modal', function (e) {
        var expence_id = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'POST',
            url : '<?php echo site_url();?>/expences/update/',
            data :  'expence_id='+ expence_id,
            success : function(data){
            $('.fetcheupdate').html(data);
            }
        });
     });

    });
    var items = [];
   // delete 
   function deletebtm(idClt){
    $.ajax({
            url : "<?php echo base_url('expences/delete/')?>"+idClt,
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
                //$('.sounderr').get(0).play();
               }  
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
               alert("error");
            }
        });
   }

  </script>