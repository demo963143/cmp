<link rel="stylesheet" href="<?= base_url(); ?>assets/css/vendor/select2.min.css" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/vendor/select2-bootstrap.min.css" />

<style>
    .color_btn {
        padding: 8px 10px;
    }
</style>

<div class="container-fluid">
    <?= form_open_multipart('settings/index'); ?>
    <div class="row">
        <div class="col-12">
            <nav class="breadcrumb-container d-lg-inline-block mb-sm-0 mb-2" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('settings') ?>"><button type="button" class="btn btn-primary"> <?= display('general_settings'); ?> </button></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('language') ?>"><button type="button" class="btn btn-primary"><?= display('languages_list'); ?> </button></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('backup') ?>"><button type="button" class="btn btn-primary"><?= display('backup'); ?> </button></a>
                    </li>

                </ol>
            </nav>
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-5 col-lg-5 mb-4">
            <div class="card">

                <div class="card-body">
                    <h5 class="mb-4"><?= display('general_settings'); ?></h5>
                    <?PHP
                    if ($this->session->userdata('msg_success')) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show rounded mb-5" role="alert">
                            <?= $this->session->userdata('msg_success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?PHP
                    }
                    ?>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="storename"><?= display('storename'); ?></label>
                            <input type="text" class="form-control" id="storename" placeholder="" name="storename" value="<?= settings()->store_name ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="storeaddress"><?= display('adress'); ?></label>
                            <input type="text" class="form-control" id="storeaddress" name="storeaddress" value="<?= settings()->store_address ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="storephone"> <?= display('phone'); ?></label>
                            <input type="text" class="form-control" id="storephone" placeholder="" name="storephone" value="<?= settings()->store_phone ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="storeemail"><?= display('email'); ?></label>
                            <input type="text" class="form-control" id="storeemail" name="storeemail" value="<?= settings()->store_email ?>">
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="inputState"><?= display('language'); ?> </label>
                            <select id="language" class="form-control" name="language" disabled required>
                                <option><?= display('choose'); ?>...</option>
                                <?php
                                foreach ($languages as $key => $language) {
                                ?>
                                    <option <?PHP if ($key == settings()->language) echo 'selected'; ?> value="<?= $key; ?>"><?= $key; ?></option>
                                <?PHP
                                }
                                ?>
                            </select>
                        </div>
                        
                        
                       
                        
                        
                        
                        <div class="form-group col-md-6">
                            <label for="audioalert"><?= display('play_audio_alerts'); ?></label>
                            <select id="audioalert" class="form-control" name="audioalert">
                                <option <?PHP if (settings()->audio_alert == 1) echo 'selected'; ?> value="1" selected><?= display('yes'); ?></option>
                                <option <?PHP if (settings()->audio_alert == 0) echo 'selected'; ?> value="0"><?= display('no'); ?></option>
                            </select>
                        </div>
                        <hr />


                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="inputState"> <?= display('currency'); ?></label>
                            <select id="currency" name="currency" class="form-control select2-single" data-width="100%" data-height="20%" required>
                                <option value=""><?= display('choose'); ?>...</option>
                                <?php
                                foreach ($currencies as $currency) {
                                ?>
                                    <option <?PHP if ($currency->code == settings()->currency) echo 'selected'; ?> value="<?= $currency->code; ?>"><?= $currency->country . '(' . $currency->code . ')'; ?></option>
                                <?PHP
                                }
                                ?>
                            </select>
                            <button type="button" class="btn btn-primary default mt-2" data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight"> <?= display('add'); ?> <i class="glyph-icon simple-icon-plus"></i> </button>


                        </div>



                        <div class="form-group col-md-6">
                            <label for="storename"> <?= display('tax'); ?> (<?= display('default'); ?>)</label>
                            <input type="text" class="form-control" id="tax" placeholder="" name="tax" value="<?= settings()->tax ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="storeaddress"><?= display('discounts'); ?> (<?= display('default'); ?>) </label>
                            <input type="text" class="form-control" id="discount" name="discount" value="<?= settings()->discount ?>">
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 mb-4">
            <div class="card">

                <div class="card-body">
                    <img alt="Profile Picture" id="blah" src="<?= base_url('files/img/') . settings()->logo; ?>" class="mb-3" width="60%">
                    <br>
                    <label class="btn btn-outline-primary btn-upload" for="logo" title="Upload image file">
                        <input type="file" class="sr-only" id="logo" name="logo" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff" onchange="readURL(this);">
                        <?= display('logo'); ?>
                    </label>
                    <hr>
                    <label> <?= display('address_above_the_receipt'); ?> :</label>
                    <textarea class="form-control" name="receiptheader"><?= settings()->receiptheader; ?></textarea>
                    <hr>

                    <label> <?= display('warning'); ?> :</label>
                    <textarea class="form-control" name="receiptfooter"><?= settings()->receiptfooter; ?></textarea>
                    <hr>
                    <label> <?= display('message_of_thanks'); ?> :</label>
                    <textarea class="form-control" name="footer_text"><?= settings()->footer_text; ?></textarea>

                </div>

            </div>

        </div>
        <div class="col-xl-4 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4"><?= display('colors'); ?></h5>
                    <div class="row mb-2">
                        <div class="col-xl-4 col-lg-4">
                            <input type="color" class="form-control mb-2" id="getColor" name="getColor"  onchange="fetchColor()">
                        </div>
                        <input type="hidden" id="putColor">
                        
                        <div class="col-xl-4 col-lg-4">
                            <input type="text" class="form-control mb-2" id="nameColor" name="nameColor" placeholder="<?=display('name'); ?>">
                        </div>
                        
                        <div class="col-xl-3 col-lg-5">
                            <button type="button" class="btn btn-primary  text-center default mb-2 color_btn" onclick="saveColor()">
                            <?= display('add'); ?> <i class="glyph-icon simple-icon-plus"></i>
                            </button>
                        </div>
                        
                        
                        
                        
                    </div>
                    <div class="scroll dashboard-list-with-thumbs ps" style="max-height: 450px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><?=display('name'); ?></th>
                                    <th scope="col"><?=display('color'); ?></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="colorList">
                                <?PHP  
                                foreach($colors as $color)
                                {
                                ?>
                                <tr>
                                    <td><?=$color->name?></td>
                                    <td style="color:#ffffff;background-color:<?=$color->color?>;"><?=$color->color?></td>
                                    <td><a href="#" onclick="deletecColor(<?=$color->id?>)"><i class="glyph-icon simple-icon-trash"></i></a></td>
                                </tr>
                                <?PHP 
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 mb-4">
            <div class="card">
                <div class="card-body row">
                    <h5 class="mb-4 col-md-12"><?=display('sms'); ?> <?=display('settings'); ?></h5>
                    <div class="form-group col-md-6">
                                <label for="storename"> <?=display('sms_of_adding_the_order');?></label>
                                <textarea rows="5" class="form-control" id="tax" placeholder="" name="sms_add_order"><?=settings()->sms_add_order?></textarea>
                            </div>
                
                    <div class="form-group col-md-6">
                                <label for="storename"> <?=display('sms_when_order_is_ready');?></label>
                                <textarea rows="5" class="form-control" id="tax" placeholder="" name="sms_order_readyr"><?=settings()->sms_order_readyr ?></textarea>
                            </div>

                     <div class="form-group col-md-6">
                            <label for="storename">API (bulksmsnigeria)</label>
                            <input type="text" class="form-control" id="api_sms" placeholder="" name="api_sms" value="<?=settings()->api_sms;?>">
                     </div>
                     <div class="form-group col-md-6">
                            <label for="storename">senderId (bulksmsnigeria)</label>
                            <input type="text" class="form-control" id="api_sms" placeholder="" name="senderid" value="<?=settings()->senderId;?>">
                     </div>
                 </div>
                </div>
                <button type="submit" class="btn btn-primary d-block mt-3"><?= display('update'); ?> <?= display('settings'); ?></button>

            </div>
        </div>




    </div>
    <?= form_close(); ?>
</div>
<div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= display('create_currency'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation">
                <div class="modal-body">
                    <div id="savebtm_result" class="form-group text-success"></div>


                    <div class="form-group">
                        <label> <?= display('code'); ?> <span class="text-danger error_code">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="code" id="code" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label> <?= display('country'); ?> <span class="text-danger error_country">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="country" id="country" autocomplete="off">
                    </div>

                    <div class="error_validateclt text-danger"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?= display('cancel'); ?></button>
                    <button type="button" id="savebtn" onclick="savebtm()" class="btn btn-primary"><?= display('save'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function fetchColor()
    {
    var getColor = document.getElementById("getColor").value;
    document.getElementById("putColor").value = getColor;
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function savebtm() {
        var code = $('#code').val();
       
        var country = $('#country').val();
        if (code != '') {
            $.ajax({
                url: "<?php echo base_url('settings/addCurrency') ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    code: code,
                    country: country
                },
                success: function(data) {
                    $('#savebtm_result').html(data.msg);
                    $('#currency').load("<?php echo site_url('settings/load_Currencies/') ?>" + data.insertid);
                    $('#exampleModalRight').modal('toggle');
                    if (data.add == 'add') {
                        $('#code').val('');
                        $('#country').val('');
                        table.ajax.reload();
                        $('.sound2').get(0).play();
                    } else {
                        $('.sounderr').get(0).play();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("error");
                }
            });
        } else {
            $('.error_validateclt').html(' * <?= display('this_fieldis_required'); ?>');
        }
    }
    function saveColor() {
        var color = $('#putColor').val(); 
        var namecolor = $('#nameColor').val();
        if (namecolor != '') {
            $.ajax({
                url: "<?php echo base_url('settings/addColor') ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    namecolor: namecolor,
                    color: color
                },
                success: function(data) {
                    $('#savebtm_result').html(data.msg);
                    $('#colorList').load("<?php echo site_url('settings/load_colors/') ?>" );
                    if (data.add == 'add') {
                        $('#color').val('');
                        $('#putColor').val('');
                        $('#getColor').val('');
                    } else {
                        $('.sounderr').get(0).play();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("error");
                }
            });
        } else {
            $('.error_validateclt').html(' * <?= display('this_fieldis_required'); ?>');
        }
    }
    function deletecColor(idColor) {
        $.ajax({
            url: "<?php echo base_url('settings/deletecColor/') ?>" + idColor,
            type: "POST",
            dataType: "JSON",
            data: {},
            success: function(data) {
                $('#deletbtm_result').html(data.msg);
                $('#colorList').load("<?php echo site_url('settings/load_colors/') ?>" );
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });
    }
</script>