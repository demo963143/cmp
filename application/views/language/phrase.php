
<div class="container-fluid">
<!-- Modal delet -->
<?php $this->load->view('tpl/delete_modal');?>


<div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalRight" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><?=display('add_phrase');?> </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                         <?=form_open_multipart('language/addPhrase');?>
                                        <div class="modal-body">
                                                <div id="savebtm_result" class="form-group text-success"></div>

                                                <div class="form-group">
                                                    <label> <?=display('phrase_name');?></label>
                                                    <input type="text" class="form-control" placeholder="" name="phrase[]" id="addphrase" style="direction: ltr;">
                                                </div>
                                               
                                                
                                          <div class="error_validateclt text-danger"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal"><?=display('close');?></button>
                                            <button type="submit" name="savebtn" id="savebtn"  onclick="savebtm()" class="btn btn-primary"><?=display('save');?></button>
                                        </div>
                                        <?=form_close();?>
                                    </div>
                                </div>
     </div>
    
    
            <div class="row">
                <div class="col-12">
                    <nav class="breadcrumb-container d-lg-inline-block mb-sm-0 mb-2" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight"><i class="fa fa-plus"></i> Phrase</button>
                            </li>
                        <li class="breadcrumb-item">
                            <a href="<?=base_url('language')?>"><button type="button" class="btn btn-primary"><i class="glyph-icon simple-icon-list"></i> <?=display('languages_list');?> </button></a>
                            </li>
                            
                           
                           
                        </ol>
                    </nav>
                    
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
         <th><i class="fa fa-th-list"></i></th>
         <th><?=display('phrases');?></th> 
        </tr>
      </thead>
      <tbody>
       <?php if (!empty($phrases)) {?>
                        <?php $sl = 1 ?>
                        <?php foreach ($phrases as $value) {?>
                        <tr>
                            <td><?= $sl++ ?></td>
                            <td><?= $value->phrase ?></td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th><i class="fa fa-th-list"></i></th>
         <th><?=display('phrase');?></th>
        </tr>
      </tfoot>
    </table>
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>

   <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable({
        "language": {
            "searchPlaceholder": " <?=display('search')?>",
          },
       });
     });
    </script>