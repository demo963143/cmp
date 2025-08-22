<div class="container-fluid">
    <!-- Modal delet -->
    <?php $this->load->view('tpl/delete_modal'); ?>


    <div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <?= display('add_user'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="basic-form">
                    <div class="modal-body">
                        <div id="savebtm_result" class="form-group text-success"></div>
                        <input type="hidden" name="idclt" id="idclt" value="">

                        <div class="form-group position-relative error-l-50">
                            <label><?= display('num'); ?></label>
                            <?PHP
                            $invID = str_pad($lastid + 1, 3, '0', STR_PAD_LEFT);
                            $numclt = 'US' . $invID;
                            ?>
                            <input type="text" class="form-control" placeholder="" name="num" id="num" autocomplete="off" value="<?= $numclt ?>" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label><?= display('name'); ?> <span class="text-danger error_lastname">*</span></label>
                            <input type="text" class="form-control" placeholder="" name="name" id="name" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label><?= display('email'); ?> <span class="text-danger error_lastname">*</span></label>
                            <input type="text" class="form-control" placeholder="" name="email " id="email" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label><?= display('password'); ?> <span class="text-danger error_lastname">*</span></label>
                            <input type="password" class="form-control" placeholder="" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label> <?= display('role'); ?> <span class="text-danger error_lastname">*</span> </label>
                            <select class="form-control" name="roleid" id="roleid">
                                <?PHP
                                foreach ($roles as $role) {
                                ?>
                                    <option value="<?= $role->id_role; ?>"><?= $role->name; ?></option>
                                <?PHP
                                }
                                ?>
                            </select>
                        </div>
                        <div class="error_validateclt text-danger"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?= display('close'); ?></button>
                        <button type="button" id="savebtn" onclick="savebtm()" class="btn btn-primary"><?= display('save'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade modal-right" id="updateclt" tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <?= display('update'); ?> </h5>
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
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?= display('close'); ?></button>
                        <button type="button" id="savebtn" onclick="updatebtm()" class="btn btn-primary"><?= display('save'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h1><?= display('user_list'); ?></h1>
            <nav class="breadcrumb-container mb-sm-0 mb-2 d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight"><i class="fa fa-plus"></i> <?= display('add_user'); ?> </button>
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
                                <th><?= display('num'); ?> </th>
                                <th><?= display('name'); ?> </th>
                                <th> <?= display('email'); ?> </th>
                                <th> <?= display('role'); ?> </th>
                                <th><?= display('action'); ?></th>

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
                "searchPlaceholder": " <?= display('search'); ?> ",
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('users/ajax_user/') ?>",
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
            var user_id = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(); ?>/users/delete/',
                data: 'user_id=' + user_id,
                success: function(data) {
                    $('.fetchedeletebtm').html(data);
                    $('#deletbtm_result').html('');

                }
            });
        });
        $('#updateclt').on('show.bs.modal', function(e) {
            var user_id = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(); ?>/users/update/',
                data: 'user_id=' + user_id,
                success: function(data) {
                    $('.fetcheupdate').html(data);
                }
            });
        });
        $('#email').change(function() {
            var email = $('#email').val();
            if (email != '') {
                $.ajax({
                    url: "<?= base_url(); ?>users/check_user/",
                    method: "POST",
                    data: {
                        email: email
                    },
                    success: function(data) {
                        $('.error_validateclt').html(data);
                    }
                });
            }
        });

    });
    var items = [];
    // delete user
    function deletebtm(idClt) {
        $.ajax({
            url: "<?php echo base_url('users/delete/') ?>" + idClt,
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
    // Add user
    function savebtm() {
        var num = $('#num').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var roleid = $('#roleid').val();
        if ((name != '') && (password != '') && (email != '')) {
            $.ajax({
                url: "<?php echo base_url('users/add') ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    num: num,
                    name: name,
                    email: email,
                    roleid: roleid,
                    password: password
                },
                success: function(data) {
                    if (data.add == 'add') {
                        $('#name').val('');
                        $('#email').val('');
                        $('#password').val('');
                        $('#savebtm_result').html(data.msg);
                        $('#num').val(data.lastid);
                        table.ajax.reload();
                        $('.sound2').get(0).play();

                    } else {
                        $('.sounderr').get(0).play();
                        $('.error_validateclt').html(data.msg);
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
    // update user
    function updatebtm() {
        var id = $('#idusup').val();
        var name = $('#nameup').val();
        var email = $('#emailup').val();
        var password = $('#passwordup').val();
        var old_password = $('#old_password').val();
        var roleid = $('#roleidup').val();
        if ((name != '') && (email != '')) {
            $.ajax({
                url: "<?php echo base_url('users/update_ajax') ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    name: name,
                    email: email,
                    password: password,
                    old_password: old_password,
                    roleid: roleid
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