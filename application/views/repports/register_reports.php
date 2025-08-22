<div class="container-fluid">
<div class="row">
                <div class="col-12">
                <?php $this->load->view('repports/nave');?>
                </div>
            </div>
<div class="row">
   

<div class="col-xl-2 col-lg-12 mb-4">
  <?=form_open('repports/registers');?>

  
                    <div class="card">
                    <div class="card-body text-center">
                                     <h6><span class="badge badge-primary"></span></h6>
                                    <i class="glyph-icon iconsminds-cash-register-2" style="font-size: 20px;"></i>
                                    <p class="card-text mb-0"> <?=display('point_sale_report')?></p>
                                    <input type="hidden" name="start_dt" value="<?=$this->session->userdata('start_date')?>">
                                    <input type="hidden" name="end_dt" value="<?=$this->session->userdata('end_date')?>">
                                    <p class="lead text-center"></p>
                                    <input type="hidden" value="" class="xdirection" id="xdirection" name="xdirection">
                                    <button type="submit" class="btn btn-sm btn-info" value="pdfgen" name="pdfgen"> <?=display('download')?> <i class="glyph-icon simple-icon-printer"></i></button>

                                </div>

                    </div>

                    <?=form_close();?>
                </div>
                <div class="col-xl-10 col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body p-2 ">
                        <?=form_open('repports/registers');?>
                          <div class="row">
                        <div class="form-group mb-3 col-6">
                                      <script type="text/javascript">
                                          $(function () {
                                              $('.input-sm').datepicker({
                                                  format: "yyyy-mm-dd"
                                              });
                                          });
                                      </script>
                                      <label><?=display('date')?>  </label>
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="input-sm form-control" name="start" placeholder="<?=display('from')?>" data-date-format="yyyy-mm-dd" autocomplete="off" value="<?=$this->session->userdata('start_date')?>" required>
                                            <span class="input-group-addon"></span>
                                            <input type="text" class="input-sm form-control" name="end" placeholder="<?=display('to')?>" data-date-format="yyyy-mm-dd" autocomplete="off" value="<?=$this->session->userdata('end_date')?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4  col-6 col-lg-2">
                                    <input type="hidden" value="" class="xdirectionadv" id="xdirection" name="xdirection">
              <button type="submit" name="advgen" value="advgen" class="btn btn-primary  mb-1"><?=display('search')?> <i class="glyph-icon simple-icon-printer"></i></button>
                                      </div>
                                      <div class="form-group mt-lg-4 btn btn-primary  col-6 col-lg-3 mx-3">
                                      <?=display('total_revenue')?> : <?=$totalRevenue?>
                                      </div>
                          </div>
                          <?=form_close();?>

                            <div class="tab-content" id="pills-tabContent">
                              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                              <table id="table" class="table">
                                <thead>
                                <tr>
                                <th><?=display('openingtime')?></th>
                                <th><?=display('closingtime')?></th>
                                <th><?=display('openedby')?></th>
                                <th><?=display('cash')?></th>
                                <th> <?=display('cheque')?></th>
                                <th></th>
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
<!-- Modal register -->
<div class="modal fade" id="RegisterDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         
         <div class="modal-header">
       <h5 class="modal-title" id="ticket"> <?=display('register')?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        
      </div>
         <div class="modal-body">
            <div id="RegisterDetails">
               <!-- close register detail goes here -->
            </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-sm btn-danger hiddenpr" data-dismiss="modal"><?=display('close')?></button>

         </div>
       </div>
    </div>
   </div>
<div id="confirm-delete" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
							
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body" id="">
                <p><?=display('deletion_confirmation')?></p>
                <p class="text-danger"><?=display('deletion_confirmation_regester')?></p>
                <div id="deletbtm_result"></div>
			</div>
			<div class="modal-footer justify-content-center fetchedeletebtm">
      
			   </div>
		</div>
	</div>
</div>
   <!-- /.Modal -->
<script src="<?=base_url();?>assets/js/Chart.min.js"></script>
<script type="text/javascript">
    var save_method; //for save method string
    var table;
    $(document).ready(function() {

      var xdirection = localStorage.getItem("dore-direction");
      $('.xdirection').val(xdirection);
      $('.xdirectionadv').val(xdirection);
      

      table = $('#table').DataTable({
        "language": {
            "url": "<?=base_url('files/ar_datatable.json')?>",
            "searchPlaceholder": " <?=display('search')?>  ",
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('registers/ajax_register/')?>",
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
      $('#confirm-delete').on('show.bs.modal', function (e) {
        var register_id = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'POST',
            url : '<?php echo site_url();?>/repports/deleteRegister/', 
            data :  'register_id='+ register_id,
            success : function(data){
            $('.fetchedeletebtm').html(data);
            $('#deletbtm_result').html('');
           
            }
        });
     });
    });
    function RegisterDetails(id) {
      $.ajax({
         url : "<?php echo site_url('repports/RegisterDetails')?>/"+id,
         type: "POST",
         success: function(data)
         {
            $('#RegisterDetails').html(data);
            $('#RegisterDetail').modal('show');
         },
         error: function (jqXHR, textStatus, errorThrown)
         {
             alert("error");
         }
      });
   }
   function deleteRegister(idReg){
    $.ajax({
            url : "<?php echo base_url('repports/deleteRegister/')?>"+idReg,
            type: "POST",
            dataType : "JSON",
            data: {},
            success: function(data)
            {
               $('#deletbtm_result').html(data.msg);
               if(data.delete == 'delete')
               {
                 table.ajax.reload();
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
</script>