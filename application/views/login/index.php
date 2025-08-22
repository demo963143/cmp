<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title><?=display('log_in');?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="<?=base_url();?>assets/font/iconsmind-s/css/iconsminds.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/font/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/bootstrap.rtl.only.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/vendor/bootstrap-float-label.min.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/main.css" />
    
    <style>
        .form-side img {
            margin: -2rem auto 0px auto;
        }
        @media screen and (max-width: 767px) {
            /*form {*/
            /*    width: 14rem !important;*/
            /*}*/
        }
    </style>
    
</head>

<body class="background show-spinner no-footer">
	
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side">
                            <p class=" text-white h2"><?=display('laundry_management_software');?></p>

                        </div>
                        <div class="form-side">
                        <div class="text-center">
                            <img style="width:80%;" src="<?=base_url();?>assets/logos/logo2.png" alt="Notification Image"
                                        class="" />
                                        <!--<img style="width:8rem; margin-top:2rem; margin-left:-3rem; float:left; height:13rem;" src="<?=base_url();?>assets/logos/logo1.png" alt="Notification Image"-->
                                        <!--class="" />-->
                         
                        </div> 
                            <h4 class="mb-3 mt-3"><?=display('log_in');?></h4>

                            <?php 
                            if($this->session->userdata('error_msg')) 
                              {
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?=$this->session->userdata('error_msg')?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?PHP
                            }
                            ?>
                            <?=form_open('auth/index');?>
                                <label class="form-group has-float-label mb-4">
                                    <?=form_input(array('required' => 'required','class' => 'form-control','name' => 'email','id' => 'email'));?>
                                    <span><?=display('username');?></span>
                                </label>

                                <label class="form-group has-float-label mb-4">
                                    <?=form_input(array('required' => 'required','type' => 'password','class' => 'form-control','name' => 'password'));?>
                                    <span><?=display('password');?></span>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit"><?=display('log_in');?></button>
                                </div>
                             <?=form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
     var linkurl = '<?=base_url();?>/assets/css/';
    </script>
    
    <style>
        form{
            width : 100%;
        }
        
        .auth-card .form-side{
            padding:58px !important;
        }
        
        
        @media (max-width:575px) {
            .auth-card .form-side{
                padding:24px !important;
            }
            .form-side img {
                margin:0;
            }
        }
        
        
    </style>

    <script src="<?=base_url();?>assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?=base_url();?>assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url();?>assets/js/dore.script.js"></script>
    <script src="<?=base_url();?>assets/js/scripts.js"></script>
  
</body>

</html>