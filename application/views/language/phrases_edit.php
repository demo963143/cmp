<div class="container-fluid">
<div class="row">
                <div class="col-12">
                    <nav class="breadcrumb-container d-lg-inline-block mb-sm-0 mb-2" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                      
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
             <?=form_open('language/addlebel') ?>
             <?=form_hidden('language', $language);?>
                        <div class="card-body">
                        <div class="table-header col-sm-12">
                           <div class="row">
                            <label class="col-sm-5" style="margin:2px 0;"> 
                              <button type="submit" class="btn btn-xs btn-success" id=""> <i class="ace-icon fa fa-refresh"></i> <?=display('save');?></button>
                               <button type="reset" class="btn btn-xs btn-danger" id=""> <i class="ace-icon fa fa-times"></i> <?=display('reset');?></button>
                              </label>
                            <div class="col-sm-5 mt-sm-0 mt-2"><h4><?=display('phrases_list');?></h4></div>
                        </div>
  </div> 
       <div class="m-2" style="overflow-x: auto;">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
            <th><i class="fa fa-th-list"></i></th>
                            <th><?=display('phrase');?></th>
                            <th><?=display('label');?></th> 
        </tr>
      </thead>
      <tbody>
       

                            <?php if (!empty($phrases)) {?>
                                <?php $sl = 1 ?>
                                <?php foreach ($phrases as $value) {?>
                                <tr class="<?= (empty($value->$language)?"bg-danger":null) ?>">
                                
                                    <td><?= $sl++ ?></td>
                                    <td><?= $value->phrase ?> <input style=" height: 25px; margin: 0px" type="hidden" name="phrase[]" value="<?= $value->phrase ?>" class="form-control"></td>
       <td><input style=" height: 25px; margin: 0px; width: 100%" type="text" name="lang[]" value="<?= $value->$language;?>" class="form-control"></td> 
                                </tr>
                                <?php } ?>
                            <?php } ?>
      
      </tbody>
      <tfoot>
        <tr>
        <td></td>
        <td></td>
        <td>
          <button type="submit" name="test" value="test" class="btn btn-xs btn-success"> <?=display('save');?></button>
       <button type="reset" class="btn btn-xs btn-danger"> <?=display('reset');?></button></td>
      </tr>
      </tfoot>
     
    </table>
       </div>
                         
                        </div>
        <?php echo form_close();?>
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
} );
    </script>