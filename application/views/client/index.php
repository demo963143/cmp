<div class="container-fluid">
    <!-- Modal delet -->
    <?php $this->load->view('tpl/delete_modal'); ?>
    <div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= display('add_new_customer') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation">
                    <div class="modal-body">
                        <div id="savebtm_result" class="form-group text-success"></div>
                        <input type="hidden" name="idclt" id="idclt" value="">

                        <div class="form-group position-relative error-l-50">
                            <label><?= display('num') ?> </label>
                            <?PHP
                            $invID = str_pad($lastid + 1, 3, '0', STR_PAD_LEFT);
                            $numclt = 'CL' . $invID;
                            ?>
                            <input type="text" class="form-control" placeholder="" name="num" id="num" autocomplete="off" value="<?= $numclt ?>" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label><?= display('first_name') ?> <span class="text-danger error_lastname">*</span></label>
                            <input type="text" class="form-control" placeholder="" name="lastname" id="lastname" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label><?= display('last_name') ?> <span class="text-danger error_firstname">*</span></label>
                            <input type="text" class="form-control" placeholder="" name="firstname" id="firstname" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label><?= display('phone') ?><span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="" name="phone" id="phone" autocomplete="off">
                            <span class="text-danger error" id="phoneError"></span>
                        </div>
                        <div class="form-group">
                            <label> <?= display('adress') ?></label>
                            <input type="text" class="form-control" placeholder="" name="adress" id="adress">
                        </div>
                        <div class="form-group">
                            <label> <?= display('discounts').' ('.settings()->currency?>)</label>
                            <input type="text" class="form-control" placeholder="" name="discount" id="discount">
                        </div>


                        <div class="error_validateclt text-danger"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?= display('close') ?></button>
                        <button type="button" id="savebtn" onclick="savebtm()" class="btn btn-primary"><?= display('save') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade modal-right" id="updateclt" tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <?= display('update') ?> </h5>
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
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?= display('close') ?></button>
                        <button type="button" id="savebtn" onclick="updatebtm()" class="btn btn-primary"><?= display('save') ?></button>
                    </div>
                </form>
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
                        <button type="submit" name="pdfgen" value="pdfgen" class="btn btn-primary  mb-1"><i class="glyph-icon simple-icon-printer"></i> <?= display('print') ?></button>

                    </li>
                    <li class="breadcrumb-item">
                        <input type="hidden" value="" class="xdirection" id="xdirection" name="xdirection">
                        <a href="<?=base_url('clients/send_sms')?>"><button type="button" class="btn btn-primary  mb-1"><i class="glyph-icon simple-icon-speech"></i> <?= display('sms') ?></button></a>

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

                    <table id="table" class="table">
                        <thead>
                            <tr>
                                <th> <?= display('num') ?></th>
                                <th><?= display('first_name') ?> </th>
                                <th><?= display('last_name') ?></th>
                                <th><?= display('phone') ?></th>
                                <th><?= display('adress') ?></th>
                                <th><?= display('total_transactions') ?></th>
                                <th><?= display('paid') ?></th>
                                <th><?= display('rest') ?></th>
                                <th><?= display('action') ?></th>

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
        var xdirection = localStorage.getItem("dore-direction");
        $('.xdirection').val(xdirection);

        table = $('#table').DataTable({
            "language": {
                "url": "<?php echo ($this->language == 'arabic') ? base_url('files/ar_datatable.json') : ''; ?>",
                "searchPlaceholder": " <?= display('search') . ' : ' . display('num') . ' , ' . display('name') ?>",
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('clients/ajax_client/') ?>",
                "type": "POST",
                "data": function(data) {},
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [-1], //last column
                "orderable": true, //set not orderable
            }, ],
            "bInfo": true,
            // "fnRowCallback": function(nRow, aData, iDisplayIndex) {
            //     nRow.setAttribute('data-order',aData[4]);
            // }
        });
        //Confirm deletion  modal 
        $('#confirm-delete').on('show.bs.modal', function(e) {
            var client_id = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(); ?>/clients/delete/',
                data: 'client_id=' + client_id,
                success: function(data) {
                    $('.fetchedeletebtm').html(data);
                    $('#deletbtm_result').html('');

                }
            });
        });
        $('#updateclt').on('show.bs.modal', function(e) {
            var client_id = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(); ?>/clients/update/',
                data: 'client_id=' + client_id,
                success: function(data) {
                    $('.fetcheupdate').html(data);
                }
            });
        });
    });
    var items = [];
    // delete customer
    function deletebtm(idClt) {
        $.ajax({
            url: "<?php echo base_url('clients/delete/') ?>" + idClt,
            type: "POST",
            dataType: "JSON",
            data: {},
            success: function(data) {
                $('#deletbtm_result').html(data.msg);
                if (data.delete == 'delete') {
                    table.ajax.reload();
                } else {
                    $('.sounderr').get(0).play();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("error");
            }
        });
    }
    // Add a customer
    function savebtm() {
        $('.error').text('');
        var num = $('#num').val();
        var phone = $('#phone').val().trim();
        var lastname = $('#lastname').val();
        var firstname = $('#firstname').val();
        var adress = $('#adress').val();
        var discount = $('#discount').val();
        const phoneRegex = /^\d{10}$/;
        if(!phoneRegex.test(phone) && phone.length!==10 ){
             $('#phoneError').text('Phone No. must be a valid 10-digit number');
             return;
        }
       
        if (lastname != '' && firstname != '' && phone!=='') {
            $.ajax({
                url: "<?php echo base_url('clients/add') ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    num: num,
                    phone: phone,
                    lastname: lastname,
                    firstname: firstname,
                    adress: adress,
                    discount: discount
                },
                success: function(data) {
                    $('#savebtm_result').html(data.msg);
                    if (data.add == 'add') {
                        $('#num').val('');
                        $('#phone').val('');
                        $('#lastname').val('');
                        $('#firstname').val('');
                        $('#adress').val('');
                        $('#discount').val('');
                        $('.sound2').get(0).play();
                        table.ajax.reload();
                    } else {
                        $('.sounderr').get(0).play();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("error");
                }
            });
        } else {
            $('.error_validateclt').html(' * <?= display('this_fieldis_required') ?>');
        }
    }
    // update
    function updatebtm() {
        var id = $('#idcltup').val();
        var num = $('#numup').val();
        var phone = $('#phoneup').val();
        var lastname = $('#lastnameup').val();
        var firstname = $('#firstnameup').val();
        var adress = $('#adressup').val();
        var discount = $('#discountup').val();

        if (lastname != '' && firstname != '') {
            $.ajax({
                url: "<?php echo base_url('clients/update_ajax') ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    num: num,
                    phone: phone,
                    lastname: lastname,
                    firstname: firstname,
                    adress: adress,
                    discount: discount
                },
                success: function(data) {
                    $('#updatebtm_result').html(data.msg);
                    if (data.update == 'update') {
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
        }
    }
</script>