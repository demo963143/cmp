<div class="container-fluid">
<div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= display('add_new_sms') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('clients/send_sms'); ?>
                    <div class="modal-body">
                        <div id="savebtm_result" class="form-group text-success"></div>

                    
                        <div class="form-group">
                            <label><?= display('message') ?> <span class="text-danger error_lastname">*</span></label>
                            <textarea rows="4" class="form-control" name="msgsms" autocomplete="off" placeholder="message"></textarea>

                        </div>
                        <div class="error_validateclt text-danger"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?= display('close') ?></button>
                        <button type="submit" id="" name="sendmsgsms" value="sendmsgsms" class="btn btn-primary"><?= display('send') ?></button>
                    </div>
               <?php echo form_close(); ?>
                
            </div>
        </div>
    </div>
<div class="row">
        <?php echo form_open('clients'); ?>
        <div class="col-12">
            <h1><?= display('list_of_clients') ?></h1>
            <nav class="breadcrumb-container d-lg-inline-block mb-sm-0 mb-2" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight"><i class="fa fa-plus"></i> Customer</button>
                    </li>
                    <li class="breadcrumb-item">
                        <input type="hidden" value="" class="xdirection" id="xdirection" name="xdirection">
                        <button type="submit" name="pdfgen" value="pdfgen" class="btn btn-primary  mb-1"><i class="glyph-icon simple-icon-printer"></i> <?= display('print') ?> </button>

                    </li>
                    <li class="breadcrumb-item">
                        <input type="hidden" value="" class="xdirection" id="xdirection" name="xdirection">
                        <a href="<?=base_url('clients/send_sms')?>"><button type="button" class="btn btn-primary  mb-1"><i class="glyph-icon simple-icon-speech"></i> <?= display('sms') ?> </button></a>

                    </li>

                </ol>
            </nav>
            
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class="row mb-4">

        <div class="col-12 mb-4">
            <div class="card">

                <div class="card-body">
                <button type="button" class="btn btn-success btn-xs mb-1" data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight"><i class="fa fa-plus"></i>  <?= display('send_sms') ?> </button>
                    <?PHP 
                    if(isset($alert))
                    {
                       ?>
<div class="alert alert-success alert-dismissible fade show rounded mt-2" role="alert">
                            <?=$alert?>  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       <?PHP
                    }
                    ?>
                    <table class="table mt-4" id="example">
                    <thead>
                        <tr>
                        <th>id</th>
                        <th width="80%">message</th>
                        <th>date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?PHP
                    if($sms_list)
                    {
                        foreach($sms_list as $sms)
                        {
                    ?>
                        <tr>
                        <td><?=$sms->id?></td>
                        <td><?=$sms->message?></td>
                        <td><?=$sms->date_create?></td>
                        </tr>
                    <?PHP 
                        }
                    }
                    ?>
                        
                    </tbody>
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
} );
    </script>