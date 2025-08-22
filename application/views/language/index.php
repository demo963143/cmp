
<div class="container-fluid">
<!-- Modal delet -->
<?php $this->load->view('tpl/delete_modal');?>


<div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalRight" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h5 class="modal-title"> <?=display('add_language')?> </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                         <?=form_open_multipart('language/addlanguage');?>
                                        <div class="modal-body">
                                                <div id="savebtm_result" class="form-group text-success"></div>

                                                <div class="form-group">
                                                    <label> <?=display('language_name')?></label>
                                                    <input type="text" class="form-control" placeholder="" name="language" id="language" style="direction: ltr;">
                                                </div>
                                               
                                                
                                          <div class="error_validateclt text-danger"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal"><?=display('close')?></button>
                                            <button type="submit" id="savebtn"  onclick="savebtm()" class="btn btn-primary"><?=display('save')?></button>
                                        </div>
                                        <?=form_close();?>
                                    </div>
                                </div>
     </div>
    
    
            <div class="row">
                <div class="col-12">
                    <h1><?=display('languages_list');?></h1>
                    <nav class="breadcrumb-container d-lg-inline-block mb-sm-0 mb-0" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight"><i class="fa fa-plus"></i> Language</button>
                            </li>
                            <li class="breadcrumb-item">
                           
                            <a href="<?PHP echo base_url("language/phrase");?>"> <button type="button" name="pdfgen" value="pdfgen" class="btn btn-primary  mb-1"><?=display('phrases');?></button></a>
                            
                            </li>
                           
                        </ol>
                    </nav>
                    <div class="separator mb-1"></div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th width="5%">#</th>
          <th width="15%"><?=display('language');?></th>
          <th width="4%"><i class="glyph-icon simple-icon-settings"></i></th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($languages)) {?>
                        <?php $sl = 1 ?>
                        <?php foreach ($languages as $key => $language) {?>
                        <tr>
                            <td><?= $sl++ ?></td>
                            <td><?= $language ?></td>
                            <td>
                            <a href="<?= base_url("language/editPhrase/$key") ?>" class="btn btn-xs btn-primary"><i class="glyph-icon iconsminds-file-edit"></i></a> 
                            </td> 
                        </tr>
                        <?php } ?>
                    <?php } ?>
      </tbody>
 
    </table>
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>

  