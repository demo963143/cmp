<link rel="stylesheet" href="<?= base_url(); ?>assets/css/vendor/select2.min.css" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/vendor/select2-bootstrap.min.css" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/vendor/cropper.min.css" />
<div class="container-fluid">
    <?= form_open_multipart('settings/profile'); ?>
    <div class="row">


        <div class="col-xl-9 col-lg-9 mb-4">
            <div class="card">

                <div class="card-body">
                    <h3 style="font-size:21px;" class="mb-3"><?=display('account')?></h3>
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
                    if ($this->session->userdata('msg_error')) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show rounded mb-5" role="alert">
                            <?= $this->session->userdata('msg_error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?PHP
                    }
                    ?>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name"> <?=display('name')?></label>
                            <input type="text" class="form-control" id="name" placeholder="" name="name" value="<?= $user->name; ?>" required>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">  <?=display('email')?></label>
                            <input type="text" class="form-control" id="email" placeholder="" name="email" value="<?= $user->email; ?>" required>
                        </div>

                    </div>
                    <div class="form-row">
                        <hr />
                       <div class="col-md-12">
                        <label for="oldpassword" class="w-100"> <?=display('leave_this_field_blank')?></label>
                       </div>
                       
                        <div class="form-group col-md-6">
                            <label for="oldpassword"> <?=display('old_password')?></label>
                            <input type="hidden" name="old" value="<?= $user->password; ?>">
                            <input type="password" class="form-control" id="oldpassword" placeholder="" name="oldpassword" value="">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password"><?=display('new_password')?></label>
                            <input type="password" class="form-control" id="password" name="password" value="">
                        </div>
                    </div>





                    <button type="submit" class="btn btn-primary d-block mt-3"><?=display('update')?></button>

                </div>
            </div>
        </div>

    </div>

</div>
<?= form_close(); ?>
</div>